{{-- Felhasználónév --}}
@includeIf('layouts.fields.input_textbox', [
    'title' => trans('app.name'),
    'textbox_id' => 's_name',
    'textbox_value' => request()->get('s_name')
])

{{-- Email --}}
@includeIf('layouts.fields.input_textbox', [
    'title' => trans('app.email'),
    'textbox_id' => 's_email',
    'textbox_value' => request()->get('s_email')
])

{{-- Nyelv --}}
@includeIf('layouts.fields.input_select', [
    'select_id' => 's_language',
    'title' => trans('app.language'),
    'get_option_all' => trans('app.select_first_element'),
    'elements' => \App\Classes\Helper::getAvailableLanguages(),
    'selected_value' => request()->get('s_language'),
])
