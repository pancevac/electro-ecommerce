<?php

namespace App\Http\Controllers\Auth;

use App\Traits\SEO;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Lunaweb\EmailVerification\Traits\VerifiesEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use VerifiesEmail;
    use SEO;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['verify', 'showResendVerificationEmailForm', 'resendVerificationEmail']]);
        $this->middleware('auth', ['only' => ['showResendVerificationEmailForm', 'resendVerificationEmail']]);
    }

    /**
     * @inheritDoc
     */
    public function showRegistrationForm()
    {
        $this->seoDefault(trans('pages.register.title'));
        return view('auth.register');
    }


    /**
     * Show form to the user which allows resending the verification mail
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showResendVerificationEmailForm()
    {
        $this->seoDefault('Resend email');
        $user = Auth::user();
        return view('auth.resend_email', ['verified' => $user->verified, 'email' => $user->email]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
