@extends('layouts.master')
@section('title')
Formation
@endsection
@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Création d'une formation</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ul>
                </div>
            </div>
        </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Crée Une formation</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('storeFormation')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Cadre formation <strong>*</strong></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control form-control-lg @error('cadreFormation') is-invalid @enderror" name="cadreFormation" placeholder="cadre de formation">
                                        @error('cadreFormation')
                                        <span class="invalid-feedback " role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Lieu formation <strong>*</strong> </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control form-control-lg @error('lieu') is-invalid @enderror" name="lieu" placeholder="lieu de formation">
                                        @error('lieu')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Date Début <strong>*</strong></label>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control form-control-lg @error('date_D') is-invalid @enderror" name="date_D">
                                        @error('date_D')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Date Fin <strong>*</strong></label>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control form-control-lg @error('date_F') is-invalid @enderror" name="date_F">
                                        @error('date_F')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Ajouter la formation</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /Page Header -->
    </div>
</div>
@endsection
