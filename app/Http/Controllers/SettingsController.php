<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        /*
        $this->middleware('role:Admin', [
            'only' => [
                'index', 'show',
                'create', 'store',
                'edit', 'update',
                'destroy', 'restore'
            ]
        ]);
        */
        $this->middleware('permission:settings-menu', [
            'only' => [
                'index', 'show',
                'create', 'store',
                'edit', 'update',
                'destroy', 'restore'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = \App\Classes\Helper::getAllSettings();

        //dd('SettingsController.index', $settings);

        return view('settings.index', [
            'settings' => $settings
        ]);
    }

    public function saveGeneral(Request $request)
    {
        //dd('SettingsController.saveGeneral', $request->all() );

        // FAVICON
        if( $request->general_favicon_value != null )
        {
            $this->validate($request, [
                'general_favicon_value'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            //$faviconImageName = \App\Classes\Helper::uploadFile(config('appConfig.favicons.folder'), $request->general_favicon_value);
            $faviconImageName = \App\Classes\Helper::uploadWithResize(
                    config('appConfig.favicons.folder'),
                    $request->general_favicon_value,
                    config('appConfig.favicons.width'),
                    config('appConfig.favicons.height')
            );

            if( $request->get('general_favicon_id') == 0 )
            {
                $favicon = new SettingModel();
                $favicon->CompanyID = \Auth::user()->CompanyID;
                $favicon->PropertyName = 'general_favicon_value';
                $favicon->PropertyValue = $faviconImageName;
                $favicon->save();
            }
            else
            {
                $favicon = SettingModel::find($request->get('general_favicon_id'));
                $old_imageName = $favicon->PropertyValue;
                $favicon->PropertyValue = $faviconImageName;
                $favicon->save();

                \App\Classes\Helper::deleteUploadedImage(config('appConfig.favicons.folder'), $old_imageName);
            }

            session()->put('settings.general_favicon_value', $faviconImageName);

        }

        // LOGO
        if( $request->general_logo_value != null )
        {
            $this->validate($request, [
                'general_logo_value'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $logoImageName = \App\Classes\Helper::uploadFile(config('appConfig.logos_folder'), $request->general_logo_value);

            if( $request->get('general_logo_id') == 0 )
            {
                $logo = new SettingModel();
                $logo->CompanyID = \Auth::user()->CompanyID;
                $logo->PropertyName = 'general_logo_value';
                $logo->PropertyValue = $logoImageName;
                $logo->save();
            }
            else
            {
                $logo = SettingModel::find($request->get('general_logo_id'));
                $old_logo = $logo->PropertyValue;
                $logo->PropertyValue = $logoImageName;

                $logo->save();

                \App\Classes\Helper::deleteUploadedImage(config('appConfig.logos_folder'), $old_logo);
            }

            session()->put('settings.general_logo_value', $logoImageName);
        }

        // PROFIL IMAGE
        if( $request->general_profil_image_value != null )
        {
            $this->validate($request, [
                'general_profil_image_value'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $profileImageName = \App\Classes\Helper::uploadFile(config('appConfig.profiles_folder'), $request->general_profil_image_value);

            if( $request->get('general_profil_image_id') == 0 )
            {
                $profile = new SettingModel();
                $profile->CompanyID = \Auth::user()->CompanyID;
                $profile->PropertyName = 'general_profil_image_value';
                $profile->PropertyValue = $profileImageName;
                $profile->save();

            }
            else
            {
                $profile = SettingModel::find($request->get('general_profil_image_id'));
                $old_profile = $profile->PropertyValue;
                $profile->PropertyValue = $profileImageName;
                $profile->save();

                \App\Classes\Helper::deleteUploadedImage(config('appConfig.profiles_folder'), $old_profile);
            }

            session()->put('session.general_profil_image_value', $profileImageName);
        }

        // MENU BACKGROUND COLOR
        if( $request->get('menu_bg_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                request()->get('general_menu_bg_color_id'),
                'general_menu_bg_color_value',
                request()->get('general_menu_bg_color_value'));
        }

        // HEADER BACKGROUND
        if( request()->get('general_header_bg_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    request()->get('general_header_bg_color_id'),
                    'general_header_bg_color_value',
                    request()->get('general_header_bg_color_value'));
        }

        // PANEL AND TAB LINE COLOR
        if( request()->get('general_panel_tab_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    request()->get('general_panel_tab_color_id'),
                    'general_panel_tab_color_value',
                    request()->get('general_panel_tab_color_value'));
        }

        return redirect()
                ->to('settings')
                ->with('success', trans('messages.update_successfully', ['name' => trans('settings.general_title')]));
    }

    public function restoreGeneral()
    {
        //dd('SettingsController.restoreGeneral');
        SettingModel::where('CompanyID', '=', \Auth::user()->CompanyID)
                ->where('PropertyName', 'like', 'general_%')
                ->forceDelete();

        return redirect()
                ->to('settings')
                ->with('success', trans('messages.restore_successfully', ['name' => trans('settings.general_title')]));
    }

    public function saveLogin(Request $request)
    {
        //dd('SettingsController.saveLogin', $request->all());
        // Wallpaper
        if( $request->login_image != null )
        {
            $this->validate($request, [
                'login_image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $wallpaperName = \App\Classes\Helper::uploadFile(
                    config('appConfig.wallpapers_folder'),
                    $request->login_image);

            if( $request->get('login_wallpaper_id') == 0 )
            {
                $wallpaper = new SettingModel();
                $wallpaper->CompanyID = \Auth::user()->CompanyID;
                $wallpaper->PropertyName = 'login_wallpaper_value';
                $wallpaper->PropertyValue = $wallpaperName;
                $wallpaper->save();
            }
            else
            {
                $wallpaper = SettingModel::find($request->get('login_wallpaper_id'));
                $old_wallpaper = $wallpaper->PropertyValue;
                $wallpaper->PropertyValue = $wallpaperName;
                $wallpaper->save();

                \App\Classes\Helper::deleteUploadedImage(
                        config('appConfig.wallpapers_folder'),
                        $old_wallpaper
                );
            }

            session()->put('settings.login_wallpaper_value', $wallpaperName);
        }

        // BACGROUND COLOR
        if( $request->get('login_background_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    $request->get('login_background_color_id'),
                    'login_background_color_value',
                    $request->get('login_background_color_value'));
        }

        return redirect()
                ->to('settings')
                ->with('success', trans('messages.update_successfully', ['name' => trans('settings.login_page_title')]));
    }

    public function restoreLogin()
    {
        //dd('SettingsController.restoreGeneral');
        SettingModel::where('CompanyID', '=', \Auth::user()->CompanyID)
                ->where('PropertyName', 'like', 'login_%')
                ->forceDelete();

        return redirect()
                ->to('settings')
                ->with('success', trans('messages.restore_successfully', ['name' => trans('settings.login_page_title')]));
    }

    public function saveDashboard(Request $request)
    {
        //dd('SettingsController.saveDashboard', $request->all());
        // MENU BG COLOR
        if( $request->get('dashboard_menu_bg_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    $request->get('dashboard_menu_bg_color_id'),
                    'dashboard_menu_bg_color_value',
                    $request->get('dashboard_menu_bg_color_value'));
        }

        // HEADER BG COLOR
        if(request()->get('dashboard_header_bg_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    $request->get('dashboard_header_bg_color_id'),
                    'dashboard_header_bg_color_value',
                    $request->get('dashboard_header_bg_color_value'));
        }

        // PANEL AND TAB LINE COLOR
        if($request->get('dashboard_panel_tab_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    $request->get('dashboard_panel_tab_color_id'),
                    'dashboard_panel_tab_color_value',
                    $request->get('dashboard_panel_tab_color_value'));
        }

        return redirect()
                ->to('settings')
                ->with('success', trans('messages.update_successfully', ['name' => trans('settings.dashboard_page_title')]));
    }

    public function restoreDashboard()
    {
        //dd('SettingsController.restoreGeneral');
        SettingModel::where('CompanyID', '=', \Auth::user()->CompanyID)
                ->where('PropertyName', 'like', 'dashboard_%')
                ->forceDelete();

        return redirect()
                ->to('settings')
                ->with('success', trans('messages.restore_successfully', ['name' => trans('settings.dashboard_page_title')]));
    }

    public function saveInvoices(Request $request)
    {
        // MENU BG COLOR
        if( request()->get('invoices_menu_bg_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    request()->get('invoices_menu_bg_color_id'),
                    'invoices_menu_bg_color_value',
                    request()->get('invoices_menu_bg_color_value'));
        }

        // HEADER BG COLOR
        if(request()->get('invoices_header_bg_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    request()->get('invoices_header_bg_color_id'),
                    'invoices_header_bg_color_value',
                    request()->get('invoices_header_bg_color_value'));
        }

        // PANEL AND TAB LINE COLOR
        if(request()->get('invoices_panel_tab_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    request()->get('invoices_panel_tab_color_id'),
                    'invoices_panel_tab_color_value',
                    request()->get('invoices_panel_tab_color_value'));
        }

        return redirect()
                ->to('settings')
                ->with('success', trans('messages.update_successfully', ['name' => trans('settings.dashboard_page_title')]));
    }

    public function restoreInvoices()
    {
        SettingModel::where('CompanyID', '=', \Auth::user()->CompanyID)
                ->where('PropertyName', 'like', 'invoices_%')
                ->forceDelete();

        return redirect()
                ->to('settings')
                ->with('success', trans('messages.restore_successfully', ['name' => trans('settings.invoices_page_title')]));
    }

    public function saveUsers(Request $request)
    {
        // MENU BG COLOR
        if( request()->get('users_menu_bg_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    request()->get('users_menu_bg_color_id'),
                    'users_menu_bg_color_value',
                    request()->get('users_menu_bg_color_value'));
        }

        // HEADER BG COLOR
        if(request()->get('users_header_bg_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    request()->get('users_header_bg_color_id'),
                    'users_header_bg_color_value',
                    request()->get('users_header_bg_color_value'));
        }

        // PANEL AND TAB LINE COLOR
        if(request()->get('users_panel_tab_color_value') !== null )
        {
            \App\Classes\ColorHelper::saveColor(
                    request()->get('users_panel_tab_color_id'),
                    'users_panel_tab_color_value',
                    request()->get('users_panel_tab_color_value'));
        }

        return redirect()
                ->to('settings')
                ->with('success', trans('messages.update_successfully', ['name' => trans('settings.users_page_title')]));
    }

    public function restoreUsers()
    {
        SettingModel::where('CompanyID', '=', \Auth::user()->CompanyID)
                ->where('PropertyName', 'like', 'users_%')
                ->forceDelete();

        return redirect()
                ->to('settings')
                ->with('success', trans('messages.restore_successfully', ['name' => trans('settings.users_page_title')]));
    }

    public function saveLoginWallpaper(Request $request, $id)
    {
        $this->validate($request, [
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->getClientOriginalName();
        $aa = $request->image->move(public_path(config('appConfig.wallpapers_folder')), $imageName);

        $old_image = '';

        // Ha nincs bejegyzés
        if( $id == '0' )
        {
            $model = new SettingModel();
            $model->PropertyName = 'Login_Wallpaper';
        }
        else
        {
            $model = SettingModel::find($id);
            $old_image = $model->PropertyValue;
        }

        $model->CompanyID = session()->get('company_id');

        $model->PropertyValue = $imageName;
        $model->save();

        // File deleting
        if($old_image != '' && \File::exists(public_path(config('appConfig.wallpapers_folder')) . '\\' . $old_image ) )
        {
            \File::delete(public_path(config('appConfig.wallpapers_folder')) . '\\' . $old_image);
        }

        return redirect()
                ->to('settings');
    }
    /*
    public function saveLoginWallpaper_new(Request $request, $id)
    {
        $this->validate($request, [
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = $request->file('image');

        $image_name = time() . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('/thumbnail');

        $resize_image = \Spatie\Image\Image::make($image->getRealPath());

        $resize_image->resize(1920, 1080, function($constraint){
            $constraint->aspectRatio();
            })
                ->save($destinationPath . '/' . $image_name);

        $destinationPath = public_path('/images');
        $image->move($destinationPath, $image_name);

        return redirect()
                ->to('settings');
    }
    */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function createWallpaper()
    {
        return view('settings.createWallpaper');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $wallpaper = \App\Models\WallpaperModel::create($request->all());

        foreach( $request->input('document', []) as $file )
        {
            $wallpaper
                    ->addMedia(storage_path('tmp/uploads/' . $file))
                    ->toMediaCollection('document');
        }
        return redirect()->to('settings');
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*
        $wallpaper->update($request->all());

        if( count($wallpaper->document) > 0 )
        {
            foreach( $wallpaper->document as $media )
            {
                if( !in_array($media->file_name, $request->input('document', [])) )
                {
                    $media->delete();
                }
            }
        }

        $media = $wallpaper->document->pluck('file_name')->toArray();

        foreach( $request->input('document', []) as $file )
        {
            if( count($media) === 0 || !in_array($file, $media) )
            {
                $wallpaper->addMedia(storage_path('tmp/uploads/' . $file))
                        ->toMediaCollection('document');
            }
        }
        return redirect()->to('settings');
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
/*
    public function fileStore(Request $request)
    {
        dd('SettingsController', $request->all());

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('image'), $imageName);

        $setting = new SettingModel();
        $setting->CompanyID = \Auth::user()->CompanyID;
        $setting->PropertyName = 'Login_Wallpaper';
        $setting->PropertyValue = $imageName;
        $setting->save();

        return response()->json(['success' => $imageName]);
    }
    */
/*
    public function fileDestroy(Request $request)
    {
        dd($request);
        $fileName = $request->get('filename');
        $setting = SettingModel::where('PropertyName', 'Login_Wallpaper')
            ->where('CompanyID', '=', \Auth::user()->CompanyName);

        //$setting->delete();

        $path = public_path() . '/images/' . $fileName;

        if( file_exists($path) )
        {
            unlink($path);
        }

        return $fileName;
    }
    */
    /*
    public function storeMedia(Request $request)
    {
        dd('SettingsController.storeMedia', $request->all());
        $path = storage_path('tmp/uploads');

        if( !file_exists($path) )
        {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }
    */
}
