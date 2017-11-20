<?php namespace App\SoapServices\PlaceToPay;

use App\SoapServices\PlaceToPay\Types\Person;
use App\SoapServices\PlaceToPay\Types\PSETransactionRequest;

class TransactionBuilder
{
    /** @var string */
    protected $bankCode;

    /** @var string */
    protected $bankInterface;

    /** @var string */
    protected $returnURL;

    /** @var string */
    protected $reference;

    /** @var string */
    protected $description;

    /** @var string */
    protected $language;

    /** @var string */
    protected $currency;

    /** @var double */
    protected $totalAmount;

    /** @var double */
    protected $taxAmount;

    /** @var double */
    protected $devolutionBase;

    /** @var double */
    protected $tipAmount;

    /** @var Person */
    protected $payer;

    /** @var Person */
    protected $buyer;

    /** @var Person */
    protected $shipping;

    /** @var string */
    protected $ipAddress;

    /** @var string */
    protected $userAgent;

    /** @var static */
    private static $selfInstance;

    private function __construct()
    {
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->ipAddress = $_SERVER['REMOTE_ADDR'];
        $this->returnURL = 'http://prueba-ptp-pse/home';
        $this->language  = 'ES';
        $this->currency  = 'COP';
    }

    public static function newTransaction()
    {
        self::$selfInstance = new TransactionBuilder();

        return self::$selfInstance;
    }

    public static function currentTransaction()
    {
        self::$selfInstance = session()->has('transaction') ? session()->get('transaction')[0] : null;

        if ( null == self::$selfInstance ) {
            self::$selfInstance = new TransactionBuilder();
        }

        return self::$selfInstance;
    }

    public function complete()
    {
        return new PSETransactionRequest(
            $this->bankCode,
            $this->bankInterface,
            $this->returnURL,
            $this->reference,
            $this->description,
            $this->language,
            $this->currency,
            $this->totalAmount,
            $this->taxAmount,
            $this->devolutionBase,
            $this->tipAmount,
            $this->payer,
            $this->buyer,
            $this->shipping,
            $this->ipAddress,
            $this->userAgent,
            []
        );
    }

    /**
     * @param string $bankCode
     */
    public function setBankCode( $bankCode )
    {
        $this->bankCode = $bankCode;

        $this->updateSession();
    }

    /**
     * @param string $bankInterface
     */
    public function setBankInterface( $bankInterface )
    {
        $this->bankInterface = $bankInterface;

        $this->updateSession();
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference( $reference )
    {
        $this->reference = $reference;

        $this->updateSession();
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription( $description )
    {
        $this->description = $description;

        $this->updateSession();
    }

    /**
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param float $totalAmount
     */
    public function setTotalAmount( $totalAmount )
    {
        $this->totalAmount = $totalAmount;

        $this->updateSession();
    }

    /**
     * @param float $taxAmount
     */
    public function setTaxAmount( $taxAmount )
    {
        $this->taxAmount = $taxAmount;

        $this->updateSession();
    }

    /**
     * @param float $devolutionBase
     */
    public function setDevolutionBase( $devolutionBase )
    {
        $this->devolutionBase = $devolutionBase;

        $this->updateSession();
    }

    /**
     * @param float $tipAmount
     */
    public function setTipAmount( $tipAmount )
    {
        $this->tipAmount = $tipAmount;

        $this->updateSession();
    }

    /**
     * @param Person $payer
     */
    public function setPayer( $payer )
    {
        $this->payer = $payer;
        $this->buyer = $payer;
        $this->shipping = $payer;

        $this->updateSession();
    }

    protected function updateSession(){
        session()->push('transaction', self::$selfInstance);
    }

}