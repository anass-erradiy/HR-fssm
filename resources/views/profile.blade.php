@extends('layouts.master')
@section('title')
Profile
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
            <!-- /Page Header -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#">
                                            @if(!isset(auth()->user()->image->first()->path))
                                            <span class="inline-block"><img src="{{asset('images/avatar-02.png')}}" alt="user">
                                            @else
                                            <span class="inline-block"><img src="{{asset(auth()->user()->image->first()->path)}}" alt="user">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{Auth::user()->nom}} {{Auth::user()->prenom}}</h3>
                                                <h4 class="text-muted">@if (Auth::user()->admin == 0)
                                                    Équipe Utilisateur
                                                @elseif (Auth::user()->admin == 1)
                                                    Équipe Chef
                                                @else
                                                    Équipe Decanat
                                                @endif</h4>
                                                <small class="text-muted">Employee </small>
                                                <div class="staff-id">CODE SOM : {{Auth::user()->som}}</div>
                                                <div class="staff-id">CIN : {{Auth::user()->cin}}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Téléphone:</div>
                                                    <div class="text"><a href="">@if (Auth::user()->number) {{Auth::user()->number}} @else -- -- --- -- -- @endif</a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text"><a href="">@if (Auth::user()->email) {{Auth::user()->email}} @else --------@gmail.com @endif</a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Anniversaire:</div>
                                                    <div class="text">@if (Auth::user()->birthday) {{Auth::user()->birthday}} @else -- / -- / -- @endif</div>
                                                </li>
                                                <li>
                                                    <div class="title">Address:</div>
                                                    <div class="text">@if (Auth::user()->adress) {{Auth::user()->adress}} @else ----- ------ @endif</div>
                                                </li>
                                                <li>
                                                    <div class="title">Gennre:</div>
                                                    <div class="text">@if (Auth::user()->sex) {{Auth::user()->sex}} @else NON-selectionner @endif</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- /Page Content -->

            <!-- Profile Modal -->
            <div id="profile_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Informations sur le profil</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="modal-body">
                        <form method="POST" action="{{route('updateProfil')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="profile-img-wrap edit-img">
                                    @if(!isset(auth()->user()->image->first()->path))
                                    <span class="inline-block"><img src="{{asset('images/avatar-02.png')}}" alt="">
                                    @else
                                    <span class="inline-block"><img src="{{asset(auth()->user()->image->first()->path)}}" alt="user">
                                    @endif
                                    <div class="fileupload btn">
                                        <span class="btn-text">Modifier</span>
                                        <input class="upload @error('image') is-invalid @enderror" type="file" name="image">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nom</label>
                                                <input type="text" class="form-control" name="nom" value="{{Auth::user()->nom}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Prénom</label>
                                                <input type="text" class="form-control" name="prenom" value="{{Auth::user()->prenom}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date de naissance</label>
                                                <div class="cal">
                                                    <input class="form-control" type="date" name="birthday" value="{{Auth::user()->birthday}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sex</label>
                                                <select class="select form-control" name="sex">
                                                    <option @if(Auth::user()->sex == 'Homme') selected @endif value="Homme">Homme</option>
                                                    <option @if(Auth::user()->sex == 'Femme') selected @endif value="Femme">Femme</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="adress" class="form-control" value="{{Auth::user()->adress}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Region</label>
                                        <input type="text" name="region" class="form-control @error('region') is-invalid @enderror" value="{{Auth::user()->region}}">
                                        @error('region')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pays</label>
                                        <input type="text" name="pays" class="form-control" value="{{Auth::user()->pays}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="text" name="postalCode" class="form-control @error('postalCode') is-invalid @enderror" value="{{Auth::user()->postalCode}}">
                                        @error('postalCode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Numéro de telephone</label>
                                        <input type="text" id="number" name="number" class="form-control @error('number') is-invalid @enderror" value="{{Auth::user()->number}}">
                                        @error('number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            <!-- /Profile Modal -->

<!-- /Page Wrapper -->
</div>
@endsection
