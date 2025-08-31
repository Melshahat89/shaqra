<?php

namespace App\Application\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayWith {

    private $order;
    private $amount;
    private $type;
    private $numberOfUsers;
    private $user;
    private $event;
    private $currency;
    private $certificates;
    private $course;
    private $amount_cents;
    private $subType;

    private $success = true;
    private $payment_token = null;
    private $error_message = null;
    private $redirect_url = null;


    
    public function __construct(Request $request)
    {
        $this->order = ($request->order) ? Orders::findOrFail($request->order) : getCurrentCartOrder();
        $this->amount = ($request->amount) ? $request->amount : null;
        $this->type = null;
        $this->numberOfUsers = ($request->numberOfUsers) ? $request->numberOfUsers : null;
        $this->user = null;
        $this->currency = ($request->currency) ? $request->currency : getCurrency(); // TODO
        $this->certificates = ($request->Certificates) ? $request->Certificates : null;
        parse_str($request->Certificates, $this->certificates);
        $this->course = ($request->courses_id) ? Courses::findOrFail($request->courses_id) : null;
        $this->event = ($request->events_id) ? Events::findOrFail($request->events_id) : null;
        $this->amount_cents = null;
        $this->subType = ($request->subType) ? $request->subType : null;
    }
    
    public function results(){
        $data['success'] = $this->success;
        $data['token'] = $this->payment_token;
        $data['order'] = $this->order;
        $data['amount'] = $this->amount;
        $data['error_message'] = $this->error_message;
        $data['redirect_url'] = $this->redirect_url;

        return $data;
    }

    public function visa(){

        $this->setupOrderAndAmount(Orders::METHOD_PAYMOB);
        
        if ($this->order->accept_status) {
            $this->order = dublicateOrderPositions($this->order->id);
        }


        $visa = new AcceptPaymentsIntegration;



        $result = $visa->init($this->order, $this->amount_cents);
        // $data['success'] = true;

        if (!$result) {
            // $data['success'] = false;
            $this->success = false;
        }
 
        // save accept_status in order
        $this->order->accept_status = 1;
        $this->order->save();
 
        if(env('APP_ENV') != "local"){
            $facebookConversionsApi = new FacebookConversionsAPI();
            $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_INITIATECHECKOUT, $this->order);
        }

        $this->payment_token = $result;
        $this->amount = (int) $this->amount_cents / 100;
        
        return $this->results();

    }

    public function fawry(){
        
        $this->setupOrderAndAmount(Orders::METHOD_FAWRY);

        $fawry = new FawryIntegration;
        $payment_token = $fawry->init($this->order, $this->amount_cents);
        
        if(!$payment_token){
            $this->success = false;
        }

        $this->order->status =  Orders::STATUS_FAWRY;
        $this->order->save();

        if(env('APP_ENV') != "local"){
            $facebookConversionsApi = new FacebookConversionsAPI();
            $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_INITIATECHECKOUT, $this->order);
        }
 
        $this->payment_token = $payment_token;
        
        return $this->results();
    }

    public function aman(){

        $this->setupOrderAndAmount(Orders::METHOD_PAYMOB);

        $kiosk = new KioskIntegration;
        $result = $kiosk->init($this->order, $this->amount_cents, KioskIntegration::KIOSK_PAYMENT_TYPE, KioskIntegration::KIOSK_PAYMENT_TYPE);

        if($result){
            $payment_token = $result['data']['bill_reference'];
        }else{
            $this->success = false;
            $payment_token = null;
        }
        
        $this->order->kiosk_id = $payment_token;
        $this->order->status =  Orders::STATUS_KIOSK;
        $this->order->save();

        if(env('APP_ENV') != "local"){
            $facebookConversionsApi = new FacebookConversionsAPI();
            $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_INITIATECHECKOUT, $this->order);
        }

        $this->payment_token = $payment_token;

        return $this->results();

    }

    public function masary(){

        $this->setupOrderAndAmount(Orders::METHOD_PAYMOB);

        $kiosk = new KioskIntegration;
        $result = $kiosk->init($this->order, $this->amount_cents, KioskIntegration::KIOSK_PAYMENT_TYPE, KioskIntegration::KIOSK_PAYMENT_TYPE);

        if($result){
            $payment_token = $result['data']['bill_reference'];
        }else{
            $this->success = false;
            $payment_token = null;
        }

        $this->order->kiosk_id = $payment_token;
        $this->order->status =  Orders::STATUS_KIOSK;
        $this->order->save();

        if(env('APP_ENV') != "local"){
            $facebookConversionsApi = new FacebookConversionsAPI();
            $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_INITIATECHECKOUT, $this->order);
        }

        $this->payment_token = $payment_token;

        return $this->results();
    }

    public function wallet(){
        
        $this->setupOrderAndAmount(Orders::METHOD_PAYMOB);

        $result = null;
        $data['success'] = true;

        if (!empty($_POST['mobile'])) {
            $mobile = $_POST['mobile'];

            $wallet = new MobilewalletIntegration;
            $result = $wallet->init($this->order, $this->amount_cents, MobilewalletIntegration::KIOSK_PAYMENT_TYPE, $mobile);

            $this->order->status =  Orders::STATUS_MOBILEWALLET;
            $this->order->save();

            if (isset($result['redirect_url'])) {
                $this->redirect_url = $result['redirect_url'];
            } else {
                $this->success = false;
                // if (isset($result['error'])) 
                //     $data['error_message'] = $result['error'];
            }

            
            if(env('APP_ENV') != "local"){
                $facebookConversionsApi = new FacebookConversionsAPI();
                $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_INITIATECHECKOUT, $this->order);
            }
        }

        return $this->results();

    }

    private function setupOrderAndAmount($method){
        //Cart Page
        $this->amount_cents = Currencies::getAmountcentsByCurrencyID($this->currency , Currencies::DEFUALT_CURRENCY, getShoppingCartCost());

        //Direct Pay - Course Page
        if($this->course){
            if(isset($this->certificates['Certificates'])){
                $this->order = createDirectPayOrder($this->course, $this->certificates['Certificates']);
            }else{
                $this->order = createDirectPayOrder($this->course);
            }
            $this->amount_cents = calculateExchangeRate($this->currency, $this->order->TotalOrderAmount, $method);
        }elseif($this->amount){
            //Direct Pay - Offline
            $this->amount_cents = calculateExchangeRate($this->currency, $this->amount, $method);
        }elseif($this->subType && !$this->numberOfUsers){
            //B2C Subscription
            $this->order = createBusinessInitialOrder($this->subType ,Orders::TYPE_B2C, $this->amount, $this->currency);
            $this->amount_cents = Currencies::getAmountcentsByCurrencyID($this->currency , Currencies::DEFUALT_CURRENCY, ceil($this->order->TotalOrderAmount) * 100);
        }elseif($this->subType && $this->numberOfUsers){
            //B2B Subscription
            $this->order = createB2bInitialOrder($this->subType, $this->numberOfUsers, $this->amount, $this->currency);
            $this->amount_cents = calculateExchangeRate($this->currency, (ceil($this->order->TotalOrderAmount) * 100), $method);

        }

    }


}