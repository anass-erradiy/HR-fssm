@extends('layouts.master')
@section('title')
Jour fériér
@endsection
@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Ajouter le Jour fériér</h3>
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
                            <h4 class="card-title mb-0">Inforamtions de jour fériér</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('storeJourFerier')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Réference <strong>*</strong></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control form-control-lg @error('reference') is-invalid @enderror" name="reference" placeholder="cadre de formation">
                                        @error('reference')
                                        <span class="invalid-feedback " role="alert">
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
                                    <button type="submit" class="btn btn-primary">Ajouter le jour fériér </button>
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
