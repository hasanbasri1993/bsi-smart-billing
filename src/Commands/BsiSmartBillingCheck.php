<?php

namespace Hasanbasri1993\BsiSmartBilling\Commands;

use Hasanbasri1993\BsiSmartBilling\BsiSmartBilling;
use Illuminate\Console\Command;

class BsiSmartBillingCheck extends Command
{
    public $signature = 'bsi:check {trx_id? : Transaction ID to check}';

    public $description = 'Check detail of transaction by trx-id.';

    public function handle(): int
    {
        $trxId = $this->argument('trx_id') 
            ?? $this->ask('Masukkan Transaction ID');

        if (empty($trxId)) {
            $this->error('Transaction ID is required.');
            return self::FAILURE;
        }

        $this->info("Checking transaction: {$trxId}...");

        $result = BsiSmartBilling::detail($trxId);

        $this->newLine();
        $this->info('Result:');
        $this->line(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return self::SUCCESS;
    }
}
