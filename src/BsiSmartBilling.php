<?php

namespace Hasanbasri1993\BsiSmartBilling;

class BsiSmartBilling
{
    public Configurator $bsiSmartBillingConfig;
    public Client $bsiSmartBillingClient;

    public function __construct()
    {
        $this->bsiSmartBillingConfig =
            Configurator::getDefaultConfiguration()
                ->setUrl(config('bsi-smart-billing.url'))
                ->setClientId(config('bsi-smart-billing.client_id'))
                ->setClientSecret(config('bsi-smart-billing.client_secret'));

        $this->bsiSmartBillingClient = new Client($this->bsiSmartBillingConfig);
    }

    public function detail($invoiceNumber): string
    {
        $parameterData = Parameter::getDefaultConfiguration()
            ->setTrxId($invoiceNumber);
        return $this->bsiSmartBillingClient->inquiryBilling($parameterData);
    }

    public function create(Parameter $parameter): string
    {
        return $this->bsiSmartBillingClient->createBilling($parameter);
    }

    public function update(Parameter $parameter): string
    {
        return $this->bsiSmartBillingClient->updateBilling($parameter);
    }


}
