@php
use Waavi\Translation\Models\Language;
use Waavi\Translation\Repositories\LanguageRepository;

if( session()->has('locale') )
{
    $locale = session()->get('locale');
}
else
{
    $locale = config('app.locale');
}

$langRepo =  new LanguageRepository(new Language(), app());
$languages = $langRepo->availableLocales();

@endphp

<div class="navbar-custom-menu" style="padding-top: 6px;padding-right: 15px;">

    <select class="form-control" id="select-lang" name="select-lang">
        @foreach($languages as $language)
            <option value="{{ $language }}" {{ ($locale == $language) ? 'selected' : '' }} >{{ trans('app.' . $language) }}</option>
        @endforeach
    </select>

</div>
<script>
    $('#select-lang').on('change', function()
    {
        var selectedCountry = $(this).children("option:selected").val();

        if( selectedCountry == 'hu' )
        {
            url = '{{ url('lang/hu') }}';
        }
        else if( selectedCountry == 'en' )
        {
            url = '{{ url('lang/en') }}';
        }

        window.location.href = url;

    });
</script>
