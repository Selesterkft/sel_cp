@if(Session::has('success'))
    @includeIf('layouts.success', ['messages' => Session::get('success')])
@endif

@if(Session::has('error'))
    @includeIf('layouts.alert', ['messages' => Session::get('alert')])
@endif
