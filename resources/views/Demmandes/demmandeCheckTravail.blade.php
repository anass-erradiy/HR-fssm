@extends('layouts.master')
@section('title')
verifier demmande att-travail
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
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre de demmande</th>
                                <th>User ID</th>
                                <th>Nom</th>
                                <th>Demmande</th>
                                <th>Date de début</th>
                                <th>Le délai</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $item )
                            {{-- check if the user has "demmandes" and do not return "demmandes" of the same connected user--}}
                            {{-- also check if the current user has the permession to see other "demmandes" --}}
                            @if (count($item->demmandes) && Auth::user()->id != $item->id)
                                @foreach ($item->demmandes as $demmande)
                                    <tr>
                                        <td>{{$demmande->id}}</td>
                                        <td>{{$demmande->titre}}</td>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->nom}}</td>
                                        <td> Congée </td>
                                        <td>{{$demmande->date_D}}</td>
                                        <td>{{(strtotime($demmande->date_F)-strtotime($demmande->date_D))/60/60/24,'Day'}} Jour</td>
                                        <td>@if ($demmande->status == 0)
                                            <a href="" data-target="#status_info{{$demmande->id}}" data-toggle="modal"><span class="badge bg-inverse-warning">Envoyée</span></a>
                                            @elseif ($demmande->status == 1)
                                            <a href="" data-target="#status_info{{$demmande->id}}" data-toggle="modal"><span class="badge bg-inverse-success">Accepter</span></a>
                                            @else
                                            <a href="" data-target="#status_info{{$demmande->id}}" data-toggle="modal"><span class="badge bg-inverse-danger">Reffuser</span></a>
                                        @endif</td>
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="" data-target="#demmande_info{{$demmande->id}}" data-toggle="modal"><i class="fa fa-eye m-r-5"></i> Voir</a>
                                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#delete_estimate{{$demmande->id}}"><i class="fa fa-trash-o m-r-5"></i> Supprimer</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal custom-modal fade" id="delete_estimate{{$demmande->id}}" role="dialog">
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
                                                                <a href="{{route('DeleteDemmande',$demmande->id)}}" class="btn btn-primary continue-btn">Supprimer</a>
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
                                    <div id="demmande_info{{$demmande->id}}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Details du demmande</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Titre de demmande</label>
                                                                    <input type="text" class="form-control" disabled value="{{$demmande->titre}}" name="titre">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea  class="form-control" name="description"  disabled >{{$demmande->description}}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Tyoe de demmande</label>
                                                                    <select  class="form-control" disabled name="type" >
                                                                        <option value="">{{$demmande->type}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Date de debut</label><br>
                                                                    <input type="date" disabled class="form-control" value="{{$demmande->date_D}}" name="date_D">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Date de fin</label><br>
                                                                    <input type="date" disabled class="form-control"  value="{{$demmande->date_F}}" name="date_F">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>La durée</label><br>
                                                                    <input type="text" class="form-control" disabled value="{{(strtotime($demmande->date_F)-strtotime($demmande->date_D))/60/60/24,'Day'}} Jour" name="date_F">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Repondre au demmande</h4>
                                                    </div>
                                                    <form action="{{route('reponseDemmande',$demmande->id)}}" method="POST">
                                                        @csrf
                                                        <div class="">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Titre de reponse</label>
                                                                <input type="text" class="form-control" value="{{$demmande->titre_reponse}}" name="titre_reponse">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Justification</label>
                                                                <textarea  class="form-control" name="justification"  >{{$demmande->justification}}</textarea>
                                                                <input type="number" class="form-control" hidden  value="2" name="type" >
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Status {{$demmande->id}}</label>
                                                                <select  class="form-control" name="status" >
                                                                    @if ($demmande->status)
                                                                        @if ($demmande->status == 1)
                                                                        <option value="1">Accepter</option>
                                                                        <option value="0">--------</option>
                                                                        <option value="2">Reffuser</option>
                                                                        @else
                                                                        <option value="2">Reffuser</option>
                                                                        <option value="0">--------</option>
                                                                        <option value="1">Accepter</option>
                                                                        @endif
                                                                    @else
                                                                    <option value="0">--------</option>
                                                                    <option value="1">Accepter</option>
                                                                    <option value="2">Reffuser</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary">Envoyée</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="status_info{{$demmande->id}}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Details du demmande</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                        <div class="">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Titre de reponse</label>
                                                                <input type="text" class="form-control" disabled value="{{$demmande->titre_reponse}}" name="titre">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Justification</label>
                                                                <textarea  class="form-control" name="description" disabled >{{$demmande->justification}}</textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select  class="form-control" name="status" disabled>
                                                                    @if ($demmande->status)
                                                                        @if ($demmande->status == 1)
                                                                        <option value="1" class="btn">Accepter</option>
                                                                        @else
                                                                        <option value="2" class="btn">Reffuser</option>
                                                                        @endif
                                                                    @else
                                                                    <option value="0" class="btn">En traitement</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->

@endsection
