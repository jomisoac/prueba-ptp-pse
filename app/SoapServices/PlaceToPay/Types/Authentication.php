<?php namespace App\SoapServices\PlaceToPay\Types;

class Authentication
{
    /** @var  string */
    protected $login;

    /** @var  string */
    protected $tranKey;

    /** @var  string */
    protected $seed;

    public $additional;

    /**
     * Authentication constructor.
     */
    public function __construct()
    {
        $this->login = env('PTP_PSE_ID');
        $this->seed = date('c');
        $this->tranKey = sha1( $this->seed. env('PTP_PSE_KEY') , false );
    }
}