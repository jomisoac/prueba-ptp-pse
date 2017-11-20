<?php namespace App\SoapServices\PlaceToPay\Types;

class Bank
{
    /** @var  string  */
    protected $bankCode;

    /** @var  string */
    protected $bankName;

    /**
     * @return string
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }
}