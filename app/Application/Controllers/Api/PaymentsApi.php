<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Businesscourses;
use App\Application\Model\Businessdata;
use App\Application\Model\Consultationsrequests;
use App\Application\Model\Courseenrollment;
use App\Application\Model\Courses;
use App\Application\Model\Currencies;
use App\Application\Model\Events;
use App\Application\Model\Eventsenrollment;
use App\Application\Model\Eventstickets;
use App\Application\Model\FacebookConversionsAPI;
use App\Application\Model\Orders;
use App\Application\Model\Ordersposition;
use App\Application\Model\Payments;
use App\Application\Model\Promotionactive;
use App\Application\Model\Promotions;
use App\Application\Model\Promotionusers;
use App\Application\Model\Transactions;
use App\Application\Model\User;
use App\Application\Transformers\PaymentsTransformers;
use App\Application\Requests\Website\Payments\ApiAddRequestPayments;
use App\Application\Requests\Website\Payments\ApiUpdateRequestPayments;
use App\Mail\OrderConfirm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Osama\TabbyIntegration\Facades\Tabby;

class PaymentsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Payments $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestPayments $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestPayments $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(PaymentsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(PaymentsTransformers::transform($data) + $paginate), $status_code);
    }


    public function actionAcceptConfirmationCallback2(Request $request)
    {
        //            Parameters


        $myArray =   $request;

        $object =  (array) $myArray["obj"];
        $data =  (array) $object["data"];
        $source_data =  (array) $object["source_data"];
        $order =  (array) $object["order"];

        $currency =  ($order['currency']) ? $order['currency'] : "";
        $source_data_type =  ($source_data['type']) ? $source_data['type'] : "";
        $accept_id =  ($object['id']) ? $object['id'] : "";
        $pending = ($object['pending']) ? $object['pending'] : "";
        $getOrder = ($order['id']) ? $order['id'] : "";
        $merchant_order_id = ($order['merchant_order_id']) ? $order['merchant_order_id'] : "";
        $amount_cents = ($order['amount_cents']) ? $order['amount_cents'] : "";
        $success = ($object['success']) ? $object['success'] : "";
        $data_message = ($data['message']) ? $data['message'] : "";
        $source_data_sub_type = ($source_data['sub_type']) ? $source_data['sub_type'] : "";
        $profile_id =  ($object['profile_id']) ? $object['profile_id'] : "";
        $txn_response_code = ($data['txn_response_code']) ? $data['txn_response_code'] : "";
        $hmac = (isset($data['hmac'])) ? $data['hmac'] : "";  // not found


        $order = Orders::findOrFail($merchant_order_id);
        $order_status = $order->status;

        $user = User::findOrFail($order->user_id);


        //save the payement
        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = (int)$amount_cents / 100;
        $payment->currency_id = "EGP";
        $payment->user_id = $user->id;
        $payment->receiver_id = 1;
        $payment->orders_id = $merchant_order_id;

        if(isset($order->currency) && $order->currency != "EGP"){
            $order->exchange_rate = Payments::exchangeRate();
        }

        // Set the error flag to false
        $errorExists = false;

        if ($success == 'true') {
            $payment->status = Payments::STATUS_SUCCEEDED;
        } else {
            $payment->status = Payments::STATUS_FAILED;
        }

        // Payment Data
        $payment->txn_response_code = $txn_response_code;
        $payment->accept_hmac = $hmac;
        $payment->accept_source_data_sub_type = $source_data_sub_type;
        $payment->accept_profile_id = $profile_id;
        $payment->accept_data_message = $data_message;
        $payment->accept_success = $success;
        $payment->accept_amount_cents = $amount_cents;
        $payment->accept_order = $getOrder;
        $payment->accept_pending = $pending;
        $payment->accept_id = $accept_id;
        $payment->accept_source_data_type = $source_data_type;

        //Save the order
        if($payment->save()){

            $promoRow = null;

            if($order && $payment->status == Payments::STATUS_SUCCEEDED){

                //Categorize Cart Items (Courses & Events)
                $itemsArr = extractOrderItemTypes($order, $user->id);
     
                $promoCode = getCurrentPromoCode($user->id);
                if ($promoCode) {
                    //Check the promo again
                    $promoRow = $promoCode->promotions;


                }
                
                foreach($itemsArr as $key => $values){
                   
                    switch($key){

                        case 'courses': 
                            foreach($values as $value){
                                enrollCourse($value->courses_id, $user->id, null, null, $order->id);
                            }
                        break;


                        case 'events':
                            foreach($values as $value){
                                enrollEvent($value->events_id, $user->id);
                            }
                        break;

                        default:
                    }
                }     


                // Make sure the instructors and affiliates get their transactions only once
                if ($order_status != Orders::STATUS_SUCCEEDED){
                    //save the Transaction
                    foreach ($order->ordersposition as $orderPosition) {
                        if ($orderPosition->type == Ordersposition::TYPE_Course) {        //Course
                            $course = $orderPosition->courses;
                            $course_price = $orderPosition->amount;


                            switch(getCurrency()) {
                                case('EGP'):
                                    $exchangeRate = 1;
                                    break;

                                case('AED'):
                                    $exchangeRate = getSetting('AED_EGP');
                                    break;

                                case('SAR'):
                                    $exchangeRate = getSetting('SAR_EGP');
                                    break;

                                case('USD'):
                                    $exchangeRate = getSetting('USD_EGP');
                                    break;

                                default:
                                    $exchangeRate = 1;
                            }


                            $amount_cents = round($exchangeRate * $amount_cents);
                            $course_price = round($exchangeRate * $course_price);

                            
                            if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $course->instructor_id)){

                                setInstructorAffTransactions2($course, $course_price, $payment, $promoRow);

                            }else{

                                setInstructorAffTransactions2($course, $course_price, $payment);

                            }


                        }elseif($orderPosition->type == Ordersposition::TYPE_Event){    //Event


                            $event = $orderPosition->events;
                            $event_price = $orderPosition->amount;


                            switch(getCurrency()) {
                                case('EGP'):
                                    $exchangeRate = 1;
                                    break;

                                case('AED'):
                                    $exchangeRate = getSetting('AED_EGP');
                                    break;

                                case('SAR'):
                                    $exchangeRate = getSetting('SAR_EGP');
                                    break;

                                case('USD'):
                                    $exchangeRate = getSetting('USD_EGP');
                                    break;

                                default:
                                    $exchangeRate = 1;
                            }
                            $amount_cents = round($exchangeRate * $amount_cents);
                            $event_price = round($exchangeRate * $event_price);


                            if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $event->instructor_id)){

                                distEventTransactions($event, $event_price, $payment, $promoRow);

                            }else{

                                distEventTransactions($event, $event_price, $payment);

                            }

                        }
                    }

                    // Emails::instance()->sendOrderEmail($this->oAuthUser, $payment, $order);

                }

            }


                // Link the order with the payement:
                if($success == "true"){
                    $order->status =  Orders::STATUS_SUCCEEDED;
                    $order->payments_id = $payment->id;
                }
                
                if($order->save()){
                    //Check if applied promo code and make use of it:

                    if($promoRow){
                        
                        connectPromoWithOrder($promoRow, $order->id, $user->id);

                    }
                }
            }

        if ($success == "true") {
            //Send Order Confirmation Email

        }


            // $this->data['test'] = $test;
            $this->data['orderId'] = $order->id;
            $this->data['data_message'] = $data_message;
            $this->data['txn_response_code'] =  $txn_response_code;
            $this->data['txnResponseCode'] =  $success;
            $this->data['errorExists'] =  $errorExists;

            var_dump($this->data);
    }


    public function actionFawryConfirmationCallback(Request $request) {
        //            Parameters

        $myArray =   $request;   
      
        $orderItems =  (array) $myArray["orderItems"];

        $requestId =  ($myArray['requestId']) ? $myArray['requestId'] : "";
        $fawryRefNumber =  ($myArray['fawryRefNumber']) ? $myArray['fawryRefNumber'] : "";
        $merchantRefNumber =  ($myArray['merchantRefNumber']) ? $myArray['merchantRefNumber'] : "";
        $customerMobile =  ($myArray['customerMobile']) ? $myArray['customerMobile'] : "";
        $customerMail =  ($myArray['customerMail']) ? $myArray['customerMail'] : "";
        $paymentAmount =  ($myArray['paymentAmount']) ? $myArray['paymentAmount'] : "";
        $amount_cents =  ($myArray['orderAmount']) ? $myArray['orderAmount'] : "";
        $fawryFees =  ($myArray['fawryFees']) ? $myArray['fawryFees'] : "";
        $shippingFees =  ($myArray['shippingFees']) ? $myArray['shippingFees'] : "";
        $orderStatus =  ($myArray['orderStatus']) ? $myArray['orderStatus'] : "";
        $paymentMethod =  ($myArray['paymentMethod']) ? $myArray['paymentMethod'] : "";
        $messageSignature =  ($myArray['messageSignature']) ? $myArray['messageSignature'] : "";
        $orderExpiryDate =  ($myArray['orderExpiryDate']) ? $myArray['orderExpiryDate'] : "";
        $merchant_order_id =  ($myArray['merchantRefNumber']) ? $myArray['merchantRefNumber'] : "";
        $price =  ($myArray['orderAmount']) ? $myArray['orderAmount'] : "";
        $quantity =  ($orderItems[0]['quantity']) ? $orderItems[0]['quantity'] : "";
        $failureReason =  ($myArray['failureReason']) ? $myArray['failureReason'] : "";
        $failureErrorCode =  ($myArray['failureErrorCode']) ? $myArray['failureErrorCode'] : "";
        $paymentTime =  ($myArray['paymentTime']) ? $myArray['paymentTime'] : "";


        // $is_capture = array_key_exists("is_capture", $_GET) ? $_GET["is_capture"] : "";
        $order = Orders::findOrFail($merchant_order_id);
        $order_status = $order->status;

        $user = User::findOrFail($order->user_id);
        $currency = 'EGP';
        //save the payement
        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = (int)$amount_cents / 100;
        $payment->currency_id = ($currency == 'EGP') ? 34 : 2;
        $payment->user_id = $user->id;
        $payment->receiver_id = 1;
        $payment->orders_id = $merchant_order_id;

        // Set the error flag to false
        $errorExists = false;


        if($orderStatus == 'PAID'){
            $payment->status = Payments::STATUS_SUCCEEDED;
        }else{
            $payment->status = $orderStatus;
        }

        $payment->txn_response_code = $failureReason;
        $payment->accept_hmac = $requestId;
        $payment->accept_source_data_sub_type = $paymentMethod;
        $payment->accept_profile_id = $fawryFees;
        $payment->accept_data_message = $messageSignature;
        $payment->accept_success = $orderStatus;
        $payment->accept_amount_cents = $amount_cents;
        $payment->accept_order = $failureErrorCode;
        $payment->accept_pending = $orderExpiryDate;
        $payment->accept_source_data_type = $paymentMethod;

        //Save the order
        if($payment->save()){
    
            $promoRow = null;

            if($order && $payment->status == Payments::STATUS_SUCCEEDED){

                //Categorize Cart Items (Courses & Events)
                $itemsArr = extractOrderItemTypes($order, $user->id);
                $promoCode = getCurrentPromoCode();
                if ($promoCode) {
                    //Check the promo again
                    $promoRow = $promoCode->promotions;
                    
                }
                
                foreach($itemsArr as $key => $values){
          
                    switch($key){

                        case 'courses': 
                            foreach($values as $value){
                                enrollCourse($value->courses_id, $user->id, null, null, $order->id);
                            }
                        break;


                        case 'events':
                            foreach($values as $value){
                                enrollEvent($value->events_id, $user->id);
                            }
                        break;

                        default:
                    }
                }     


                // Make sure the instructors and affiliates get their transactions only once
                if ($order_status != Orders::STATUS_SUCCEEDED){
                    //save the Transaction
                    foreach ($order->ordersposition as $orderPosition) {
                        if ($orderPosition->type == Ordersposition::TYPE_Course) {        //Course
                            $course = $orderPosition->courses;
                            $course_price = $orderPosition->amount;

                            if(getCurrency() == 'USD'){
                                //get Exchange rate
                                $exchangeRate = Payments::exchangeRate();
                                $amount_cents = round($exchangeRate * $amount_cents);

                                $course_price = round($exchangeRate * $course_price);
                            }
                            
                            if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $course->instructor_id)){

                                setInstructorAffTransactions2($course, $course_price, $payment, $promoRow);

                            }else{

                                setInstructorAffTransactions2($course, $course_price, $payment);

                            }


                        }elseif($orderPosition->type == Ordersposition::TYPE_Event) {    //Event


                            $event = $orderPosition->events;
                            $event_price = $orderPosition->amount;

                            if (getCurrency() == 'USD') {
                                //get Exchange rate
                                $exchangeRate = Payments::exchangeRate();
                                $amount_cents = round($exchangeRate * $amount_cents);

                                $event_price = round($exchangeRate * $event_price);
                            }



                            if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $event->instructor_id)){

                                distEventTransactions($event, $event_price, $payment, $promoRow);

                            }else{

                                distEventTransactions($event, $event_price, $payment);

                            }

                        }
                    }

                    // Emails::instance()->sendOrderEmail($this->oAuthUser, $payment, $order);

                }

            }


                // Link the order with the payement:
                    if($orderStatus == "PAID"){
                        $order->status =  Orders::STATUS_SUCCEEDED;
                        $order->payments_id = $payment->id;
                    }
                
                if($order->save()){
                    //Check if applied promo code and make use of it:

                    if($promoRow){
                        
                        connectPromoWithOrder($promoRow, $order->id, $user->id);

                    }
                }
            }

        if($orderStatus == "PAID"){

            //send order confirmation email


            $result[] = array(
                'status' => 200,
                'result' =>'DONE',
            );

        }else{
            $result[] = array(
                'status' => 400,
                'result' =>'ERROR',
            );
        }

        var_dump($result);

    }


    public function actionTamaraConfirmationCallback(Request $request)
    {
        if ($request->paymentStatus == 'approved') {
            //update order payment status
            $success = 'true';


//            return view('success_payment');
        } else {


            $data_message = $request['decline_type'] ?  $request['decline_type'] :'';

            $this->data['data_message'] = $data_message;
            return view('website.fail_payment', $this->data);

        }
        $order = Orders::where('tamara_order_id',$request->orderId)->firstOrFail();

        $user = User::findOrFail($order->user_id);

        //save the payement
        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = (int)$order->totalOrderAmount ;
        $payment->currency_id = $order->currency;
        $payment->user_id = $order['user']->id;
        $payment->receiver_id = 1;
        $payment->orders_id = $order->id;


        $order_status = $order->status;

          if ($request->paymentStatus == 'approved') {
              $payment->status = Payments::STATUS_SUCCEEDED;
          } else {
              $payment->status = Payments::STATUS_FAILED;
          }


        //Save the order
        if($payment->save()){
            $promoRow = null;
            if($order && $payment->status == Payments::STATUS_SUCCEEDED){
                //Categorize Cart Items (Courses & Events)
                $itemsArr = extractOrderItemTypes($order, $user->id);
                $promoCode = getCurrentPromoCode($user->id);
                if ($promoCode) {
                    //Check the promo again
                    $promoRow = $promoCode->promotions;
                }
                foreach($itemsArr as $key => $values){
                    switch($key){
                        case 'courses':
                            foreach($values as $value){
                                enrollCourse($value->courses_id, $user->id, null, null, $order->id);
                            }
                            break;
                        case 'events':
                            foreach($values as $value){
                                enrollEvent($value->events_id, $user->id);
                            }
                            break;

                        default:
                    }
                }


                // Make sure the instructors and affiliates get their transactions only once
                if ($order_status != Orders::STATUS_SUCCEEDED){
                    //save the Transaction
                    foreach ($order->ordersposition as $orderPosition) {
                        if ($orderPosition->type == Ordersposition::TYPE_Course) {        //Course
                            $course = $orderPosition->courses;
                            $course_price = $orderPosition->amount;


                            switch(getCurrency()) {
                                case('EGP'):
                                    $exchangeRate = 1;
                                    break;

                                case('AED'):
                                    $exchangeRate = getSetting('AED_EGP');
                                    break;

                                case('SAR'):
                                    $exchangeRate = getSetting('SAR_EGP');
                                    break;

                                case('USD'):
                                    $exchangeRate = getSetting('USD_EGP');
                                    break;

                                default:
                                    $exchangeRate = 1;
                            }


                            $course_price = round($exchangeRate * $course_price);


                            if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $course->instructor_id)){

                                setInstructorAffTransactions2($course, $course_price, $payment, $promoRow);

                            }else{

                                setInstructorAffTransactions2($course, $course_price, $payment);

                            }


                        }elseif($orderPosition->type == Ordersposition::TYPE_Event){    //Event


                            $event = $orderPosition->events;
                            $event_price = $orderPosition->amount;


                            switch(getCurrency()) {
                                case('EGP'):
                                    $exchangeRate = 1;
                                    break;

                                case('AED'):
                                    $exchangeRate = getSetting('AED_EGP');
                                    break;

                                case('SAR'):
                                    $exchangeRate = getSetting('SAR_EGP');
                                    break;

                                case('USD'):
                                    $exchangeRate = getSetting('USD_EGP');
                                    break;

                                default:
                                    $exchangeRate = 1;
                            }
                            $event_price = round($exchangeRate * $event_price);


                            if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $event->instructor_id)){

                                distEventTransactions($event, $event_price, $payment, $promoRow);

                            }else{

                                distEventTransactions($event, $event_price, $payment);

                            }

                        }
                    }

                    // Emails::instance()->sendOrderEmail($this->oAuthUser, $payment, $order);

                }

            }


            // Link the order with the payement:
            if($success == "true"){
                $order->status =  Orders::STATUS_SUCCEEDED;
                $order->payments_id = $payment->id;
            }

            if($order->save()){
                //Check if applied promo code and make use of it:

                if($promoRow){

                    connectPromoWithOrder($promoRow, $order->id, $user->id);

                }
            }
        }

        if ($success == "true") {
            //Send Order Confirmation Email

        }


        // $this->data['test'] = $test;
        $this->data['orderId'] = $order->id;

        return view('website.success-payment', $this->data);


        var_dump($this->data);
    }

    public function actionTabbyConfirmationCallback(Request $request, $type = null)
    {

        if ($type == "cancel" or $type == "failure"){

            $this->data['data_message'] = "Wrong";
            return view('website.fail_payment', $this->data);
        }

        if ($request->payment_id) {

            $response = Tabby::getPayment($request->payment_id);

            if ($response['status'] == "EXPIRED" or $response['status'] == "REJECTED" ){
            $this->data['data_message'] = "Wrong";
            return view('website.fail_payment', $this->data);
            }

            $success = 'true';


//            return view('success_payment');
        } else {


            $data_message = $request['decline_type'] ?  $request['decline_type'] :'';

            $this->data['data_message'] = $data_message;
            return view('website.fail_payment', $this->data);

        }
        $order = Orders::where('tabby_payment_id',$request->payment_id)->firstOrFail();


        $user = User::findOrFail($order->user_id);

        //save the payement
        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = (int)$order->totalOrderAmount ;
        $payment->currency_id = $order->currency;
        $payment->user_id = $order['user']->id;
        $payment->receiver_id = 1;
        $payment->orders_id = $order->id;


        $order_status = $order->status;

          if ($request->payment_id) {
              $payment->status = Payments::STATUS_SUCCEEDED;
          } else {
              $payment->status = Payments::STATUS_FAILED;
          }
          

        //Save the order
        if($payment->save()){
            $promoRow = null;
            if($order && $payment->status == Payments::STATUS_SUCCEEDED){
                //Categorize Cart Items (Courses & Events)
                $itemsArr = extractOrderItemTypes($order, $user->id);
                $promoCode = getCurrentPromoCode($user->id);
                if ($promoCode) {
                    //Check the promo again
                    $promoRow = $promoCode->promotions;
                }
                foreach($itemsArr as $key => $values){
                    switch($key){
                        case 'courses':
                            foreach($values as $value){
                                enrollCourse($value->courses_id, $user->id, null, null, $order->id);
                            }
                            break;
                        case 'events':
                            foreach($values as $value){
                                enrollEvent($value->events_id, $user->id);
                            }
                            break;

                        default:
                    }
                }


                // Make sure the instructors and affiliates get their transactions only once
                if ($order_status != Orders::STATUS_SUCCEEDED){
                    //save the Transaction
                    foreach ($order->ordersposition as $orderPosition) {
                        if ($orderPosition->type == Ordersposition::TYPE_Course) {        //Course
                            $course = $orderPosition->courses;
                            $course_price = $orderPosition->amount;


                            switch(getCurrency()) {
                                case('EGP'):
                                    $exchangeRate = 1;
                                    break;

                                case('AED'):
                                    $exchangeRate = getSetting('AED_EGP');
                                    break;

                                case('SAR'):
                                    $exchangeRate = getSetting('SAR_EGP');
                                    break;

                                case('USD'):
                                    $exchangeRate = getSetting('USD_EGP');
                                    break;

                                default:
                                    $exchangeRate = 1;
                            }


                            $course_price = round($exchangeRate * $course_price);


                            if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $course->instructor_id)){

                                setInstructorAffTransactions2($course, $course_price, $payment, $promoRow);

                            }else{

                                setInstructorAffTransactions2($course, $course_price, $payment);

                            }


                        }elseif($orderPosition->type == Ordersposition::TYPE_Event){    //Event


                            $event = $orderPosition->events;
                            $event_price = $orderPosition->amount;


                            switch(getCurrency()) {
                                case('EGP'):
                                    $exchangeRate = 1;
                                    break;

                                case('AED'):
                                    $exchangeRate = getSetting('AED_EGP');
                                    break;

                                case('SAR'):
                                    $exchangeRate = getSetting('SAR_EGP');
                                    break;

                                case('USD'):
                                    $exchangeRate = getSetting('USD_EGP');
                                    break;

                                default:
                                    $exchangeRate = 1;
                            }
                            $event_price = round($exchangeRate * $event_price);


                            if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $event->instructor_id)){

                                distEventTransactions($event, $event_price, $payment, $promoRow);

                            }else{

                                distEventTransactions($event, $event_price, $payment);

                            }

                        }
                    }

                    // Emails::instance()->sendOrderEmail($this->oAuthUser, $payment, $order);

                }

            }


            // Link the order with the payement:
            if($success == "true"){
                $order->status =  Orders::STATUS_SUCCEEDED;
                $order->payments_id = $payment->id;
            }

            if($order->save()){
                //Check if applied promo code and make use of it:

                if($promoRow){

                    connectPromoWithOrder($promoRow, $order->id, $user->id);

                }
            }
        }

        if ($success == "true") {
            //Send Order Confirmation Email

        }


        // $this->data['test'] = $test;
        $this->data['orderId'] = $order->id;

        return view('website.success-payment', $this->data);


        var_dump($this->data);
    }


    public function actionAcceptConfirmationCallbackApplePay(){
        //---------
        $amount_cents = array_key_exists("amount_cents", $_GET) ? $_GET["amount_cents"] : "";
        $data_message = array_key_exists("data_message", $_GET) ? $_GET["data_message"] : "";
        $currency = array_key_exists("currency", $_GET) ? $_GET["currency"] : "";
        $hmac = array_key_exists("hmac", $_GET) ? $_GET["hmac"] : "";
        $accept_id = array_key_exists("id", $_GET) ? $_GET["id"] : "";
        $is_capture = array_key_exists("is_capture", $_GET) ? $_GET["is_capture"] : "";
        $is_standalone_payment = array_key_exists("is_standalone_payment", $_GET) ? $_GET["is_standalone_payment"] : "";
        $txn_response_code = array_key_exists("txn_response_code", $_GET) ? $_GET["txn_response_code"] : "";
        $success = array_key_exists("success", $_GET) ? $_GET["success"] : "";
        $source_data_sub_type = array_key_exists("source_data_sub_type", $_GET) ? $_GET["source_data_sub_type"] : "";
        $source_data_type = array_key_exists("source_data_type", $_GET) ? $_GET["source_data_type"] : "";
        $profile_id = array_key_exists("profile_id", $_GET) ? $_GET["profile_id"] : "";
        $pending = array_key_exists("pending", $_GET) ? $_GET["pending"] : "";
        $getOrder = array_key_exists("order", $_GET) ? $_GET["order"] : "";
        $merchant_order_id = array_key_exists("merchant_order_id", $_GET) ? $_GET["merchant_order_id"] : ""; //payment id
        $order = Orders::findOrFail($merchant_order_id);

        if($order->status == Orders::STATUS_SUCCEEDED){

            alert()->error("Order had already been processed", "ERROR");
            return redirect('/');
        }
        $order_status = $order->status;

        //save the payement
        $payment = new Payments();
        $payment->operation = Payments::OPERATION_DEPOSIT;
        $payment->amount = (int)$amount_cents / 100;
        $payment->currency_id = Currencies::DEFUALT_CURRENCY;
        $payment->user_id = $order->user_id;
        $payment->receiver_id = 1;
        $payment->orders_id = $merchant_order_id;

        if(isset($order->currency) && $order->currency != Currencies::DEFUALT_CURRENCY){
            $order->exchange_rate = Payments::exchangeRate();
        }

        // Set the error flag to false
        $errorExists = false;

        if($success == 'true'){
            $payment->status = Payments::STATUS_SUCCEEDED;
        }else{
            $payment->status = Payments::STATUS_FAILED;
        }

       // Payment Data
        $payment->txn_response_code = $txn_response_code;
        $payment->accept_hmac = $hmac;
        $payment->accept_source_data_sub_type = $source_data_sub_type;
        $payment->accept_profile_id = $profile_id;
        $payment->accept_data_message = $data_message;
        $payment->accept_success = $success;
        $payment->accept_amount_cents = $amount_cents;
        $payment->accept_order = $getOrder;
        $payment->accept_pending = $pending;
        $payment->accept_id = $accept_id;
        $payment->accept_source_data_type = $source_data_type;

        //Save the order
        if($payment->save()){
            // Consultation Check Condition
            if($order_status == Orders::STATUS_CONSULTATION){

                $consultationRequest = $order->consultationrequest;
                $consultationRequest->status = Consultationsrequests::STATUS_DONE;
                $consultationRequest->save();
                // $curl = curl_init();
                // curl_setopt($curl, CURLOPT_URL, "https://docs.google.com/forms/d/e/1FAIpQLScHo6JaxqYBAVftuNRUeFxcZx5ZK3N7pMVVv8HaEznj5Bm8Bw/formResponse");
                // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                // curl_setopt($curl, CURLOPT_POST, true);
                // $data = array(
                //     'entry.987512726' => Auth::user()->name,
                //     'entry.577339088' => Auth::user()->email,
                //     'entry.205539914' => Auth::user()->mobile,
                //     'entry.1945803881' => $consultationDesc
                // );
                // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                // $response = curl_exec($curl);
                // curl_close($curl);

                $order->payments_id = $payment->id;
                $order->status = Orders::STATUS_SUCCEEDED;
                $order->save();

                setConsultantTransaction($order);
            }else{
                $promoRow = null;
                if($order && $payment->status == Payments::STATUS_SUCCEEDED){
//                if($order && $order->status != Orders::STATUS_DIRECTBUY && $payment->status == Payments::STATUS_SUCCEEDED){
                    if($order->type != Orders::TYPE_B2B AND $order->type != Orders::TYPE_B2C ){
                        //Categorize Cart Items (Courses & Events)
                        $itemsArr = extractOrderItemTypes($order,$order->user_id);
                        $promoCode = getCurrentPromoCode();
                        if ($promoCode) {
                            //Check the promo again
                            $promoRow = $promoCode->promotions;
                        }
                        foreach($itemsArr as $key => $values){
                            switch($key){
                                case 'courses':
                                    foreach($values as $value){
                                        enrollCourse($value->courses_id, $order->user_id, null, null, $order->id);
                                    }
                                    break;

                                case 'certificates':
                                    foreach($values as $value){
                                        enrollCertificate($value->courses_id, $value->certificate_id, $order->user_id, $order->id);
                                    }
                                    break;

                                case 'events':
                                    foreach($values as $value){
                                        enrollEvent($value->events_id);
                                    }
                                    break;

                                default:
                            }
                        }
                        // Make sure the instructors and affiliates get their transactions only once
                        if ($order_status != Orders::STATUS_SUCCEEDED){
                            //save the Transaction
                            foreach ($order->ordersposition as $orderPosition) {
                                if ($orderPosition->type == Ordersposition::TYPE_Course) {        //Course
                                    $course = $orderPosition->courses;
                                    $course_price = $orderPosition->amount;
                                    $currency = ($orderPosition->currency) ? $orderPosition->currency : getCurrency();
                                    switch(getCurrency()) {
                                        case('EGP'):
                                            $exchangeRate = 1;
                                            break;

                                        case('AED'):
                                            $exchangeRate = getSetting('AED_EGP');
                                            break;

                                        case('SAR'):
                                            $exchangeRate = getSetting('SAR_EGP');
                                            break;

                                        case('USD'):
                                            $exchangeRate = getSetting('USD_EGP');
                                            break;

                                        default:
                                            $exchangeRate = 1;
                                    }
                                    $amount_cents = round($exchangeRate * $amount_cents);
                                    $course_price = round($exchangeRate * $course_price);

                                    if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $course->instructor_id)){
                                        setInstructorAffTransactions2($course, $course_price, $payment, $currency, $promoRow);
                                    }else{
                                        setInstructorAffTransactions2($course, $course_price, $payment, $currency);
                                    }
                                }elseif($orderPosition->type == Ordersposition::TYPE_Event) {    //Event
                                    $event = $orderPosition->events;
                                    $event_price = $orderPosition->amount;
                                    $currency = ($value->currency) ? $value->currency : getCurrency();
                                    if($currency == 'USD'){
                                        //get Exchange rate
                                        $exchangeRate = Payments::exchangeRate();

                                        $event_price = round($exchangeRate * $event_price);
                                    }

                                    if($promoRow && $promoRow->affiliate && $promoRow->affiliate_perc && Promotions::instructorAffEligible($promoRow, $event->instructor_id)){
                                        distEventTransactions($event, $event_price, $payment, $promoRow);
                                    }else{
                                        distEventTransactions($event, $event_price, $payment);
                                    }
                                }
                            }
                            // Emails::instance()->sendOrderEmail($this->oAuthUser, $payment, $order);
                        }
                    }else{
                        // B2B or B2C
                        completeBusinessOrder($order,$payment);
                    }
                }


                // Link the order with the payement:
                if($success == "true"){
                    $order->status =  Orders::STATUS_SUCCEEDED;
                    $order->payments_id = $payment->id;

                    if($order->type != Orders::TYPE_B2B AND $order->type != Orders::TYPE_B2C ){
//                        Mail::to($order->user['email'])->send(new OrderConfirm($order, $order->user, $payment->amount));
                    }
//                    User::addNotification([auth()->user()->id], trans('messages.notificationPurchaseTitle'), trans('messages.notificationPurchaseDescription'), '/account/myCourses');
                    $facebookConversionsApi = new FacebookConversionsAPI();
                    $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_PURCHASE, $order);
                }
                if($order->save()){
                    //Check if applied promo code and make use of it:
                    if($promoRow){
                        connectPromoWithOrder($promoRow, $order->id);
                    }
                }
            }
        }

        $this->data['orderId'] = $order->id;
        $this->data['data_message'] = $data_message;
        $this->data['txn_response_code'] =  $txn_response_code;
        $this->data['txnResponseCode'] =  $success;
        $this->data['errorExists'] =  $errorExists;

        return view('website.confirmation', $this->data);

    }


}
