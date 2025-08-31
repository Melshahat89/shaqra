<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\Controller;
use App\Application\Model\AcceptAEDPaymentsIntegration;
use App\Application\Model\AcceptPaymentsIntegration;
use App\Application\Model\Achievements;
use App\Application\Model\Businesscourses;
use App\Application\Model\Businessdata;
use App\Application\Model\Businessgroups;
use App\Application\Model\Businessgroupscourses;
use App\Application\Model\Careers;
use App\Application\Model\Categories;
use App\Application\Model\Consultations;
use App\Application\Model\Consultationsrequests;
use App\Application\Model\Countries;
use App\Application\Model\Courseenrollment;
use App\Application\Model\Courselectures;
use App\Application\Model\Courseresources;
use App\Application\Model\Courses;
use App\Application\Model\Coursesections;
use App\Application\Model\Events;
use App\Application\Model\Eventsdata;
use App\Application\Model\Eventsenrollment;
use App\Application\Model\Eventstickets;
use App\Application\Model\FacebookConversionsAPI;
use App\Application\Model\Orders;
use App\Application\Model\Partners;
use App\Application\Model\Payments;
use App\Application\Model\PayWith;
use App\Application\Model\Promotionactive;
use App\Application\Model\Promotions;
use App\Application\Model\Promotionusers;
use App\Application\Model\Quiz;
use App\Application\Model\Quizquestions;
use App\Application\Model\Quizquestionschoice;
use App\Application\Model\Spin;
use App\Application\Model\Subscriptionslider;
use App\Application\Model\Subscriptionuser;
use App\Application\Model\Talks;
use App\Application\Model\Testimonials;
use App\Application\Model\Transactions;
use App\Application\Model\Homesettings;
use App\Application\Model\Setting;
use App\Application\Model\User;
use App\Application\Model\Faq;
use App\Application\Model\FawryIntegration as ModelFawryIntegration;
use App\Application\Model\KioskIntegration as ModelKioskIntegration;
use App\Application\Model\Lecturequestions;
use App\Application\Model\MobilewalletIntegration;
use App\Application\Model\Ordersposition;
use App\Application\Model\PaymentMethods;
use App\Application\Model\PaymentsData as ModelPaymentsData;
use App\Application\Model\PostAffiliateProIntegration;
use App\Application\Model\PaypalPaymentsIntegration;
use App\Application\Model\Posts;
use App\Application\Model\Quizstudentsstatus;
use App\Application\Model\Slider;
use App\Mail\OrderConfirm;
use App\Application\Model\Currencies;

use Carbon\Carbon;
use Cart;
use FawryIntegration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use KioskIntegration;
use PaymentsData;

use Osama\TabbyIntegration\Facades\Tabby;



use Maree\Tamara\Tamara;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $homeSettings = Homesettings::where('id', 1)->first();
      /*  // $this->data['BestSeller'] = Courses::where('published', 1)->where('type', Courses::TYPE_COURSE)->where('featured', 1)->limit(8)->orderBy('sales_count', 'desc')->get();
        // $this->data['LastCourses'] = Courses::where('published', 1)
        // ->where(function ($query) {
        //     $query->where("type", Courses::TYPE_COURSE)
        //         ->orWhere('type', Courses::TYPE_WEBINAR)
        //     ;
        // })
        // ->limit(8)->orderBy('sort', 'asc')->get()*/;
        $this->data['featuredAll'] = Courses::where('published', 1)->where('featured', 1)->skip(0)->take(5)->orderBy('sort', 'asc')->get(); //Best Learning
/*//        $this->data['PartnerCards'] = Partners::limit(30)->orderBy('id', 'asc')->get();*/
        $this->data['latestReleased'] = Courses::where('published', 1)->orderBy('created_at', 'desc')->skip(0)->take(10)->get();

/*
        // $this->data['featuredDiplomas'] = Courses::where('published', 1)->where('type', Courses::TYPE_DIPLOMAS)->inRandomOrder()->skip(0)->take(10)->get();
        // $this->data['featuredCourses'] = Courses::where('published', 1)->where('type', Courses::TYPE_COURSE)->where('categories_id','!=' , 8)->where('categories_id','!=' , 9)->inRandomOrder()->skip(0)->take(10)->get();
        // $this->data['featuredMasters'] = Courses::where('published', 1)->where('type', Courses::TYPE_MASTERS)->inRandomOrder()->skip(0)->take(10)->get();
        // $this->data['bundleCourses'] = Courses::where('published', 1)->where('type', Courses::TYPE_BUNDLES)->inRandomOrder()->skip(0)->take(10)->get();
//        $this->data['instructors'] = User::where('group_id', User::TYPE_INSTRUCTOR)->where('hidden', 0)->skip(0)->take(10)->inRandomOrder()->get();
//        $this->data['testimonials'] = Testimonials::skip(0)->take(10)->get();*/

/*//        $this->data['bundle_discount'] = $homeSettings->bundle_discount;
//        $this->data['courses_discount'] = $homeSettings->courses_discount;
//        $this->data['masters_discount'] = $homeSettings->masters_discount;
//        $this->data['diplomas_discount'] = $homeSettings->diplomas_discount;*/

        $this->data['sliders'] = Slider::where('status', 1)->get();
        $this->data['categories'] = $categories = Categories::where('show_menu', 1)->get();
        $homeCategories = Categories::where('show_home', 1)->orderBy('sort', 'ASC')->get();
        foreach($homeCategories as $category){
            $this->data['coursesPerCategory'][$category->name_en] = Courses::where('published', 1)->where('categories_id', $category->id)->where('type', '!=', Courses::TYPE_WEBINAR)->where('type', '!=', Courses::TYPE_BUNDLES)->skip(0)->take(5)->get();
        }


        $exchangeRate = Payments::exchangeRate();
        $this->data['subscription_monthly'] = round($homeSettings->MonthlyB2cSubscriptionPrice);
        $this->data['subscription_yearly'] = round($homeSettings->subscription_yearly * $exchangeRate);
        $this->data['subscription_yearly_after'] = round($homeSettings->YearlyB2cSubscriptionPrice);
        $this->data['subscription_yearly_before'] = round(($homeSettings->MonthlyB2cSubscriptionPrice * 12));
        return view('website.home', $this->data);
    }

    public function professionalcertificateshome()
    {

        $homeSettings = Homesettings::where('id', 1)->first();

        $this->data['featuredCourses'] = Courses::where('published', 1)->where('type', Courses::TYPE_PROFESSIONAL_CERTIFICATES)
            ->skip(0)->take(16)->orderBy('sort', 'asc')->get(); //Best Learning


        $this->data['sliders'] = Slider::where('status', 1)->get();
        $this->data['categories'] = $categories = Categories::where('show_menu', 1)->get();
        $homeCategories = Categories::where('show_home', 1)->orderBy('sort', 'ASC')->get();
        foreach($homeCategories as $category){
            $this->data['coursesPerCategory'][$category->name_en] = Courses::where('published', 1)->where('categories_id', $category->id)->where('type', '!=', Courses::TYPE_WEBINAR)->where('type', '!=', Courses::TYPE_BUNDLES)->skip(0)->take(5)->get();
        }
        $exchangeRate = Payments::exchangeRate();
        return view('website.professionalcertificates', $this->data);
    }

    public function businessCourses()
    {

        if(Courses::isBusinessProfileInComplete()){
            alert()->error(trans('website.Please complete your informations to be able to properly browse the site'), "Error");
            return redirect('account/complete');
        }


        $businessdata = Businessdata::findOrfail(Auth::user()->businessdata_id);
        $this->data['businessdata'] = $businessdata;
        $this->data['businessCourses'] = $businessdata->businesscourses;
//        dd( $this->data['businessCourses'] );

        if(!Auth::user()->businessgroupsusersuser->isEmpty()){
            //Check if user in group
            if (Auth::user()->businessgroupsusersuser[0]->businessgroups){
                $businessgroupscourses = Businessgroups::where('id',Auth::user()->businessgroupsusersuser[0]->businessgroups['id'])->first();
                $this->data['businessCourses'] = $businessgroupscourses->businessgroupscoursesrows;

                $this->data['Group'] = true;
            }
        }

        return view('website.businessCourses', $this->data);
    }
    public function welcome()
    {

        $rowId = 456; // generate a unique() row ID
        $userID = 2; // the user ID to bind the cart contents

        // add the product to cart
        Cart::session($userID)->add(array(
            'id' => $rowId,
            'name' => 'product',
            'price' => 3000,
            'quantity' => 4,
            'attributes' => array(),
            'associatedModel' => 'Model',
        ));
        $items = Cart::getContent();

        //        dd( getDir() );

        return view(layoutHomePage('website'));
    }




    public function deleteImage($model, $id, Request $request)
    {
        if (auth()->check()) {

            if (file_exists(env('UPLOAD_PATH_1') . DS . $request->name)) {
                $model = 'App\\Application\\Model\\' . ucfirst($model);
                $filed = $request->has('filed_name') ? $request->get('filed_name') : 'image';
                if (class_exists($model)) {
                    $item = $model::findorFail($id);
                    if (json_decode($item->{$filed})) {
                        $array = [];
                        foreach (json_decode($item->{$filed}) as $file) {
                            if ($file != $request->name) {
                                $array[] = $file;
                            }
                        }
                        $item->{$filed} = json_encode($array);
                        $item->save();
                        alert()->success("Done Delete", "Done");
                        return redirect()->back();
                    }elseif(isset($item->{$filed})){
                        $item->{$filed} = NULL;
                        $item->save();
                        alert()->success("Done Delete", "Done");
                        return redirect()->back();
                    }
                    alert()->error("Filed not found", "Error");
                    return redirect()->back();
                }
                alert()->error("Class not exists", "Error");
                return redirect()->back();
            }
            alert()->error("File not exists", "Error");
            return redirect()->back();
        }
        abort('404');
    }

    public function cart(Request $request)
    {
        // Start Check if order new 
        $order = getCurrentOrder();
        if(isset($order)){

            // $postAffPro = new PostAffiliateProIntegration;
            // $order->aff_id = $postAffPro->getAffiliateId($request);

            if ($order->accept_status) {
                //new Order
                $order = $this->dublicateOrderPositions($order->id);
            }

            //Update Cart
            Promotionactive::updateOrderPositions(Auth::user()->id);
        }

        $this->data['title'] = '';

        $this->data['paymentMethods'] = $paymentMethods = PaymentMethods::where('status', 1)->get();


        return view('website.cart', $this->data);
    }
    public function cartPayments()
    {
        return view('website.cartPayments');
    }
    public function cartFinish()
    {

        if (count(getShoppingCart()) < 1) {
            alert()->error(trans('website.Cart empty'), "Error");
            return redirect()->back();
        }

        //User Order

        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);
        })->orderBy('id', 'DESC')->first();

        if ($order->accept_status) {
            //new Order
            $order = $this->dublicateOrderPositions($order->id);
        }


        $currency = getCurrency();
        $amount_cents = ceil(getShoppingCartCost()) * 100;
        switch($currency) {
            case('EGP'):
                $amount_cents = round( $amount_cents);
                break;

            case('AED'):
                $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                break;

            case('SAR'):
                $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                break;

            default:
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
        }


        $visa = new AcceptPaymentsIntegration;
        $result = $visa->init($order, $amount_cents);

        if (!isset($result)) {
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
        }

        // save accept_status in order
        $order->accept_status = 1;
        $order->save();

        $payment_token = $result;

        $this->data['payment_token'] = $payment_token;
        $this->data['order'] = $order;
        $this->data['amount'] = (int) getShoppingCartCost();

        $facebookConversionsApi = new FacebookConversionsAPI();
        $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_INITIATECHECKOUT,$order);

        return view('website.cartFinish', $this->data);
    }

    public function cartFinishDirect()
    {
        $course_id = $_GET['id'];
        //Create new order

        $course = Courses::findOrfail($course_id);

        $order = createDirectPayOrder($course);

        $currency = getCurrency();
        $amount_cents = ceil($course->OriginalPrice) * 100;

        switch($currency) {
            case('EGP'):
                $amount_cents = round( $amount_cents);
                break;

            case('AED'):
                $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                break;

            case('SAR'):
                $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                break;

            default:
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
        }


        $visa = new AcceptPaymentsIntegration;
        $result = $visa->init($order, $amount_cents);

        if (!isset($result)) {
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
        }


        // save accept_status in order
        $order->accept_status = 1;
        $order->save();

        $payment_token = $result;

        return response()->json(['success'=>true , 'type'=>'direct' , 'token'=>$payment_token ,'order'=>$order], 200);


    }

    static function dublicateOrderPositions($Order_id)
    {
        $oldOrder = Orders::where('user_id', Auth::user()->id)->where('id', $Order_id)->with('ordersposition')->orderBy('id', 'DESC')->first();
        $oldOrder->load('ordersposition');

        $newOrder = $oldOrder->replicate();
        $newOrder->accept_status = 0;
        $newOrder->accept_order_id = null;
        $newOrder->tamara_order_id = null;
        $newOrder->tamara_checkout_id = null;
        $newOrder->tamara_checkout_url = null;
        $newOrder->tamara_status = null;
        $newOrder->save();



        foreach ($oldOrder->ordersposition as $option) {
            $new_option = $option->replicate();
            $new_option->orders_id = $newOrder->id;
            $new_option->push();
        }
        // dd($newOrder);
        $oldOrder->status = Orders::STATUS_FAILED;
        $oldOrder->save();


        return $newOrder;
    }

    public function cartFinishVodafone()
    {

        if (count(getShoppingCart()) < 1) {
            alert()->error(trans('website.Cart empty'), "Error");
            return redirect('/cart');
        }


        ///////////// Variables \\\\\\\\\\\\\\
        $this->data['amount'] = getShoppingCartCost();
        $currency = getCurrency();
        $amount_cents = ceil(getShoppingCartCost()) * 100;
        switch($currency) {
            case('EGP'):
                $amount_cents = round( $amount_cents);
                break;

            case('AED'):
                $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                break;

            case('SAR'):
                $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                break;

            default:
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
        }


        //User Order:
        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);

        })->orderBy('id', 'DESC')->first();

        $order->status = Orders::STATUS_VODAFONE;
        $order->save();


        //Clear PromoCode
        Promotionactive::removeActivePromo();

        $this->data['order'] = $order;

        return view('website.cartFinishVodafone', $this->data);
    }

    public function cartFinishVodafoneDirect()
    {

        $course_id = $_GET['id'];

        $course = Courses::findOrfail($course_id);

        //Create new order

        $order = createDirectPayOrder($course);

        $currency = getCurrency();
        $amount_cents = ceil($course->OriginalPrice) * 100;

        switch($currency) {
            case('EGP'):
                $amount_cents = round( $amount_cents);
                break;

            case('AED'):
                $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                break;

            case('SAR'):
                $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                break;

            default:
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
        }


        $order->status = Orders::STATUS_VODAFONE;
        $order->save();

        $this->data['order'] = $order;

        return response()->json(['success'=>true , 'type'=>'direct' , 'order'=>$order], 200);

    }


    public function cartFinishKiosk($type = 'masary')
    {
        if (count(getShoppingCart()) < 1) {
            alert()->error(trans('website.Cart empty'), "Error");
            return redirect('/cart');
        }

        $this->data['amount'] = (int) getShoppingCartCost();
        $currency = getCurrency();
        $amount_cents = ceil(getShoppingCartCost()) * 100;
        switch($currency) {
            case('EGP'):
                $amount_cents = round( $amount_cents);
                break;

            case('AED'):
                $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                break;

            case('SAR'):
                $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                break;

            default:
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
        }


        //User Order:
        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);
        })->orderBy('id', 'DESC')->first();

        $kiosk = new ModelKioskIntegration;
        $result = $kiosk->init($order, $amount_cents, ModelKioskIntegration::KIOSK_PAYMENT_TYPE, ModelKioskIntegration::KIOSK_PAYMENT_TYPE);

        if(!isset($result['data']['bill_reference'])){
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
        }

        $payment_data = $result['data']['bill_reference'];
        $order->kiosk_id = $payment_data;
        $order->status =  Orders::STATUS_KIOSK;
        $order->save();

        $this->data['payment_data'] = $payment_data;
        $this->data['order'] = $order;

        $this->data['type'] = $type;
        return view('website.cartFinishKiosk', $this->data);
    }


    public function cartFinishKioskDirect($type = 'masary')
    {
        $course_id = $_GET['id'];
        //Create new order

        $course = Courses::findOrfail($course_id);

        //Check the existing of pending order for this user

        $order = createDirectPayOrder($course);


        $currency = getCurrency();
        $amount_cents = ceil($course->OriginalPrice) * 100;
        switch($currency) {
            case('EGP'):
                $amount_cents = round( $amount_cents);
                break;

            case('AED'):
                $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                break;

            case('SAR'):
                $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                break;

            default:
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
        }



        $kiosk = new ModelKioskIntegration;

        $result = $kiosk->init($order, $amount_cents, ModelKioskIntegration::KIOSK_PAYMENT_TYPE, ModelKioskIntegration::KIOSK_PAYMENT_TYPE);

        if(!isset($result['data']['bill_reference'])){
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
        }

        $payment_data = $result['data']['bill_reference'];
        $order->kiosk_id = $payment_data;
        $order->status =  Orders::STATUS_KIOSK;
        $order->save();

        $this->data['payment_data'] = $payment_data;
        $this->data['order'] = $order;
        $this->data['type'] = $type;

        return response()->json(['success'=>true , 'type'=>'direct' , 'payment_data'=>$payment_data ,'order'=>$order], 200);
    }

    public function cartFinishFawry()
    {
        if (count(getShoppingCart()) < 1) {
            alert()->error(trans('website.Cart empty'), "Error");
            return redirect('/cart');
        }
        $this->data['amount'] = (int) getShoppingCartCost();
        //User Order:
        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);
        })->orderBy('id', 'DESC')->first();

        $currency = getCurrency();

        $amount_cents = ceil(getShoppingCartCost()) * 100;
        switch($currency) {
            case('EGP'):
                $amount_cents = round( $amount_cents);
                break;

            case('AED'):
                $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                break;

            case('SAR'):
                $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                break;

            default:
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
        }


        $fawry = new ModelFawryIntegration;
        $payment_data = $fawry->init($order, $amount_cents);

        $order->status =  Orders::STATUS_FAWRY;
        $order->save();


        $this->data['payment_data'] = $payment_data;
        $this->data['order'] = $order;


        return view('website.fawry', $this->data);
    }

    public function cartFinishFawryDirect()
    {
        $course_id = $_GET['id'];
        //Create new order

        $course = Courses::findOrfail($course_id);

        $order = createDirectPayOrder($course);

        $currency = getCurrency();

        $amount_cents = ceil($course->OriginalPrice) * 100;
        switch($currency) {
            case('EGP'):
                $amount_cents = round( $amount_cents);
                break;

            case('AED'):
                $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                break;

            case('SAR'):
                $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                break;

            default:
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
        }


        $fawry = new ModelFawryIntegration;
        $payment_data = $fawry->init($order, $amount_cents);

        $order->status =  Orders::STATUS_FAWRY;
        $order->save();


        return response()->json(['success'=>true , 'type'=>'direct' , 'payment_data'=>$payment_data ,'order'=>$order], 200);
    }

    public function cartFinishMobileWallet()
    {

        if (count(getShoppingCart()) < 1) {
            alert()->error(trans('website.Cart empty'), "Error");
            return redirect('/cart');
        }
        $this->data['amount'] = (int) getShoppingCartCost();
        //User Order:
        $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
            $query->where('status', Orders::STATUS_PENDING);
        })->orderBy('id', 'DESC')->first();
        $currency = getCurrency();
        $amount_cents = ceil(getShoppingCartCost()) * 100;
        switch($currency) {
            case('EGP'):
                $amount_cents = round( $amount_cents);
                break;

            case('AED'):
                $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                break;

            case('SAR'):
                $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                break;

            default:
                //get Exchange rate
                $exchangeRate = Payments::exchangeRate();
                $amount_cents = round($exchangeRate * $amount_cents);
        }


        if (!empty($_POST['mobile'])) {

            $mobile = $_POST['mobile'];

            $wallet = new MobilewalletIntegration;
            $result = $wallet->init($order, $amount_cents, MobilewalletIntegration::KIOSK_PAYMENT_TYPE, $mobile);

            if (isset($result['redirect_url'])) {
                return redirect($result['redirect_url']);
            } else {
                if (isset($result['error'])) {
                    alert()->info(trans('website.Wrong'), $result['error']);
                } else {
                    alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                }
            }


            $order->status =  Orders::STATUS_MOBILEWALLET;
            $order->save();
        }

        $this->data['order'] = $order;


        return view('website.mobilewallet', $this->data);
    }

    public function cartFinishMobileWalletDirect()
    {
        if (!empty($_GET['mobile'])) {

            $mobile = $_GET['mobile'];
            $course_id = $_GET['course_id'];

            //Create new order

            $course = Courses::findOrfail($course_id);

            $order = createDirectPayOrder($course);

            $currency = getCurrency();
            $amount_cents = ceil($course->OriginalPrice) * 100;
            switch($currency) {
                case('EGP'):
                    $amount_cents = round( $amount_cents);
                    break;

                case('AED'):
                    $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                    $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                    break;

                case('SAR'):
                    $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                    $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                    break;

                default:
                    //get Exchange rate
                    $exchangeRate = Payments::exchangeRate();
                    $amount_cents = round($exchangeRate * $amount_cents);
            }


            $wallet = new MobilewalletIntegration;
            $result = $wallet->init($order, $amount_cents, MobilewalletIntegration::KIOSK_PAYMENT_TYPE, $mobile);

            if (isset($result['redirect_url']) AND !empty($result['redirect_url'])) {

                return response()->json(['success'=>true ,'redirect_url'=>$result['redirect_url'], 'type'=>'direct' ,'order'=>$order], 200);

            }elseif (isset($result['iframe_redirection_url'])) {

                return response()->json(['success'=>true ,'redirect_url'=>$result['iframe_redirection_url'], 'type'=>'direct' ,'order'=>$order], 200);

            } else {
                if (isset($result['error'])) {
                    return response()->json(['success'=>false , 'type'=>'direct'], 200);
                } else {
                    return response()->json(['success'=>false , 'type'=>'direct'], 200);
                }
            }

            $order->status =  Orders::STATUS_MOBILEWALLET;
            $order->save();

            return response()->json(['success'=>true , 'type'=>'direct' ,'order'=>$order], 200);

        }


        return response()->json(['success'=>true , 'type'=>'direct' ], 200);
    }


    public function insertCoupon(Request $request)
    {

        $bundleDiscountSetting = Setting::where('id', 9)->get()[0];

        if($bundleDiscountSetting->status == 1 && count(getShoppingCart()) > 1){

            alert()->error(trans('defualt.Problem adding the coupon'), trans('website.bundle discount applied'));
            return redirect()->back();

        }else{

            //Save data:
            if (isset($_POST['code'])) {

                // submitted values
                $code = $_POST['code'];
                $course_id = isset($_POST['course_id']) ? $_POST['course_id'] : null;
                $promoRow = Promotions::where('code', $code)->first();

                /*  if ($promoRow && Promotions::isValid($promoRow, $course_id)) {

                      $Promotionactive = Promotionactive::setActivePromo($promoRow->id);
                      alert()->success(trans('defualt.Coupon added successfully'), trans('website.Success'));
                      if($course_id){
                          $coursesController = new CoursesController(Courses::findOrFail($course_id));
                          $coursesController->addToCart($course_id, $request);
                      }
                  */

                if($promoRow){
                    if($promoRow->type == Promotions::TYPE_B2C_FIXED || $promoRow->type == Promotions::TYPE_B2C_PERCENT
                        || $promoRow->type == Promotions::TYPE_B2C_PERCENT_MONTHLY || $promoRow->type == Promotions::TYPE_B2C_PERCENT_MONTHLY){
                        if(Promotions::isValidB2c($promoRow) || Promotions::isValidB2cMonthly($promoRow) || Promotions::isValidB2cAnnual($promoRow)){
                            $Promotionactive = Promotionactive::setActivePromo($promoRow->id, Promotionactive::TYPE_B2C);
                            alert()->success(trans('defualt.Coupon added successfully'), trans('website.Success'));
                        }else{
                            alert()->error(trans('defualt.Problem adding the coupon'), trans('website.Error Message'));
                        }
                    }else{
                        if (Promotions::isValid($promoRow, $course_id)) {
                            $Promotionactive = Promotionactive::setActivePromo($promoRow->id);
                            alert()->success(trans('defualt.Coupon added successfully'), trans('website.Success'));
                            if($course_id){
                                $coursesController = new CoursesController(Courses::findOrFail($course_id));
                                $coursesController->addToCart($course_id);
                            }
                        } else {
                            alert()->error(trans('defualt.Problem adding the coupon'), trans('website.Error Message'));
                        }
                    }
                } else {

                    alert()->error(trans('defualt.Problem adding the coupon'), trans('website.Error Message'));

                }
            }

        }

        //Update Cart
        Promotionactive::updateOrderPositions(Auth::user()->id);
        return redirect()->back();
    }

    public function insertCouponAjax()
    {

        //Save data:
        if (isset($_GET['code'])) {
//            $course = Courses::findOrfail($_GET['course_id']) ;
            // submitted values
            $code = $_GET['code'];
            $promoRow = Promotions::where('code', $code)->first();
            if($promoRow){
                if($promoRow->type == Promotions::TYPE_B2C_FIXED || $promoRow->type == Promotions::TYPE_B2C_PERCENT
                    || $promoRow->type == Promotions::TYPE_B2C_PERCENT_MONTHLY || $promoRow->type == Promotions::TYPE_B2C_PERCENT_MONTHLY){
                    if(Promotions::isValidB2c($promoRow) || Promotions::isValidB2cMonthly($promoRow)){
                        $Promotionactive = Promotionactive::setActivePromo($promoRow->id, Promotionactive::TYPE_B2C);
                        return response()->json(['success'=>true ,'title'=>trans('website.Success'),'text'=>trans('defualt.Coupon added successfully'),'promo'=>$code, 'type'=>'success'], 200);
                    }else{
                        return response()->json(['success'=>false ,'title'=>trans('website.Error Message'),'text'=>trans('defualt.Problem adding the coupon'), 'type'=>'error'], 200);
                    }
                }else{
                    return response()->json(['success'=>false ,'title'=>trans('website.Error Message'),'text'=>trans('defualt.Problem adding the coupon'), 'type'=>'error'], 200);
                }
            } else {
                return response()->json(['success'=>false ,'title'=>trans('website.Error Message'),'text'=>trans('defualt.Problem adding the coupon'), 'type'=>'error'], 200);
            }
        }

        // Update Cart
        // Promotionactive::updateOrderPositions(Auth::user()->id);

        return response()->json(['success'=>true , 'type'=>'direct'], 200);

    }

    public function removePromoAjax()
    {
//        $course = Courses::findOrfail($_GET['course_id']) ;
        Promotionactive::where('user_id', Auth::user()->id)->where('status', 1)->update(array('status' => 0));
        //Update Cart
//        Promotionactive::updateOrderPositions(Auth::user()->id);
        return response()->json(['success'=>true ,'title'=>trans('website.Success'),'text'=>trans('defualt.Coupon was deleted successfully'), 'type'=>'success'], 200);
    }


    public function removePromo()
    {
        Promotionactive::where('user_id', Auth::user()->id)->where('status', 1)->update(array('status' => 0));
        alert()->warning(trans('defualt.Coupon was deleted successfully'), trans('website.Error Message'));

        //Update Cart
        Promotionactive::updateOrderPositions(Auth::user()->id);
        return redirect()->back();
    }

    public function actionHasWallet($id)
    {


        //User Order:
        $order = Orders::where('user_id', Auth::user()->id)->where('id', $id)->orderBy('id', 'DESC')->first();
        $order->status = Orders::STATUS_PENDING;
        $order->save();

        return redirect('/site/cartFinishMobileWallet');
    }


    public function directPay(Request $request){


        $this->data['payment_token'] = null;
        $this->data['tamra_token'] = null;

        if($request->has('currency') && $request->has('amount') && $request->has('type') ){
            $currency = $request->get('currency');
            $amount = ceil($request->get('amount'));


            $orderPositions = newDirectPayOrder($amount, $currency);
            $this->data['orderPosition'] = $orderPositions;

            if($request->get('type') == 'Visa'){
                $visa = new AcceptPaymentsIntegration;

                $amount_cents = ceil($amount) * 100;
                $amount_cents = Currencies::getAmountcentsByCurrencyID($currency , Currencies::DEFUALT_CURRENCY, $amount_cents);
                $result = $visa->init($orderPositions->orders, $amount_cents);

                if (!isset($result)) {
                    alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                    return redirect()->back();
                }

                $this->data['payment_token'] = $result;

            }elseif ($request->get('type') == 'Tamara'){

                //Amount Cents After ExchangeRate
                $amount_cents = Currencies::getAmountcentsByCurrencyID($currency , 'SAR', $amount);
                $order2       = [
                    'order_num' => $orderPositions->orders['id'],
                    'total' => $amount_cents,
                    'notes' => 'notes ',
                    'discount_name' => ' ',
                    'discount_amount' => 0,
                    'vat_amount' => 0,
                    'shipping_amount' => 0
                ];

                $products = [];
//                foreach ($orderPositions as $key => $ordersw ){
//
//                    dd($orderPositions);
                    $products['id'] = $orderPositions['id'];
                    $products['type'] = $orderPositions['type'];
                    $products['name'] = "DirectPay - دفع مباشر";
                    $products['sku'] = $orderPositions['id'];
                    $products['image_url'] =  'https://igtsservice.com/website/images/logonew.webp';
                    $products['quantity'] = 1;
                    $products['unit_price'] = $orderPositions['amount'];
                    $products['discount_amount'] = 0;
                    $products['tax_amount'] = 0;
                    $products['total'] = $orderPositions['amount'];
//                }


                $consumer    = [
                    'first_name' => $orderPositions->orders['user']['name'],
                    'last_name' => $orderPositions->orders['user']['name'] ,
                    'phone' => $orderPositions->orders['user']['mobile'],   //566027755
                    'email' => $orderPositions->orders['user']['email']
                ];


                $billing_address  = ['first_name' => $orderPositions['user']['name'],'last_name' => $orderPositions['user']['name'],'line1' => 'mehalla' ,'city' => 'mehalla','phone' => $orderPositions['user']['mobile']];
                $shipping_address = ['first_name' => $orderPositions['user']['name'],'last_name' => $orderPositions['user']['name'],'line1' => 'mehalla' ,'city' => 'mehalla','phone' => $orderPositions['user']['mobile']];
                $urls = [
                    'success' => url('api/site/tamaraConfirmationCallback'),
                    'failure' => url('api/site/tamaraConfirmationCallback'),
                    'cancel' => url('api/site/tamaraConfirmationCallback'),
                    'notification' => url('site/tamaraConfirmationCallback')
                ];

                $response = (new Tamara())->createCheckoutSession($order2,[$products],$consumer,$billing_address,$shipping_address,$urls);

                if (!isset($response)) {
                    // alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                    return response()->json(['success'=>false , 'type'=>'visa'], 400);

                }

                $order = Orders::findOrFail($orderPositions->orders['id']);

                // save tamara in order
                $order->tamara_order_id = $response['order_id'];
                $order->tamara_checkout_id = $response['checkout_id'];
                $order->tamara_checkout_url = $response['checkout_url'];
                $order->tamara_status = $response['status'];
                $order->save();

                $this->data['tamra_token'] = $response['checkout_url'];



            }elseif ($request->get('type') == 'ApplePay'){


                $visa = new AcceptPaymentsIntegration;

                $amount_cents = ceil($amount) * 100;
                $amount_cents = Currencies::getAmountcentsByCurrencyID($currency , Currencies::DEFUALT_CURRENCY, $amount_cents);
                $result = $visa->intention($orderPositions->orders, $amount_cents);

                if (!isset($result)) {
                    alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                    return redirect()->back();
                }

                $this->data['payment_token'] = $result;


                return  redirect("https://uae.paymob.com/unifiedcheckout/?publicKey=" . AcceptPaymentsIntegration::ACCEPT_Public_key . "&clientSecret=" . $result);


            }

        }

        return view('website.directpay', $this->data);
    }

    public function directPay2($orderID, Request $request){


        $order = Orders::findOrFail($orderID);
        $errorMessage = null;
        if(Auth::check() && $order->user_id != Auth::user()->id){
            return redirect('/');
        }

        if($order->status == Orders::STATUS_SUCCEEDED){
            $errorMessage = trans('orders.This order had already been paid');
        }

        if(!Auth::check()){
            $errorMessage = trans('orders.You must sign-in in order to view this page');
        }

        $this->data['error'] = $errorMessage;

        $this->data['order'] = $order;

        $this->data['paymentMethods'] = $paymentMethods = PaymentMethods::where('status', 1)->get();


        $this->data['payment_token'] = null;

        if($request->has('currency') && $request->has('amount')){

            $currency = $request->all()['currency'];
            $amount = $request->all()['amount'];
            $visa = new AcceptPaymentsIntegration;

            $orderPosition = newDirectPayOrder($amount, $currency);
            $this->data['orderPosition'] = $orderPosition;

            $amount_cents = ceil($amount) * 100;

            switch($currency) {
                case('EGP'):
                    $amount_cents = round( $amount_cents);
                    break;

                case('AED'):
                    $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                    $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                    break;

                case('SAR'):
                    $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                    $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                    break;

                default:
                    //get Exchange rate
                    $exchangeRate = Payments::exchangeRate();
                    $amount_cents = round($exchangeRate * $amount_cents);
            }


            $result = $visa->init($orderPosition->orders, $amount_cents);

            if (!isset($result)) {
                alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                return redirect()->back();
            }



            $this->data['payment_token'] = $result;
        }

        return view('website.directpay2', $this->data);
    }

    public function instructor($slug)
    {
        $this->data['instructor'] = User::where('group_id', User::TYPE_INSTRUCTOR)->where('slug', $slug)->firstOrFail();
        $this->data['latestTenCourses'] = $this->data['instructor']->InstructorCoursesWithRelations;
        $this->data['latestTenTalks'] = Talks::where('instructor_id', $this->data['instructor']['id'])->get()->all();
        return view('website.instructor', $this->data);
    }

    public function partner($slug)
    {


        $this->data['partner'] = User::where('group_id', User::TYPE_INSTITUTION)->where('slug', $slug)->firstOrFail();
        $eventsDataId = Eventsdata::where('user_id', $this->data['partner']->id)->firstOrFail()->id;
        $this->data['latestTenCourses'] = Courses::where('instructor_id', $this->data['partner']['id'])->get();
        $this->data['latestTenTalks'] = Talks::where('instructor_id', $this->data['partner']['id'])->get();
        $this->data['latestTenEvents'] = Events::where('eventsdata_id', $eventsDataId)->get();
        return view('website.instructor', $this->data);
    }

    public function AllInstructors()
    {
        $this->data['Instructors'] = User::where('group_id', User::TYPE_INSTRUCTOR)->where('activated', 1)
            ->where('verified', 1)->where('hidden', 0)->paginate(20);
        return view('website.instructors', $this->data);
    }

    public function AllPartners()
    {
        $this->data['Partners'] = Partners::paginate(16);
        $this->data['Achievements'] = Achievements::paginate(16);

        return view('website.partners', $this->data);
    }

    public function joinAsInstructor()
    {
        $this->data['Instructors'] = User::where('group_id', User::TYPE_INSTRUCTOR)->where('activated', 1)->where('verified', 1)->paginate(8);
        return view('website.joinAsInstructor', $this->data);
    }
    public function thankyou()
    {
        $this->data['title'] = trans('partnership.Institution');
        return view('website.partnership.thankyou', $this->data);
    }
    public function landing()
    {
        return view('website.partnership.landing');
    }
    public function business()
    {

        $this->data['title'] = 'Business';
        $this->data['Partners'] = Partners::limit(20)->get();
        $this->data['Testimonials'] = Testimonials::limit(20)->get();
        return view('website.business.newBusiness.index', $this->data);
    }

    public function trainingDisclosureBusiness()
    {

        $this->data['title'] = 'Business';
        $this->data['Partners'] = Partners::limit(20)->get();
        $this->data['Testimonials'] = Testimonials::limit(20)->get();
        return view('website.business.newBusiness.trainingDisclosure', $this->data);
    }


    public function subscriptionsService()
    {
        $this->data['title'] = 'offerPrice';
        $this->data['Partners'] = Partners::limit(20)->get();
        $this->data['logo'] = asset('business/newBusiness/src/images/service-01-logo.png');
        return view('website.business.newBusiness.subscriptionsService', $this->data);
    }
    public function offlineTraining()
    {
        $this->data['title'] = 'offlineTraining';
        $this->data['Partners'] = Partners::limit(20)->get();
        $this->data['logo'] = asset('business/newBusiness/src/images/service-02-logo.png');
        return view('website.business.newBusiness.offlineTraining', $this->data);
    }
    public function professionalCertificates()
    {
        $this->data['title'] = 'professionalCertificates';
        $this->data['Partners'] = Partners::limit(20)->get();
        $this->data['logo'] = asset('business/newBusiness/src/images/service-04-logo.png');
        return view('website.business.newBusiness.professionalCertificates', $this->data);
    }
    public function digitalTransformation()
    {
        $this->data['title'] = 'digitalTransformation';
        $this->data['Partners'] = Partners::limit(20)->get();
        $this->data['logo'] = asset('business/newBusiness/src/images/service-03-logo.png');
        return view('website.business.newBusiness.digitalTransformation', $this->data);
    }

    public function contactus()
    {
        $this->data['title'] = 'contactus';
        $this->data['Partners'] = Partners::limit(20)->get();
        return view('website.business.newBusiness.contactus', $this->data);
    }

    public function offerPrice()
    {
        $this->data['title'] = 'offerPrice';
        $this->data['Partners'] = Partners::limit(20)->get();
        return view('website.business.newBusiness.offerPrice', $this->data);
    }



    public function testNotifi()
    {
        // return User::getById();
        //  return User::addNotification([auth()->user()->id], 'You have a new question lecture ', 'You have a new question lecture ', '/courses/courseLecture/id/');
        // return User::readNotification(auth()->user()->id, "-MQ5IcQ-HemYPXuAHYBF");

    }
    public  function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        //check if exist code
        $code = Eventstickets::where('code', $randomString)->first();
        if ($code) {
            $this->generateRandomString($length);
        }

        return $randomString;
    }
    public function faq()
    {
        $this->data['title'] = trans('faq.faq');
        $this->data['faq'] = Faq::all();


        return view('website.faq', $this->data);
    }
    public function ourteam()
    {
        $this->data['title'] = trans('page.ourteam');

        return view('website.ourteam', $this->data);
    }

    public function verifyCertificate(Request $request) {


        $this->data['certificate'] = null;

        if(isset($request->request->all()['certificate_id'])){

            $this->data['certificate'] = Quizstudentsstatus::where('id', $request->all()['certificate_id'])->where('passed', 1)->whereNotNull('certificate')->first();
        }

        return view('website.verifyCertificate', $this->data);

    }

    public function posts($category=null, $slug=null){


        $post = Posts::where('slug', $slug)->first();

        if($category && $slug && $post){

            return redirect("http://igtsservice.com/blog/".$category.'/'. $slug);

        }elseif($category && !$slug && $post){

            return redirect("http://igtsservice.com/blog/".$category);

        }else{

            return abort(404);

        }

    }

    public function payments(){

        $this->data['paymentMethods'] = $paymentMethods = PaymentMethods::where('status', 1)->get();

        return view('website.payments', $this->data);

    }

    public function paypal($orderID=null){

        $paypalPaymentIntegration = new PaypalPaymentsIntegration;
        $result = ($orderID) ? $paypalPaymentIntegration->init($orderID) : $paypalPaymentIntegration->init();

        if(!$result){
            alert()->error("There has been an issue, please try again", "ERROR");
            return redirect('/cart');
        }

        $order = getCurrentOrder();
        if($orderID){
            $order = Orders::findOrFail($orderID);
        }
        $order->paypalorderid = $result['id'];
        $order->save();

        return redirect($result['links'][1]['href']);

    }

    public function ajaxPayVisa($orderID=null){

        if (!$orderID && count(getShoppingCart()) < 1) {
            return response()->json(['success'=>false , 'type'=>'visa'], 400);
        }

        //User Order

        $order = getCurrentOrder();

        if($orderID){
            $order = Orders::findOrFail($orderID);
        }



        if ($order->accept_status) {
            //new Order
            $order = $this->dublicateOrderPositions($order->id);
        }

        if($orderID){
            $currency = Currencies::getCurrencyCodeByID($order->payments->currency_id);
            $amount_cents = $order->payments->amount * 100;
        }else{
            $currency = getCurrency();
            $amount_cents = ceil(getShoppingCartCost()) * 100;
        }

        //Amount Cents After ExchangeRate
        $amount_cents = Currencies::getAmountcentsByCurrencyID($currency , Currencies::DEFUALT_CURRENCY, $amount_cents);

        $visa = new AcceptPaymentsIntegration();
        $result = $visa->init($order, $amount_cents);

        if (!isset($result)) {
            // alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return response()->json(['success'=>false , 'type'=>'visa'], 400);

        }

        // save accept_status in order
        $order->accept_status = 1;
        $order->save();

        $payment_token = $result;

        return response()->json(['success'=>true , 'type'=>'visa' ,'public_key' => AcceptAEDPaymentsIntegration::ACCEPT_Public_key , 'token'=>$payment_token ,'order'=>$order], 200);

    }
    public function ajaxPayApple($orderID=null){

        if (!$orderID && count(getShoppingCart()) < 1) {
            return response()->json(['success'=>false , 'type'=>'apple'], 400);
        }
        //User Order
        $order = getCurrentOrder();
        if($orderID){
            $order = Orders::findOrFail($orderID);
        }
        if ($order->accept_status) {
            //new Order
            $order = $this->dublicateOrderPositions($order->id);
        }
        if($orderID){
            $currency = Currencies::getCurrencyCodeByID($order->payments->currency_id);
            $amount_cents = $order->payments->amount * 100;
        }else{
            $currency = getCurrency();
            $amount_cents = ceil(getShoppingCartCost()) * 100;
        }

        //Amount Cents After ExchangeRate
        $amount_cents = Currencies::getAmountcentsByCurrencyID($currency , Currencies::DEFUALT_CURRENCY, $amount_cents);


        $visa = new AcceptPaymentsIntegration();
        $result = $visa->intention($order, $amount_cents);

        if (!isset($result)) {
            // alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return response()->json(['success'=>false , 'type'=>'apple'], 400);
        }

        // save accept_status in order
        $order->accept_status = 1;
        $order->save();


        return response()->json(['success'=>true , 'type'=>'apple' ,'public_key' => AcceptPaymentsIntegration::ACCEPT_Public_key , 'client_secret'=>$result ,'order'=>$order], 200);

    }


    public function ajaxPayTamara($orderID=null){



        if (!$orderID && count(getShoppingCart()) < 1) {
            return response()->json(['success'=>false , 'type'=>'tamara'], 400);
        }

        //User Order

        $order = getCurrentOrder();
        if($orderID){
            $order = Orders::findOrFail($orderID);
        }
        if ($order->tamara_order_id) {
            //new Order
            $order = $this->dublicateOrderPositions($order->id);
        }
        if($orderID){
            $currency = Currencies::getCurrencyCodeByID($order->payments->currency_id);
            $amount_cents = $order->payments->amount ;
        }else{
            $currency = getCurrency();
            $amount_cents = ceil(getShoppingCartCost()) ;
        }

        //Amount Cents After ExchangeRate
        $amount_cents = Currencies::getAmountcentsByCurrencyID($currency , 'SAR', $amount_cents);

//        $order2 = ['phone' => '00966511111110', 'total' => 1000];
//        $response = (new Tamara())->checkPaymentOptionsAvailability($order2);



        $order2       = [
            'order_num' => $order->id,
            'total' => $amount_cents,
            'notes' => 'notes ',
            'discount_name' => ' ',
            'discount_amount' => 0,
            'vat_amount' => 0,
            'shipping_amount' => 0
        ];


//        $products[0] = ['id' => '123','type' => 'mobiles' ,'name' => 'iphone','sku' => 'SA-12436','image_url' => 'https://example.com/image.png','quantity' => 1,
//            'unit_price'=>50,'discount_amount' => 5,'tax_amount'=>10,'total' => 70];
//        $products[1] = ['id' => '345','type' => 'labtops' ,'name' => 'macbook air','sku' => 'SA-789','image_url' => 'https://example.com/image.png','quantity' => 1,'unit_price'=>200,'discount_amount' => 50,'tax_amount'=>100,'total' => 300];
        $products = [];
        foreach ($order->ordersposition as $key => $orderPosition ){
            $products[$key]['id'] = $orderPosition['id'];
            $products[$key]['type'] = $orderPosition['type'];
            $products[$key]['name'] = $orderPosition['type'] == Ordersposition::TYPE_Course ? $orderPosition['courses']['title_en'] : 'Certificate';
            $products[$key]['sku'] = $orderPosition['id'];
            $products[$key]['image_url'] = $orderPosition['type'] == Ordersposition::TYPE_Course ? 'https://igtsservice.com/uploads/files/medium/'.$orderPosition['courses']['image'] : 'https://igtsservice.com/website/images/logonew.webp';
            $products[$key]['quantity'] = $orderPosition['quantity'];
            $products[$key]['unit_price'] = $orderPosition['amount'];
            $products[$key]['discount_amount'] = 0;
            $products[$key]['tax_amount'] = 0;
            $products[$key]['total'] = $orderPosition['amount'];
        }

        $consumer    = [
            'first_name' => $order['user']['name'],
            'last_name' => $order['user']['name'] ,
            'phone' => $order['user']['mobile'],   //566027755
            'email' => $order['user']['email']
        ];
        $billing_address  = ['first_name' => $order['user']['name'],'last_name' => $order['user']['name'],'line1' => 'mehalla' ,'city' => 'mehalla','phone' => $order['user']['mobile']];
        $shipping_address = ['first_name' => $order['user']['name'],'last_name' => $order['user']['name'],'line1' => 'mehalla' ,'city' => 'mehalla','phone' => $order['user']['mobile']];
        $urls = [
            'success' => url('api/site/tamaraConfirmationCallback'),
            'failure' => url('api/site/tamaraConfirmationCallback'),
            'cancel' => url('api/site/tamaraConfirmationCallback'),
            'notification' => url('site/tamaraConfirmationCallback')
        ];
        $response = (new Tamara())->createCheckoutSession($order2,$products,$consumer,$billing_address,$shipping_address,$urls);
//        return redirect()->to($response['checkout_url']);

        if (!isset($response)) {
            // alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return response()->json(['success'=>false , 'type'=>'tamara'], 400);

        }

        // save tamara in order
        $order->tamara_order_id = $response['order_id'];
        $order->tamara_checkout_id = $response['checkout_id'];
        $order->tamara_checkout_url = $response['checkout_url'];
        $order->tamara_status = $response['status'];
        $order->save();

        return response()->json(['success'=>true , 'type'=>'tamara' ,'checkout_url' => $response['checkout_url'] ,'order'=>$order], 200);
    }


    public function ajaxPayTabby($orderID = null)
    {


        try {
            // التحقق من الطلب
            if (!$orderID && count(getShoppingCart()) < 1) {
                return response()->json(['success' => false, 'type' => 'tabby'], 400);
            }

            // جلب الطلب الحالي أو المحدد
            $order = $orderID ? Orders::findOrFail($orderID) : getCurrentOrder();

            if ($order->tabby_order_id) {
                $order = $this->dublicateOrderPositions($order->id);
            }

            $currency = $orderID ? Currencies::getCurrencyCodeByID($order->payments->currency_id) : getCurrency();
            $amount_cents = $orderID ? $order->payments->amount : ceil(getShoppingCartCost());
            $amount_cents = Currencies::getAmountcentsByCurrencyID($currency, 'SAR', $amount_cents);

            $products = [];
            foreach ($order->ordersposition as $key => $orderPosition) {
                $products[$key] = [
                    'title' => Ordersposition::TYPE_Course ? $orderPosition['courses']['title_en'] : 'Certificate',
                    'description' => "Course Description",
                    'quantity' => 1,
                    'unit_price' => $orderPosition['amount'],
                    'discount_amount' => "0.00",
                    'reference_id' => $orderPosition['id'],
                    'image_url' => Ordersposition::TYPE_Course ? 'https://igtsservice.com/uploads/files/medium/' . $orderPosition['courses']['image'] : 'https://igtsservice.com/website/images/logonew.webp',
                    'product_url' => Ordersposition::TYPE_Course ? 'https://igtsservice.com/ar/courses/view/' . $orderPosition['courses']['slug'] : 'https://igtsservice.com',
                    'gender' => "Male",
                    'category' => "Course Category",
                    'color' => "color",
                    'product_material' => "product_material",
                    'size_type' => "size_type",
                    'size' => "size",
                    'brand' => "brand",
                    'is_refundable' => true
                ];
            }

            // تحضير بيانات الدفع
            $paymentData = [
                "payment" => [
                    "amount" => $amount_cents,
                    "currency" => "SAR",
                    "description" => "Course",
                    "buyer" => [
                        "phone" => formatPhone($order['user']['mobile']),
                        "email" => $order['user']['email'],
                        "name" => $order['user']['name'],
                        "dob" => "1990-08-24"
                    ],
                    "shipping_address" => [
                        "city" => "city",
                        "address" => "address",
                        "zip" => "002"
                    ],
                    "order" => [
                        "tax_amount" => "0.00",
                        "shipping_amount" => "0.00",
                        "discount_amount" => "0.00",
                        "updated_at" => now()->toIso8601String(),
                        "reference_id" => (string) $order->id,
                        "items" => $products
                    ],
                    "buyer_history" => [
                        "registered_since" => Auth::user()->created_at->toIso8601String(),
                        "loyalty_level" => 0,
                        "wishlist_count" => 0,
                        "is_social_networks_connected" => true,
                        "is_phone_number_verified" => true,
                        "is_email_verified" => true
                    ],

                ],
                "lang" => config('app.locale'),
                "merchant_code" => env('TABBY_MERCHANT_CODE'),
                "merchant_urls" => [
                    "success" => url('api/site/tabbyConfirmationCallback'),
                    "cancel" => url('api/site/tabbyConfirmationCallback/cancel'),
                    "failure" => url('api/site/tabbyConfirmationCallback/failure')
                ],
                "token" => null
            ];

            $response = Tabby::createCheckoutSession($paymentData);

            if (!$response) {
                return response()->json(['success' => false, 'type' => 'tabby'], 400);
            }

            // حفظ البيانات في الطلب
            $order->tabby_order_id = $response['id'];
            $order->tabby_order_status = $response['status'];
            $order->tabby_order_warnings = $response['warnings'] ?? '';
            $order->tabby_payment_id = $response['payment']['id'] ?? '';
            $order->tabby_checkout_url = $response['configuration']['available_products']['installments'][0]['web_url'] ?? '';
            $order->save();

            return response()->json([
                'success' => true,
                'type' => 'tabby',
                'checkout_url' => $response['configuration']['available_products']['installments'][0]['web_url'] ?? '',
                'order' => $order
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function ajaxPayVisaConsultation(Request $request){

        $consultation = Consultations::findOrFail($request->get('consultation_id'));

        $array = DB::transaction(function () use ($consultation, $request) {

            $error = false;

            //Consultation Request 
            $consultationRequest = Consultationsrequests::where('user_id', Auth::user()->id)->where('consultation_id', $request->get('consultation_id'))->where('status', Consultationsrequests::STATUS_PENDING)->orderBy('id', 'DESC')->first();

            if(!$consultationRequest){
                $consultationRequest = new Consultationsrequests();
            }

            $consultationRequest->user_id = Auth::user()->id;
            $consultationRequest->request = $request->get('description');
            $consultationRequest->scheduled_at = $request->get('dateTime');
            $consultationRequest->consultation_id = $consultation->id;
            $consultationRequest->status = Consultationsrequests::STATUS_PENDING;
            $consultationRequest->save();

            $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
                $query->where('status', Orders::STATUS_CONSULTATION);
            })->where('consultationrequest_id', $consultationRequest->id)->orderBy('id', 'DESC')->first();

            if(!$order){
                //User Order
                $order = new Orders();
                $order->status = Orders::STATUS_CONSULTATION;
                $order->user_id = Auth::user()->id;
                $order->type = Orders::TYPE_ONLINE;
                $order->consultationrequest_id = $consultationRequest->id;
                $order->currency = getCurrency();
                $order->save();
            }

            if ($order->accept_status) {
                //new Order
                $order = $this->dublicateOrderPositions($order->id);
            }

            $currency = getCurrency();
            $amount_cents = $consultation->OriginalPrice;
            switch($currency) {
                case('EGP'):
                    $amount_cents = round( $amount_cents);
                    break;

                case('AED'):
                    $aedToEGPExchangeRate = getSetting('AED_EGP') ? getSetting('AED_EGP') : 11;
                    $amount_cents = round($aedToEGPExchangeRate * $amount_cents);
                    break;

                case('SAR'):
                    $sarToEGPExchangeRate = getSetting('SAR_EGP') ? getSetting('SAR_EGP') : 11 ;
                    $amount_cents = round($sarToEGPExchangeRate * $amount_cents);
                    break;

                default:
                    //get Exchange rate
                    $exchangeRate = Payments::exchangeRate();
                    $amount_cents = round($exchangeRate * $amount_cents);
            }


            $visa = new AcceptPaymentsIntegration;
            $result = $visa->init($order, ($amount_cents * 100));

            if (!isset($result)) {
                // alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                $error = true;
                DB::rollBack();
            }


            // save accept_status in order
            // $order->accept_status = 1;
            // $order->save();

            // $payment_token = $result;

            return compact('order', 'result', 'error');


        });

        if(!$array['error']){
            $array['order']->accept_status = 1;
            $array['order']->save();
            return response()->json(['success'=>true , 'type'=>'visa' , 'token'=>$array['result'] ,'order'=>$array['order']], 200);
        }else{
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return response()->json(['success'=>false ,], 400);
            //return redirect()->back();
        }

    }

    public function paypalConsultation(Request $request){

        $consultation = Consultations::findOrFail($request->get('consultation_id'));

        $array = DB::transaction(function () use ($consultation, $request) {

            $error = false;

            //Consultation Request 
            $consultationRequest = Consultationsrequests::where('user_id', Auth::user()->id)->where('consultation_id', $request->get('consultation_id'))->where('status', Consultationsrequests::STATUS_PENDING)->orderBy('id', 'DESC')->first();

            if(!$consultationRequest){
                $consultationRequest = new Consultationsrequests();
            }

            $consultationRequest->user_id = Auth::user()->id;
            $consultationRequest->request = $request->get('description');
            $consultationRequest->scheduled_at = $request->get('dateTime');
            $consultationRequest->consultation_id = $consultation->id;
            $consultationRequest->status = Consultationsrequests::STATUS_PENDING;
            $consultationRequest->save();

            $order = Orders::where('user_id', Auth::user()->id)->where(function ($query) {
                $query->where('status', Orders::STATUS_CONSULTATION);
            })->where('consultationrequest_id', $consultationRequest->id)->orderBy('id', 'DESC')->first();

            if(!$order){
                //User Order
                $order = new Orders();
                $order->status = Orders::STATUS_CONSULTATION;
                $order->user_id = Auth::user()->id;
                $order->type = Orders::TYPE_ONLINE;
                $order->consultationrequest_id = $consultationRequest->id;
                $order->save();
            }


            $currency = getCurrency();
            $amount_cents = $consultation->OriginalPrice;
            $amount_cents = Currencies::getAmountcentsByCurrencyID($currency , Currencies::DEFUALT_CURRENCY, $amount_cents);

            $orderPosition = Ordersposition::where('orders_id', $order->id)->where('user_id', Auth::user()->id)->first();

            if(!$orderPosition){
                $orderPosition = new Ordersposition();
                $orderPosition->orders_id = $order->id;
                $orderPosition->user_id = Auth::user()->id;
                $orderPosition->currency = $currency;
            }

            $orderPosition->amount =  $amount_cents;
            $orderPosition->save();

            //Payment Integration API
            $paypalPaymentIntegration = new PaypalPaymentsIntegration;
            $result = $paypalPaymentIntegration->init($order->id);

// dd($result);
            if (!isset($result)) {
                // alert()->info(trans('website.Wrong'), trans('website.Error Message'));
                $error = true;
                DB::rollBack();
            }


            return compact('order', 'result', 'error');

            // return redirect($result['links'][1]['href']);

        });


        if(!$array['error'] && isset($array['result'])){
            $array['order']->paypalorderid = $array['result']['id'];
            $array['order']->save();
            return response()->json(['success'=>true , 'type'=>'paypal' , 'result'=>$array['result'] ,'order'=>$array['order']], 200);
        }else{
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return response()->json(['success'=>false ,], 400);
            //return redirect()->back();
        }










        //User Order
        // $order = new Orders();
        // $order->status = Orders::STATUS_CONSULTATION;
        // $order->user_id = Auth::user()->id;
        // $order->type = Orders::TYPE_ONLINE;
        // $order->comments = $request->get('description');
        // $order->save();

        // if(getUserCountryByAPI()->currency_code == "EGP"){
        //     $amount = 300;
        // }elseif(getUserCountryByAPI()->currency_code == "SAR"){
        //     $exchangeRate = Payments::exchangeRateSAR();
        //     $amount = (int) 100 * $exchangeRate;
        // }else{
        //     $exchangeRate = Payments::exchangeRate();
        //     $amount = (int) 35 * $exchangeRate;
        // }

        // $payment = new Payments();
        // $payment->amount = $amount;
        // $payment->currency_id = 34;
        // $payment->Status = "Pending";
        // $payment->user_id = Auth::user()->id;
        // $payment->orders_id = $order->id;
        // $payment->save();

        // $orderPosition = new Ordersposition();
        // $orderPosition->orders_id = $order->id;
        // $orderPosition->user_id = Auth::user()->id;
        // $orderPosition->amount =  $amount;
        // $orderPosition->currency = "EGP";
        // $orderPosition->save();

        // $paypalPaymentIntegration = new PaypalPaymentsIntegration;
        // $result = $paypalPaymentIntegration->init($order->id);

        // if(!$result){
        //     alert()->error("There has been an issue, please try again", "ERROR");
        //     return redirect('/cart');
        // }

        // $order->paypalorderid = $result['id'];
        // $order->save();

        // return redirect($result['links'][1]['href']);

    }

    public function getCountry($id){

        $country = Countries::findOrFail($id);

        $data = [
            "name" => $country->name_lang,
            "country_phone_code" => $country->country_phone_code
        ];
        return response()->json(['success'=>true, 'country'=>$data], 200);

    }

    public function consultation(){

        return view('website.consultation');
    }

    public function mobileApp(){

    }



    public function subscriptions(){

        $homeSettings = Homesettings::findOrFail(1);
        $exchangeRate = Payments::exchangeRate();
        $this->data['subscription_monthly'] = round($homeSettings->MonthlyB2cSubscriptionPrice);
        $this->data['subscription_yearly'] = round($homeSettings->subscription_yearly * $exchangeRate);
        $this->data['subscription_yearly_after'] = round($homeSettings->YearlyB2cSubscriptionPrice);
        $this->data['subscription_yearly_before'] = round(($homeSettings->MonthlyB2cSubscriptionPrice * 12));
        $this->data['sliders'] = Subscriptionslider::where('status', 1)->get();
        $this->data['featuredAll'] = Courses::where('type',Courses::TYPE_COURSE)->where('published', 1)->where('featured_on_subscription', 1)->skip(0)->take(8)->orderBy('sort', 'asc')->get(); //Best Learning
        $this->data['Last4'] = Courses::where('type',Courses::TYPE_COURSE)->where('published', 1)->skip(0)->take(4)->orderBy('sort', 'asc')->get(); //Best Learning
        $this->data['Partners'] = Partners::limit(20)->get();
        $this->data['homeCategories']  = Categories::whereNull('parent_id')->where('show_menu', 1)->limit(10)->orderBy('sort', 'ASC')->get();
        $this->data['instructors'] = User::where('group_id', User::TYPE_INSTRUCTOR)->where('hidden', 0)->skip(0)->take(10)->inRandomOrder()->get();


        if (Auth::check()){
            if (isset($_GET['promotion'])) {
                $promoRow = Promotions::where('code', $_GET['promotion'])->first();

                $Promotionactive = Promotionactive::where('user_id', Auth::user()->id)
                    ->where('promotions_id',$promoRow->id)
                    ->where('status',1)
                    ->first();

                if(!$Promotionactive){

                    if($promoRow){
                        if($promoRow->type == Promotions::TYPE_B2C_FIXED || $promoRow->type == Promotions::TYPE_B2C_PERCENT
                            || $promoRow->type == Promotions::TYPE_B2C_PERCENT_MONTHLY || $promoRow->type == Promotions::TYPE_B2C_PERCENT_MONTHLY){
                            if(Promotions::isValidB2c($promoRow) || Promotions::isValidB2cMonthly($promoRow) || Promotions::isValidB2cAnnual($promoRow)){
                                $Promotionactive = Promotionactive::setActivePromo($promoRow->id, Promotionactive::TYPE_B2C);
                                alert()->success(trans('defualt.Coupon added successfully'), trans('website.Success'));
                            }else{
                                alert()->error(trans('defualt.Problem adding the coupon'), trans('website.Error Message'));
                            }
                        }else{
                            if (Promotions::isValid($promoRow, $course_id = null)) {
                                $Promotionactive = Promotionactive::setActivePromo($promoRow->id);
                                alert()->success(trans('defualt.Coupon added successfully'), trans('website.Success'));
                                if($course_id){
                                    $coursesController = new CoursesController(Courses::findOrFail($course_id));
                                    $coursesController->addToCart($course_id);
                                }
                            } else {
                                alert()->error(trans('defualt.Problem adding the coupon'), trans('website.Error Message'));
                            }
                        }
                    } else {
                        alert()->error(trans('defualt.Problem adding the coupon'), trans('website.Error Message'));
                    }
                }


            }
        }

        if(Auth::check() && Auth::user()->categories){
            $this->data['forYou'] = Courses::where('type',Courses::TYPE_COURSE)->where('categories_id', Auth::user()->categories)->where('published', 1)->orderBy('created_at', 'desc')->skip(0)->take(10)->get();
        }else{
            $this->data['forYou'] = Courses::where('type',Courses::TYPE_COURSE)->where('published', 1)->orderBy('created_at', 'desc')->skip(0)->take(10)->get();
        }

        return view('website.business.subscriptions.subscriptions', $this->data);
    }


    public function payBy($method, Request $request){

        $pay = new PayWith($request);

        switch($method){
            case 'visa':
                $result = $pay->visa();

                if($result['amount'] == 0){

                    //save the payement
                    $payment = new Payments();
                    $payment->operation = Payments::OPERATION_DEPOSIT;
                    $payment->amount = 0;
                    $payment->currency_id = Currencies::DEFUALT_CURRENCY;
                    $payment->user_id = Auth::user()->id;
                    $payment->receiver_id = 1;
                    $payment->orders_id =  $result['order']['id'];
                    $payment->status = Payments::STATUS_SUCCEEDED;

                    if($payment->save()){
                        $result['order']->payments_id = $payment->id;
                        $result['order']->status = Orders::STATUS_SUCCEEDED;
                        $result['order']->save();
                    }

                    completeBusinessOrder($result['order'], $payment);
                    $result['success'] = true;
                    $result['free'] = true;
                }


                $view = 'cartFinish';
                break;
            case 'fawry':
                $result = $pay->fawry();
                $view = 'fawry';
                break;
            case 'kioskaman':
                $result = $pay->aman();
                $view = 'cartFinishKiosk';
                break;
            case 'kioskmasary':
                $result = $pay->masary();
                $view = 'cartFinishKiosk';
                break;
            case 'wallet':
                $result = $pay->wallet();
                $view = 'mobilewallet';
                break;
        }

        if($request->ajax()){
            return response()->json($result, 200);
        }

        if(!$result['success'])
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));


        return view('website.' . $view, $result);

    }
    public function subscriptionEnrollFree(Request $request){

        if($request->has('subType')){

            $homeSettings = Homesettings::where('id', 1)->first();
            $subscription_monthly = round($homeSettings->MonthlyB2cSubscriptionPrice);
            $subscription_yearly_after = round($homeSettings->YearlyB2cSubscriptionPrice);



            if ( ($request['subType'] == Subscriptionuser::SUBSCRIPTION_MONTHLY
                    && $subscription_monthly == 0 )
                || ($request['subType']  == Subscriptionuser::SUBSCRIPTION_YEARLY
                    && $subscription_yearly_after == 0 ) ){



                $pay = new PayWith($request);
                $result = $pay->visa();

                if($result['amount'] == 0){
                    //save the payement
                    $payment = new Payments();
                    $payment->operation = Payments::OPERATION_DEPOSIT;
                    $payment->amount = 0;
                    $payment->currency_id = Currencies::DEFUALT_CURRENCY;
                    $payment->user_id = Auth::user()->id;
                    $payment->receiver_id = 1;
                    $payment->orders_id =  $result['order']['id'];
                    $payment->status = Payments::STATUS_SUCCEEDED;


                    if($payment->save()){
                        $result['order']->payments_id = $payment->id;
                        $result['order']->status = Orders::STATUS_SUCCEEDED;
                        $result['order']->save();
                    }

                    completeBusinessOrder($result['order'], $payment);
                    $result['success'] = true;
                    $result['free'] = true;
                }

                if($request->ajax()){
                    return response()->json($result, 200);
                }

                if(!$result['success'])
                    alert()->info(trans('website.Wrong'), trans('website.Error Message'));




            }


        }

        alert()->info(trans('website.Wrong'), trans('website.Error Message'));


    }




    static public function calculateB2bQuotations($numberOfUsers=5){

        $homeSettings = Homesettings::findOrFail(1);

        $exchangeRate = Payments::exchangeRate();

        $data['monthlyPrice'] = round(($homeSettings->b2b_monthly * $exchangeRate) * $numberOfUsers);
        $data['annualPrice'] = round(($homeSettings->b2b_annual * $exchangeRate) * $numberOfUsers);

        $data['monthlyPerUser'] = round($homeSettings->b2b_monthly * $exchangeRate);
        $data['annualPerUser'] = round($homeSettings->b2b_annual * $exchangeRate);

        $data['subscription_monthly'] = round($homeSettings->subscription_monthly * $exchangeRate);
        $data['subscription_yearly'] = round($homeSettings->subscription_yearly * $exchangeRate);

        $data['numberOfUsersLimit'] = (auth()->check() && Auth::user()->business_users_limit) ? Auth::user()->business_users_limit : 5;
        $data['numberOfUsers'] = ($numberOfUsers >= $data['numberOfUsersLimit']) ? $numberOfUsers : $data['numberOfUsersLimit'];

        return $data;
    }




    public function spin(Request $request) {

        if ($request->id){
//            check if user have spin win
            $spin = Spin::where('user_id', Auth::user()->id)->first();
            $text = '';
            if($spin){
                $code =  $spin->code;


                switch ($spin->type){
                    case 1;
                        $text = '<a href="https://igtsservice.com/ar/masters/category"> الماجيستير </a>';
                        $code = '<br> '. trans('website.Copy Link') .$code;
                        break;
                    case 2;
                        $text = '<a href="https://igtsservice.com/subscriptions"> الاشتراكات </a>';
                        $code = '<br> '. trans('website.Copy Link') .$code;
                        break;
                    case 3;
                        $text = '<a href="https://contactus.igtsservice.com"> للاستفادة بالعرض  تواصل معنا </a>';
                        break;
                    case 4;
                        $text = '<a href="https://contactus.igtsservice.com"> للاستفادة بالعرض  تواصل معنا </a>';
                        break;
                    case 5;
                        $text = '<a href="https://contactus.igtsservice.com"> للاستفادة بالعرض  تواصل معنا </a>';
                        break;
                    case 6;
//                        $text = '<a href="https://igtsservice.com/ar/diplomas/category"> دبلوم </a>';
                        $text = '<a href="https://contactus.igtsservice.com"> لقد حصلت على إشتراك شهري مجاني تواصل مع خدمة العملاء للحصول على الإشتراك ........ </a>';

//                        $code = '';
                        break;
                    case 7;
                        $text = '<a href="https://igtsservice.com/ar/courses/category"> الدورات </a>';
                        $code = '<br> '. trans('website.Copy Link') .$code;
                        break;
                    default;
                        break;
                }


            }else{

                switch ($request->id){

                    case 1;
                        $text = '<a href="https://igtsservice.com/ar/masters/category"> الماجيستير </a>';
                        $codeA = Promotions::generatePromotion('spin',Promotions::TYPE_PERCENT,40,40,'2024-12-01');
                        $code = '<br> '. trans('website.Copy Link') . $codeA;
                        break;
                    case 2;
                        $text = '<a href="https://igtsservice.com/subscriptions"> الاشتراكات </a>';
                        $codeA = Promotions::generatePromotion('spin',Promotions::TYPE_B2C_PERCENT_ANNUAL,75,75,'2025-12-01');
                        $code = '<br> '. trans('website.Copy Link') .$codeA;
                        break;
                    case 3;
                        $text = '<a href="https://contactus.igtsservice.com"> للاستفادة بالعرض  تواصل معنا </a>';
                        $code = '';
                        break;
                    case 4;
                        $text = '<a href="https://contactus.igtsservice.com"> للاستفادة بالعرض  تواصل معنا </a>';
                        $code = '';
                        break;
                    case 5;
                        $text = '<a href="https://contactus.igtsservice.com"> للاستفادة بالعرض  تواصل معنا </a>';
                        $code = '';
                        break;
                    case 6;
//                        $subscriptionuser = new Subscriptionuser();
//                        $subscriptionuser->user_id = Auth::user()->id;
//                        $subscriptionuser->subscription_id = 1;
//                        $subscriptionuser->start_date = Carbon::now()->format('Y-m-d');
//                        $subscriptionuser->end_date =  Carbon::now()->addDays(31)->format('Y-m-d');
//                        $subscriptionuser->amount = null;
//                        $subscriptionuser->b_type = 1;
//                        $subscriptionuser->is_active = 1;
//                        $subscriptionuser->orders_id = 1;
//                        $subscriptionuser->save();
//                        $text = '<a href="https://igtsservice.com/ar/diplomas/category"> دبلوم </a>';
                        $text = '<a href="https://contactus.igtsservice.com"> لقد حصلت على إشتراك شهري مجاني تواصل مع خدمة العملاء للحصول على الإشتراك ........</a>';
                        $codeA = '';
//                        $codeA = Promotions::generatePromotion('spin',Promotions::TYPE_PERCENT,50,50,'2024-12-01');
                        $code = '';
                        break;
                    case 7;
                        $text = '<a href="https://contactus.igtsservice.com"> "دورة + دورة مجاناً" 
للحصول على العرض تواصل مع خدمة العملاء عن طريق الرابط التالي </a>';
//                        $codeA = Promotions::generatePromotion('spin',Promotions::TYPE_PERCENT,50,50,'2024-12-01');
                        $code = '<br> '. trans('website.Copy Link') ;
                        break;
                    default;
                        break;
                }

                $spin = new Spin();
                $spin->user_id = Auth::user()->id;
                $spin->type = $request->id;
                $spin->code = $codeA;
                $spin->save();
            }

            return response()->json(
                [
                    'success'=> trans('website.You have won') .   ' ' . trans('website.gift'.$spin->type)   . $code,
                    'text2'=> $text,
                    'code'=> $code
                ]
            );

        }

        $this->data['title'] = 2;
        return view('website.spin', $this->data);

    }


    public function addData(){

        dd(3);
        $coursesID = 41;
        $CategoryId = 7;
        $Prefix = '2_41';
        $instructorID  = 22689;




        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://meduo.net/api/v1/course/innerAll',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('course_id' => $coursesID),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);

        if($result['status']){
            $data = $result['data'];
            //Create new Course ;
            $newCourse = new Courses();
            $newCourse['categories_id'] = $CategoryId;
            $newCourse['prefix_vimeo'] = $Prefix;
            $newCourse['published'] = 0;
            $newCourse['full_access'] = 1;
            $newCourse['access_time'] = NULL;

//            ----------------------------

            $newCourse['title'] = $data['title'];
            $newCourse['slug'] = $data['slug'];
            $newCourse['description'] = $data['description'];
            $newCourse['welcome_message'] = $data['welcome_message'];
            $newCourse['congratulation_message'] = $data['congratulation_message'];
            $newCourse['type'] = $data['type'];
            $newCourse['skill_level'] = $data['skill_level'];
            $newCourse['language_id'] = $data['language_id'];
            $newCourse['has_captions'] = $data['has_captions'];
            $newCourse['has_certificate'] = $data['has_certificate'];
            $newCourse['length'] = $data['length'];
            $newCourse['price'] = $data['price'];
            $newCourse['price_in_dollar'] = $data['price_in_dollar'];
            $newCourse['affiliate1_per'] = $data['affiliate1_per'];
            $newCourse['affiliate2_per'] = $data['affiliate2_per'];
            $newCourse['affiliate3_per'] = $data['affiliate3_per'];
            $newCourse['affiliate4_per'] = $data['affiliate4_per'];
            $newCourse['instructor_per'] = $data['instructor_per'];
            $newCourse['discount_egp'] = $data['discount'];
            $newCourse['discount_usd'] = $data['discount_usd'];
            $newCourse['featured'] = $data['featured'];
            $newCourse['image'] = $data['image'];
            $newCourse['promo_video'] = $data['promo_video'];
            $newCourse['visits'] = $data['visits'];
            $newCourse['position'] = $data['position'];
            $newCourse['sort'] = $data['sort'];
            $newCourse['doctor_name'] = $data['doctor_name'];
            $newCourse['soon'] = $data['soon'];
            $newCourse['seo_desc'] = $data['seo_desc'];
            $newCourse['seo_keys'] = $data['seo_keys'];
            $newCourse['search_keys'] = $data['search_keys'];
            $newCourse['poster'] = $data['poster'];
            $newCourse['promoPoster'] = $data['promoPoster'];
            $newCourse['created_at'] = $data['created_at'];
            $newCourse['updated_at'] = $data['updated_at'];
            $newCourse['instructor_id'] = $instructorID;
            $newCourse['will_learn'] = $data['will_learn'];
            $newCourse['requirments'] = $data['requirments'];
            $newCourse['description_large'] = $data['description_large'];
            $newCourse['target_students'] = $data['target_students'];
            $newCourse['is_partnership'] = $data['is_partnership'];
            $newCourse['other_categories'] = $data['other_categories'];
            $newCourse['lectures_link'] = $data['lectures_link'];
            $newCourse['videosready'] = $data['videosready'];
            $newCourse['sales_count'] = $data['sales_count'];
            $newCourse['start_date'] = $data['start_date'];
            $newCourse['certificates'] = $data['certificates'];
            $newCourse['accreditation_text'] = $data['accreditation_text'];
            $newCourse['vdocipher_tag'] = $data['vdocipher_tag'];
//            $newCourse['extra_field'] = $data['extra_field'];
//            $newCourse['hidden_subs'] = $data['hidden_subs'];
//            $newCourse['scorm_id'] = $data['scorm_id'];
//            $newCourse['parent_course'] = $data['parent_course'];
//            $newCourse['enable_livechat'] = $data['enable_livechat'];
//            $newCourse['livechat_time'] = $data['livechat_time'];



            if($newCourse->save()){
                echo "Success Course Added Successfully CourseId =" .   $newCourse->id .' </br> ';

                if (sizeof($data['coursesections'])) {
                    // add new coursesections
                    foreach ($data['coursesections'] as $coursesections){
                        $newCoursesections = new Coursesections();
                        $newCoursesections->courses_id = $newCourse->id;
                        $newCoursesections->title = $coursesections['title'];
                        $newCoursesections->will_do_at_the_end = $coursesections['will_do_at_the_end'];
                        $newCoursesections->position = $coursesections['position'];
                        if($newCoursesections->save()){
                            echo "Success Course Added Successfully Coursesections =" .   $newCoursesections->id .' </br> ';
                        }
                    }
                }

                if (sizeof($data['courselectures'])) {
                    // add new coursesections
                    foreach ($data['courselectures'] as $courselectures){
                        $newCourselectures = new Courselectures();
                        $newCourselectures->courses_id = $newCourse['id'];
                        $newCourselectures->coursesections_id = $newCoursesections->id;
                        $newCourselectures->title = $courselectures['title'];
                        $newCourselectures->slug = $courselectures['slug'];
                        $newCourselectures->description = $courselectures['description'];
                        $newCourselectures->video_file = $courselectures['video_file'];
                        $newCourselectures->length = $courselectures['length'];
                        $newCourselectures->is_free = $courselectures['is_free'];
                        $newCourselectures->position = $courselectures['position'];
//                        $newCourselectures->vid_playbackInfo = $courselectures['vid_playbackInfo'];
                        $newCourselectures->vdocipher_id = $courselectures['vdocipher_id'];
                        $newCourselectures->start_date = $courselectures['start_date'];
                        $newCourselectures->webinar_link = $courselectures['webinar_link'];
                        $newCourselectures->event_id = $courselectures['event_id'];
                        if($newCourselectures->save()){
                            echo "Success Courselectures Added Successfully Courselectures =" .   $newCourselectures->id .' </br> ';
                        }
                    }
                }



                if (sizeof($data['courseresources'])) {
                    // add new courseresources
                    foreach ($data['courseresources'] as $courseresources){
                        $newCourseresources = new Courseresources();
                        $newCourseresources->courses_id = $newCourse->id;
                        $newCourseresources->title = $courseresources['title'];
                        $newCourseresources->file = $courseresources['file'];
                        if($newCourseresources->save()){
                            echo "Success Courseresources Added Successfully Courseresources =" .   $newCourseresources->id .' </br> ';
                        }
                    }
                }


                if (sizeof($data['quiz'])) {
                    // add new quiz
                    $newQuiz = new Quiz();
                    $newQuiz->courses_id = $newCourse->id;
                    $newQuiz->title = $data['quiz']['title'];
                    $newQuiz->description = $data['quiz']['description'];
                    $newQuiz->instructions = $data['quiz']['instructions'];
                    $newQuiz->time = $data['quiz']['time'];
                    $newQuiz->time_in_mins = $data['quiz']['time_in_mins'];
                    $newQuiz->type = $data['quiz']['type'];
                    $newQuiz->pass_percentage = $data['quiz']['pass_percentage'];
                    if($newQuiz->save()){
                        echo "Success Quiz Added Successfully Quiz =" .   $newQuiz->id .' </br> ';

                        if (sizeof($data['quiz']['quizquestions'])) {
                            foreach ($data['quiz']['quizquestions'] as $quizquestions){
                                // add new quizquestions
                                $newquizquestions = new Quizquestions();
                                $newquizquestions->quiz_id = $newQuiz->id;
                                $newquizquestions->question = $quizquestions['question'];
                                $newquizquestions->type = $quizquestions['type'];
                                $newquizquestions->mark = $quizquestions['mark'];
                                if($newquizquestions->save()) {
                                    echo " ---- Success quizquestions Added Successfully quizquestions =" . $newquizquestions->id . ' </br> ';

                                    if (sizeof($quizquestions['quizquestionschoice'])) {

                                        foreach ($quizquestions['quizquestionschoice'] as $quizquestionschoice) {
                                            // add new quizquestionschoice
                                            $newquizquestionschoice = new Quizquestionschoice();
                                            $newquizquestionschoice->quizquestions_id = $newquizquestions->id;
                                            $newquizquestionschoice->choice = $quizquestionschoice['choice'];
                                            $newquizquestionschoice->is_correct = $quizquestionschoice['is_correct'];

                                            if($newquizquestionschoice->save()) {
                                                echo " ----  ------ Success Quizquestionschoice Added Successfully Quizquestionschoice =" . $newquizquestionschoice->id . ' </br> ';
                                            }

                                        }
                                    }
                                }

                            }
                        }

                        echo "All Done";
                    }
                }

            }




        }else{
            echo 'Wrong status code';
        }







    }

    public function addDataInstructor(){

        dd(2);

        $instructors = [
            1299,
            16600,
            15539,
            13434,
            1318,
            8293,
        ];

        foreach ($instructors as $instructor){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://meduo.net/api/v1/instructorAll',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'instructor_id='.$instructor,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response, true);

            if($result['status']){
                $data = $result['data'];
                //Create new Instructor ;
                $newInstructor = new User();
                $newInstructor->name = $data['name'];
                $newInstructor->email = $data['email'];
                $newInstructor->group_id = 3;
                $newInstructor->mobile = $data['mobile'];
                $newInstructor->api_token = $data['api_token'];
                $newInstructor->facebook_identifier = $data['facebook_identifier'];
                $newInstructor->verified = $data['verified'];
                $newInstructor->activated = $data['activated'];
                $newInstructor->activation_code = $data['activation_code'];
                $newInstructor->activation_date = $data['activation_date'];
                $newInstructor->banned = 0;
                $newInstructor->first_name = $data['first_name'];
                $newInstructor->last_name = $data['last_name'];
                $newInstructor->gender = $data['gender'];
                $newInstructor->birthdate = $data['birthdate'];
                $newInstructor->is_affiliate = $data['is_affiliate'];
                $newInstructor->affiliate_id = $data['affiliate_id'];
                $newInstructor->title = $data['title'];
                $newInstructor->about = $data['about'];
                $newInstructor->additional_info = $data['additional_info'];
                $newInstructor->description = $data['description'];
                $newInstructor->image = $data['image'];
                $newInstructor->cover = $data['cover'];
                $newInstructor->slug = $data['slug'];
                $newInstructor->specialization = $data['specialization'];
                $newInstructor->sub_specialization = $data['sub_specialization'];
                $newInstructor->other_specialization = $data['other_specialization'];
                $newInstructor->businessdata_id = $data['businessdata_id'];
                $newInstructor->instructorname = $data['instructorname'];
                $newInstructor->is_instructor = $data['is_instructor'];
                $newInstructor->sort = $data['sort'];
                $newInstructor->hidden = $data['hidden'];
                $newInstructor->categories = $data['categories'];

                if ($newInstructor->save()) {
                    echo "Success Instuctor Added Successfully Old Meduo = ------". $instructor . " InstuctorId =" .   $newInstructor->id .' </br> ';
                }
            }else{
                echo 'Wrong status code';
            }




        }
    }


    public function b2bPayVisa(){
        $amount = $_POST['amount'];
        $type = $_POST['type'];
        $numberOfUsers = isset($_POST['numberOfUsers']) ? $_POST['numberOfUsers'] : null;
        $user = Auth::user();
        $currency = getCurrency();

        if($numberOfUsers){
            $order = createB2bInitialOrder($type, $numberOfUsers, $amount, $currency);
        }else{
            $order = createBusinessInitialOrder($type ,Orders::TYPE_B2C, $amount, $currency);
        }

        $amount_cents = $amount * 100;
        //Amount Cents After ExchangeRate
        $amount_cents = Currencies::getAmountcentsByCurrencyID($currency , Currencies::DEFUALT_CURRENCY, $amount_cents);


        $visa = new AcceptPaymentsIntegration();
        $result = $visa->init($order, $amount_cents);

        if (!isset($result)) {
            alert()->info(trans('website.Wrong'), trans('website.Error Message'));
            return redirect()->back();
        }

        // save accept_status in order
        $order->accept_status = 1;
        $order->save();

        $this->data['payment_token'] = $result;

        return response()->json(['success'=>true , 'type'=>'b2b', 'token' => $result, 'amount' => $amount], 200);

    }


    public function subscripeNow($type){
        $homeSettings = Homesettings::where('id', 1)->first();

        if($type == 'monthly'){
            $price = round($homeSettings->MonthlyB2cSubscriptionPrice);
            if($price <= 0){
                $subscriptionuser = new Subscriptionuser();
                $subscriptionuser->user_id = Auth::user()->id;
                $subscriptionuser->subscription_id = 1;
                $subscriptionuser->start_date = Carbon::now()->format('Y-m-d');
                $subscriptionuser->end_date =  Carbon::now()->addDays(31)->format('Y-m-d');
                $subscriptionuser->amount = null;
                $subscriptionuser->b_type = 4;
                $subscriptionuser->is_active = 1;
                $subscriptionuser->orders_id = 1;
                $subscriptionuser->save();

                alert()->success("Subscription Done", "Done");
                return redirect('account/mySubscriptions');
            }

        }elseif($type == 'yearly'){
            $price = round($homeSettings->YearlyB2cSubscriptionPrice);
            if($price <= 0){
                $subscriptionuser = new Subscriptionuser();
                $subscriptionuser->user_id = Auth::user()->id;
                $subscriptionuser->subscription_id = 1;
                $subscriptionuser->start_date = Carbon::now()->format('Y-m-d');
                $subscriptionuser->end_date =  Carbon::now()->addDays(365)->format('Y-m-d');
                $subscriptionuser->amount = null;
                $subscriptionuser->b_type = 4;
                $subscriptionuser->is_active = 1;
                $subscriptionuser->orders_id = 1;
                $subscriptionuser->save();

                alert()->success("Subscription Done", "Done");
                return redirect('account/mySubscriptions');
            }
        }

    }

    public function guide(){

        $this->data['title'] = 2;
        return view('website.guide', $this->data);

    }

    public function trainingDisclosure()
    {

        return redirect('https://igtsservice.com/ar/business/trainingDisclosure');

        $this->data['title'] = 'training Disclosure';
        $this->data['faq'] = Faq::all();
        return view('website.trainingDisclosure', $this->data);
    }
}
