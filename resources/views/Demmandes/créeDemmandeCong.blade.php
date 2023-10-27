@extends('layouts.master')
@section('title')
Une demmandes de congée
@endsection
@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Création des demmandes</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ul>
                </div>
            </div>
        </div>
            <!-- /Page Header -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('ajouteDemmandeCong')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <h4 class="card-title">Les informations de demmande</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Titre de demmande <strong>*</strong></label>
                                            <input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre">
                                            @error('titre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Vos Motifs <strong>*</strong></label>
                                            <textarea  class="form-control @error('description') is-invalid @enderror" name="description" ></textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <select  class="form-control" name="type" hidden>
                                                <option value="0"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                            <input type="date" class="form-control @error('date_F') is-invalid @enderror"  name="date_F">
                                            @error('date_F')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Justification <strong>PDF*</strong></label><br>
                                            <input type="file" class="form-control @error('filePath') is-invalid @enderror"   name="filePath">
                                            @error('filePath')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if (count(Auth::user()->demmandes->where('type',0))>= 3)
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            Vous avez déjà effectuer trois demandes de congé
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
        <!-- /Page Header -->
    </div>
</div>
@endsection
