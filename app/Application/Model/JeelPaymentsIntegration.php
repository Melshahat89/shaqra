<?php
namespace App\Application\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class JeelPaymentsIntegration  {

    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;
    public function __construct()
    {

        $this->baseUrl = env('JEELPAY_BASE_URL');
        $this->clientId = env('JEELPAY_CLIENT_ID');
        $this->clientSecret = env('JEELPAY_CLIENT_SECRET');
    }

    public function init($order, $amount_cents, $paymentType = null, $identifier = null)
    {
        // 1. الحصول على Access Token
        $tokenResponse = Http::asForm()->post(env('JEELPAY_AUTH_URL'). '/oauth2/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        if (!$tokenResponse->successful()) {
            throw new \Exception("JeelPay Auth Failed: " . $tokenResponse->body());
        }

        $accessToken = $tokenResponse->json()['access_token'];
        // 2. بناء بيانات الـ Checkout
        $payload = [
            "buyer" => [
                "first_name"    => "جامعة",
                "last_name"     => "شقراء",
                "mobile_number" => "542576272",
                "email"         => "mahmoud.elshahat@meduo.net",
                "national_id"   => "1010103367",
            ],
            "students" => [
                [
                    "national_id"         => Auth::user()->nid  ?? "1104448787",
                    "entity_id"           => env('JEELPAY_entity_id'),
                    "educational_year_id" => env('JEELPAY_educationalYear_ID'),
                    "reference_id"        => $order['id']  ?? "ref_" . uniqid(),
                    "name"                => Auth::user()->name ?? "NA",
                    "cost"                => $amount_cents,
                ]
            ],
            "urls" => [
                "redirect_url"    => 'https://mehany.igtsservice.com/payments/jeelConfirmation',   // أو رابطك
                "notification_url"=> 'https://mehany.igtsservice.com/payments/jeelWeebHook',   // أو رابطك
            ],

            "metadata" => [
                "order_id"     => $order['id'] ?? "order_12345",
                "payment_type" => $paymentType ?? "jeel",
            ],
            "referenceId" => $order['id'] ?? "order_" . uniqid(),
        ];



        // 3. إرسال الطلب إلى JeelPay
        $response = Http::withToken($accessToken)
            ->post($this->baseUrl . '/v3/checkout/schooling', $payload);

        if (!$response->successful()) {
            throw new \Exception("JeelPay Checkout Failed: " . $response->body());
        }

        return $response->json();
    }


    public function getCheckout($checkoutId)
    {
        // 1. الحصول على Access Token جديد
        $tokenResponse = Http::asForm()->post(env('JEELPAY_AUTH_URL'). '/oauth2/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        if (!$tokenResponse->successful()) {
            throw new \Exception("JeelPay Auth Failed: " . $tokenResponse->body());
        }

        $accessToken = $tokenResponse->json()['access_token'];

        // 2. استدعاء الـ API لجلب تفاصيل الـ checkout
        $response = Http::withToken($accessToken)
            ->get($this->baseUrl . '/v3/checkout/' . $checkoutId);

        if (!$response->successful()) {
            throw new \Exception("JeelPay Checkout Fetch Failed: " . $response->body());
        }

        return $response->json();
    }








}