@extends('layouts.app')

@section('title', __('global.settings.title'))

@section('content')

<section class="content-header">
    <h1>
        {{ __('global.settings.title') }}
        <small>{{ __('global.settings.sub_title') }}</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('/') }}">
                <i class="fa fa-dashboard"></i>&nbsp;
                {{ __('global.app_dashboard') }}
            </a>
        </li>

        <li class="active">
            <i class="fa fa-users"></i>&nbsp;
            {{ __('global.settings.title') }}
        </li>

    </ol>
</section>

<section class="content">
    @php
    
    //echo '<pre>';
    //print_r($errors);
    //echo '<pre>';
    
    @endphp
    {{--
    @if( session()->has('success') )

        @includeIf('layouts.success', ['messages' => session()->get('success') ])

    @elseif( session()->has('errors') )

        @includeIf('layouts.alert', ['messages' => session()->get('errors')] )

    @endif
    --}}
    {{-- GENERAL SETTINGS --}}
    @includeIf('settings.general', [
        'general_logo_id' =>            $settings['general_logo_id'],                          'general_logo_value' =>  $settings['general_logo_value'], 
        'general_favicon_id' =>         $settings['general_favicon_id'],                    'general_favicon_value' =>  $settings['general_favicon_value'], 
        'general_profil_image_id' =>    $settings['general_profil_image_id'],          'general_profil_image_value' =>  $settings['general_profil_image_value'],
        'general_menu_bg_color_id' =>   $settings['general_menu_bg_color_id'],        'general_menu_bg_color_value' =>  $settings['general_menu_bg_color_value'],
        'general_header_bg_color_id' => $settings['general_header_bg_color_id'],    'general_header_bg_color_value' =>  $settings['general_header_bg_color_value'],
        'general_panel_tab_color_id' => $settings['general_panel_tab_color_id'],    'general_panel_tab_color_value' =>  $settings['general_panel_tab_color_value']
    ])

    {{-- LOGIN PAGE --}}
    @includeIf('settings.loginPage', [
        'login_wallpaper_id'        => $settings['login_wallpaper_id'], 'login_wallpaper_value' => $settings['login_wallpaper_value'],
        'login_logo_id'             => $settings['login_logo_id'], 'login_logo_value' => $settings['login_logo_value'],
        'login_background_color_id' => $settings['login_background_color_id'], 'login_background_color_value' => $settings['login_background_color_value'],
    ])
    
    {{-- DASHBOARD PAGE --}}
    @includeIf('settings.dashboardPage', [
        'dashboard_menu_bg_color_id'    => $settings['dashboard_menu_bg_color_id'],     'dashboard_menu_bg_color_value' => $settings['dashboard_menu_bg_color_value'],
        'dashboard_header_bg_color_id'  => $settings['dashboard_header_bg_color_id'],   'dashboard_header_bg_color_value' => $settings['dashboard_header_bg_color_value'],
        'dashboard_panel_tab_color_id'  => $settings['dashboard_panel_tab_color_id'],   'dashboard_panel_tab_color_value' => $settings['dashboard_panel_tab_color_value']
    ])
    
    {{-- INVOICES PAGE --}}
    @includeIf('settings.invoicesPage', [
        'invoices_menu_bg_color_id'     => $settings['invoices_menu_bg_color_id'], 'invoices_menu_bg_color_value' => $settings['invoices_menu_bg_color_value'],
        'invoices_header_bg_color_id'   => $settings['invoices_header_bg_color_id'], 'invoices_header_bg_color_value' => $settings['invoices_header_bg_color_value'],
        'invoices_panel_tab_color_id'   => $settings['invoices_panel_tab_color_id'], 'invoices_panel_tab_color_value' => $settings['invoices_panel_tab_color_value']
    ])
    
    @includeIf('settings.usersPage', [
        'users_menu_bg_color_id'    => $settings['users_menu_bg_color_id'], 'users_menu_bg_color_value' => $settings['users_menu_bg_color_value'],
        'users_header_bg_color_id'  => $settings['users_header_bg_color_id'], 'users_header_bg_color_value' => $settings['users_header_bg_color_value'],
        'users_panel_tab_color_id'  => $settings['users_panel_tab_color_id'], 'users_panel_tab_color_value' => $settings['users_panel_tab_color_value']
    ])
    
</section>

@endsection

@section('css')
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-colorpicker-3.2.0/src/bootstrap-colorpicker.css') }}">--}}
@php
echo "<!-- BACGROUND COLOR -->\n";
echo "<style>.skin-blue .main-sidebar, .skin-blue .left-side {background-color: " . \App\Classes\Helper::getMenuBgColor() . ";}</style>\n";
echo "<!-- HEADER BG COLOR -->\n";
$header_bg_color = \App\Classes\Helper::getHeaderBgColor();
echo "<style>.skin-blue .main-header .navbar {background-color: " . $header_bg_color . ";}</style>\n";
echo "<style>.skin-blue .main-header .logo {background-color: " . $header_bg_color . ";}</style>\n";

echo "<!-- PANEL AND TAB COLOR -->\n";
echo "<style>.box.box-default {border-top-color: " . \App\Classes\Helper::getPanelTabLineColor() . ";}</style>\n";
@endphp

<style>
    .colorpicker-2x .colorpicker-saturation {
        width: 200px;
        height: 200px;
    }

    .colorpicker-2x .colorpicker-hue,
    .colorpicker-2x .colorpicker-alpha {
        width: 30px;
        height: 200px;
    }

    .colorpicker-2x .colorpicker-color,
    .colorpicker-2x .colorpicker-color div {
        height: 30px;
    }
</style>

@endsection

@section('js')

    <!-- bootstrap color picker -->
    <script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    {{--<script src="{{ asset('assets/bower_components/bootstrap-colorpicker-3.2.0/src/bootstrap-colorpicker.js') }}"></script>--}}
    <script>
        // COLOR PICKER
        $('#general_menu_bg_color').colorpicker({
            format: "hex",
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        });

        $('#general_header_bg_color').colorpicker({
            format: "hex",
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        });
        
        $('#general_panel_tab_color').colorpicker({
            format: "hex",
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        });
        
        $('#login_background_color').colorpicker({
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }/*{
            horizontal: true
            @php
            if( $settings['login_background_color_value'] != '' )
            {
                echo ",color: '{$settings['login_background_color_value']}'\n";
            }
            @endphp
        }*/);
        
        $('#dashboard_menu_bg_color').colorpicker({
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }/*{
            horizontal: true
            @php
            if( $settings['dashboard_menu_bg_color_value'] != '' )
            {
                echo ",color: '{$settings['dashboard_menu_bg_color_value']}'\n";
            }
            @endphp
        }*/);
        
        $('#dashboard_header_bg_color').colorpicker({
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }/*{
            horizontal: true
            @php
            if( $settings['dashboard_header_bg_color_value'] != '' )
            {
                echo ",color: '{$settings['dashboard_header_bg_color_value']}'\n";
            }
            @endphp
        }*/);
        
        $('#dashboard_panel_tab_color').colorpicker({
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }/*{
            horizontal: true
            @php
            if( $settings['dashboard_panel_tab_color_value'] != '' )
            {
                echo ",color: '{$settings['dashboard_panel_tab_color_value']}'\n";
            }
            @endphp
        }*/);
        
        $('#invoices_menu_bg_color').colorpicker({
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }/*{
            horizontal: true
            @php
            if( $settings['invoices_menu_bg_color_value'] != '' )
            {
                echo ",color: '{$settings['invoices_menu_bg_color_value']}'\n";
            }
            @endphp
        }*/);
        
        
        $('#invoices_header_bg_color').colorpicker({
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }/*{
            horizontal: true
            @php
            if( $settings['invoices_header_bg_color_value'] != '' )
            {
                echo ",color: '{$settings['invoices_header_bg_color_value']}'\n";
            }
            @endphp
        }*/);
        
        $('#invoices_panel_tab_color').colorpicker({
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }/*{
            horizontal: true
            @php
            if( $settings['invoices_panel_tab_color_value'] != '' )
            {
                echo ",color: '{$settings['invoices_panel_tab_color_value']}'\n";
            }
            @endphp
        }*/);
        
        $('#users_menu_bg_color').colorpicker({
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }/*{
            horizontal: true
            @php
            if( $settings['users_menu_bg_color_value'] != '' )
            {
                echo ",color: '{$settings['users_menu_bg_color_value']}'\n";
            }
            @endphp
        }*/);
        
        $('#users_header_bg_color').colorpicker({
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }/*{
            horizontal: true
            @php
            if( $settings['users_header_bg_color_value'] != '' )
            {
                echo ",color: '{$settings['users_header_bg_color_value']}'\n";
            }
            @endphp
        }*/);
        
        $('#users_panel_tab_color').colorpicker({
            format: 'hex',
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        }/*{
            horizontal: true
            @php
            if( $settings['users_panel_tab_color_value'] != '' )
            {
                echo ",color: '{$settings['users_panel_tab_color_value']}'\n";
            }
            @endphp
        }*/);
        
    </script>

@endsection