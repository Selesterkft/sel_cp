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

    'invoices2' => [
        'fields' => [
            'Inv_ID' => 'Egyedi azonosító',
            'SELEXPED_INV_ID' => 'SELEXPED_INV_ID',
            'Inv_Num' => 'Számla szám',
            'Inv_SeqNum' => 'Iktatószám',
            'ACCT_Period' => 'Periódus',
            'INV_Type_ID' => 'TipusID',
            'INV_Type' => 'Típus',
            'Ref_Inv' => 'Referencia számla',
            'Cancellation_ReasonCode' => 'Számla javítás oka',

            //'Partner_Country_ZIP_City' => 'Partner teljes cím',
            'Partner_Bank_Account' => 'Partner bankszámla',
            'Type_of_Invoice' => 'Számla típus',
            'Period_From_To' => 'Periódus tól - ig',
            'InvDate' => 'Kelte',
            'DeliveryDate' => 'Teljesítve',
            'PaymentMethod_ID' => 'Fiz.Mod.ID',
            'PaymentMethod' => 'Fizetési mód',
            'DueDate' => 'Lejárat',
            'PostInDate' => 'Beérkezés dátuma',
            'Net_LC' => 'Nettó összesen',
            'Tax_LC' => 'ÁFA összesen',
            'Gross_LC' => 'Bruttó összesen',
            'PayStatus_ID' => 'Fizetési státusz ID',
            'PayStatus' => 'Fizetési státusz',
            'PaidAmount_DC' => 'Eddig kifizetve',
            'PaidAmount_FC' => 'Eddig kifizetve (EUR)',
            'PaidAmount_LC' => 'Eddig kifizetve (FIBU)',
            'Net_DC' => 'Net_DC',
            'Tax_DC' => 'Tax_DC',
            'Gross_DC' => 'Gross_DC',
            'Curr_DC' => 'Curr_DC',
            'Net_FC' => 'Net_FC',
            'Tax_FC' => 'Tax_FC',
            'Gross_FC' => 'Gross_FC',
            'Remarks' => 'Megjegyzések',
            'Attachments' => 'Mellékletek',
            'Added_User' => 'Felhasználó',
        ]
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
        ],
        'fields' => [
            'inv_num' => 'Szla szám',
            'seq_num' => 'Iktatószám',
            'period' => 'Periódus',
            'period_to_from' => 'Periódus tól-ig',
            'period_from' => 'Tól',
            'period_to' => 'Ig',
            'cancellation_reason_code' => 'Javítás oka',
            'type_of_document' => 'Bizonylat típusa',
            'num_ref_doc' => 'Hivatkozott bizonylat száma',
            'account_repair_reason' => 'Számla javítás oka',
            'account_partner_name' => 'Számlapartner neve',
            'partner_address' => 'Partner címe',
            'vendor_address' => 'Eladó címe',
            'cust_bank_code' => 'Vevő Pénzforg.jelző',
            'bank_code' => 'Bankszámla szám',
            'class_id' => 'Számla fajta',
            'date' => 'Kelte',
            'completed' => 'Teljesítve',
            'payment' => 'Fizetési mód',
            'pay_status' => 'Fizetési állapot',
            'expiry' => 'Lejárat',
            'date_of_arrival' => 'Beérkezés dátuma',
            'net_total' => 'Nettó összesen',
            'tax_total' => 'ÁFA összesen',
            'brut_total' => 'Bruttó összesen',
            'fully_paid_date' => 'Teljesítés dátuma',
            'paid_so_far' => 'Eddig fizetve',
            'paid_so_far_eur' => 'Eddig fizetve EUR',
            'paid_so_far_fibu' => 'Eddig fizetve könyvelési devizában',
            'remarks' => 'Megjegyzés',
            'attachments' => 'Csatolmányok',
            'added_user_name' => 'Rögzítette',

            'Partner_Name' => 'Partner név',
            'Partner_Addr' => 'Partner cím',
            'partner_addr_district' => 'Kerület',
            'partner_addr_ps_type' => 'Típus',
            'partner_addr_housenr' => 'Házszám',
            'partner_addr_building' => 'Épület',
            'partner_addr_stairway' => 'Lépcsőház',
            'partner_addr_floor' => 'Emelet',
            'partner_addr_door' => 'Ajtó',
            'partner_country' => 'Ország',
            'partner_zip' => 'Irszám',
            'partner_city' => 'Város',

            'net_dc' => 'Nettó össz.(DC)',
            'tax_dc' => 'AFA össz.(DC)',
            'gross_dc' => 'Brutto össz.(DC)',

            'net_lc' => 'Nettó össz.(LC)',
            'tax_lc' => 'AFA össz.(LC)',
            'gross_lc' => 'Brutto össz.(LC)',

            'paid_amount_lc' => 'Kintlevőség (LC)',
            'paid_amount_dc' => 'Kintlevőség (DC)',
            'paid_amount_fc' => 'Kintlevőség (FC)',

            'curr_lc' => 'Deviza LC',
            'curr_dc' => 'Deviza DC',
            'curr_fc' => 'Deviza FC',
            'curr_fc2' => 'Deviza FC2',

            'net_fc' => 'Nettó (FC)',
            'tax_fc' => 'ÁFA (FC)',
            'gross_fc' => 'Bruttó (FC)',

            'net_eur' => 'Net EUR',
            'gross_eur' => 'Gross EUR',
            'bemerkung' => 'Megjegyzés',
            'attachment' => 'Melléklet',
            'iktatta' => 'Iktatta',
            'subcontracted_services' => 'Közvetített szolgáltatás',
            'payment_due' => 'Fizetési határidő',
            'payment_method' => 'Fizetési mód',
            'postin_date' => 'Beérkezés dátuma',

            'cancel_inv_id' => 'Stornó sz.',
            'ref_inv_id' => 'Ref.Inv.ID',
            'cancel_date' => 'Stornó dátum',
            'vendor_name' => 'Eladó név',

            'cust_name' => 'Vevő név',
            'period_from' => 'TÓL',
            'period_to' => 'IG',
            'inv_date' => 'Kelte',
            'delivery_date' => 'Teljesítve',

            'due_date' => 'Lejárat',
        ],
    ],

    'invoice' => [
        'title' => 'Számla',
        'sub_title' => 'Megtekintés',
        'inv_id' => 'Számla sorszám',
        'inv_seq_num' => 'Iktatószám',
        'order_id' => 'Megrendelésszám',
        'payment_due' => 'Fizetési határidő',
        'payment_method' => 'Fizetési mód',
        'account_number' => 'Számla szám',
        'fields' => [
            'descr' => 'Leírás',
            'pcs' => 'Mennyiség',
            'product' => 'Termék',
            'unit' => 'Egység',
            'unit_price_lc' => 'Egységár LC',
            'unit_price_dc' => 'Egységár DC',
            'unit_price_fc' => 'Egységár FC',
            'unit_price_fc2' => 'Egységár FC2',
            'net_lc' => 'Nettó LC',
            'net_dc' => 'Nettó DC',
            'net_fc' => 'Nettó FC',
            'net_fc2' => 'Nettó FC2',
            'tax_rate' => 'ÁFA',
            'tax_lc' => 'ÁFA LC',
            'tax_dc' => 'ÁFA DC',
            'tax_fc2' => 'ÁFA FC2',
            'gross_lc' => 'Bruttó LC',
            'gross_dc' => 'ÁFA DC',
            'gross_fc' => 'ÁFA FC',
            'gross_fc2' => 'ÁFA FC2',
            'curr_lc' => 'Deviza LC',
            'curr_dc' => 'Deviza DC',
            'curr_fc' => 'Deviza FC',
            'curr_fc2' => 'Deviza FC2',
            'postin_date' => 'Beérkezés dátuma',

            'paid_so_far' => 'Eddig kifizetve',

            //'qty' => 'Mennyiség',
            //'qty_unit' => 'Egység',
            'unit_price' => 'Egységár',
            'vat' => 'ÁFA',
            'vat_value' => 'ÁFA érték',
            'net' => 'Nettó',
            'gross' => 'Bruttó',
        ],
    ],

    'invoices_widget' => [
        'title' => 'Egyenleg',
        'currency' => 'Deviza',
        'type' => 'Típus',
        'debts' => 'Tartozások',
        'overdue_debts' => 'Lejárt tartozások',
        'open_invoices' => 'Nyitott számlák',
        'paid_so_far' => 'Eddig kifizetve',
        'net_total' => 'Nettó össz.',
        'brut_total' => 'Bruttó össz.',
        'vat_total' => 'ÁFA össz.',
        'debit' => 'Tartozás',
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

    'account_type' => [
        201 => 'Kimenő',
        202 => 'Bejövő',
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
    'app_data' => 'adat',
    'app_are_you_sure' => 'Biztos vagy ebben?',
    'app_back_to_list' => 'Vissza a listához',
    'app_dashboard' => 'Irányítópult',
    'app_delete' => 'Törlés',
    'app_cancel' => 'Mégsem',
    'app_apply' => 'Alkalmaz',
    'app_from' => 'Eladó',
    'app_to' => 'Vevő',
    'app_partner' => 'Partner',
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
    'app_currency' => 'Deviza',
    'app_quantity' => 'Mennyiség',
    'app_amount' => 'Darab',
    'app_pay_status' => 'Fizetési állapot',
    'app_curr_id' => 'Valuta',
    'app_tax_fc' => 'ÁFA FC',

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
