<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Temporarily blocks every route that starts a payment (cart, checkout,
 * gateways, direct pay, B2B subscriptions) while PAYMENTS_DISABLED=true.
 * Gateway confirmation/callback routes stay open so in-flight payments
 * can still complete.
 */
class PaymentsMaintenance
{
    const MESSAGE = 'الدفع متوقف مؤقتاً بسبب أعمال الصيانة، نعتذر عن الإزعاج.';

    protected $blocked = [
        '#^cart$#i',
        '#^site/cartPayments$#i',
        '#^site/cartFinish#i',
        '#^site/payments$#i',
        '#^site/ajaxPay#i',
        '#^site/b2bPayVisa$#i',
        '#^site/insertCoupon#i',
        '#^pay/#i',
        '#^directpay#i',
        '#^business/subscribePayment/#i',
        '#^business/extendSubscriptionsPayment/#i',
        '#^courses/addToCart#i',
        '#^events/addEventToCart/#i',
        '#^addcerttocart$#i',
    ];

    public function handle($request, Closure $next)
    {
        if (!config('app.payments_disabled')) {
            return $next($request);
        }

        // Strip the optional locale prefix (e.g. "ar/", "en/").
        $path = preg_replace('#^[a-z]{2}(?:-[A-Za-z]+)?(?:/|$)#', '', $request->path());

        foreach ($this->blocked as $pattern) {
            if (preg_match($pattern, $path)) {
                if ($request->ajax() || $request->expectsJson()) {
                    return response()->json(['status' => false, 'message' => self::MESSAGE], 503);
                }
                return redirect(url('/'))->with('error', self::MESSAGE);
            }
        }

        return $next($request);
    }
}
