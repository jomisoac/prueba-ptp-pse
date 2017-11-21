<?php namespace App\SoapServices\PlaceToPay\Types;

class TransactionInformation
{
    /** @var  string */
    protected $transactionID;

    /** @var  string */
    protected $sessionID;

    /** @var  string */
    protected $reference;

    /** @var  string */
    protected $requestDate;

    /** @var  string */
    protected $bankProcessDate;

    /** @var  boolean */
    protected $onTest;

    /** @var  string */
    protected $returnCode;

    /** @var  string */
    protected $trazabilityCode;

    /** @var  integer */
    protected $transactionCycle;

    /** @var  string */
    protected $transactionState;

    /** @var  integer */
    protected $responseCode;

    /** @var  string */
    protected $responseReasonCode;

    /** @var  string */
    protected $responseReasonText;

    /**
     * @return string
     */
    public function getTransactionID(): string
    {
        return $this->transactionID;
    }

    /**
     * @return string
     */
    public function getSessionID(): string
    {
        return $this->sessionID;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getRequestDate(): string
    {
        return $this->requestDate;
    }

    /**
     * @return string
     */
    public function getBankProcessDate(): string
    {
        return $this->bankProcessDate;
    }

    /**
     * @return bool
     */
    public function isOnTest(): bool
    {
        return $this->onTest;
    }

    /**
     * @return string
     */
    public function getReturnCode(): string
    {
        return $this->returnCode;
    }

    /**
     * @return string
     */
    public function getTrazabilityCode(): string
    {
        return $this->trazabilityCode;
    }

    /**
     * @return int
     */
    public function getTransactionCycle(): int
    {
        return $this->transactionCycle;
    }

    /**
     * @return string
     */
    public function getTransactionState(): string
    {
        return $this->transactionState;
    }

    /**
     * @return int
     */
    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    /**
     * @return string
     */
    public function getResponseReasonCode(): string
    {
        return $this->responseReasonCode;
    }

    /**
     * @return string
     */
    public function getResponseReasonText(): string
    {
        return $this->responseReasonText;
    }
}