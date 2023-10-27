@extends('layouts.master')
@section('title')
Les utilisateur désactiver 
@endsection
@section('content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">
        @if (session()->get('message'))
        <div class="alert alert-success" role="alert">
            {{session()->get('message')}}
          </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">@yield('title')</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('register')}}" class="btn add-btn"  ><i class="fa fa-plus"></i> Ajoutée des utilisateurs</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('showUsers')}}" class="btn add-btn"  ><i class="fa fa-eye"></i>Voir les utilisateurs</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Utilisateur</th>
                                <th>Email</th>
                                <th>Numero </th>
                                <th>Anniversaire</th>
                                <th>Role</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )
                            @if (Auth::user()->id != $user->id )
                                <tr>
                                    <td>EMP-{{$user->id}}</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="#" data-toggle="modal" data-target="#show_user{{$user->id}}" class="avatar"><img src="assets/img/profiles/avatar-02.png" height="43px" alt=""></a>
                                            <a href="#" data-toggle="modal" data-target="#show_user{{$user->id}}">{{$user->nom}} {{$user->prenom}} <span>{{$user->sex}}</span></a>
                                        </h2>
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>@if ($user->number)

                                        {{$user->number}}
                                        @else
                                        --------------
                                        @endif
                                    </td>
                                    <td>@if ($user->birthday)

                                        {{$user->birthday}}
                                        @else
                                        -- / -- / --
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->admin == 2)
                                        <span class="badge bg-inverse-danger">Decanat</span>
                                        @elseif ($user->admin == 1)
                                        <span class="badge bg-inverse-warning">Chef</span>
                                        @else
                                        <span class="badge bg-inverse-primary">Utilisateur</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#restore_user{{$user->id}}"><i class="la la-check-circle m-r-5"></i> Activé</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_user{{$user->id}}"><i class="fa fa-trash-o m-r-5"></i> Supprimer</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- /Edit User Modal -->

                                <!-- Delete User Modal -->
                                <div id="show_user{{$user->id}}" class="modal custom-modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Informations d'utilisateur <strong>{{strtoupper($user->prenom)}}</strong></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 ">
                                                            <div class="form-group justify-content-center">
                                                                <label>Employee ID</label>
                                                                <input type="text" value="EMP-{{$user->id}}" disabled class="form-control floating">
                                                            </div>
                                                       </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Prenom</label>
                                                                <input class="form-control" disabled value="{{$user->prenom}}" type="text" name="prenom">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Nom</label>
                                                                <input class="form-control" disabled value="{{$user->nom}}" type="text" name="nom">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Le role</label><br>
                                                                <select class="select" disabled>
                                                                    @if (Auth::user()->admin == 2)
                                                                    <option @if($user->admin == 0) selected @endif value="0">Utilisateur</option>
                                                                    <option @if($user->admin == 1) selected @endif value="1">Chef</option>
                                                                    <option @if($user->admin == 2) selected @endif value="2">Decanat</option>
                                                                    @else
                                                                    <option @if($user->admin == 0) selected @endif value="0">Utilisateur</option>
                                                                    <option @if($user->admin == 1) selected @endif value="1">Chef</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control @error('email') is-invalid @enderror" disabled value="{{$user->email}}" type="email" name="email" required>
                                                                @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Adress </label>
                                                                <input class="form-control" value="{{$user->adress}}" type="text" disabled name="adress">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>numero de telephone </label>
                                                                <input class="form-control" value="{{$user->number}}" type="text" disabled name="number">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Date d'anniversaire </label>
                                                                <input class="form-control" value="{{$user->birthday}}" type="date" disabled name="birthday">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Code postal</label>
                                                                <input class="form-control" value="{{$user->postalCode}}" type="text" disabled name="postalCode">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal custom-modal fade" id="restore_user{{$user->id}}" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="form-header">
                                                    <h3>Restorer l'utilisateur</h3>
                                                    <p>Voulez-vous restorer l'utilisateur {{$user->prenom}} ?</p>
                                                </div>
                                                <div class="modal-btn delete-action">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="{{route('restoreUser',$user->id)}}" class="btn btn-success continue-btn">Restorer</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-warning cancel-btn">Annuler</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal custom-modal fade" id="delete_user{{$user->id}}" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="form-header">
                                                    <h3>Supprimer l'utilisateur</h3>
                                                    <p>Voulez-vous vraiment supprimer ?</p>
                                                </div>
                                                <div class="modal-btn delete-action">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="{{route('forceDelete',$user->id)}}" class="btn btn-primary continue-btn">Supprimer</a>
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
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    <!-- Edit User Modal -->

    <!-- /Delete User Modal -->
</div>
@endsection
