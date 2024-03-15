<?php

namespace Hasanbasri1993\BsiSmartBilling;

class BsiSmartBilling
{

    public static function connectClient(): Client
    {
        $bsiSmartBillingConfig =
            Configurator::getDefaultConfiguration()
                ->setUrl(config('bsi-smart-billing.url'))
                ->setClientId(config('bsi-smart-billing.client_id'))
                ->setClientSecret(config('bsi-smart-billing.client_secret'));

        return new Client($bsiSmartBillingConfig);
    }

    public static function detail($invoiceNumber)
    {
        $parameterData = Parameter::getDefaultConfiguration()
            ->setTrxId($invoiceNumber);
        return self::connectClient()->inquiryBilling($parameterData);
    }

    public static function create(Parameter $parameter): string
    {
        return self::connectClient()->createBilling($parameter);
    }

    public static function update(Parameter $parameter): string
    {
        return self::connectClient()->updateBilling($parameter);
    }
}
