<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user){
            // Перевірте, чи оплата проведена
            $paymentStatus = $user->payment;
            if ($paymentStatus === 1) {
                return redirect()->route('success');
            } else {
                // Перенаправте користувача на сторінку оплати або іншу сторінку
                return redirect()->route('checkout');
            }
        }

    }
}
