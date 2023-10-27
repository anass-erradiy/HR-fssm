@extends('layouts.master')
@section('title')
attestation de travail
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
                                    <h4 class="card-title">Les informations de demande </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Titre de demande <strong>*</strong></label>
                                            <input type="text" class="form-control" name="titre">
                                        </div>
                                        <div class="form-group">
                                            <label>Vos Motifs <strong>*</strong></label>
                                            <textarea  class="form-control" name="description" ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <select  class="form-control" name="type" hidden>
                                                <option value="2"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Le délai Pour votre demande</h4>
                                        <br>
                                        <div class="form-group">
                                            <label>Date de debut <strong>*</strong></label><br>
                                            <input type="date" class="form-control" name="date_D">
                                        </div>
                                        <div class="form-group">
                                            <label>Date de fin <strong>*</strong></label><br>
                                            <input type="date" class="form-control" name="date_F">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if (count(Auth::user()->demmandes->where('type',2)))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">

                                        Vous avez déjà fait trois demandes attestation de travail
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
