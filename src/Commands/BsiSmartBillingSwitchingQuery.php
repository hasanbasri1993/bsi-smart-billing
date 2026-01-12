<?php

namespace Hasanbasri1993\BsiSmartBilling\Commands;

use Hasanbasri1993\BsiSmartBilling\Service\BPIWeb;
use Illuminate\Console\Command;

class BsiSmartBillingSwitchingQuery extends Command
{
    public $signature = 'bsi:switching-query {nomor_pembayaran? : Nomor pembayaran to query}';

    public $description = 'Query tagihan using switching inquiry.';

    public function handle(): int
    {
        $nomorPembayaran = $this->argument('nomor_pembayaran') 
            ?? $this->ask('Masukkan nomor pembayaran');

        if (empty($nomorPembayaran)) {
            $this->error('Nomor pembayaran is required.');
            return self::FAILURE;
        }

        $this->info("Querying tagihan for: {$nomorPembayaran}...");

        $result = BPIWeb::inqueryTagihan($nomorPembayaran);

        $this->newLine();
        $this->info('Result:');
        $this->line(json_encode($result->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return self::SUCCESS;
    }
}
