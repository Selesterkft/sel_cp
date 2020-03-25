<div class="box box-default">

    <div class="box-header clearfix">
        <h4 class="box-title pull-left" style="padding-top: 7.5px;">
            {{ trans('settings.designs_title') }}
        </h4>
        <div class="btn-group pull-right">
            <button class="btn btn-success btn-sm"
                    onclick="event.preventDefault();document.getElementById('frmDesigns').submit()">
                <i class="fa fa-save"></i>&nbsp;{{ trans('app.save') }}
            </button>
            <!--<a href="#" class="btn btn-warning btn-sm">## Delete</a>-->
            <a href="{{ url('settings.restoreGeneral') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-recycle">&nbsp;
                    {{ trans('app.restore') }}
                </i>
            </a>
        </div>
    </div>

    <style>
        table.table.table-striped.table-bordered td{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <div class="box-body">
        <form id="frmDesigns" name="frmDesigns"
              class="form-horizontal"
              method="post"
              accept-charset="UTF-8"
              enctype="multipart/form-data"
              action="{{ url('settings.saveDesigns') }}">
            {{ csrf_field() }}
            @method('PUT')
            <div class="table-responsive-lg">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        {{--<th>{{ trans('app.operations') }}</th>--}}
                        <th>{{ trans('app.id') }}</th>
                        <th>{{ trans('app.name') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($designs as $design)
                        <tr>
                            {{--<td class="col-sm-1">
                                <a class="btn btn-success btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a class="btn btn-success btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>--}}
                            <td>{{ $design->id }}</td>
                            <td>
                                <a href="#"
                                   id="text" name="text"
                                   class="editable editable-pre-wrapper editable-click"
                                   data-type="text"
                                   data-name="name"
                                   data-pk="{{ $design->id }}"
                                   data-url="{{ url('api/settings/design/edit') }}"
                                   data-title="{{ trans('app.edit') }}">{{ $design->name }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <div class="box-footer"></div>

</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function()
    {
        $.fn.editable.defaults.mode = 'popup';
    });

    $('#edit-button').click(function(e) {
        e.stopPropagation();
        $('#username').editable('toggle');
    });

    $(document).ready(function()
    {
        $('.editable').editable({
            mode: 'popup',
            showbuttons: 'button',
            emptytext: '{{ trans('app.empty') }}',
            ajaxOptions: {
                type: 'post',
                dataType: 'json'
            },
            success: function(response, newValue)
            {
                location.reload();
            },
            error: function(response, newValue)
            {
                if(response.status === 500) {
                    return 'Service unavailable. Please try later.';
                } else {
                    return response.responseText;
                }
            }
        });
    });

</script>
