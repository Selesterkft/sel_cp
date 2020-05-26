<?php

namespace App\Listeners;

//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Auth\Events\Login;
use App\Classes\Helper;

class UserChangeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //dd('UserChangeListener.handle', 'aaa');
        $user = $event->user;
        //dd('UserChangeListener.handle', $user);
        $settings = Helper::getAllSettings();

        $tz = Helper::get_user_tz_array();

        $sessionData = [
            'company_id' => $user->CompanyID,
            'company_name' => Helper::getCompanyNickNameByID($user->CompanyID),
            'version' => Helper::getVersionString($user->CompanyID),
            'design' => Helper::getCompanyDesign($user->CompanyID),
            //'locale' => $user->language,
            'settings' => $settings,
            'tz' => $tz
        ];

        if( app()->getLocale() !== $user->language )
        {
            app()->setLocale($user->language);
        }

        session($sessionData);
        //dd('UserChangeListener.handle', session()->all());
    }

    /*
    // Az $user->getCompanyName függvényt is REM-eltem
    public function handle_old($event)
    {
        $user = $event->user;

        $company = Helper::getCompanyNickName($user->getCompanyName());
        $version = Helper::getVersionString($user->CompanyID);

        $sessionData = [
            'company_id' => $user->CompanyID,
            'company_name' => $company,
            'version' => $version,
        ];

        session($sessionData);
    }
    */
}
