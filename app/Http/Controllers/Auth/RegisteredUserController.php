<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Voucher\Companies\Company;
use DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required|string|max:255|unique:companies,name',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $company = Company::create([
            'name'          => $request->company,
            'contact_name'  => $request->name,
            'contact_email' => $request->email,
        ]);

        DB::table('base_terms_payment')->get()->map(function ($term) use ($company) {
            DB::table('terms_payment')->insert([
                'company_id' => $company->id,
                'name'       => $term->name,
                'days'       => $term->days,
                'is_active'  => 1
            ]);
        });

        Auth::login($user = User::create([
            'company_id'   => $company->id,
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'raw_password' => $request->password,
            'last_login'   => now()
        ]));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
