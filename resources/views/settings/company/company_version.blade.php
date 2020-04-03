<style>
    .modal-active {
        display: block;
    }
</style>

<div id="app_company_version">

    <!-- BOX -->
    <div class="box box-default">

        <!-- BOX HEADER -->
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('company_version.title') }}</h3>
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
                        <th>{{ trans('app.company') }}</th>
                        <th>{{ trans('versions.version') }}</th>
                        <th class="text-center">{{ trans('app.active') }}</th>
                        <th class="text-center col-md-1">{{ trans('app.operations') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="c_version in company_versions" :key="company_version.ID">
                        <td class="text-right">@{{ c_version.ID }}</td>
                        <td>@{{ c_version.CompanyName }}</td>
                        <td>@{{ c_version.Version }}</td>
                        <td class="text-center">
                            <div v-bind:class="[c_version.Active == 1 ? 'label label-success' : 'label label-primary']">
                                @{{ c_version.Active == 1 ? 'Active' : 'Inactive' }}
                            </div>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-xs"
                               @click="openModal(c_version)">
                                <i class="fa fa-pencil"></i>
                            </button>
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

        <!-- BOX FOOTER -->
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
                        {{ trans('company_version.title') }}
                    </h4>
                </div>

                <form method="POST" enctype="multipart/form-data" class="form-horizontal">

                    <div class="modal-body">

                        <!-- Partners -->
                        <div class="form-group">
                            <label for="CompanyID" class="col-sm-2 control-label">{{ trans('app.company') }}:</label>
                            <div class="col-sm-10">

                                <select id="CompanyID" class="form-control" v-model="company_version.CompanyID">

                                    <option v-for="partner in partners"
                                            v-bind:value="partner.ID">@{{ partner.Name }}</option>

                                </select>
                            </div>
                        </div>

                        <!-- Version -->
                        <div class="form-group">
                            <label for="VersionID" class="col-sm-2 control-label">{{ trans('app.version') }}:</label>
                            <div class="col-sm-10">
                                <select id="VersionID" name="VersionID" class="form-control" v-model="company_version.VersionID">
                                        <option v-for="version in versions"
                                                v-bind:value="version.ID">@{{ version.Version }}</option>
                                </select>
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
                                        <input type="checkbox" id="Active" name="Active"
                                               v-model="company_version.Active" value="1">
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
                                @click.prevent="createCompanyVersions"
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
                    <button type="button" @click="closeModal" class="close">
                        <span>&times;</span>
                    </button>
                    <h4 class="modal-title">
                        {{ trans('company_version.title') }}
                    </h4>
                </div>

                <form method="POST" enctype="multipart/form-data" class="form-horizontal">

                    <div class="modal-body">

                        <!-- Partners -->
                        <div class="form-group">
                            <label for="CompanyID" class="col-sm-2 control-label">{{ trans('app.company') }}:</label>
                            <div class="col-sm-10">

                                <select id="CompanyID" class="form-control" v-model="company_version.CompanyID">

                                    <option v-for="partner in partners"
                                            v-bind:value="partner.ID">@{{ partner.Name }}</option>

                                </select>
                            </div>
                        </div>

                        <!-- Version -->
                        <div class="form-group">
                            <label for="VersionID" class="col-sm-2 control-label">{{ trans('app.version') }}:</label>
                            <div class="col-sm-10">
                                <select id="VersionID" name="VersionID" class="form-control" v-model="company_version.VersionID">
                                    <option v-for="version in versions"
                                            v-bind:value="version.ID">@{{ version.Version }}</option>
                                </select>
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
                                        <input type="checkbox" id="Active" name="Active"
                                               v-model="company_version.Active"
                                               value="1">
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
                                @click.prevent="updateCompanyVersions(company_version.ID)" @click="closeModal">
                            {{ trans('app.save') }}
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </edit_modal>

</div>

<script>

    var company_versions = new Vue({
        el: '#app_company_version',
        data: {
            versions: [],
            partners: [],
            company_versions: [],
            company_version: {
                ID: 0,
                CompanyID: 0,
                VersionID: 0,
                Active: 1},
            pagination: {
                total: 0,
                per_page: 10,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4,
            showCreateModal: false,
            showEditModal: false,
            client_id: '{{ $client_id }}',
            version: '{{ $version }}'
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

            //token = document.head.querySelector('meta[name="csrf-token"]');
            //axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
            //axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

            this.getVersions();
            this.getPartners(this.client_id, this.version);
            this.getCompanyVersions(this.pagination.current_page);
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

            getCompanyVersions: function(page){
                axios.get('api/getCompaniesVersions?page=' + page)
                    .then(res => {
                        this.company_versions = res.data.compaies_versions.data;
                        this.pagination = res.data.pagination;
                    })
                    .catch(error => {
                        toastr['error'](error, 'Get Company Versions');
                    });
            },

            getVersions: function(){

                axios.get('api/getVersionsToSelect')
                    .then(res => {
                        this.versions = res.data;
                    })
                    .catch(error => {
                        toastr['error'](error, 'getVersions');
                    });
            },

            getPartners: function(client_id, version){

                axios.get('api/getPartnersToSelect/' + client_id + '/' + version)
                    .then(res => {
                        this.partners = res.data;
                    })
                    .catch(error => {
                        toastr['error'](error, 'getPartners');
                    });
            },

            createCompanyVersions: function(){

                if (this.company_version.Active == false) {
                    this.company_version.Active = 0;
                }

                axios.post('api/storeCompanyVersion', this.company_version)
                    .then(res => {

                        this.changePage(this.pagination.current_page);
                        this.clearCompanyVersion();

                        toastr['success']('Company Versions Created Succesfully', 'Success');
                    })
                    .catch(error => {
                        toastr['error'](error, 'Create Company Version');
                    });
            },

            editCompanyVersions: function(company_version){

                this.company_version.CompanyID = company_version.CompanyID;
                this.company_version.VersionID = company_version.VersionID;
                this.company_version.Active = company_version.Active == 1 ? true : false;
                //console.log(this.company_version.Active);
            },

            updateCompanyVersions: function(id){

                if (this.company_version.Active == false) {
                    this.company_version.Active = 0;
                }
                else
                {
                    this.company_version.Active = 1;
                }

                axios.put('api/updateCompanyVersion/' + id, this.company_version)
                    .then(res => {

                        this.changePage(this.changePage(this.pagination.current_page));
                        this.clearCompanyVersion();

                        toastr['success'](
                            '{{ trans('messages.update_successfully', ['name' => trans('company_version.title')]) }}',
                            '{{ trans('app.success') }}'
                        );
                    })
                    .catch(error => {
                        toastr['error'](error, 'Update Company Version');
                    });
            },

            deleteCompanyVersions: function(company_version){},

            changePage: function (page) {

                this.pagination.current_page = page;
                this.getCompanyVersions(page);
            },

            openModal: function(c_version){

                this.company_version = {
                    ID: c_version.ID,
                    CompanyID: c_version.CompanyID,
                    VersionID: c_version.VersionID,
                    Active: c_version.Active == '0' ? false : true
                };

                this.showEditModal = true;
            },

            closeModal: function(){

                this.showCreateModal = false;
                this.showEditModal = false;
                this.clearCompanyVersion();
            },

            clearCompanyVersion: function(){
                this.company_version = {
                    ID: 0,
                    CompanyID: 0,
                    VersionID: 0,
                    Active: 1
                };
            }
        }
    });

</script>
