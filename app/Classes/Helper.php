<?php

namespace App\Classes;

//use App\Models\VersionCompanyModel;
//use App\Models\VersionModel;
//use Spatie\Permission\Models\Role;
use App\Models\SettingModel;
use App\Models\VersionModel;

//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Session;

class Helper
{
    public static function timestampRemover(string $string)
    {
        $aa = strpos($string, '.') + 1;
        $bb = substr($string, $aa);
        //dd('general', $string, $aa, $bb);
        return $bb;
    }

    public static function get_user_tz() : string
    {
        $tz = self::get_user_tz_array();
        return $tz['timezone'];
    }

    public static function get_user_tz_array() : array
    {
        $ip = file_get_contents("http://ipecho.net/plain");
        $url = 'http://ip-api.com/json/'.$ip;
        $tz = file_get_contents($url);
        $tz = json_decode($tz, true);

        return $tz;
    }

    public static function get_timestamp()
    {
        $locale = self::get_user_tz();
        $date = \Carbon::now()
            ->setTimezone($locale)
            ->toDateTimeString();

        return $date;
    }

    public static function getAllSettings() : array
    {
        $config = config('appConfig.tables.settings');
        $db_settings = \DB::connection($config['connection'])
                ->table($config['table'])
                ->where('CompanyID', '=', \Auth::user()->CompanyID)
                ->select('ID', 'PropertyName', 'PropertyValue')
                ->get();

        $def_settings = config('appConfig.default_settings');
        //dd($def_settings);
        foreach( $def_settings as $key => $val )
        {
            $def_settings[ str_replace('_value', '_id', $key) ] = 0;
        }

        foreach( $db_settings as $db_setting )
        {
            if(array_key_exists($db_setting->PropertyName, $def_settings) )
            {
                $def_settings[$db_setting->PropertyName] = $db_setting->PropertyValue;
                $def_settings[str_replace('_value', '_id', $db_setting->PropertyName) ] = (int)$db_setting->ID;
            }
        }

        return $def_settings;
    }

    public static function uploadFile($path, $image)
    {
        //dd('Helper.uploadFile', $path, $image);
        $aa = null;
        $imageName = null;

        try
        {
            $imageName = time() . '.' . $image->getClientOriginalName();
            $aa = $image->move(public_path( $path ), $imageName);
        }
        catch(\Exception $e)
        {
            dd($aa, $e->getMessage());
        }

        return $imageName;
    }

    public static function uploadWithResize($path, $image, $width, $height) : string
    {
        // Kép nevének elkészítése
        $imageName = time() . '.' . $image->getClientOriginalName();

        // Célkönyvtár könyvtár helye
        $destMap = public_path($path);

        // ??
        $img = \Image::make($image->path());

        // Átméretezés és mentés az átmeneti könyvtárba
        $img->resize($width, $height, function($constraint)
        {
            $constraint->aspectRatio();
        })->save($destMap . '\\' . $imageName);

        return $imageName;
    }

    public static function deleteUploadedImage($path, $imageName = '')
    {
        $retValue = false;

        if( $imageName != '' )
        {
            \File::delete( public_path($path) . '\\' . $imageName );
            $retValue = true;
        }

        return $retValue;
    }

    public static function getAppDomain()
    {
        $domain = '';

        $url_array = explode(
            '.',
            parse_url(\Request::url(), PHP_URL_HOST)
        );
        //dd('Helper.getAppDomain', $url_array);
        if( count($url_array) == 2 )
        {
            //$domain = '{company}.' . $url_array[1];
            $domain = $url_array[1];
        }
        elseif( count($url_array) == 3 )
        {
            //$domain = '{company}.' . "{$url_array[2]}.{$url_array[3]}";
            $domain = "{$url_array[1]}.{$url_array[2]}";
        }

        return $domain;
    }

    public static function getFavicon()
    {
        // Visszatérő érték
        $retVal = '';
        // Könyvtár
        $faviconPath = config('appConfig.favicons.folder');
        // Session-ben levő érték
        $faviconFile = session()->get('settings.general_favicon_value');

        // A könyvtárnév a beállításokból, a fájlnév meg a session-ből jön.
        $favIcon = asset($faviconPath) . '/' . $faviconFile;
        // Fájl a vizsgálathoz
        $file = public_path( $faviconPath . '\\' . $faviconFile );

        // Fájl meglétének vizsgálata
        if(file_exists($file) )
        {
            // Ha megvan a fájl, akkor azt adom vissza.
            $retVal = $favIcon;
        }
        else
        {
            // Ha nincs meg a fájl, akkor az alap fájlt adom vissza
            //$retVal = config('appConfig.default_settings.general_favicon_value');
            $retVal = asset('assets/dist/img') . '/' . config('appConfig.default_settings.general_favicon_value');
        }
        //dd('Helper.getFavicon', $retVal);
        return $retVal;

    }

    public static function getLogo()
    {
        $retVal = '';

        $logoPath = config('appConfig.logos_folder');
        $logoFile = session()->get('settings.general_logo_value');

        $logo = asset($logoPath) . '/' . $logoFile;

        $file = public_path($logoPath . '\\' . $logoFile);

        if(file_exists($file) )
        {
            $retVal = $logo;
        }
        else
        {
            $retVal = asset('assets/dist/img') . '/' . config('appConfig.default_settings.general_logo_value');
        }

        return $retVal;
    }

    public static function getProfile()
    {
        $retVal = '';

        $profilePath = config('appConfig.profiles_folder');
        $profileFile = session()->get('settings.general_profil_image_value');

        $profile_image = asset($profilePath) . '/' . $profileFile;

        $file = public_path($profilePath . '\\' . $profileFile);

        if(file_exists($file) )
        {
            $retVal = $profile_image;
        }
        else
        {
            $retVal = asset('assets/dist/img') . '/' . config('appConfig.default_settings.general_profil_image_value');
        }

        return $retVal;
    }

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

    public static function getAppSubdomain()
    {
        $url_array = explode(
            '.',
            parse_url(\Request::url(), PHP_URL_HOST)
        );

        //dd('Helper.getAppSubdomain', $url_array, $url_array[0]);

        return $url_array[0];
    }

    public static function checkCompanyNickName(string $companyNickName)
    {
        //$companies = CompanyModel::all();
        $companyModel = app()->make('\App\Models\\' . session()->get('version') . '\CompanyModel');
        $companies = $companyModel::all();

        foreach($companies as $company)
        {
            $retValue = false;

            if( self::remove_accents($company->Nev1) == $companyNickName )
            {
                $retValue = true;
                break;
            }
        }

        return $retValue;
    }

    public static function getCompanyNickNameByID($company_id)
    {
        $companyNickName = null;
        $config = config('appConfig.tables.company_has_subdomain');

        $results = \DB::connection($config['connection'])
                ->select(\DB::raw("SELECT * FROM {$config['table']} WHERE CompanyID = :id;"),
                        ['id' => $company_id]);

        if( $company_id != 71 )
        {
            dd('Helper.getCompanyNickNameByID', $company_id, $results);
        }
         //dd('Helper.getCompanyNickNameByID', $company_id, $results);
         if( !empty($results) )
         {
             $companyNickName = $results[0]->SubdomainName;
         }

        return $companyNickName;
    }

    public static function getCompanyNickName(string $company_name)
    {
        //dd('Helper.getCompanyNickName', $company_name);
        $config = config('appConfig.tables.company_has_subdomain');
        //dd('Helper.getCompanyNickName', $config);
        $results = \DB::connection($config['connection'])
                ->select(\DB::connection($config['connection'])
                        ->raw("SELECT * 
                                        FROM {$config['table']} 
                                        WHERE SubdomainName = :name"),
                                ['name' => $company_name]);
        //dd('Helper.getCompanyNickName', $company_name, $results, (empty($results)));

        $retVal = null;

        if( !empty($results) )
        {
            $retVal = $results[0]->SubdomainName;
        }
        //dd('Helper.getCompanyNickName', $retVal);
        return $retVal;
        //return substr(self::remove_accents($company_name), 0, 20);
    }

    public static function getCompanyNameByID($id)
    {
        $config = config('appConfig.tables.company.' . session()->get('version'));
        //dd('Helper.getCompanyNameByID', $config, $id);
        $results = \DB::connection($config['connection'])
            ->table($config['read'])
            ->where('ID', '=', $id)
            ->select(['ID', 'Nev1'])
            ->get();
        //dd('Helper.getCompanyNameByID', $results[0]->Nev1);
        return $results[0]->Nev1;
    }

    public static function getWallpaper($company_id)
    {
        $wallpaper = '';

        // Feltöltött háttérkép keresése a felhasználói beállítások között
        $settings = SettingModel::where('CompanyID', '=', $company_id)
                ->where('PropertyName', '=', 'login_wallpaper_value')
                ->first();

        // Ha van felhasználó által feltöltött háttérkép, akkor...
        if( !empty($settings) )
        {
            // A felhasználó által feltöltött háttérkép megjelenítése
            $wallpaper = asset(config('appConfig.wallpapers_folder')) . '/' . $settings->PropertyValue;
        }
        // Rendszer által biztosított háttérkép megjelenítése
        else
        {
            // Ha engedélyezve van a véletlen háttérkép, akkor...
            if( config('appConfig.random_wallpaper') )
            {
                // Véletlen szám generálása 1 és 15 között
                $faker = \Faker\Factory::create();
                $number = $faker->numberBetween($min = 1, $max = 40);
                // Választás az előre feltöltött képek között a véletlen szám alapján
                $wallpaper_name = str_replace('%s', ($number < 10) ? '0' . $number : $number, config('appConfig.random_wallpaper_name'));
            }
            else
            {
                // Egyébként az alap háttérkép jelenik meg
                $wallpaper_name = config('appConfig.default_wallpaper');
            }

            $wallpaper = asset('assets/dist/img/' . config('appConfig.wallpapers_folder') . '/' . $wallpaper_name);
        }
        //dd('Helper.getWallpaper', $wallpaper);
        return $wallpaper;
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

    public static function getCompanyIDByCompanyNickName($companyNickName)
    {
        //dd('Helper.getCompanyIDByCompanyNickName', $companyNickName);
        $config = config('appConfig.tables.company_has_subdomain');
        $results = \DB::connection($config['connection'])
                ->select(
                        \DB::connection($config['connection'])
                        ->raw("SELECT * FROM {$config['table']} WHERE SubdomainName = :name;"),
                                ['name' => $companyNickName]
                );

        $companyID = $results[0]->CompanyID;

        return $companyID;

    }

    public static function getVersionString(int $company_id)
    {
        //$valami = VersionCompanyModel::where('CompanyID', '=', $company_id)->where('Active', '=', 1)->first();

        $vcConfig = config('appConfig.tables.version_has_company');
        $vc = \DB::connection($vcConfig['connection'])
            ->select(\DB::connection($vcConfig['connection'])
                ->raw("SELECT VersionID FROM dbo.{$vcConfig['read']} WHERE CompanyID = ?"),
                [$company_id]
        );

        $vConfig = config('appConfig.tables.versions');
        $versionName = \DB::connection($vConfig['connection'])
            ->select(\DB::connection($vConfig['connection'])
                ->raw("SELECT Version FROM dbo.{$vConfig['read']} WHERE ID = ?"),
                [$vc[0]->VersionID]
        );

        //dd('Helper.getVersionString', $vc, $versionName);

        /*
        $valami = \DB::connection('azure')
                ->select(\DB::connection('azure')
                        ->raw('SELECT VersionID FROM version_has_company WHERE CompanyID = :CompanyID'),
                        ['CompanyID' => $company_id]);
        */
        /*
        $versionName = \DB::connection('azure')
                ->select(\DB::connection('azure')
                        ->raw('SELECT Version FROM Versions WHERE ID = :ID'), ['ID' => $valami[0]->VersionID]);
        */
        //dd('Helper.getVersionString', $company_id, $valami[0]->VersionID, $versionName);

        return $versionName[0]->Version;
    }

    public static function getRoles()
    {
        $loggedUser = \Auth::user();
        $roles = null;

        if($loggedUser->hasRole('Admin'))
        {
            $roles = Role::raw('config.raw')
                    ->where('name', '=', 'Admin')
                    ->pluck('name', 'name');
        }
        else
        {
            $roles = Role::raw(config('appConfig.raw'))
                ->where('name', '<>', 'Admin')
                ->pluck('name', 'name');
        }

        return $roles;
    }

    /**
     * @return array|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function getCompanies()
    {
        $loggedUser = \Auth::user();
        $companies = null;

        $companyModel = app()->make('\App\Models\\' . session()->get('version') . '\CompanyModel');

        if( $loggedUser->hasRole('Admin') )
        {
            $companies = $companyModel::raw(config('appConfig.raw'))
                ->orderBy('Nev1', 'asc')
                ->pluck('Nev1', 'ID')
                ->all();
            $companies = ['0' => __('global.app_select_first_element')] + $companies;
        }
        else
        {
            $companies = $companyModel::raw(config('appConfig.raw'))
                ->where('ID', $loggedUser->CompanyID)
                ->orderBy('Nev1','asc')
                ->pluck('Nev1', 'ID')
                ->all();
        }

        return $companies;
    }

    public static function getVersions()
    {
        $versions = null;

        $versions = VersionModel::raw(config('appConfig.raw'))
            ->where('Active', '=', 1)
            ->orderBy('Version', 'asc')
            ->pluck('Version', 'ID')
            ->all();

        $versions = ['0' => __('global.app_select_first_element')] + $versions;

        return $versions;

    }

    public static function getBizonylatTipusok()
    {
        $retVal = [
            null => __('global.app_select_first_element'),
            '1' => __('global.invoices.search.types.all'),
            '201' => __('global.invoices.search.types.incoming'),
            '202' => __('global.invoices.search.types.outgoing'),
        ];
        //dd($retVal);
        return $retVal;
    }

    public static function resToClass($res, &$instance)
    {
        foreach($res as $key => $val)
        {
            $instance->$key = $val;
        }
        return $instance;
    }

    /**
     * Unaccent the input string string. An example string like `ÀØėÿᾜὨζὅБю`
     * will be translated to `AOeyIOzoBY`. More complete than :
     *   strtr( (string)$str,
     *          "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
     *          "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn" );
     *
     * @param $str input string
     * @param $utf8 if null, function will detect input string encoding
     * @author http://www.evaisse.net/2008/php-translit-remove-accent-unaccent-21001
     * @return string input string without accent
     */
    public static function remove_accents( $str, $utf8=true )
    {
        $str = (string)$str;
        if( is_null($utf8) ) {
            if( !function_exists('mb_detect_encoding') ) {
                $utf8 = (strtolower( mb_detect_encoding($str) )=='utf-8');
            } else {
                $length = strlen($str);
                $utf8 = true;
                for ($i=0; $i < $length; $i++) {
                    $c = ord($str[$i]);
                    if ($c < 0x80) $n = 0; # 0bbbbbbb
                    elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
                    elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
                    elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
                    elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
                    elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
                    else return false; # Does not match any model
                    for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
                        if ((++$i == $length)
                            || ((ord($str[$i]) & 0xC0) != 0x80)) {
                            $utf8 = false;
                            break;
                        }

                    }
                }
            }

        }

        if(!$utf8)
            $str = utf8_encode($str);

        $transliteration = array(
            'Ĳ' => 'I', 'Ö' => 'O','Œ' => 'O','Ü' => 'U','ä' => 'a','æ' => 'a',
            'ĳ' => 'i','ö' => 'o','œ' => 'o','ü' => 'u','ß' => 's','ſ' => 's',
            'À' => 'A','Á' => 'A','Â' => 'A','Ã' => 'A','Ä' => 'A','Å' => 'A',
            'Æ' => 'A','Ā' => 'A','Ą' => 'A','Ă' => 'A','Ç' => 'C','Ć' => 'C',
            'Č' => 'C','Ĉ' => 'C','Ċ' => 'C','Ď' => 'D','Đ' => 'D','È' => 'E',
            'É' => 'E','Ê' => 'E','Ë' => 'E','Ē' => 'E','Ę' => 'E','Ě' => 'E',
            'Ĕ' => 'E','Ė' => 'E','Ĝ' => 'G','Ğ' => 'G','Ġ' => 'G','Ģ' => 'G',
            'Ĥ' => 'H','Ħ' => 'H','Ì' => 'I','Í' => 'I','Î' => 'I','Ï' => 'I',
            'Ī' => 'I','Ĩ' => 'I','Ĭ' => 'I','Į' => 'I','İ' => 'I','Ĵ' => 'J',
            'Ķ' => 'K','Ľ' => 'K','Ĺ' => 'K','Ļ' => 'K','Ŀ' => 'K','Ł' => 'L',
            'Ñ' => 'N','Ń' => 'N','Ň' => 'N','Ņ' => 'N','Ŋ' => 'N','Ò' => 'O',
            'Ó' => 'O','Ô' => 'O','Õ' => 'O','Ø' => 'O','Ō' => 'O','Ő' => 'O',
            'Ŏ' => 'O','Ŕ' => 'R','Ř' => 'R','Ŗ' => 'R','Ś' => 'S','Ş' => 'S',
            'Ŝ' => 'S','Ș' => 'S','Š' => 'S','Ť' => 'T','Ţ' => 'T','Ŧ' => 'T',
            'Ț' => 'T','Ù' => 'U','Ú' => 'U','Û' => 'U','Ū' => 'U','Ů' => 'U',
            'Ű' => 'U','Ŭ' => 'U','Ũ' => 'U','Ų' => 'U','Ŵ' => 'W','Ŷ' => 'Y',
            'Ÿ' => 'Y','Ý' => 'Y','Ź' => 'Z','Ż' => 'Z','Ž' => 'Z','à' => 'a',
            'á' => 'a','â' => 'a','ã' => 'a','ā' => 'a','ą' => 'a','ă' => 'a',
            'å' => 'a','ç' => 'c','ć' => 'c','č' => 'c','ĉ' => 'c','ċ' => 'c',
            'ď' => 'd','đ' => 'd','è' => 'e','é' => 'e','ê' => 'e','ë' => 'e',
            'ē' => 'e','ę' => 'e','ě' => 'e','ĕ' => 'e','ė' => 'e','ƒ' => 'f',
            'ĝ' => 'g','ğ' => 'g','ġ' => 'g','ģ' => 'g','ĥ' => 'h','ħ' => 'h',
            'ì' => 'i','í' => 'i','î' => 'i','ï' => 'i','ī' => 'i','ĩ' => 'i',
            'ĭ' => 'i','į' => 'i','ı' => 'i','ĵ' => 'j','ķ' => 'k','ĸ' => 'k',
            'ł' => 'l','ľ' => 'l','ĺ' => 'l','ļ' => 'l','ŀ' => 'l','ñ' => 'n',
            'ń' => 'n','ň' => 'n','ņ' => 'n','ŉ' => 'n','ŋ' => 'n','ò' => 'o',
            'ó' => 'o','ô' => 'o','õ' => 'o','ø' => 'o','ō' => 'o','ő' => 'o',
            'ŏ' => 'o','ŕ' => 'r','ř' => 'r','ŗ' => 'r','ś' => 's','š' => 's',
            'ť' => 't','ù' => 'u','ú' => 'u','û' => 'u','ū' => 'u','ů' => 'u',
            'ű' => 'u','ŭ' => 'u','ũ' => 'u','ų' => 'u','ŵ' => 'w','ÿ' => 'y',
            'ý' => 'y','ŷ' => 'y','ż' => 'z','ź' => 'z','ž' => 'z','Α' => 'A',
            'Ά' => 'A','Ἀ' => 'A','Ἁ' => 'A','Ἂ' => 'A','Ἃ' => 'A','Ἄ' => 'A',
            'Ἅ' => 'A','Ἆ' => 'A','Ἇ' => 'A','ᾈ' => 'A','ᾉ' => 'A','ᾊ' => 'A',
            'ᾋ' => 'A','ᾌ' => 'A','ᾍ' => 'A','ᾎ' => 'A','ᾏ' => 'A','Ᾰ' => 'A',
            'Ᾱ' => 'A','Ὰ' => 'A','ᾼ' => 'A','Β' => 'B','Γ' => 'G','Δ' => 'D',
            'Ε' => 'E','Έ' => 'E','Ἐ' => 'E','Ἑ' => 'E','Ἒ' => 'E','Ἓ' => 'E',
            'Ἔ' => 'E','Ἕ' => 'E','Ὲ' => 'E','Ζ' => 'Z','Η' => 'I','Ή' => 'I',
            'Ἠ' => 'I','Ἡ' => 'I','Ἢ' => 'I','Ἣ' => 'I','Ἤ' => 'I','Ἥ' => 'I',
            'Ἦ' => 'I','Ἧ' => 'I','ᾘ' => 'I','ᾙ' => 'I','ᾚ' => 'I','ᾛ' => 'I',
            'ᾜ' => 'I','ᾝ' => 'I','ᾞ' => 'I','ᾟ' => 'I','Ὴ' => 'I','ῌ' => 'I',
            'Θ' => 'T','Ι' => 'I','Ί' => 'I','Ϊ' => 'I','Ἰ' => 'I','Ἱ' => 'I',
            'Ἲ' => 'I','Ἳ' => 'I','Ἴ' => 'I','Ἵ' => 'I','Ἶ' => 'I','Ἷ' => 'I',
            'Ῐ' => 'I','Ῑ' => 'I','Ὶ' => 'I','Κ' => 'K','Λ' => 'L','Μ' => 'M',
            'Ν' => 'N','Ξ' => 'K','Ο' => 'O','Ό' => 'O','Ὀ' => 'O','Ὁ' => 'O',
            'Ὂ' => 'O','Ὃ' => 'O','Ὄ' => 'O','Ὅ' => 'O','Ὸ' => 'O','Π' => 'P',
            'Ρ' => 'R','Ῥ' => 'R','Σ' => 'S','Τ' => 'T','Υ' => 'Y','Ύ' => 'Y',
            'Ϋ' => 'Y','Ὑ' => 'Y','Ὓ' => 'Y','Ὕ' => 'Y','Ὗ' => 'Y','Ῠ' => 'Y',
            'Ῡ' => 'Y','Ὺ' => 'Y','Φ' => 'F','Χ' => 'X','Ψ' => 'P','Ω' => 'O',
            'Ώ' => 'O','Ὠ' => 'O','Ὡ' => 'O','Ὢ' => 'O','Ὣ' => 'O','Ὤ' => 'O',
            'Ὥ' => 'O','Ὦ' => 'O','Ὧ' => 'O','ᾨ' => 'O','ᾩ' => 'O','ᾪ' => 'O',
            'ᾫ' => 'O','ᾬ' => 'O','ᾭ' => 'O','ᾮ' => 'O','ᾯ' => 'O','Ὼ' => 'O',
            'ῼ' => 'O','α' => 'a','ά' => 'a','ἀ' => 'a','ἁ' => 'a','ἂ' => 'a',
            'ἃ' => 'a','ἄ' => 'a','ἅ' => 'a','ἆ' => 'a','ἇ' => 'a','ᾀ' => 'a',
            'ᾁ' => 'a','ᾂ' => 'a','ᾃ' => 'a','ᾄ' => 'a','ᾅ' => 'a','ᾆ' => 'a',
            'ᾇ' => 'a','ὰ' => 'a','ᾰ' => 'a','ᾱ' => 'a','ᾲ' => 'a','ᾳ' => 'a',
            'ᾴ' => 'a','ᾶ' => 'a','ᾷ' => 'a','β' => 'b','γ' => 'g','δ' => 'd',
            'ε' => 'e','έ' => 'e','ἐ' => 'e','ἑ' => 'e','ἒ' => 'e','ἓ' => 'e',
            'ἔ' => 'e','ἕ' => 'e','ὲ' => 'e','ζ' => 'z','η' => 'i','ή' => 'i',
            'ἠ' => 'i','ἡ' => 'i','ἢ' => 'i','ἣ' => 'i','ἤ' => 'i','ἥ' => 'i',
            'ἦ' => 'i','ἧ' => 'i','ᾐ' => 'i','ᾑ' => 'i','ᾒ' => 'i','ᾓ' => 'i',
            'ᾔ' => 'i','ᾕ' => 'i','ᾖ' => 'i','ᾗ' => 'i','ὴ' => 'i','ῂ' => 'i',
            'ῃ' => 'i','ῄ' => 'i','ῆ' => 'i','ῇ' => 'i','θ' => 't','ι' => 'i',
            'ί' => 'i','ϊ' => 'i','ΐ' => 'i','ἰ' => 'i','ἱ' => 'i','ἲ' => 'i',
            'ἳ' => 'i','ἴ' => 'i','ἵ' => 'i','ἶ' => 'i','ἷ' => 'i','ὶ' => 'i',
            'ῐ' => 'i','ῑ' => 'i','ῒ' => 'i','ῖ' => 'i','ῗ' => 'i','κ' => 'k',
            'λ' => 'l','μ' => 'm','ν' => 'n','ξ' => 'k','ο' => 'o','ό' => 'o',
            'ὀ' => 'o','ὁ' => 'o','ὂ' => 'o','ὃ' => 'o','ὄ' => 'o','ὅ' => 'o',
            'ὸ' => 'o','π' => 'p','ρ' => 'r','ῤ' => 'r','ῥ' => 'r','σ' => 's',
            'ς' => 's','τ' => 't','υ' => 'y','ύ' => 'y','ϋ' => 'y','ΰ' => 'y',
            'ὐ' => 'y','ὑ' => 'y','ὒ' => 'y','ὓ' => 'y','ὔ' => 'y','ὕ' => 'y',
            'ὖ' => 'y','ὗ' => 'y','ὺ' => 'y','ῠ' => 'y','ῡ' => 'y','ῢ' => 'y',
            'ῦ' => 'y','ῧ' => 'y','φ' => 'f','χ' => 'x','ψ' => 'p','ω' => 'o',
            'ώ' => 'o','ὠ' => 'o','ὡ' => 'o','ὢ' => 'o','ὣ' => 'o','ὤ' => 'o',
            'ὥ' => 'o','ὦ' => 'o','ὧ' => 'o','ᾠ' => 'o','ᾡ' => 'o','ᾢ' => 'o',
            'ᾣ' => 'o','ᾤ' => 'o','ᾥ' => 'o','ᾦ' => 'o','ᾧ' => 'o','ὼ' => 'o',
            'ῲ' => 'o','ῳ' => 'o','ῴ' => 'o','ῶ' => 'o','ῷ' => 'o','А' => 'A',
            'Б' => 'B','В' => 'V','Г' => 'G','Д' => 'D','Е' => 'E','Ё' => 'E',
            'Ж' => 'Z','З' => 'Z','И' => 'I','Й' => 'I','К' => 'K','Л' => 'L',
            'М' => 'M','Н' => 'N','О' => 'O','П' => 'P','Р' => 'R','С' => 'S',
            'Т' => 'T','У' => 'U','Ф' => 'F','Х' => 'K','Ц' => 'T','Ч' => 'C',
            'Ш' => 'S','Щ' => 'S','Ы' => 'Y','Э' => 'E','Ю' => 'Y','Я' => 'Y',
            'а' => 'A','б' => 'B','в' => 'V','г' => 'G','д' => 'D','е' => 'E',
            'ё' => 'E','ж' => 'Z','з' => 'Z','и' => 'I','й' => 'I','к' => 'K',
            'л' => 'L','м' => 'M','н' => 'N','о' => 'O','п' => 'P','р' => 'R',
            'с' => 'S','т' => 'T','у' => 'U','ф' => 'F','х' => 'K','ц' => 'T',
            'ч' => 'C','ш' => 'S','щ' => 'S','ы' => 'Y','э' => 'E','ю' => 'Y',
            'я' => 'Y','ð' => 'd','Ð' => 'D','þ' => 't','Þ' => 'T','ა' => 'a',
            'ბ' => 'b','გ' => 'g','დ' => 'd','ე' => 'e','ვ' => 'v','ზ' => 'z',
            'თ' => 't','ი' => 'i','კ' => 'k','ლ' => 'l','მ' => 'm','ნ' => 'n',
            'ო' => 'o','პ' => 'p','ჟ' => 'z','რ' => 'r','ს' => 's','ტ' => 't',
            'უ' => 'u','ფ' => 'p','ქ' => 'k','ღ' => 'g','ყ' => 'q','შ' => 's',
            'ჩ' => 'c','ც' => 't','ძ' => 'd','წ' => 't','ჭ' => 'c','ხ' => 'k',
            'ჯ' => 'j','ჰ' => 'h',
            //' ' => '_',
            ' ' => '-',
            ',' => '', '.' => '', '(' => '', ')' => '',
            //'-' => '_'
        );
        $str = str_replace( array_keys( $transliteration ),
            array_values( $transliteration ),
            $str);
        return strtolower($str);
    }
}
