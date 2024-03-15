<?php

namespace Hasanbasri1993\BsiSmartBilling\Commands;

use Illuminate\Console\Command;

class BsiSmartBillingCommand extends Command
{
    public $signature = 'bsi-smart-billing';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
