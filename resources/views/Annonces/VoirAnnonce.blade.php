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
                    <h3 class="page-title">@if (Auth::user()->admin == 0)
                        Voir les annonces
                        @else
                        Voir et modifier les annonces
                        @endif </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ul>
                </div>
            </div>
        </div>
            <!-- /Page Header -->
            <div class="row">
                @if (count($data))
                    @foreach ($data as $annonce )
                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown dropdown-action profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if (Auth::user()->admin == 0)
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#voir_detail{{$annonce->id}}"><i class="fa fa-eye m-r-5"></i> Voir Details</a>
                                            @else
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project{{$annonce->id}}"><i class="fa fa-pencil m-r-5"></i> Voir et Modifier</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project{{$annonce->id}}"><i class="fa fa-trash-o m-r-5"></i> Supprimer</a>
                                            @endif
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view.html">{{$annonce->titre_annonce}}</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-muted">envoyé à </span><strong>{{$annonce->usersCount}}</strong> <span class="text-muted">personnes</span>
                                    </small>

                                    <div class="project-members m-b-15">
                                        <div>Propriétaire de l'annonce :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="{{$annonce->userName}}"><img alt="" src="{{asset($annonce->image['0']->path)}}" height="40px"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Date d'annoncement :
                                        </div>
                                        <div class="text-muted">
                                            {{$annonce->created_at->format('Y-m-d H:m')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="voir_detail{{$annonce->id}}" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail d'annonce</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Titre d'annonce</label>
                                                        <input class="form-control" disabled value="{{$annonce->titre_annonce}}" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Propriétaire de l'annonce : </label>
                                                        <div class="project-members">
                                                            <a href="#" data-toggle="tooltip" title="{{$annonce->userName}}" class="avatar">
                                                                <img src="{{asset($annonce->image['0']->path)}}" alt="" height="40px">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea disabled rows="7" class="form-control">{{$annonce->body}}</textarea>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="edit_project{{$annonce->id}}" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modifier l'annonce</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('annonceEdit',$annonce->id)}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Titre d'annonce</label>
                                                        <input class="form-control" name="titre_annonce" value="{{$annonce->titre_annonce}}" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Propriétaire de l'annonce :</label>
                                                        <div class="project-members">
                                                            <a href="#" data-toggle="tooltip" title="{{$annonce->userName}}" class="avatar">
                                                                <img src="{{asset($annonce->image['0']->path)}}" alt="" height="40px">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="4" class="form-control" name="body">{{$annonce->body}}</textarea>
                                            </div>
                                            <div class="submit-section">
                                                <button class="btn btn-primary submit-btn">Modifier l'annonce</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal custom-modal fade" id="delete_project{{$annonce->id}}" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-header">
                                            <h3>Suppression d'annonce</h3>
                                            <p>Voulez-vous vraiment supprimer ?</p>
                                        </div>
                                        <div class="modal-btn delete-action">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="{{route('annonceDelete',$annonce->id)}}" class="btn btn-primary continue-btn">Supprimer</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Annuler</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2>Vous n'avez pas des annonces pour le moment !</h2>
                @endif
            </div>
        <!-- /Page Header -->
    </div>
</div>
@endsection
