<div class="table-responsive mailbox-messages">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>{{ trans('app.id') }}</th>
            <th>{{ trans('app.company') }}</th>
            <th>{{ trans('app.design') }}</th>
            <th class="text-center col-md-4">{{ trans('app.operations') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($company_design as $cd)
            <tr>
                <td>{{ $cd->id }}</td>
                <td>{{ $cd->company->Nev1 }}</td>
                <td>{{ $cd->design }}</td>
                <td class="text-center">
                    {{--<a href="#"
                       class="btn btn-xs btn-info">
                        <i class="fa fa-eye"></i>
                    </a>--}}
                    <a href="{{ url('company_design.edit', $cd) }}"
                       class="btn btn-xs btn-success"
                       style="margin-left: 5px;">
                        <i class="fa fa-pencil"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
