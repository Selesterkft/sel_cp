@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('users.verify_email_address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ trans('users.verification_link') }}
                        </div>
                    @endif

                    {{ trans('users.check_your_email') }}
                    {{ trans('users.not_receive_email_1') }}, <a href="{{ route('verification.resend') }}">{{ trans('users.not_receive_email_2') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
