@extends('layouts.master')
@section('title')
Paramètre
@endsection
@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        @if (session()->get('alert'))
        <div class="alert alert-success" role="alert">
            Le mot de passe a été changé avec succès !
          </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">@yield('title')</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ul>
                </div>
            </div>
        </div>
            <!-- /Page Header -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header"><h3>{{ __("Changer le mot de pass") }}</h3></div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('changePassword') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="oldPassword" class="col-md-4 col-form-label text-md-end">{{ __('Votre mot de pass') }}</label>

                                        <div class="col-md-6">
                                            <input id="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword" >

                                            @error('oldPassword')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Nouveau mot de pass') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmer mot de pass') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __("Changer le mot de pass") }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- /Page Wrapper -->
</div>
@endsection
