<?php

namespace App\Classes;

use App\Models\SettingModel;

class ColorHelper
{
    public static function getMenuBgColor($page = 'general')
    {
        $menuBgColor = '';

        if( !session()->has('settings.' . $page . '_menu_bg_color_value') || session()->get('settings.' . $page . '_menu_bg_color_value') == '' )
        {
            $menuBgColor = session()->get('settings.general_menu_bg_color_value');
        }
        else
        {
            $menuBgColor = session()->get('settings.' . $page . '_menu_bg_color_value');
        }

        return $menuBgColor;
    }

    public static function getHeaderBgColor($page = 'general')
    {
        $headerBgColor = '';


        if( !session()->has('settings.' . $page . '_header_bg_color_value') || session()->get('settings.' . $page . '_header_bg_color_value') == '')
        {
            $headerBgColor = session()->get('settings.general_header_bg_color_value');
        }
        else
        {
            $headerBgColor = session()->get('settings.' . $page . '_header_bg_color_value');
        }

        return $headerBgColor;
    }

    public static function getPanelTabLineColor($page = 'general')
    {
        $lineColor = '';

        if( !session()->has('settings.' . $page . '_panel_tab_color_value') || session()->get('settings.' . $page . '_panel_tab_color_value') == '' )
        {
            $lineColor = session()->get('settings.general_panel_tab_color_value');
        }
        else
        {
            $lineColor = session()->get('settings.' . $page . '_panel_tab_color_value');
        }
        //dd('Helper.getPanelTabLineColor', $lineColor);
        return $lineColor;
    }

    public static function getColor($propertyName)
    {
        $propertyValue = '';

        return $propertyValue;
    }

    public static function getLoginBgColor($company_id)
    {
        $bgColor = '';

        $settings = SettingModel::where('CompanyID', '=', $company_id)
            ->where('PropertyName', '=', 'login_background_color_value')
            ->first();

        if( !empty($settings) )
        {
            $bgColor = $settings->PropertyValue;
        }
        else
        {
            $bgColor = config('appConfig.default_settings.login_background_color_value');
        }

        return $bgColor;
    }

    public static function saveColor($id, $propertyName, $propertyValue)
    {
        $settingModel = null;
        $changed = false;

        if( $id == 0 )
        {
            $settingModel = new \App\Models\SettingModel();
            $settingModel->CompanyID = \Auth::user()->CompanyID;
            $settingModel->PropertyName = $propertyName;
            $settingModel->PropertyValue = $propertyValue;
            $changed = true;
        }
        else
        {
            $settingModel = \App\Models\SettingModel::find($id);
            if( $settingModel->PropertyValue != $propertyValue )
            {
                $settingModel->PropertyValue = $propertyValue;
                $changed = true;
            }
        }

        if( $changed )
        {
            $settingModel->save();

            session()->put('settings.' . $propertyName, $propertyValue);
        }

    }
}
