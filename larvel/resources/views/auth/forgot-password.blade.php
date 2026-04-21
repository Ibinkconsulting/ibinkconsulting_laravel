@extends('auth.app')

@section('title', 'Forgot your password')

@push('style')
@endpush

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        <!-- Login v1 -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="brand-logo ">
                                    <img src="{{ asset($setting->logo ?? 'backend/app-assets/images/logo/logo.png') }}"
                                        width="150" alt="logo">

                                </a>

                                <form class="auth-login-form mt-2" action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="login-email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="john@example.com" value="{{ old('email') }}"
                                            aria-describedby="login-email" tabindex="1" autofocus />
                                        @if ($errors->has('email'))
                                            <span class="text-danger">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="4">Email Password Reset
                                        Link</button>
                                </form>
                            </div>
                        </div>
                        <!-- /Login v1 -->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
