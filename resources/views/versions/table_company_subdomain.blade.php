<div class="table-responsive mailbox-messages">
<table class="table table-striped">
    <thead>
    <tr>
        <th>{{ trans('app.company') }}</th>
        <th>{{ trans('company_subdomain.company_nickname') }}</th>
        <th>{{ trans('company_subdomain.subdomain') }}</th>
        <th>{{ trans('app.operations') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($company_subdomains as $cs)
    <tr>
        <td>{{ $cs->CompanyName }}</td>
        <td>{{ $cs->CompanyNickName }}</td>
        <td>{{ $cs->SubdomainName }}</td>
        <td>
            <a href="{{ url('companysubdomain.show', ['id' => $cs->id]) }}" class="btn btn-info btn-xs">
                <i class="fa fa-eye"></i>
            </a>
            <a href="{{ url('companysubdomain.edit', ['id' => $cs->id]) }}" class="btn btn-success btn-xs">
                <i class="fa fa-pencil"></i>
            </a>
            @if( $cs->deleted_at)
                <form method="post"
                      action="{{ url('companysubdomain.restore', ['id' => $cs->id]) }}"
                      style="display:inline;">
                    @csrf
                    <button type="submit"
                            class="btn btn-info btn-xs"
                            style="margin-left: 5px;">
                        <i class="fa fa-recycle"></i>
                    </button>
                </form>
            @else
                <form method="post"
                      action="#"
                      style="display:inline;"></form>
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
