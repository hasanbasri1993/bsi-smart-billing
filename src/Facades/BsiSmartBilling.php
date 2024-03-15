<?php

namespace Hasanbasri1993\BsiSmartBilling\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hasanbasri1993\BsiSmartBilling\BsiSmartBilling
 */
class BsiSmartBilling extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Hasanbasri1993\BsiSmartBilling\BsiSmartBilling::class;
    }
}
