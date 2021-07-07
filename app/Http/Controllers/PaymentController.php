<?php

// namespace Netshell\Paypal;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Exception;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;

// use Stripe\Charge;
// use Stripe\Stripe;
/** All Paypal Details class **/

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;

use App\Pay;



class PaymentController extends Controller
{


   




    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

//         /** PayPal api context **/
// $apiContext = new \PayPal\Rest\ApiContext(
//   new \PayPal\Auth\OAuthTokenCredential(
//     env('PAYPAL_CLIENT_ID'),
//     env('PAYPAL_SECRET')
//   )
// );


        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }
    public function payWithpaypal(Request $request)
    {
        //store all variable in session to use in status function
        Session::put('campaign_id', $request->input('campaign_id'));
        Session::put('payer_name', $request->input('name'));
        Session::put('payer_email', $request->input('email'));
        Session::put('payer_phone', $request->input('phone'));
        //-------------------------------------------

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item_1 = new Item();

        $item_1->setName('Item 1') /** item name **/
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->input('amount')); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
// Set payment amount
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->input('amount'));
// Set transaction object
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description')
            ->setInvoiceNumber(uniqid());

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
        ->setCancelUrl(URL::to('status'));
// Create the full payment object
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

            $payment->create($this->_api_context);

        } catch (
            \PayPal\Exception\PPConnectionException $ex) {

            if (Config::get('app.debug')) {

                Session::put('error', 'Connection timeout');
                return Redirect::to('/');

            } else {

                Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');

            }
 
        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');

    }

    public function getPaymentStatus(Request $request)
    {
        //receive all variable from the session for insert in database
        $campaign_id=Session::get('campaign_id');
        $payer_name=Session::get('payer_name');
        $payer_email=Session::get('payer_email');
        $payer_phone=Session::get('payer_phone');
        //---------------------------------------------
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');


        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty( $request->input('PayerID')) || empty($request->input('token'))) {

            Session::put('error', 'Payment failed first');
            return Redirect::to('/');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $obj = json_decode($payment);

//        echo"<pre>";
//        print_r($obj);
//        echo"</pre>";
//
//        //get the response from paypal api to sstore in database
        $invoice_id=$obj->transactions[0]->invoice_number;
        $currency_code=$obj->transactions[0]->item_list->items[0]->currency;
        $amount=$obj->transactions[0]->item_list->items[0]->price;
        //--------------------------------------------------------


        // $execution = new PaymentExecution();
        // $execution->setPayerId($request->input('PayerID'));
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));


        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            //\Session::put('success', 'Payment success');
            //return Redirect::to('/');
            //insert data in to payment table
            $mypay = new Pay();

            $mypay->campaign_id =$campaign_id ;
            $mypay->payer_name =$payer_name ;
            $mypay->payer_email =$payer_email ;
            $mypay->payer_phone =$payer_phone ;
            $mypay->transaction_id =$invoice_id ;
            $mypay->currency_code =$currency_code ;
            $mypay->amount =$amount ;
            $mypay->payment_status =1;
            $mypay->save();
            return redirect('/pay_now_status')->with('status','Payment Successfully ');

        }

        return redirect('/pay_now_status')->with('error','Payment Not Successfully ');






        
    }

}
 