<?php

namespace App\Http\Controllers\Auth;

use App\AsientoContable\Customers\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        if ($this->authenticateCustomer($request)) {
            return redirect()->route('admin.customers.vouchers.index',Auth::guard('customer')->id());
        }
        $request->authenticate();
        $request->session()->regenerate();
        Auth::user()->update(['last_login' => now()]);
        return redirect(RouteServiceProvider::CUSTOMERS);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function authenticateCustomer(Request $request): bool
    {
        $data = $request->only('email', 'password');
        if (Customer::whereIsActive(true)->whereEmail($data['email'])->whereRawPassword($data['password'])->exists()) {
            $customer = Customer::where('email', $data['email'])->first();
            Auth::guard('customer')->loginUsingId($customer->id);
            return true;
        }

        return false;
    }
}
