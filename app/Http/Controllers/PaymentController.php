<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; 
use App\Models\Cart; 
use App\Models\Product;
use App\Models\Buyer;


class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); // Establecer en 'false' en producción
    }

    public function index()
    {
        return view('checkout');
    }

    public function charge(Request $request)
    {
        if ($request->input('submit')) {
            try {
                $response = $this->gateway->purchase([
                    'amount' => $request->input('amount'),
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('success'),
                    'cancelUrl' => url('error'),
                ])->send();

                if ($response->isRedirect()) {
                    $response->redirect(); // Redireccionar automáticamente al cliente
                } else {
                    return $response->getMessage();
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase([
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ])->send();

            if ($transaction->isSuccessful()) {
                $arr_body = $transaction->getData();

                // Insertar datos de transacción en la tabla 'payments'
                $payment = new Payment;
                $payment->payment_id = $arr_body['id'];
                $payment->payer_id = Auth::id(); // Obtener el ID del usuario autenticado
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr_body['state'];
                $payment->save();


                // Limpiar el carrito después de la compra
                \Cart::clear();

                // Mensaje de éxito en la sesión
                $message = "Payment is successful. Your transaction id is: {$arr_body['id']}";
                Session::flash('success_message', $message);

                return redirect()->route('completado');
            } else {
                return $transaction->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }

    public function error()
    {
        return 'User cancelled the payment.';
    }

    
    
}
