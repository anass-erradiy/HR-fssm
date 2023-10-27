@extends('layouts.master')
@section('title')
Annonce
@endsection
@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Création d'une annonce</h3>
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
                            <h4 class="card-title mb-0">Crée Une Annonce</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('StoreAnnonce')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Titre d'annonce</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control form-control-lg @error('titre_annonce') is-invalid @enderror" name="titre_annonce" placeholder="titre d'annonce">
                                    </div>
                                    @error('titre_annonce')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Description d'annonce </label>
                                    <div class="col-md-10">
                                        <textarea name="body" cols="" class="form-control @error('body') is-invalid @enderror" rows="10" placeholder="description annonce"></textarea>
                                    </div>
                                    @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Ajouter l'annonce</button>
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
