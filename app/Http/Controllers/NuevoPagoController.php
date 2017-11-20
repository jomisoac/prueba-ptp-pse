<?php

namespace App\Http\Controllers;

use App\SoapServices\PlaceToPay\PlaceToPayPSEService;
use App\SoapServices\PlaceToPay\TransactionBuilder;
use App\SoapServices\PlaceToPay\Types\Person;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NuevoPagoController extends Controller
{
    private $ptp_pse;

    /**
     * NuevoPagoController constructor.
     *
     * @param $ptp_pse
     */
    public function __construct( PlaceToPayPSEService $ptp_pse )
    {
        $this->middleware( 'auth' );

        $this->ptp_pse = $ptp_pse;
    }

    public function checkInfoPago()
    {
        $user                = Auth::user();
        $payer               = new Person();
        $payer->document     = $user->document;
        $payer->documentType = $user->documentType;
        $payer->firstName    = $user->name;
        $payer->address      = $user->address;
        $payer->city         = $user->city;
        $payer->province     = $user->province;
        $payer->country      = $user->country;
        $payer->emailAddress = $user->email;
        $payer->mobile       = $user->mobile;
        $payer->phone        = $user->phone;
        $payer->company      = $user->company;

        session()->forget('transaction');

        $transaction = TransactionBuilder::currentTransaction();

        $transaction->setPayer( $payer );

        return view( 'info-pago', ['transaction' => $transaction]);
    }

    public function confirmInfoPago( Request $request )
    {
        $this->validate( $request, [
            'totalAmount' => [ 'required' ],
            'reference'   => [ 'required' ],
            'description' => [ 'required' ],
            //            'totalAmount' => ['required'],
            //            'totalAmount' => ['required'],
        ] );

        $data = $request->input();

        $transaction = TransactionBuilder::currentTransaction();

        $transaction->setTotalAmount($data['totalAmount']);
        $transaction->setReference($data['reference']);
        $transaction->setDescription($data['description']);

        return $this->getBancos();
    }

    public function getBancos()
    {
        $bancos = $this->ptp_pse->bankList();

        return view( 'bancos-list', [ 'bancos' => $bancos ] );
    }

    public function createTransaction( Request $request )
    {
        $this->validate( $request, [
            'bankCode'  => [ 'required', 'not_in:0' ],
            'bankInterface' => [ 'required' ]
        ], [
            'bank_ode.required'  => 'Debes seleccionar tu banco',
            'bank_ode.not_in'    => 'Debes seleccionar tu banco',
            'bankInterface.required' => 'Debes seleccionar una opción',
        ] );

        $data = $request->input();

        $transaction = TransactionBuilder::currentTransaction();
        $transaction->setBankCode($data['bankCode']);
        $transaction->setBankInterface($data['bankInterface']);

        $result = $this->ptp_pse->sendTransaction($transaction->complete());

        if($result->returnCode == 'SUCCESS'){
            $transaction = Transaction::create([
                'transactionID' => $result->transactionID,
                'reference' => $transaction->getReference(),
                'description' => $transaction->getDescription(),
                'totalAmount' => $transaction->getTotalAmount(),
                'user_id' => Auth::user()->id,
            ]);

            if($transaction){
                return redirect()->away($result->bankURL);
            } else {
                return view('error-transaction', ['responseReasonText' => 'No se pudo almacenar la transacción en la base de datos ']);
            }
        } else {
            return view('error-transaction', ['responseReasonText' => $result->responseReasonText]);
        }
    }
}
