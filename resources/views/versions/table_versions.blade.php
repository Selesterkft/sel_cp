<div class="table-responsive mailbox-messages">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>{{ trans('app.id') }}</th>
            <th>{{ trans('versions.version') }}</th>
            <th>{{ trans('app.active') }}</th>
            <th class="text-center col-md-4">{{ trans('app.operations') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($versions as $version)
            <tr>
                <td>{{ $version->ID }}</td>
                <td>{{ $version->Version }}</td>

                <td>
                    <?php
                        $label = 'label-primary';
                        $active = 'inactive';
                    /** @var VersionModel $version */
                    if( $version->Active == 1)
                        {
                            $label = 'label-success';
                            $active = 'active';
                        }
                    ?>
                    <div class="label {{ $label }}">{{ $active }}</div>
                </td>

                <td class="text-center">
                    <a href="{{ url('versions.show', $version->ID) }}"
                       class="btn btn-xs btn-info">
                        <i class="fa fa-eye"></i>
                    </a>

                    <a href="{{ url('versions.edit', $version->ID) }}"
                       class="btn btn-xs btn-success"
                       style="margin-left: 5px;">
                        <i class="fa fa-pencil"></i>
                    </a>

                    @if( !empty($version->deleted_at) )
                        <form action="{{ url('versions.restore', $version->ID) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-info"
                                    style="margin-left: 5px;">
                                <i class="fa fa-recycle"></i>
                            </button>
                        </form>
                    @else
                        <form method="POST"
                              action="{{ url('versions.destroy', $version->ID) }}"
                              style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-xs btn-danger"
                                    style="margin-left: 5px;">
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
