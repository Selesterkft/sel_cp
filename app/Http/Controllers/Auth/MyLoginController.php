<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Classes\Helper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MyLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    /**
     * MyLoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        return $this->redirectTo;
    }

    public function showLogin()
    {
        $subdomain = Helper::getAppSubdomain();

        if( !$subdomain )
        {
            return redirect()->to('http://webandtrace.com');
        }
        else
        {
            $company_id = Helper::getCompanyIDByCompanyNickName($subdomain);
            $design = Helper::getCompanyDesign($company_id);

            return view("{$design}.auth.login", ['design' => $design]);
        }
    }

    protected function doLogout(Request $request)
    {
        \Auth::logout();

        //return redirect('/');
        return redirect( $this->redirectTo() );
    }

    protected function doLogin(Request $request)
    {
        // Bejövő adatok validálása
        $this->validateLogin($request);

        // Felhasználó keresése az e-mail cím alapján
        $loginUser = User::where('Email', '=', $request->get('email'))
            ->first();

        // Ha nincs meg a felhasználó, akkor...
        if( empty($loginUser) )
        {
            // Visszairányítás a hibákkal
            return \Redirect::back()
                ->withErrors(['email' => [trans('messages.errors_user_not_found')]])
                ->withInput(Input::except('password'));
        }

        // Az url-ből jövő companyNickName
        $subdomain = $request->get('company');

        // A belépett felhasználó cég azonosítója
        $companyID = $loginUser->CompanyID;

        $companyNickName = Helper::getCompanyNickNameByID($companyID);

        if( $subdomain != $companyNickName )
        {
            return \Redirect::back()
                ->withErrors(['company' => [ trans('messages.errors_login_company') ]])
                ->withInput(Input::except('password'));
        }
        else
        {
            if ($this->attemptLogin($request))
            {
                return $this->sendLoginResponse($request);
            }
            else
            {
                return \Redirect::back()
                    ->withErrors([
                        'password' => trans('messages.errors_password')
                    ])
                    ->withInput(Input::except('password'));
            }
        }

    }
/*
    protected function doLogin_old(Request $request)
    {
        // Bejövő adatok validálása
        $this->validateLogin($request);

        // Felhasználó keresése az e-mail cím alapján
        $loginUser = User::where('Email', '=', $request->get('email'))
            ->first();

        // Ha nincs meg a felhasználó, akkor...
        if( empty($loginUser) )
        {
            // Visszairányítás a hibákkal
            return \Redirect::back()
                ->withErrors(['email' => [__('global.login.messages.error_user_not_found')]])
                ->withInput(Input::except('password'));
        }

        $subdomain = $request->get('company');

        $comapnyID = null;

        // Verziószám lekérése


        $companyModel = '\App\Models\\' . session()->get('version') . '\CompanyModel';
        //dd('MyLoginController.doLogin', $companyModel, $loginUser);
        $allCompanies = $companyModel::raw(config('appConfig.raw'))
                ->orderBy('Nev1', 'asc')
                ->pluck('Nev1', 'ID')
                ->all();
        //dd('MyLoginController:68', $allCompanies);
        $companyID = null;

        foreach($allCompanies as $key => $val)
        {
            $aaa = Helper::remove_accents($val);

            if( $subdomain == $aaa && $key == $loginUser->CompanyID)
            {
                $companyID = $key;
                break;
            }
        }

        //dd('MyLoginController:doLogin', $loginUser->CompanyID, $allCompanies, $companyID);

        if( empty($companyID) )
        {
            return \Redirect::back()
                ->withErrors(['company' => [ __('global.app_messages.login_company_error') ]])
                ->withInput(Input::except('password'));
        }
        else
        {
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
        }
    }
*/
    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    private function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:6',
            'company' => 'required',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => \App\Classes\Helper::get_timestamp(),
            'last_login_ip' => $request->getClientIp(),
        ]);
    }
}
