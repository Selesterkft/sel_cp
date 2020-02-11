<?php

return [
    'dashboard' => [
        'title' => 'Dashboard',
        'sub-title' => 'Control panel',
    ],
    'login' => [
        'title' => 'Sign in to start your session',
        'button' => 'Login',
        'fields' => [
            'email' => 'Email',
            'password' => 'Password',
        ],
        'messages' => [
            'error_user_not_found' => 'User not found',
        ],
    ],
    'register' => [
        'title' => 'Register',
        'fields' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirm' => 'Confirm',
        ],
    ],
    'lock' => [
        'title' => 'Lock',
    ],
    'roles' => [
        'title' => 'Roles',
        'created_at' => 'Time',
        'fields' => [
            'name' => 'Name',
            'permission' => 'Permissions',
        ],
    ],
    'role' => [
        'title' => 'Role',
        'sub_titles' => [
            'create' => 'New Role',
            'update' => 'Edit Role'
        ],
        'role_names' => [
            'Admin' => 'Admin',
            'users-menu' => 'Users menu',
            'invoices-menu' => 'Invoices menu',
            'stocks-menu' => 'Stocks menu',
            'transports-menu' => 'Transports menu',
            'settings-menu' => 'Settings menu',
        ],
        'fields' => [
            'name' => 'Name',
            'permissions' => 'Permissions',
        ],
    ],

    'invoices2' => [
        'fields' => [
            'Inv_ID' => 'Unique Identifier',
            'SELEXPED_INV_ID' => 'SELEXPED_INV_ID',
            'Inv_Num' => 'Invoice Number',
            'Inv_SeqNum' => 'Registry Number',
            'ACCT_Period' => 'Period',
            'INV_Type_ID' => 'Invoice Type ID',
            'INV_Type' => 'Type',
            'Ref_Inv' => 'Ref. Invoice',
            'Cancellation_ReasonCode' => 'Cancellation Reason Code',
            'Partner_Name' => 'Partner Name',
            'Partner_Address' => 'Partner Address',
            'Partner_Country_ZIP_City' => 'Partner Country ZIP City',
            'Partner_Bank_Account' => 'Partner Bank Account',
            'Type_of_Invoice' => 'Type of Invoice',
            'Period_From_To' => 'Period From-To',
            'InvDate' => 'Invoice Date',
            'DeliveryDate' => 'DElivery Date',
            'PaymentMethod_ID' => 'Payment Method ID',
            'PaymentMethod' => 'Payment Method',
            'DueDate' => 'Due Date',
            'PostInDate' => 'Beérkezés dátuma',
            'Net_LC' => 'Net Totla',
            'Tax_LC' => 'Tax Total',
            'Gross_LC' => 'Gross Total',
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
            'Remarks' => 'Remarks',
            'Attachments' => 'Attachments',
            'Added_User' => 'Felhasználó',
        ]
    ],

    'invoices' => [
        'title' => 'Invoices',
        'sub_title' => 'Account data',
        'created_at' => 'Time',
        'search' => [
            'vendor' => 'Vendor',
            'customer' => 'Customer',
            'type' => 'Type',
            'types' => [
                'all' => 'all accounts',
                'incoming' => 'inbound account',
                'outgoing' => 'outbound account',
            ],
        ],
        'fields' => [
            'inv_num' => 'Inv num',
            'reg_num' => 'Registration Number',
            'period' => 'Period',
            'type_of_document' => 'Type of Document',
            'num_ref_doc' => 'Number of Referenced Document',
            'account_repair_reason' => 'Account Repair Reason',
            'account_partner_name' => 'Account Partner Name',
            'cust_address' => 'Customer Address',
            'vendor_address' => 'Vendor Address',
            'cust_bank_code' => 'Customer Bank Code',
            'bank_code' => 'Bank Code',
            'class_id' => 'Account Kind',
            'date' => 'Date',
            'completed' => 'Completed',
            'payment' => 'Payment',
            'expiry' => 'Expiry',
            'date_of_arrival' => 'date of Arrival',
            'net_total' => 'Net Total',
            'tax_total' => 'Tax Total',
            'brut_total' => 'Brut total',
            'pay_status' => 'Pay Status',
            'fully_paid_date' => 'Fully Paid Date',
            'paid_so_far' => 'Paid so Far',
            'paid_so_far_eur' => 'Paid so Far EUR',
            'paid_so_far_fibu' => 'Paid so Far FIBU',
            'net_dc' => 'Net DC',
            'tax_dc' => 'Tax DC',
            'gross_dc' => 'Gross DC',
            'curr_id' => 'Deviza ID',
            'net_eur' => 'Net EUR',
            'tax_fc' => 'Tax FC',
            'gross_eur' => 'Gross EUR',
            'bemerkung' => 'Comment',
            'attachment' => 'Attachment',
            'iktatta' => 'enacted',
            'subcontracted_services' => 'Subcontracted Service',

            'inv_seq_num' => 'Registry Number',
            'cancel_inv_id' => 'Cancel Inv.ID',
            'ref_inv_id' => 'Ref.Inv.ID',
            'cancel_date' => 'Cancel Date',
            'vendor_name' => 'Vendor name',

            'cust_name' => 'Customer name',
            'period_from' => 'FROM',
            'period_to' => 'TO',
            'inv_date' => 'Inv.Date',
            'delivery_date' => 'Delivery D.',

            'due_date' => 'Due Date',
            'net_lc' => 'Net LC',
            'tax_lc' => 'Tax LC',
            'gross_lc' => 'Gross LC',
            'pay_status' => 'Pay stat.',

            'paid_amount_dc' => 'Paid Amount DC',
            'paid_amount_fc' => 'Paid Amount EUR',
            'curr_id' => 'Currency',
            'net_fc' => 'EUR net',
            'tax_fc' => 'TAX net',

            'gross_fc' => 'EUR gross',

        ],
    ],

    'invoice' => [
        'title' => 'Invoice',
        'sub_title' => 'View',
        'inv_id' => 'Invoice ID',
        'order_id' => 'Order ID',
        'payment_due' => 'Payment Due',
        'account_number' => 'Account Number',
        'fields' => [
            'product' => 'Product',
            'qty' => 'Quantity',
            'qty_unit' => 'Quantity Unit',
            'unit_price' => 'Unit Price',
            'vat' => 'VAT',
            'vat_value' => 'VAT value',
            'net' => 'Net',
            'gross' => 'Gross',
        ],
    ],

    'invoices_widget' => [
        'title' => 'Balance',
        'currency' => 'Currency',
        'type' => 'Type',
        'debts' => 'Debts',
        'overdue_debts' => 'Overdue Debts',
        'open_invoices' => 'Open Invoices',
        'paid_so_far' => 'Paid so Far',
        'net_total' => 'Net Total',
        'brut_total' => 'Brut Total',
        'vat_total' => 'VAT Total',
        'debit' => 'Debit',
    ],

    'transports' => [
        'title' => 'Transports',
        'created_at' => 'Time',
        'fields' => [],
    ],

    'stocks' => [
        'title' => 'Stocks',
        'sub_title' => 'View stocks',
        'created_at' => 'Time',
        'fields' => [],
    ],

    'insurance' => [
        'title' => 'Insurance',
        'created_at' => 'Time',
        'fields' => [],
    ],
    'vehicles' => [
        'title' => 'Vehicles',
        'sub_title' => 'Manage my vehicles',
        'fields' => [
            'license_number' => 'License Number',
            'type' => 'Type',
            'date_of_manufacture' => 'Date of Manufacture',
        ]
    ],
    'vehicle' => [
        'title' => 'Vehicle',
        'sub_title' => 'Data of Vehicle',
        'fields' => [
            'license_number' => 'License Number',
            'type' => 'Type',
            'date_of_manufacture' => 'Date of Manufacture',
            'date_of_purchase' => 'Date of Purchase',
            'date_of_sale' => 'Date of Sale',
        ]
    ],
    'communication' => [
        'title' => 'Communication',
        'created_at' => 'Time',
        'fields' => [],
    ],
    'messages' => [
        'title' => 'Messages',
        'sub-title' => '',
        'created_at' => 'Time',
        'fields' => [],
    ],
    'tasks' => [
        'title' => 'Tasks',
    ],

    'notifications' => [
        'title' => 'Notifications',
    ],

    'system_data' => [
        'title' => 'System Data',
    ],

    'menu_points' => [
        'title' => 'Menu Points',
    ],

    'settings' => [
        'title' => 'Settings',
        'sub_title' => 'Personal Settings',

        'wallpapers_title' => 'Wallpapers',
        'wallpapers_sub_title' => '',

        'login_wallpaper' => 'Login wallpaper',

        'fields' => [
            'name' => 'Name',
            'value' => 'Value',
        ],
        'general' => [
            'title' => 'General Settings',
            'favicon' => 'FavIcon',
            'logo_image' => 'Logo',
            'profile_image' => 'Profile Image',
            'menu_bg_color' => 'Menu Background Color',
            'header_bg_color' => 'Header Background Color',
            'panel_tab_line_color' => 'Panel and Tab line color',
        ],
        'login_page' => [
            'title' => 'Login Page',
            'wallpaper' => 'Wallpaper',
            'background_color' => 'Background Color',
        ],
        'users_page' => [
            'title' => 'Users Page'
        ],
        'invoices_page' => [
            'title' => 'Invoices Page',
        ],
    ],
/*
	'user-management' => [
		'title' => 'User Management',
		'created_at' => 'Time',
		'fields' => [
		],
	],
	*/
	'permissions' => [
		'title' => 'Permissions',
        'sub-title' => '',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
		],
	],

    'versions' => [
        'title' => 'Versions',
        'sub_title' => 'Version Handling',
        'fields' => [
            'company' => 'Comapny',
            'version' => 'Version',
            'active' => 'Active',
        ]
    ],

    'version' => [
        'title' => 'Version',
        'sub_title' => 'version hendling',
        'create_title' => 'Add new version',
        'create_subtitle' => '',
        'edit_title' => 'Edit Version',
        'edit_subtitle' => '',
        'fields' => [
            'version' => 'Version',
            'active' => 'Active'
        ],
        'connection' => 'connection',
    ],

    'company_version' => [
        'title' => 'Company Versions',
        'sub_title' => '',
        'create_title' => 'New Connection',
        'create_subtitle' => '',
        'edit_title' => 'Edit Connection',
        'edit_subtitle' => '',
    ],

    'company_subdomain' => [
        'menu_title' => 'Subdomains of Companies',
        'tab_title' => 'Subdomains',
        'title' => 'Company aldomains',
        'sub_title' => '',
        'fields' => [
            'company' => 'Company',
            'company_nickname' => 'Short name',
            'subdomain' => 'Subdomain Name',
        ],
    ],

    'users' => [
        'title' => 'Users',
        'sub_title' => 'management',
        'created_at' => 'Time',
        'fields' => [
                'name' => 'Name',
                'email' => 'Email',
        'email_verify' => 'Email Verify',
                'password' => 'Password',
                'roles' => 'Roles',
                'remember-token' => 'Remember token',
        ],
        'messages' => [
            'success_create' => 'User successfully created.',
            'success_update' => 'I have successfully updated the user information.',
            'success_delete' => 'User successfully deleted.',
            'success_restore' => 'User successfully restored.',
            'error_create' => 'The record could not be saved',
            'error_update' => 'The record could not be updated.',
            'error_delete' => 'The record could not be deleted',
            'error_restore' => 'The record could not be restored',
        ],
	],

    'user' => [
        'title' => 'User',
        'sub_titles' => [
            'create' => 'New User',
            'update' => 'Edit User'
        ],
        'change_password_title' => 'Change Password',
        'created_at' => 'Time',
        'fields' => [
            'name' => 'Name',
            'email' => 'Email',
            'email_verify' => 'Verify Email',
            'company' => 'Company',
            'password' => 'Password',
            'password_confirm' => 'Confirm Password',
            'language' => 'Language',
            'roles' => 'Roles',
            'remember-token' => 'Remember token',
        ],
    ],
    'profile' => [
        'title' => 'Profile',
        'sub_title' => 'User Details',
    ],
    'filter' => [
        'title' => 'Filter',
        'all' => 'All',
        'cash' => 'Cash',
        'transfer' => 'Transfer',
    ],

    'menu' => [
        'change_password' => 'Change password'
    ],

    'app_messages' => [
        'create_successfully' => ':name created sucesfully',
        'update_successfully' => ':name updated successfully',
        'delete_successfully' => ':name deleted successfully',
        'restore_successfully' => ':name restore successfully',
        'create_error' => 'The record could not be saved',
        'update_error' => 'The record could not be updated.',
        'delete_error' => 'The :name could not be deleted',
        'restore_error' => 'The record could not be restored',

        'login_company_error' => 'Not the right company',
    ],

    'app_fields' => [
        'id' => '#',
        'operations' => 'Operations',
    ],

    'export_types' => [
        'export_all' => 'Export All',
        'export_selected' => 'Export Selected',
    ],

    'languages' => [
        'hu' => 'Hungarian',
        'en' => 'English',
    ],

    'sd_helper' => [
        'title' => 'Subdomain Helper',
        'fields' => [
            'sd' => 'Subdomain',
            'url' => 'url',
        ],
    ],

    'todos' => [
        'nothing_todo' => 'There is nothing to do',
    ],

    'account_type' => [
        201 => 'Outgoing',
        202 => 'Incoming',
    ],

    'app_name' => 'Name',
    'app_main_navigation' => 'Main Navigation',
    'app_id' => '#',
    'app_create' => 'Create',
    'app_save' => 'Save',
    'app_restore' => 'Restore',
    'app_edit' => 'Edit',
    'app_view' => 'View',
    'app_update' => 'Update',
    'app_list' => 'List',
    'app_search' => 'Search',
    'app_search_title' => 'Search accounts',
    'app_delete_search' => 'Delete Search',
    'app_relation' => 'Relation',
    'app_send_email' => 'Send Message',
    'app_no_entries_in_table' => 'No entries in table',
    'custom_controller_index' => 'Custom controller index.',
    'app_logout' => 'Logout',
    'app_add_new' => 'Add new',
    'app_date' => 'Date',
    'app_are_you_sure' => 'Are you sure?',
    'app_back_to_list' => 'Back to list',
    'app_dashboard' => 'Dashboard',
    'app_delete' => 'Delete',
    'app_cancel' => 'Cancel',
    'app_apply' => 'Apply',
    'app_from' => 'From',
    'app_to' => 'To',
    'app_phone' => 'Phone',
    'app_email' => 'Email',
    'app_more_info' => 'More Info',
    'app_open' => 'Open',
    'app_select_first_element' => '--- Select ---',
    'app_hello' => 'Hello',
    'app_version' => 'Version',
    'app_copyright_1' => 'Copyright 2019',
    'app_copyright_2' => ' All rights reserved.',
    'app_success' => 'Success!',
    'app_error' => 'Error!',
    'app_alert' => 'Alert!',
    'app_currency' => 'Currency',
    'app_quantity' => 'Quantity',
    'app_amount' => 'Pieces',

    'app_activity' => [
        'active' => 'Aktive',
        'inactive' => 'Inactive',
    ],

    'app_page_render_time' => 'This page took :time seconds to render',

    'app_page_render_ime_01' => 'This page took',
    'app_page_render_ime_02' => 'seconds to render',


    'global_title' => 'Customer Portal',
    'global_sort_title' => 'CP',

    'global_member_since' => 'Member since',
];
