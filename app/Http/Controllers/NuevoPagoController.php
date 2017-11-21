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
        session()->forget('transaction');

        return view( 'info-pago', ['user' => Auth::user()]);
    }

    public function confirmInfoPago( Request $request )
    {
        $this->validate( $request, [
            'totalAmount'  => 'required',
            'reference'    => 'required',
            'firstName'    => 'required',
            'description'  => 'required',
            'document'     => 'required',
            'documentType' => 'required',
            'emailAddress' => 'required|email'
        ] );

        $data = $request->input();

        $payer = new Person();

        $fields = [
            'firstName',
            'document',
            'documentType',
            'emailAddress',
            'firstName',
            'address',
            'city',
            'province',
            'country',
            'email',
            'mobile',
            'phone',
            'company'
        ];
        foreach ( $fields as $field ) {
            $payer->$field = !empty( $data[ $field ] ) ? $data[ $field ] : null;
        }

        $transaction = TransactionBuilder::currentTransaction();

        $transaction->setPayer( $payer );
        $transaction->setTotalAmount( $data['totalAmount'] );
        $transaction->setReference( $data['reference'] );
        $transaction->setDescription( $data['description'] );

        $bancos = $this->ptp_pse->bankList();

        return view( 'bancos-list', [ 'bancos' => $bancos ] );
    }

    public function cancelTransaction()
    {
        session()->forget('transaction');

        return view( 'home' );
    }

    public function createTransaction( Request $request )
    {
        $this->validate( $request, [
            'bankCode'      => [ 'required', 'not_in:0' ],
            'bankInterface' => [ 'required' ]
        ], [
            'bank_ode.required'      => 'Debes seleccionar tu banco',
            'bank_ode.not_in'        => 'Debes seleccionar tu banco',
            'bankInterface.required' => 'Debes seleccionar una opción',
        ] );

        $data = $request->input();

        $transaction = TransactionBuilder::currentTransaction();
        $transaction->setBankCode( $data['bankCode'] );
        $transaction->setBankInterface( $data['bankInterface'] );

        $response = $this->ptp_pse->sendTransaction( $transaction->complete() );

        if ( $response->getReturnCode() == 'SUCCESS' ) {
            $transaction = Transaction::create( [
                'transactionID' => $response->getTransactionID(),
                'reference'     => $transaction->getReference(),
                'description'   => $transaction->getDescription(),
                'totalAmount'   => $transaction->getTotalAmount(),
                'user_id'       => Auth::user()->id,
            ] );

            if ( $transaction ) {
                return redirect()->away( $response->getBankURL() );
            } else {
                return view( 'error-transaction', [ 'responseReasonText' => 'No se pudo almacenar la transacción en la base de datos ' ] );
            }
        } else {
            return view( 'error-transaction', [ 'responseReasonText' => $response->getResponseReasonText() ] );
        }
    }
}
