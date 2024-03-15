<?php

namespace Hasanbasri1993\BsiSmartBilling\Commands;

use Hasanbasri1993\BsiSmartBilling\BsiSmartBilling;
use Illuminate\Console\Command;

class BsiSmartBillingCommand extends Command
{
    public $signature = 'bsi-smart-billing {trx-id}';

    public $description = 'Check detail of transaction by trx-id.';

    public function handle(): int
    {
        $this->info(json_encode(BsiSmartBilling::detail($this->argument('trx-id')), JSON_PRETTY_PRINT));
        return self::SUCCESS;
    }
}
