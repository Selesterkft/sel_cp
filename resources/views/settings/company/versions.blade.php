<style>
    .modal-active {
        display: block;
    }
</style>

<div id="app_version">

    <!-- BOX -->
    <div class="box box-default">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('versions.title') }}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-xs"
                        @click="showCreateModal=true">
                    {{ trans('app.add_new') }}
                </button>
            </div>
        </div>

        <!-- BOX BODY -->
        <div class="box-body with-border">
            <div class="table-responsive">

                <!-- TABLE -->
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-right">{{ trans('app.id') }}</th>
                        <th>{{ trans('versions.version') }}</th>
                        <th class="text-center">{{ trans('app.active') }}</th>
                        <th class="text-center col-md-1">{{ trans('app.operations') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="version in versions" :key="version.ID">
                        <td class="text-right">@{{ version.ID }}</td>
                        <td>@{{ version.Version }}</td>
                        <td class="text-center">
                            <div v-bind:class="[version.Active == 1 ? 'label label-success' : 'label label-primary']">
                                @{{ version.Active == 1 ? 'Active' : 'Inactive' }}
                            </div>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-xs"
                               @click="openModal(version)">
                                {{-- trans('app.edit') --}}
                                <i class="fa fa-pencil"></i>
                            </button>
                            {{--<button class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i>
                            </button>--}}
                        </td>
                    </tr>
                    </tbody>
                </table>

                <!-- PAGINATION -->
                <ul class="pagination">
                    <li>
                        <a href="#" @click.prevent="changePage(pagination.current_page - 1)"
                           v-bind:class="[pagination.current_page > 1 ? '': 'disabled']">&lt;</a>
                    </li>
                    <li v-for="page in pagesNumber" v-bind:class="[page == isActived ? 'current' : '']">
                        <a href="#" v-on:click.prevent="changePage(page)">@{{ page }}</a>
                    </li>
                    <li>
                        <a href="#" aria-label="Next page"
                           @click.prevent="changePage(pagination.current_page + 1)"
                           v-bind:class="[pagination.current_page < pagination.last_page ? '': 'disabled']">&gt;</a>
                    </li>
                </ul>

            </div>
        </div>

        <div class="box-footer with-border"></div>

    </div>

    <!-- CREATE MODAL -->
    <create_modal id="create_modal" class="modal fade in modal-active"
                  v-if="showCreateModal" @close="closeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" @click="closeModal" class="close">
                        <span>&times;</span>
                    </button>
                    <h4 class="modal-title">
                        {{ trans('versions.create_sub_title') }}
                    </h4>
                </div>
                <form method="POST"
                      enctype="multipart/form-data"
                      class="form-horizontal">

                    <div class="modal-body">

                        <!-- Version -->
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Version:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="version" v-model="version.Version">
                            </div>
                        </div>

                        <!-- Active -->
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{ trans('app.active') }}:</label>
                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="Active" name="Active"
                                               v-model="version.Active" value="1">
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                @click="closeModal">
                            {{ trans('app.cancel') }}
                        </button>
                        <button type="button" class="btn btn-primary"
                                @click.prevent="createVersion"
                                @click="closeModal">
                            {{ trans('app.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </create_modal>

    <!-- EDIT MODAL -->
    <edit_modal id="edit_modal" class="modal fade in modal-active"
                  v-if="showEditModal" @close="closeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" @click="closeModal" class="close"><span>&times;</span></button>
                    <h4 class="modal-title">
                        {{ trans('versions.edit_sub_title') }}
                    </h4>
                </div>
                <form method="POST"
                      enctype="multipart/form-data"
                      class="form-horizontal">

                    <div class="modal-body">

                        <!-- ID -->
                        <input type="hidden" v-model="version.ID">

                        <!-- Version -->
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Version:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="version" v-model="version.Version">
                                {{--<select class="form-control" id="Version"
                                        v-model="version.Version">
                                    <option>adasd</option>
                                </select>--}}
                            </div>
                        </div>

                        <!-- Active -->
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">
                                {{ trans('app.active') }}:
                            </label>
                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"
                                               v-model="version.Active"
                                               value="1">
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                @click="closeModal">{{ trans('app.cancel') }}</button>
                        <button type="button" class="btn btn-primary"
                                @click.prevent="updateVersion(version.ID)"
                                @click="closeModal">{{ trans('app.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </edit_modal>

</div>

<script>

    var versions = new Vue({
        el: '#app_version',
        data: {
            company_versions: [],
            versions: [],
            version: {
                ID: 0,
                Version: '',
                Active: 1
            },
            pagination: {
                total: 0,
                per_page: 10,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4,
            showCreateModal: false,
            showEditModal: false
        },
        mounted: function(){
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            this.getVersions(this.pagination.current_page);
        },
        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods: {

            // Szerkesztő ablak megnyitása
            openModal: function(version){

                this.version = {
                    'ID': version.ID,
                    'Version': version.Version,
                    'Active': version.Active === '0' ? false : true
                };

                this.showEditModal = true;
            },

            // Szerkesztő ablak becsukása
            closeModal: function(){

                this.showCreateModal = false;
                this.showEditModal = false;

                this.clearVersion();
            },

            // Verzió adatok lekérdezése
            getVersions: function(page){
                axios.get('api/getVersions?page=' + page)
                    .then(res => {
                        this.versions = res.data.versions.data;
                        this.pagination = res.data.pagination;
                    })
                    .catch(error => {
                        toastr['error'](error, 'Get Versions');
                    });
            },

            // Új adatok mentése
            createVersion: function(){

                if (this.version.Active === false) {
                    this.version.Active = 0;
                }

                axios.post('api/storeVersion', this.version)
                    .then(res => {

                        this.changePage(this.pagination.current_page);
                        this.clearVersion();
                        toastr['success']('Version Created Succesfully', 'Create Version');
                    })
                    .catch(error => {
                        toastr['error'](error, 'Create Version');
                    });
            },

            // Szerkesztő ablak feltöltése a szerkesztendő adatokkal
            editVersion: function(version){

                this.version.Version = version.Version;
                this.version.Active = version.Active === '1' ? true : false;


            },

            // Adatok frissítése
            updateVersion: function(id){

                if (this.version.Active === false) {
                    this.version.Active = 0;
                }
                else
                {
                    this.version.Active = 1;
                }

                axios.put('api/updateVersion/' + id, this.version)
                    .then(res => {

                        this.changePage(this.pagination.current_page);
                        this.clearVersion();
                        toastr['success']('Version Update Succesfully', 'Update Version');
                    })
                    .catch(error => {
                        toastr['error'](error, 'ERROR');
                    });
            },

            // Verzió törlése
            deleteVersion: function(version){},

            // Oldalváltás
            changePage: function (page) {
                this.pagination.current_page = page;
                this.getVersions(page);
            },

            // Verzió osztály alapállapotba helyezése
            clearVersion: function(){
                this.version = {
                    'ID': 0,
                    'Version': '',
                    'Active': true
                };
            }
        }
    });

</script>
