<?php namespace App\SoapServices\PlaceToPay;

use App\SoapServices\PlaceToPay\Types\Authentication;
use App\SoapServices\PlaceToPay\Types\Bank;
use App\SoapServices\PlaceToPay\Types\Person;
use App\SoapServices\PlaceToPay\Types\PSETransactionRequest;
use Illuminate\Support\Facades\Cache;
use SoapClient;

class PlaceToPayPSEService extends SoapClient
{
    private $wsdl = "https://test.placetopay.com/soap/pse?wsld";

    private static $classmap = [
        "Authentication" => Authentication::class,
        "Bank"           => Bank::class,
        "Person"         => Person::class,
        //        "CreditConcept"                        => "CreditConcept",
        //        "TransactionInformation"               => "Transaction",
    ];

    public function __construct()
    {
        $options = [];

        foreach ( self::$classmap as $wsdlClassName => $phpClassName ) {
            $options['classmap'][ $wsdlClassName ] = $phpClassName;
        }

        parent::__construct( $this->wsdl, $options );

        $this->__setLocation( $this->wsdl );
    }

    /**
     * Call: getBankList -> Obtiene la lista de bancos
     *
     * @return Bank[]
     */
    public function bankList()
    {
        return Cache::remember( 'banks', 1440, function () {
            $args = [
                'auth' => $this->getAuth()
            ];

            $result = $this->getBankList( $args );

            return $result->getBankListResult->item;
        } );
    }

    public function sendTransaction(PSETransactionRequest $transaction)
    {
        $args = [
            'auth' => $this->getAuth(),
            'transaction' => $transaction
        ];

        $result = $this->createTransaction( $args );

        return $result->createTransactionResult;
    }

    /**
     * @return Authentication
     */
    protected function getAuth()
    {
        $auth = new Authentication();

        return $auth;
    }

}