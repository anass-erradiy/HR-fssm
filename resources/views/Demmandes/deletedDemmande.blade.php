@extends('layouts.master')
@section('title')
Les demmandes supprimer
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
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('demmandeCong')}}" class="btn add-btn"><i class="fa fa-eye"></i>Voir les demmandes</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if (!count($data))
                        <h2>Il y'a pas des demmandes supprimer</h2>
                    @else
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Type</th>
                                <th>Date de début</th>
                                <th>Durée</th>
                                <th>Data de suppression</th>
                                <th>Status</th>
                                <th>User_id</th>
                                <th>Nom_utilisateur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item )
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->titre_de_demmande}}</td>
                                <td>{{$item->type_demmande}}</td>
                                <td>{{$item->date_de_debut}}</td>
                                <td>{{$item->dure_de_demmande}} Jour</td>
                                <td>{{$item->date_de_suppression}}</td>
                                <td>@if ($item->status == 0)
                                        <span class="badge bg-inverse-warning">Envoyée</span>
                                    @elseif ($item->status == 1)
                                        <span class="badge bg-inverse-success">Accepter</span>
                                    @else
                                        <span class="badge bg-inverse-danger">Reffuser</span>
                                @endif</td>
                                <td>{{$item->id_utilisateur}}</td>
                                <td>{{$getUser($item->id_utilisateur)}}</td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#delete_estimate{{$item->id}}"><i class="fa fa-trash-o m-r-5"></i> Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal custom-modal fade" id="delete_estimate{{$item->id}}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Supprimer la demmande</h3>
                                                <p>Voulez-vous vraiment supprimer ?</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="{{route('deleteDeletedDemmande',$item->id)}}" class="btn btn-primary continue-btn">Supprimer</a>
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
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
