<div id="toolbar">
    <div class="btn-group">

        <!-- KERESÉS -->
        @includeIf('layouts.buttons.search_modal_open')
        <!-- /.KERESÉS -->

        <!-- KERESÉS TÖRLÉSE -->
        @includeIf('layouts.buttons.search_clear', ['url' => $url])
        <!-- /.KERESÉS TÖRLÉSE -->

    </div>
</div>
