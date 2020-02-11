<div class="table-responsive mailbox-messages">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>{{ __('global.app_fields.id') }}</th>
            <th>{{ __('global.versions.fields.company') }}</th>
            <th>{{ __('global.versions.fields.version') }}</th>
            <th>{{ __('global.versions.fields.active') }}</th>
            <th class="text-center col-md-4">{{ __('global.app_fields.operations') }}</th>
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
                {{--
                @if( isset($versions->deleted_at) )
                <form action="{{ url('version_company.restore', $vc) }}"
                      method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-info"
                            style="margin-left: 10px;">
                        <i class="fa fa-recycle"></i>
                    </button>
                </form>
                @else
                <form method="POST"
                      action="{{ url('version_company.destroy', $vc) }}"
                      style="display:inline;">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger"
                            style="margin-left: 10px;">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
                @endif
                --}}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
