<?php

namespace App\Http\Controllers;

use App\SoapServices\PlaceToPay\PlaceToPayPSEService;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /** @var PlaceToPayPSEService  */
    private $ptp_pse;

    /**
     * Create a new controller instance.
     *
     * @param $ptp_pse
     */
    public function __construct( PlaceToPayPSEService $ptp_pse )
    {
        $this->middleware( 'auth' );

        $this->ptp_pse = $ptp_pse;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $transacciones = $user->transacciones()->orderByDesc('created_at')->get();

        foreach ( $transacciones as $transaccion ) {
            if ( $transaccion->status == 'PENDING' ){
                $transaction_server_data = $this->ptp_pse->getTransaction($transaccion->transactionID);

                if ( $transaction_server_data->getTransactionState() != 'PENDING' ){
                    $transaccion->status = $transaction_server_data->getTransactionState();
                    $transaccion->save();
                }

            }
        }

        return view('home', ['transacciones' => $transacciones]);
    }
}
