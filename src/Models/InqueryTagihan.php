<?php

namespace Hasanbasri1993\BsiSmartBilling\Models;

class InqueryTagihan
{
    private bool $success;

    private string $status;

    private string $msg;

    private string $function;

    private string $tsReq;

    private string $tsResp;

    private string $reqId;

    // Data fields
    private string $namaInstitusi;

    private string $nomorPembayaran;

    private string $nama;

    private string $informasi;

    private int $nominal;

    private string $rcIso;

    private string $msgIso;

    private string $msgBiller;

    public function __construct(array $response)
    {
        $this->success = ($response['status'] ?? '') === 'OK' && ! empty($response['data']);
        $this->status = $response['status'] ?? '';
        $this->msg = $response['msg'] ?? '';
        $this->function = $response['function'] ?? '';
        $this->tsReq = $response['ts_req'] ?? '';
        $this->tsResp = $response['ts_resp'] ?? '';
        $this->reqId = $response['req_id'] ?? '';

        // Parse data fields
        $data = $response['data'] ?? [];
        $this->namaInstitusi = $data['nama_institusi'] ?? '';
        $this->nomorPembayaran = $data['nomor_pembayaran'] ?? '';
        $this->nama = $data['nama'] ?? '';
        $this->informasi = $data['informasi'] ?? '';
        $this->nominal = (int) ($data['nominal'] ?? 0);
        $this->rcIso = $data['rc_iso'] ?? '';
        $this->msgIso = $data['msg_iso'] ?? '';
        $this->msgBiller = $data['msg_biller'] ?? '';
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMsg(): string
    {
        return $this->msg;
    }

    public function getFunction(): string
    {
        return $this->function;
    }

    public function getTsReq(): string
    {
        return $this->tsReq;
    }

    public function getTsResp(): string
    {
        return $this->tsResp;
    }

    public function getReqId(): string
    {
        return $this->reqId;
    }

    public function getNamaInstitusi(): string
    {
        return $this->namaInstitusi;
    }

    public function getNomorPembayaran(): string
    {
        return $this->nomorPembayaran;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getInformasi(): string
    {
        return $this->informasi;
    }

    public function getNominal(): int
    {
        return $this->nominal;
    }

    public function getRcIso(): string
    {
        return $this->rcIso;
    }

    public function getMsgIso(): string
    {
        return $this->msgIso;
    }

    public function getMsgBiller(): string
    {
        return $this->msgBiller;
    }

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'status' => $this->status,
            'msg' => $this->msg,
            'function' => $this->function,
            'ts_req' => $this->tsReq,
            'ts_resp' => $this->tsResp,
            'req_id' => $this->reqId,
            'data' => [
                'nama_institusi' => $this->namaInstitusi,
                'nomor_pembayaran' => $this->nomorPembayaran,
                'nama' => $this->nama,
                'informasi' => $this->informasi,
                'nominal' => $this->nominal,
                'rc_iso' => $this->rcIso,
                'msg_iso' => $this->msgIso,
                'msg_biller' => $this->msgBiller,
            ],
        ];
    }
}
