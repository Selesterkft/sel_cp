<div class="table-responsive mailbox-messages">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>{{ trans('app.id') }}</th>
            <th>{{ trans('app.company') }}</th>
            <th>{{ trans('versions.version') }}</th>
            <th>{{ trans('app.active') }}</th>
            <th class="text-center col-md-4">{{ trans('app.operations') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($version_companies as $vc)
        <tr>
            <td>{{ $vc->ID }}</td>
            <td>{{ $vc->company->Nev1 }}</td>
            <td>{{ $vc->version->Version }}</td>
            <td>
                @php
                $label = 'label-primary';
                $active = 'inactive';
                @endphp
                @if( $vc->Avtive == 1 )
                    $label = 'label-success';
                    $active = 'active';
                @endif
                <div class="label {{ $label }}">{{ $active }}</div>
            </td>
            <td class="text-center">
                <a href="{{ url('version_company.show', $vc) }}"
                   class="btn btn-xs btn-info">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ url('version_company.edit', $vc) }}"
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
