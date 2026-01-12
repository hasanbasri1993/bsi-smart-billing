<?php

namespace Hasanbasri1993\BsiSmartBilling\Commands;

use Hasanbasri1993\BsiSmartBilling\Service\BPIWeb;
use Illuminate\Console\Command;

class BsiSmartBillingSwitchingPayment extends Command
{
    public $signature = 'bsi:switching-payment 
        {nomor_pembayaran? : Nomor pembayaran}
        {total_nominal? : Total nominal pembayaran}
        {catatan? : Catatan pembayaran}';

    public $description = 'Process switching payment for tagihan.';

    public function handle(): int
    {
        $nomorPembayaran = $this->argument('nomor_pembayaran') 
            ?? $this->ask('Masukkan nomor pembayaran');

        if (empty($nomorPembayaran)) {
            $this->error('Nomor pembayaran is required.');
            return self::FAILURE;
        }

        $totalNominal = $this->argument('total_nominal') 
            ?? $this->ask('Masukkan total nominal');

        if (empty($totalNominal) || !is_numeric($totalNominal)) {
            $this->error('Total nominal is required and must be numeric.');
            return self::FAILURE;
        }

        $catatan = $this->argument('catatan') 
            ?? $this->ask('Masukkan catatan (optional)', '');

        $this->info("Processing payment...");
        $this->table(
            ['Field', 'Value'],
            [
                ['Nomor Pembayaran', $nomorPembayaran],
                ['Total Nominal', number_format((int) $totalNominal, 0, ',', '.')],
                ['Catatan', $catatan ?: '-'],
            ]
        );

        if (!$this->argument('nomor_pembayaran') && !$this->confirm('Proceed with payment?', true)) {
            $this->warn('Payment cancelled.');
            return self::SUCCESS;
        }

        $result = BPIWeb::switchingPayment($nomorPembayaran, (int) $totalNominal, $catatan);

        $this->newLine();
        $this->info('Result:');
        $this->line(json_encode($result->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return self::SUCCESS;
    }
}
