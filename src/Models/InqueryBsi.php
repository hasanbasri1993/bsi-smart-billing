<?php

namespace Hasanbasri1993\BsiSmartBilling\Models;

class InqueryBsi
{
    private string $client_id;

    private string $trx_id;

    private int $trx_amount;

    private string $virtual_account;

    private string $customer_name;

    private string $customer_phone;

    private string $customer_email;

    private string $datetime_created;

    private string $datetime_expired;

    private string $datetime_last_updated;

    private string $datetime_payment;

    private string $payment_ntb;

    private int $payment_amount;

    private string $va_status;

    private string $billing_type;

    private string $description;

    private string $minimal_payment;

    private array $info;

    private string $datetime_created_iso8601;

    private string $datetime_expired_iso8601;

    private string $datetime_last_updated_iso8601;

    private string $datetime_payment_iso8601;

    public function __construct(array $data)
    {
        $this->client_id = $data['client_id'];
        $this->trx_id = $data['trx_id'];
        $this->trx_amount = $data['trx_amount'];
        $this->virtual_account = $data['virtual_account'];
        $this->customer_name = $data['customer_name'];
        $this->customer_phone = $data['customer_phone'];
        $this->customer_email = $data['customer_email'];
        $this->datetime_created = $data['datetime_created'];
        $this->datetime_expired = $data['datetime_expired'];
        $this->datetime_last_updated = $data['datetime_last_updated'];
        $this->datetime_payment = $data['datetime_payment'];
        $this->payment_ntb = $data['payment_ntb'];
        $this->payment_amount = $data['payment_amount'];
        $this->va_status = $data['va_status'];
        $this->billing_type = $data['billing_type'];
        $this->description = $data['description'];
        $this->minimal_payment = $data['minimal_payment'];
        $this->info = $data['info'];
        $this->datetime_created_iso8601 = $data['datetime_created_iso8601'];
        $this->datetime_expired_iso8601 = $data['datetime_expired_iso8601'];
        $this->datetime_last_updated_iso8601 = $data['datetime_last_updated_iso8601'];
        $this->datetime_payment_iso8601 = $data['datetime_payment_iso8601'];
    }

    public function getClientId(): string
    {
        return $this->client_id;
    }

    public function getTrxId(): string
    {
        return $this->trx_id;
    }

    public function getTrxAmount(): int
    {
        return $this->trx_amount;
    }

    public function getVirtualAccount(): string
    {
        return $this->virtual_account;
    }

    public function getCustomerName(): string
    {
        return $this->customer_name;
    }

    public function getCustomerPhone(): string
    {
        return $this->customer_phone;
    }

    public function getCustomerEmail(): string
    {
        return $this->customer_email;
    }

    public function getDatetimeCreated(): string
    {
        return $this->datetime_created;
    }

    public function getDatetimeExpired(): string
    {
        return $this->datetime_expired;
    }

    public function getDatetimeLastUpdated(): string
    {
        return $this->datetime_last_updated;
    }

    public function getDatetimePayment(): string
    {
        return $this->datetime_payment;
    }

    public function getPaymentNtb(): string
    {
        return $this->payment_ntb;
    }

    public function getPaymentAmount(): int
    {
        return $this->payment_amount;
    }

    public function getVaStatus(): string
    {
        return $this->va_status;
    }

    public function getBillingType(): string
    {
        return $this->billing_type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMinimalPayment(): string
    {
        return $this->minimal_payment;
    }

    public function getInfo(): array
    {
        return $this->info;
    }

    public function getDatetimeCreatedIso8601(): string
    {
        return $this->datetime_created_iso8601;
    }

    public function getDatetimeExpiredIso8601(): string
    {
        return $this->datetime_expired_iso8601;
    }

    public function getDatetimeLastUpdatedIso8601(): string
    {
        return $this->datetime_last_updated_iso8601;
    }

    public function getDatetimePaymentIso8601(): string
    {
        return $this->datetime_payment_iso8601;
    }
}
