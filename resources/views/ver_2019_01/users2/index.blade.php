@extends(session()->get('design') . '.layouts.app')

@section('title', trans('users.title'))

@section('content-header')
    <section class="content-header">
        <h1>
            {{ trans('users.title') }}
            <small>{{ trans('users.sub_title') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    {{ trans('app.dashboard') }}
                </a>
            </li>

            <li class="active">
                <i class="fa fa-users"></i>&nbsp;{{ trans('users.title') }}
            </li>

        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">

            <div class="col-sm-12">
                @if( session()->has('success') )
                    @includeIf('layouts.success', ['messages' => session()->get('success') ])
                @elseif( session()->has('errors') )
                    @includeIf('layouts.alert', ['messages' => session()->get('errors')] )
                @endif
            </div>

            <div class="box box-default">
                <div class="box-header">
                    <div class="box-tools pull-right">
                        <a class="btn btn-success btn-xs"
                           style="margin-top: 5px;"
                           href="{{ url('users.create') }}">&nbsp;
                            {{ trans('app.add_new') }}
                        </a>
                    </div>
                </div>

                <div class="box-body">

                    <table id="user_table" name="user_table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="table_body" name="table_body">
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </section>
@endsection

@section('js')

    <script>

        (function(){
/*
            var COMPAT_ENVS = [
                ['Firefox', ">= 16.0"],
                ['Google Chrome',
                    ">= 24.0 (you may need to get Google Chrome Canary), NO Blob storage support"]
            ];
            var compat = $('#compat');
            compat.empty();
            compat.append('<ul id="compat-list"></ul>');
            COMPAT_ENVS.forEach(function (val, idx, array) {
                $('#compat-list').append('<li>' + val[0] + ': ' + val[1] + '</li>');
            });
*/

            // Adatbázis neve
            const DB_NAME = 'cp_database';
            // Adatbázis verzió
            const DB_VERSION = 1; // Use a long long for this value (don't use a float)
            // Tároló (tábla) neve
            const DB_STORE_NAME = 'users';

            const table_body = $('#table_body');

            // Adatbázis változó
            var db;

            /***
             *
             */
            function openDb(){

                console.log("openDb ...");

                // Adatbázis megnyitása
                var req = indexedDB.open(DB_NAME, DB_VERSION);

                // Sikeres művelet esetén ...
                req.onsuccess = function (event) {
                    // Equal to: db = req.result;
                    db = this.result;
                    console.log("openDb DONE");
                };

                // Hiba esetén ...
                req.onerror = function (event) {
                    console.error("openDb:", event.target.errorCode);
                };

                // Adatbázis létrehozása, ha még nincs.
                req.onupgradeneeded = function (event) {

                    console.log("openDb.onupgradeneeded");

                    // Adatbázis létrehozása és az elsődleges kulcs megadása
                    var store = event.currentTarget.result.createObjectStore(
                        DB_STORE_NAME, { keyPath: 'ID', autoIncrement: true });

                    // Indexek létrehozása
                    store.createIndex('Emai', 'Email', { unique: true });
                    store.createIndex('Name', 'Name', { unique: false });
                };
            }

            /**
             * @param {string} store_name   Tároló neve
             * @param {string} mode         Megnyitás módja. Lehet "readonly" vagy "readwrite"
             */
            function getObjectStore(store_name, mode) {
                var tx = db.transaction(store_name, mode);
                return tx.objectStore(store_name);
            }

            /**
             * Tároló törlése
             */
            function clearObjectStore() {

                // Tároló lekérése
                var store = getObjectStore(DB_STORE_NAME, 'readwrite');

                // Tároló törlése
                var req = store.clear();

                // Sikeres törlés esetén ...
                req.onsuccess = function (event) {
                    displayActionSuccess("Store cleared");
                    displayPubList(store);
                };

                // Hiva esetén ...
                req.onerror = function (event) {
                    console.error("clearObjectStore:", event.target.errorCode);
                    displayActionFailure(this.error);
                };
            }

            /**
             *
             * @param {IDBObjectStore=} store   Tároló
             */
            function displayUsers(store){

                console.log("displayUsers");

                if( typeof store == 'undefined'){

                    // Tároló megnyitása olvasásra
                    store = getObjectStore(DB_STORE_NAME, 'readonly');
                }

                // Rekord számláló
                var req;
                var rowCount = 0;

                // Rekordok számának lekérése
                req = store.count();

                // Siker esetén ...
                req.onsuccess = function (event) {
                    rowCount = event.target.result;
                };

                // Hiba esetén ...
                req.onerror = function (event) {}

                // Kurzor megnyitása
                req = store.openCursor();

                // Sikeres megnyitás esetén ...
                req.onsuccess = function (event) {

                    var cursor = event.target.result;

                    // Ha a kurzor valamire mutat, kérdezze meg az adatokat
                    if (cursor) {

                        console.log("displayPubList cursor:", cursor);

                        // Aktuális rekord lekérése a tárolótból
                        req = store.get(cursor.key);

                        // Sikeres lekérés esetén ...
                        req.onsuccess = function (event) {

                            // Aktuális rekord
                            var value = event.target.result;

                            // Lista elem
                            var table_item = $('<tr>' +
                                '<td>' + value.ID + '</td>' +
                                '<td>' + value.Name + '</td>' +
                                '<td>' + value.Email + '</td>' +
                                '</tr>');
                            table_body.append(table_item);
                        };

                        cursor.continue();
                    }else{
                        console.log("Nincs több bejegyzés.");
                    }
                };

            }

            openDb();

            var store = getObjectStore(DB_STORE_NAME, 'readwrite');
            displayUsers(store);

        })();

    </script>

@endsection
