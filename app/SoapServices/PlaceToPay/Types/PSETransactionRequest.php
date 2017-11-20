<?php namespace App\SoapServices\PlaceToPay\Types;

class PSETransactionRequest
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

    protected $additionalData;

    /**
     * PSETransactionRequest constructor.
     *
     * @param string $bankCode
     * @param string $bankInterface
     * @param string $returnURL
     * @param string $reference
     * @param string $description
     * @param string $language
     * @param string $currency
     * @param float $totalAmount
     * @param float $taxAmount
     * @param float $devolutionBase
     * @param float $tipAmount
     * @param Person $payer
     * @param Person $buyer
     * @param Person $shipping
     * @param string $ipAddress
     * @param string $userAgent
     * @param $additionalData
     */
    public function __construct( $bankCode, $bankInterface, $returnURL, $reference, $description, $language, $currency, $totalAmount, $taxAmount, $devolutionBase, $tipAmount, Person $payer, Person $buyer, Person $shipping, $ipAddress, $userAgent, $additionalData )
    {
        $this->bankCode       = $bankCode;
        $this->bankInterface  = $bankInterface;
        $this->returnURL      = $returnURL;
        $this->reference      = $reference;
        $this->description    = $description;
        $this->language       = $language;
        $this->currency       = $currency;
        $this->totalAmount    = $totalAmount;
        $this->taxAmount      = $taxAmount;
        $this->devolutionBase = $devolutionBase;
        $this->tipAmount      = $tipAmount;
        $this->payer          = $payer;
        $this->buyer          = $buyer;
        $this->shipping       = $shipping;
        $this->ipAddress      = $ipAddress;
        $this->userAgent      = $userAgent;
        $this->additionalData = $additionalData;
    }


}