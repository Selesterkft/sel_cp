<?php

namespace App\Classes;

class ColorHelper
{
    public static function getColor($propertyName)
    {
        $propertyValue = '';
        
        return $propertyValue;
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