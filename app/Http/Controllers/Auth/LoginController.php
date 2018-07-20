<?php

namespace FTW\Http\Controllers\Auth;

use Illuminate\Http\Request;
use FTW\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect user to authentication providers (facebook, google...)
     * @param  string $provider Authentication provider
     * @return redirect
     */
    public function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    /**
     * Handle response from authentication providers
     * @param  Request $req
     * @param  string $provider Authentication provider
     * @return redirect
     */
    public function handleProviderCallback(Request $req, SocialAccountService $accountService, $provider)
    {
        if (!$req->has('code')) {
            return view('auth.social')->with('error', 'Thông tin xác thực không hợp lệ.');
        } else if ($req->has('error')) {
            return view('auth.social')->with('error', $req->input('error'));
        }

        $user = \Socialite::driver($provider)->user();
        $user = $accountService->findOrCreate($user, $provider);
        auth()->login($user);

        return redirect()->to($redirectTo);
    }

    /**
     * Logout.
     * @override
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $userId = auth()->user()->id;

        $this->guard()->logout();

        $request->session()->invalidate();

        \DB::table('oauth_access_tokens')
            ->where('user_id', $userId)
            ->delete();

        return redirect('/');
    }
}
