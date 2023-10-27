@extends('layouts.master')
@section('title')
Crée Utilisateur
@endsection
@section('content')

<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

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
                            <div class="card-header"><h3>{{ __("Creation d'un utilisatreur") }}</h3></div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('NOM') }}</label>

                                        <div class="col-md-6">
                                            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>

                                            @error('nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="prenom" class="col-md-4 col-form-label text-md-end">{{ __('PRENOM') }}</label>

                                        <div class="col-md-6">
                                            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                                            @error('prenom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="som" class="col-md-4 col-form-label text-md-end">{{ __('CODE-SOM') }}</label>

                                        <div class="col-md-6">
                                            <input id="som" type="number" class="form-control @error('som') is-invalid @enderror" name="som" value="{{ old('som') }}" required autocomplete="som" autofocus>
                                            @error('som')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cin" class="col-md-4 col-form-label text-md-end">{{ __('CIN') }}</label>

                                        <div class="col-md-6">
                                            <input id="cin" type="text" class="form-control @error('cin') is-invalid @enderror" name="cin" value="{{ old('cin') }}" required autocomplete="cin" autofocus>
                                            @error('cin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="Role" class="col-md-4 col-form-label text-md-end">{{ __('ROLE') }}</label>

                                        <div class="col-md-6">
                                            <select name="admin" class="form-control text-align-center  @error('admin') is-invalid @enderror" >
                                                <option class="text-align-center" selected >Selectioner le role</option>
                                                <option class="text-align-center" value="0">-- Personnel --</option>
                                                @if (Auth::user()->admin == 2)
                                                <option class="text-align-center" value="1">-- Chef --</option>
                                                <option class="text-align-center" value="2">-- Decanat --</option>
                                                @endif
                                            </select>
                                            @error('admin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="Role" class="col-md-4 col-form-label text-md-end">{{ __('DÉPARTEMENT') }}</label>

                                        <div class="col-md-6">
                                            <select name="departement" class="form-control text-align-center @error('departement') is-invalid @enderror" >
                                                <option class="text-align-center" >Selectioner le departement</option>
                                                <option class="text-align-center" value="MATH">Mathématique</option>
                                                <option class="text-align-center" value="GEO">Géologie</option>
                                                <option class="text-align-center" value="INFO">Informatique</option>
                                                <option class="text-align-center" value="CHIMIE">Chémie</option>
                                                <option class="text-align-center" value="PHYS">Physique</option>
                                                <option class="text-align-center" value="BIO">Biologie</option>
                                                <option class="text-align-center" value="HUM">Humanitiés</option>
                                            </select>
                                            @error('departement')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('ADRESS EMAIL') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('MOT DE PASS') }}</label>

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
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('CONFIRMER MOT DE PASS') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __("AJOUTER L'UTILISATEUR") }}
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
