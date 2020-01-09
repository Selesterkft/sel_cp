<div class="table-responsive mailbox-messages">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>{{ __('global.app_fields.id') }}</th>
            <th>{{ __('global.versions.fields.version') }}</th>
            <th>{{ __('global.versions.fields.active') }}</th>
            <th class="text-center col-md-4">{{ __('global.app_fields.operations') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($versions as $version)
            <tr>
                <td>{{ $version->ID }}</td>
                <td>{{ $version->Version }}</td>

                <td>
                    @php
                        $label = 'label-primary';
                        $active = 'inactive';
                        if($version->Active == 1)
                        {
                        $label = 'label-success';
                        $active = 'active';
                        }
                    @endphp
                    <div class="label {{ $label }}">{{ $active }}</div>
                </td>

                <td class="text-center">
                    <a href="{{ url('versions.show', $version->ID) }}"
                       class="btn btn-info">
                        <i class="fa fa-eye"></i>
                    </a>

                    <a href="{{ url('versions.edit', $version->ID) }}"
                       class="btn btn-success"
                       style="margin-left: 10px;">
                        <i class="fa fa-pencil"></i>
                    </a>

                    @if( !empty($version->deleted_at) )
                        <form action="{{ url('versions.restore', $version->ID) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-info"
                                    style="margin-left: 10px;">
                                <i class="fa fa-recycle"></i>
                            </button>
                        </form>
                    @else
                        <form method="POST"
                              action="{{ url('versions.destroy', $version->ID) }}"
                              style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                    style="margin-left: 10px;">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    @endif

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>