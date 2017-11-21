<?php namespace App\SoapServices\PlaceToPay\Types;

class PSETransactionResponse
{

    /** @var  string */
    protected $returnCode;

    /** @var  string */
    protected $bankURL;

    /** @var  string */
    protected $trazabilityCode;

    /** @var  integer */
    protected $transactionCycle;

    /** @var  integer */
    protected $transactionID;

    /** @var  string */
    protected $sessionID;

    /** @var  string */
    protected $bankCurrency;

    /** @var  double */
    protected $bankFactor;

    /** @var  integer */
    protected $responseCode;

    /** @var  string */
    protected $responseReasonCode;

    /** @var  string */
    protected $responseReasonText;

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
    public function getBankURL(): string
    {
        return $this->bankURL;
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
     * @return int
     */
    public function getTransactionID(): int
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
    public function getBankCurrency(): string
    {
        return $this->bankCurrency;
    }

    /**
     * @return float
     */
    public function getBankFactor(): float
    {
        return $this->bankFactor;
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