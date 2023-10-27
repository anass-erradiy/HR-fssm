@extends('layouts.master')
@section('title')
attestation de salaire
@endsection
@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Les demandes</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ul>
                </div>
            </div>
        </div>
            <!-- /Page Header -->

            <div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('ajouteDemmande')}}" method="post">
                                    @method('post')
                                    @csrf
                                    <h3 class="card-title">Les informations de demande</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Titre de demande <strong>*</strong></label>
                                            <input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre">
                                            @error('titre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Vos Motifs <strong>*</strong></label>
                                            <textarea  class="form-control" name="description" ></textarea>
                                        </div>

                                        <div class="form-group">
                                            <select  class="form-control" name="type" hidden>
                                                <option value="1"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Le délai Pour votre demande</h4>
                                        <br>
                                        <div class="form-group">
                                            <label>Date de debut <strong>*</strong></label><br>
                                            <input type="date" class="form-control @error('date_D') is-invalid @enderror" name="date_D">
                                            @error('date_D')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Date de fin <strong>*</strong></label><br>
                                            <input type="date" class="form-control @error('date_F') is-invalid @enderror" name="date_F">
                                            @error('date_F')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                @if (count(Auth::user()->demmandes->where('type',1)))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">

                                    Vous avez déjà fait trois demandes attestation de salaire
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @else
                                    <button type="submit" class="btn btn-primary">Ajouter la demmande</button>
                                @endif
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
    </div>
</div>
@endsection
