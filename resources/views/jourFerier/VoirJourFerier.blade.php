@extends('layouts.master')
@section('title')
@if (Auth::user()->admin == 0)
Voir les jour fériér
@else
Voir et modifier les jour fériér
@endif
@endsection
@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Les jour fériér</h3>
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
                    @if (count($data))
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Date Début</th>
                                    <th>Durée</th>
                                    <th>Date Fin</th>
                                    @if (Auth::user()->admin >= 1)
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $jourFerier )
                                    {{-- check if the user has "demmandes" and do not return "demmandes" of the same connected user--}}
                                    {{-- also check if the current user has the permession to see other "demmandes" --}}
                                            <tr>
                                                <td>{{$jourFerier->reference}}</td>
                                                <td>{{$jourFerier->date_D}}</td>
                                                <td>{{(strtotime($jourFerier->date_F)-strtotime($jourFerier->date_D))/60/60/24,'Day'}} Jour</td>
                                                <td>{{$jourFerier->date_F}}</td>
                                                @if (Auth::user()->admin >= 1)
                                                    <td>
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="" data-target="#demmande_info{{$jourFerier->id}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i>Modifier</a>
                                                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#delete_estimate{{$jourFerier->id}}"><i class="fa fa-trash-o m-r-5"></i> Supprimer</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                            <div class="modal custom-modal fade" id="delete_estimate{{$jourFerier->id}}" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-header">
                                                                <h3>Supprimer le jour </h3>
                                                                <p>Voulez-vous vraiment supprimer ?</p>
                                                            </div>
                                                            <div class="modal-btn delete-action">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <a href="{{route('deleteJourFerier',$jourFerier->id)}}" class="btn btn-primary continue-btn">Supprimer</a>
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
                                            <div id="demmande_info{{$jourFerier->id}}" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Fait des modifications au jour fériér</h4>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form action="{{route('editJourFerier',$jourFerier->id)}}" method="POST">
                                                                    @csrf
                                                                    <div class="">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                            <label>Cadre de formation :</label>
                                                                            <input type="text" class="form-control" value="{{$jourFerier->reference}}" name="reference">
                                                                        </div>
                                                                    <div class="form-group">
                                                                        <label>Date de début : </label>
                                                                        <input  class="form-control" name="date_D" value="{{$jourFerier->date_D}}" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Date de fin : </label>
                                                                        <input  class="form-control" name="date_F" value="{{$jourFerier->date_F}}" />
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div class="text-right">
                                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h1>Vous n'avez pas des jour fériér pour le moment !</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->

@endsection
