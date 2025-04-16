<?php

namespace OpenPayments\Models;

class OutgoingPayment
{
    public string $id;

    public string $walletAddress;

    public ?string $quoteId;

    public ?bool $failed;

    public string $receiver;

    public Amount $receiveAmount;

    public Amount $debitAmount;

    public Amount $sentAmount;

    public ?Amount $grantSpentDebitAmount;

    public ?Amount $grantSpentReceiveAmount;

    public ?array $metadata;

    public string $createdAt;

    public string $updatedAt;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->walletAddress = $data['walletAddress'] ?? '';
        $this->quoteId = $data['quoteId'] ?? '';
        $this->failed = $data['failed'] ?? null;
        $this->receiver = $data['receiver'] ?? '';

        $this->receiveAmount = isset($data['receiveAmount'])
            ? new Amount(
                (string) $data['receiveAmount']['value'],
                (string) $data['receiveAmount']['assetCode'],
                (int) $data['receiveAmount']['assetScale']
            )
            : null;

        $this->debitAmount = isset($data['debitAmount'])
            ? new Amount(
                (string) $data['debitAmount']['value'],
                (string) $data['debitAmount']['assetCode'],
                (int) $data['debitAmount']['assetScale']
            )
            : null;

        $this->sentAmount = isset($data['sentAmount'])
            ? new Amount(
                (string) $data['sentAmount']['value'],
                (string) $data['sentAmount']['assetCode'],
                (int) $data['sentAmount']['assetScale']
            )
            : null;

        $this->grantSpentDebitAmount = isset($data['grantSpentDebitAmount'])
            ? new Amount(
                (string) $data['grantSpentDebitAmount']['value'],
                (string) $data['grantSpentDebitAmount']['assetCode'],
                (int) $data['grantSpentDebitAmount']['assetScale']
            )
            : null;

        $this->grantSpentReceiveAmount = isset($data['grantSpentReceiveAmount'])
            ? new Amount(
                (string) $data['grantSpentReceiveAmount']['value'],
                (string) $data['grantSpentReceiveAmount']['assetCode'],
                (int) $data['grantSpentReceiveAmount']['assetScale']
            )
            : null;

        $this->metadata = $data['metadata'] ?? [];
        $this->createdAt = $data['createdAt'] ?? '';
        $this->updatedAt = $data['updatedAt'] ?? '';
    }

    /**
     * Convert the model to an associative array.
     */
    public function toArray(): array
    {
        $response = [
            'id' => $this->id,
            'walletAddress' => $this->walletAddress,
        ];
        if ($this->quoteId) {
            $response['quoteId'] = $this->quoteId;
        }
        if ($this->failed) {
            $response['failed'] = $this->failed;
        }
        $response['receiver'] = $this->receiver;
        $response['receiveAmount'] = $this->receiveAmount->toArray();
        $response['debitAmount'] = $this->debitAmount->toArray();
        $response['sentAmount'] = $this->sentAmount->toArray();

        if ($this->grantSpentDebitAmount) {
            $response['grantSpentDebitAmount'] = $this->grantSpentDebitAmount->toArray();
        }
        if ($this->grantSpentReceiveAmount) {
            $response['grantSpentReceiveAmount'] = $this->grantSpentReceiveAmount->toArray();
        }
        if (! empty($this->metadata)) {
            $response['metadata'] = $this->metadata;
        }

        $response['createdAt'] = $this->createdAt;
        $response['updatedAt'] = $this->updatedAt;

        return $response;
    }
}
