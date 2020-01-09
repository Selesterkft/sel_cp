<?php

return [
    'dashboard' => [
        'title' => 'Műszerfal',
        'sub-title' => 'Gyors betekintés',
    ],
    'login' => [
        'title' => 'Jelentkezzen be a munkamenet megkezdéséhez',
        'button' => 'Belépés',
        'fields' => [
            'email' => 'Email',
            'password' => 'Jelszó',
        ],
        'messages' => [
            'error_user_not_found' => 'Nem találom a felhasználót',
        ],
    ],
    'register' => [
        'title' => 'Regisztráció',
        'fields' => [
            'name' => 'Név',
            'email' => 'Email',
            'password' => 'Jelszó',
            'password_confirm' => 'Megerősítés',
        ],
    ],
    'lock' => [
        'title' => 'Zárolás',
    ],
    'roles' => [
        'title' => 'Szerepkörök',
        'created_at' => 'Time',
        'fields' => [
            'name' => 'Név',
            'permission' => 'Permissions',
        ],
    ],
    'role' => [
        'title' => 'Szerepkör',
        'sub_titles' => [
            'create' => 'létrehozása',
            'update' => 'szerkesztése'
        ],
        'role_names' => [
            'Admin' => 'Admin',
            'users-menu' => 'Felhasználók menü',
            'invoices-menu' => 'Számlák menü',
            'stocks-menu' => 'Készletek menü',
            'transports-menu' => 'Szállítások menü',
            'settings-menu' => 'Beállítások menü',
        ],
        'fields' => [
            'name' => 'Név',
            'permissions' => 'Szerepkörök',
        ],
    ],

    'company_version' => [
        'title' => 'Cég verziói',
        'sub_title' => '',
        'create_title' => 'Új verzió',
        'create_subtitle' => '',
        'edit_title' => 'Kapcsolat szerkesztése',
        'edit_subtitle' => '',
    ],

    'company_subdomain' => [
        'menu_title' => 'Cégek altartományai',
        'tab_title' => 'Altartományok',
        'title' => 'Cég altartomány neve',
        'sub_title' => '',
        'fields' => [
            'company' => 'Cég',
            'company_nickname' => 'Rövid név',
            'subdomain' => 'Altartomány név',
        ],
    ],

    'invoices' => [
        'title' => 'Számláim',
        'sub_title' => 'Számlaadatok',
        'created_at' => 'Time',
        'search' => [
            'vendor' => 'Szállító',
            'customer' => 'Vevő',
            'type' => 'Típus',
            'types' => [
                'all' => 'Összes bizonylat',
                'incoming' => 'Bejövő bizonylat',
                'outgoing' => 'Kimenő bizonylat',
            ],
            '' => '',
            '' => '',
        ],
        'fields' => [
            'inv_num' => 'Szla szám',
            'cancel_inv_id' => 'Stornó sz.',
            'ref_inv_id' => 'Ref.Inv.ID',
            'cancel_date' => 'Stornó dátum',
            'vendor_name' => 'Szállító név',

            'cust_name' => 'Vevő név',
            'period_from' => 'TÓL',
            'period_to' => 'IG',
            'inv_date' => 'Kelte',
            'delivery_date' => 'Teljesítve',

            'due_date' => 'Lejárat',
            'netto_lc' => 'Netto össz.',
            'tax_lc' => 'AFA össz.',
            'brutto_lc' => 'Brutto össz.',
            'pay_status' => 'Fiz.állapot',

            'paid_amount_dc' => 'Tartozás kint',
            'paid_amount_fc' => 'Tartozás kint EUR',
            'curr_id' => 'Valuta',
            'netto_fc' => 'EUR netto',
            'tax_fc' => 'AFA netto',

            'brutto_fc' => 'EUR brutto',
        ],
    ],

    'invoice' => [
        'title' => 'Számla',
        'sub_title' => 'Megtekintés',
        'inv_id' => 'Számla sorszám',
        'order_id' => 'Megrendelésszám',
        'payment_due' => 'Fizetési határidő',
        'account_number' => 'Számlaszám',
        'fields' => [
            'product' => 'Termék',
            'qty' => 'Mennyiség',
            'qty_unit' => 'Egység',
            'unit_price' => 'Egységár',
            'vat' => 'ÁFA',
            'vat_value' => 'ÁFA érték',
            'net' => 'Nettó',
            'gross' => 'Gross',
        ],
    ],

    'invoices_widget' => [
        'currency' => 'Valuta',
        'type' => 'Típus',
        'debts' => 'Tartozások',
        'overdue_debts' => 'Lejárt tartozások',
        'open_invoices' => 'Nyitott számlák',
    ],

    'transports' => [
        'title' => 'Fuvarjaim',
        'created_at' => 'Time',
        'fields' => [],
    ],

    'stocks' => [
        'title' => 'Készletek',
        'sub_title' => 'Készletek megjelenítése',
        'created_at' => 'Time',
        'fields' => [],
    ],

    'insurance' => [
        'title' => 'Biztosítások',
        'created_at' => 'Time',
        'fields' => [],
    ],

    'vehicles' => [
        'title' => 'Járművek',
        'sub_title' => 'Járművek kezelése',
        'fields' => [
            'license_number' => 'Rendszám',
            'type' => 'Típus',
            'date_of_manufacture' => 'Gyártási dátum',
        ]
    ],

    'vehicle' => [
        'title' => 'Jármű',
        'sub_title' => 'Jármű adatai',
        'fields' => [
            'license_number' => 'Rendszám',
            'type' => 'Típus',
            'date_of_manufacture' => 'Gyártás dátum',
            'date_of_purchase' => 'Beszerzés dátuma',
            'date_of_sale' => 'Eladás dátuma',
        ]
    ],

    'communication' => [
        'title' => 'Kommunikáció',
        'created_at' => 'Time',
        'fields' => [],
    ],

    'messages' => [
        'title' => 'Üzenetek',
        'created_at' => 'Time',
        'fields' => [],
    ],

    'tasks' => [
        'title' => 'Feladatok',
    ],

    'notifications' => [
        'title' => 'Értesítések',
    ],

    'system_data' => [
        'title' => 'Rendszer adatok',
    ],

    'menu_points' => [
        'title' => 'Menüpontok',
    ],

    'settings' => [
        'title' => 'Beállítások',
        'sub_title' => 'Egyedi beállítások',

        'wallpapers_title' => 'Háttárképek',
        'wallpapers_sub_title' => '',

        'login_wallpaper' => 'Login háttérkép',

        'fields' => [
            'name' => 'Név',
            'value' => 'Érték',
        ],
        'general' => [
            'title' => 'Általános beállítások',
            'favicon' => 'FavIcon',
            'logo_image' => 'Logó',
            'profile_image' => 'Profilkép',
            'menu_bg_color' => 'Menü háttérszín',
            'header_bg_color' => 'Fejléc háttérszín',
            'panel_tab_line_color' => 'Panel és fül vonal színe',
        ],
        'login_page' => [
            'title' => 'Bejelentkező oldal',
            'wallpaper' => 'Háttérkép',
            'background_color' => 'Háttérszín',
        ],
        'dashboard_page' => [
            'title' => 'Irányítópult oldal',
        ],
        'users_page' => [
            'title' => 'Felhasználók oldal'
        ],
        'invoices_page' => [
            'title' => 'Számlák oldal',
        ],
    ],

    'permissions' => [
        'title' => 'Jogosultságok',
        'created_at' => 'Time',
        'fields' => [
            'name' => 'Név',
        ],
    ],

    'versions' => [
        'title' => 'Verziók',
        'sub_title' => 'Verzió kezelés',
        'fields' => [
            'company' => 'Cég',
            'version' => 'Verzió',
            'active' => 'Aktív',
        ]
    ],

    'version' => [
        'title' => 'Verzió',
        'sub_title' => '',
        'create_title' => 'Új verzió',
        'create_subtitle' => '',
        'edit_title' => 'Verzió szerkesztése',
        'edit_subtitle' => '',
        'fields' => [
            'version' => 'Verzió',
            'active' => 'Aktív'
        ],
        'connection' => 'kapcsolat',
    ],

    'users' => [
        'title' => 'Felhasználók',
        'sub_title' => 'kezelése',
        'created_at' => 'Time',
        'fields' => [
            'name' => 'Név',
            'email' => 'E-mail',
            'email_verify' => 'E-mail ellenőrzés',
            'password' => 'Jelszó',
            'roles' => 'Szerepek',
            'remember-token' => 'Remember token',
        ],
        'messages' => [
            'success_create' => 'A felhasználót sikeresen létrehoztam.',
            'success_update' => 'A felhasználó adatait sikeresen frissítettem.',
            'success_delete' => 'A felhasználót sikeresen töröltem.',
            'success_restore' => 'A felhasználót sikeresen visszaállítottam.',
            'errors_create' => 'A rekord mentése nem sikerült',
            'errors_update' => 'A rekord frissítése nem sikerült.',
            'errors_delete' => 'A rekord törlése nem sikerült',
            'errors_restore' => 'A rekord visszaállítása nem sikerült',
        ],
    ],

    'user' => [
        'title' => 'Felhasználó',
        'sub_titles' => [
            'create' => 'Új felhasználó',
            'update' => 'Felhasználó szerkesztése',
            'show' => 'Felhasználó adatai',
        ],
        'change_password_title' => 'Jelszó módosítása',
        'created_at' => 'Time',
        'fields' => [
            'name' => 'Név',
            'email' => 'E-mail',
            'email_verify' => 'Email ellenőrzés',
            'company' => 'Cég',
            'password' => 'Jelszó',
            'password_confirm' => 'Jelszó megerősítés',
            'language' => 'Nyelv',
            'roles' => 'Szerepek',
            'remember-token' => 'Remember token',
        ],
    ],
    'profile' => [
        'title' => 'Profil',
        'sub_title' => 'Felhasználói adatok',
    ],
    'filter' => [
        'title' => 'Szűrő',
        'all' => 'Összes',
        'cash' => 'Készpénz',
        'transfer' => 'Átutalás',
    ],

    'menu' => [
        'change_password' => 'Jelszó megváltoztatása'
    ],

    'app_messages' => [
        'create_successfully' => ' A(z) :name sikeresen létrejött.',
        'update_successfully' => 'A(z) :name sikeresen frissítve.',
        'delete_successfully' => 'A(z) :name sikeresen törölve.',
        'restore_successfully' => 'A(z) :name sikeresen visszaállítva.',

        'create_error' => 'A(z) :name mentése nem sikerült',
        'update_error' => 'A(z) :name frissítése nem sikerült.',
        'delete_error' => 'A(z) :name törlése nem sikerült',
        'restore_error' => 'A(z) :name visszaállítása nem sikerült',

        'login_company_error' => 'Nem megfelelő cég',
    ],

    'app_fields' => [
        'id' => '#',
        'operations' => 'Műveletek',
    ],

    'export_types' => [
        'export_all' => 'Összes exportálása',
        'export_selected' => 'Kijelöltek exportálása',
    ],

    'languages' => [
        'hu' => 'Magyar',
        'en' => 'Angol',
    ],

    'sd_helper' => [
        'title' => 'Aldomain névmutató',
        'fields' => [
            'sd' => 'Subdomain',
            'url' => 'url',
        ],
    ],

    'todos' => [
        'nothing_todo' => 'Nincsenek teendők',
    ],

    'app_name' => 'Név',
    'app_main_navigation' => 'Fő menü',
    'app_id' => '#',
    'app_create' => 'Létrehozás',
    'app_save' => 'Mentés',
    'app_restore' => 'Visszaállít',
    'app_edit' => 'Szerkesztés',
    'app_view' => 'Nézet',
    'app_update' => 'Frissítés',
    'app_list' => 'Lista',
    'app_search' => 'Keresés',
    'app_delete_search' => 'Keresés törlése',
    'app_search_title' => 'Keresés a számlák között',
    'app_relation' => 'Reláció',
    'app_send_email' => 'Üzenet küldése',
    'app_no_entries_in_table' => 'Nincs bejegyzés a táblázatban',
    'custom_controller_index' => 'Custom controller index.',
    'app_logout' => 'Kijelentkezés',
    'app_add_new' => 'Új hozzáadása',
    'app_date' => 'Dátum',
    'app_are_you_sure' => 'Biztos vagy ebben?',
    'app_back_to_list' => 'Vissza a listához',
    'app_dashboard' => 'Irányítópult',
    'app_delete' => 'Törlés',
    'app_cancel' => 'Mégsem',
    'app_apply' => 'Alkalmaz',
    'app_from' => 'Eladó',
    'app_to' => 'Vevő',
    'app_phone' => 'Telefon',
    'app_email' => 'E-mail',
    'app_more_info' => 'További információ',
    'app_open' => 'Megnyit',
    'app_select_first_element' => '--- Válassz ---',
    'app_hello' => 'Helló',
    'app_version' => 'Verzió',
    'app_copyright_1' => 'Copyright 2019',
    'app_copyright_2' => ' Minden jog fenntartva.',
    'app_success' => 'Siker!',
    'app_error' => 'Hiba!',
    'app_alert' => 'Figyelmeztetés!',

    'app_activity' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'app_page_render_time' => 'Az oldal megjelenítéséhez :time másodperc kellett',

    'app_page_render_ime_01' => 'Az oldal megjelenítéséhez',
    'app_page_render_ime_02' => 'másodperc kellett',

    'global_title' => 'Ügyfélportál',
    'global_sort_title' => 'CP',

    'global_member_since' => 'Tagság kezdete: ',
];
