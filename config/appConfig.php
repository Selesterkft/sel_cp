<?php
/*
	A version tömbön kívül nem lehet benne szögletes zárójel!!!
*/
return array(

    'enable_minifier' => false,

    'company_name' => 'Selester Kft.',
    'company_addr_1' => '1113, Budapest',
    'company_addr_2' => 'Kökrcsin utca 11.',
    'company_phone' => '(+36) 1 372-0061',
    'company_email' => 'info@selester.hu',

    'raw' => 'SET SESSION TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;',

    'appSortName' => 'CP',
    'timezones' => [
        'en' => [
            'carbon' => 'Europe/London',
            'moment' => '',
        ],
        'hu' => [
            'carbon' => 'Europe/Budapest',
            'moment' => '',
        ],
    ],
    'dateFormats' => array(
        'datetimepicker' => 'YYYY-MM-DD',
        'en' => array(
            'carbon' => 'd/m/Y',        // PHP date format
            'moment' => 'MM/DD/YY'    // Javascript date format
        ),
        'hu' => array(
            'carbon' => 'Y-m-d',        // PHP date format
            'moment' => 'YYYY.MM.DD'    // Javascript date format
        ),
    ),
    'currencies' => array(
        'en' => '$ %s',
        'hu' => '%s Ft',
    ),

    'wallpapers_folder' => 'wallpapers',
    'default_wallpaper' => 'wallpaper_02.jpg',
    'random_wallpaper' => true,
    'random_wallpaper_name' => 'wallpaper_%s.jpg',

    'tmp_folder' => 'tmp',

    'favicons' => [
        'folder' => 'favicons',
        'width' => 32,
        'height' => 32,
    ],

    'logos_folder' => 'logos',
    'profiles_folder' => 'profiles',

    'relations' => [
        0 => '=',
        1 => '<>',
        2 => '<',
        3 => '>',
        4 => '>=',
        5 => '<=',
        6 => 'like',
        7 => 'not like',
    ],

    'paginate_number' => 10,
    'checksum_separator' => '|',
    'string_min_length' => 3,
    'string_max_length' => 255,
    'default_query_name' => 'default_query',

    'date_filters' => [
        'invoice_look_back' => 90,  // Számla visszatekintés
        'stocks_movement_look_back' => 30, // Készletmozgás visszatekintés
    ],

    'languages' => array(
        'hu' => 'Hungarian',
        'en' => 'English'
    ),

    'default_design' => 'adminlte',

    'default_settings' => [
        'general_logo_value' => 'guest.png', // asset('assets/dist/img/guest.png')
        'general_favicon_value' => 'favicon.png', // asset('assets/dist/img/favicon.png')
        'general_profil_image_value' => 'guest.png', //asset('assets/dist/img/guest.png')
        /*
         * .skin-blue .main-sidebar, .skin-blue .left-side {background-color: #222d32;}
         */
        'general_menu_bg_color_value' => '#222d32',
        /*
         * .skin-blue .main-header .navbar {background-color: #3c8dbc;}
         * .skin-blue .main-header .logo {background-color: #367fa9;}
         */
        'general_header_bg_color_value' => '#3c8dbc',
        /*
         * .box.box-default {border-top-color: #3c8dbc;}
         */
        'general_panel_tab_color_value' => '#d2d6de',

        'login_wallpaper_value' => '',
        'login_background_color_value' => '#cc99cc',
        'login_logo_value' => '',
        'dashboard_menu_bg_color_value' => '',
        'dashboard_header_bg_color_value' => '',
        'dashboard_panel_tab_color_value' => '',
        'invoices_menu_bg_color_value' => '',
        'invoices_header_bg_color_value' => '',
        'invoices_panel_tab_color_value' => '',
        'users_menu_bg_color_value' => '',
        'users_header_bg_color_value' => '',
        'users_panel_tab_color_value' => '',
    ],

    'tables' => array(
        'company_has_subdomain' => [
            'connection'    => 'azure',
            'table'         => 'company_has_subdomain',
            'read'          => 'CP_Company_Subdomain_Read',
            'insert'        => 'CP_Company_Subdomain_Insert',
            'update'        => 'CP_Company_Subdomain_Update',
            'delete'        => 'CP_Company_Subdomain_Delete',
            'restore'       => 'CP_Company_Subdomain_RestoreDelete',
        ],
        'versions' => array(
            'connection'    => 'azure',
            'table'         => 'Versions',
            'read'          => 'CP_Versions_Read',
            'insert'        => 'CP_Versions_Insert',
            'update'        => 'CP_Versions_Update',
            'delete'        => 'CP_Versions_Delete',
            'restore'       => 'CP_Versions_RestoreDeleted',
        ),
        'version_has_company' => array(
            'connection'    => 'azure',
            'table'         => 'version_has_company',
            'read'          => 'CP_Version_Company_Read',
            'insert'        => 'CP_Version_Company_Insert',
            'update'        => 'CP_Version_Company_Update',
            'delete'        => 'CP_Version_Company_Delete',
            'restore'       => 'CP_Version_Company_RestoreDeleted',
        ),
        'designs' => [
            'connection' => 'azure',
            'table' => 'CP_designs',
        ],
        'company_design' => [
            'connection' => 'azure',
            'table' => 'CP_company_design',
            'insert' => 'CP_company_design_insert',
            'update' => 'CP_company_design_update',
            'delete' => 'CP_company_design_delete',
        ],
        'wallpapers' => array(
            'connection' => 'azure',
            'table' => 'wallpapers',
        ),
        'company' => array(
            'connection' => 'azure3',
            'table' => 'Cegek',
            'read' => 'CP_Cegek_Read',
            /*'ver_2019_01' => [
                'connection' => 'azure3',
                'table' => 'Cegek',
                'read' => 'CP_Cegek_Read',
            ],
            'ver_2019_02' => [
                'connection' => 'azure3',
                'table' => 'Cegek',
                'read' => 'CP_Cegek_Read',
            ],*/
        ),
        'stocks' => array(
            'ver_2019_01' => [
                'connection' => 'azure',
                'table' => 'CP_Stocks',
                'read_orig' => 'CP_getStocks',
                'read' => 'CP_STOCK_GET_Kovi_verzio',
            ],
        ),

        'table_columns' => [
            'connection'                => 'azure',
            'table'                     => 'CP_Table_Columns',
            'get_table_columns'         => 'CP_GetTableColumns',
            'get_company_reports' => 'CP_GET_COMPANY_REPORTS',
            'column_sync'               => 'CP_TableColumns_SYNC',
        ],

        'query_types' => [
            'connection'    => 'azure',
            'table'         => 'CP_QueryTypes',
        ],

        'user_queries' => [
            'connection'    => 'azure',
            'table'         => 'CP_UserQueries',
            'update'        => 'CP_UserQuery_update',
            'delete'        => 'CP_UserQuery_delete',
        ],

        'wrhs_stocks' => [
            'connection' => 'azure',
            'table' => 'CP_WRHS_STOCKS',
        ],
        'wrhs_trans' => [
            'connection' => 'azure',
            'table' => 'CP_WRHS_TRANS',
            'read' => 'CP_TRANS_GET',
        ],
        'wrhs_trans_l' => [
            'connection' => 'azure',
            'table' => 'CP_WRHS_TRANS_L',
        ],

        'invoices' => [
            'ver_2019_01' => [
                'connection'    => 'azure',
                'table'         => 'Inv',
                'read'          => 'CP_PAGE_INV_INDEX_INV_LIST',
                'read2'         => 'CP_Inv_Read_Data',
                'getCustomers'  => 'CP_getCustomers',
                'getVendors'    => 'CP_getVendors',
                'getPartners'   => 'CP_get_Invoice_Partners',
                'widget_read'   => 'CP_Invoices_Widget',
            ]
        ],
        'invoice_details2' => [
            'ver_2019_01' => [
                'connection' => 'azure',
                'table' => 'Inv_L',
                'read' => 'CP_Inv_L_Read',
                'read2' => 'CP_Inv_L_Read_Data',
            ]
        ],
        'invoice_details' => array(
            'ver_2019_01' => [
                'connection' => 'azure',
                'table' => 'CP_Inv_L_Read',
                //'table' => 'Inv_L',
            ],
            'ver_2019_02' => [
                'connection' => 'azure',
                'table' => 'Inv_L',
            ],
        ),
        'settings' => array(
            'connection' => 'azure',
            'table'     => 'settings',
            'read'      => 'CP_Settings_Read',
            'insert'    => 'CP_Settings_Insert',
            'update'    => 'CP_Settings_Update',
            'delete'    => 'CP_Settings_Delete',
            'restore'   => 'CP_Settings_RestoreDeleted',
        ),
        'menus' => array(
            'connection' => 'azure',
            'table' => 'menus',
        ),
        'users' => array(
            'connection' => 'azure',
            'table' => 'CP_Users',
            'read' => 'CP_Users_Read',
            'insert' => 'CP_Users_Insert',
            'update' => 'CP_Users_Update',
            'register' => 'CP_User_Register_Login',
            'delete' => 'CP_Users_Delete',
            'restore' => 'CP_Users_RestoreDeleted',
        ),

        'model_has_roles' => array(
            'connection' => 'azure',
            'table' => 'model_has_roles',
        ),
        'roles' => [
            'connection' => 'azure',
            'table' => 'roles',
        ],
        'permissions' => array(
            'connection' => 'azure',
            'table' => 'permissions',
        ),
        'password_reset' => array(
            'connection' => 'azure',
            'table' => 'password_resets',
        ),
        'transacts' => array(
            'connection' => 'azure',
            'table' => 'Transacts',
        ),
        'alkalmazottak' => array(
            'connection' => 'azure',
            'table' => 'Alkalmazottak',
        ),
        'vehicles' => array(
            'connection' => 'azure',
            'table' => 'Jarmuvek',
        ),
        'currencies' => [
            'connection' => 'azure',
            'table' => 'CP_Currs',
        ],
        'audit_logs' => [
            'connection' => 'azure',
            'table' => 'audit_logs',
        ],
        /*
        'invoices_old' => array(
            'connection' => 'azure2',
            'table' => 'Szamlak',
        ),
        'invoice_details_old' => array(
            'connection' => 'azure2',
            'table' => 'Szamlatetelek',
        ),
        */

    ),
);
