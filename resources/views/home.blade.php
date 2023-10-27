@extends('layouts.master')
@section('title')
    Home
@endsection
@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-box">
                    <div class="welcome-img">
                        @if (isset(auth()->user()->image->first()->path))
                        <img alt="" src="{{asset(auth()->user()->image->first()->path)}}">
                        @else
                        <img alt="" src="{{asset('images/avatar-02.png')}}">
                        @endif
                    </div>
                    <div class="welcome-det">
                        <h3>Bienvunue @if(Auth::user()->sex == 'Homme') M.@elseif(Auth::user()->sex == 'Femme') MM.@endif {{Auth::user()->prenom}} {{Auth::user()->nom}}</h3>
                        <p><strong>Aujourd'hui est le {{ date('d-m-y') }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->admin >= 1)
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                            {{-- <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span> --}}
                            <div class="dash-widget-info">
                                <h3>{{count($data['users'])}}</h3>
                                <span>Employées</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-file-text"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{count($data['demande'])}}</h3>
                                <span>Demandes</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-graduation-cap"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{count($data['formation'])}}</h3>
                                <span>Formations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-group m-b-30">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">Nouveaux employés</span>
                                    </div>
                                    <div>
                                        <span class="text-success">+{{$data['calculatePercentage'](count($data['usersPerMonth']),count($data['users']))}} %</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">{{count($data['usersPerMonth'])}}</h3>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: @if(($data['calculatePercentage'](count($data['usersPerMonth']),count($data['users']))) > 100 )100% @else {{$data['calculatePercentage'](count($data['usersPerMonth']),count($data['users']))}}% @endif;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Total des employés {{count($data['users'])}}</p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">Nouveaux demande</span>
                                    </div>
                                    <div>
                                        <span class="text-success">+{{$data['calculatePercentage'](count($data['thisMonthDemande']),count($data['lastMonthDemande']))}} %</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">{{count($data['thisMonthDemande'])}}</h3>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: @if(($data['calculatePercentage'](count($data['thisMonthDemande']),count($data['lastMonthDemande']))) > 100 )100% @else {{$data['calculatePercentage'](count($data['thisMonthDemande']),count($data['lastMonthDemande']))}}% @endif;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Le mois précédent <span class="text-muted">{{count($data['lastMonthDemande'])}}</span></p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">Nouveaux formations</span>
                                    </div>
                                    <div>
                                        <span class="text-success">+{{$data['calculatePercentage'](count($data['thisMonthFormation']),count($data['lastMonthFormation']))}} %</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">{{count($data['thisMonthFormation'])}}</h3>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: @if(($data['calculatePercentage'](count($data['thisMonthFormation']),count($data['lastMonthFormation']))) > 100 )100% @else {{$data['calculatePercentage'](count($data['thisMonthFormation']),count($data['lastMonthFormation']))}}% @endif;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Le mois précédent <span class="text-muted">{{count($data['lastMonthFormation'])}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Statistics Widget -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 d-flex">
                <div class="card flex-fill dash-statistics">
                    <div class="card-body">
                        <h5 class="card-title">Votre statistics</h5>
                        <div class="stats-list">
                            <div class="stats-info">
                                <p>Demande Congé <strong>{{count(Auth::user()->demmandes->where('type',0))}}<small>/ 3</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{count(Auth::user()->demmandes->where('type',0))*33.3}}%" aria-valuenow="{{count(Auth::user()->demmandes->where('type',0))}}" aria-valuemin="0" aria-valuemax="3"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Demande Attestation de salaire<strong>{{count(Auth::user()->demmandes->where('type',1))}}<small>/ 3</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width:{{count(Auth::user()->demmandes->where('type',1))*33.3}}%" aria-valuenow="{{count(Auth::user()->demmandes->where('type',1))}}" aria-valuemin="0" aria-valuemax="3"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Demande Attestation de travail <strong>{{count(Auth::user()->demmandes->where('type',2))}} <small>/ 3</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{count(Auth::user()->demmandes->where('type',2))*33.3}}%" aria-valuenow="{{count(Auth::user()->demmandes->where('type',2))}}" aria-valuemin="0" aria-valuemax="3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Statistics Widget -->
        @if (Auth::user()->admin >= 1)
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Employées récents</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Code-som</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($data['users']->take(5) as $user)
                                    <tr>

                                        <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar"><img alt="" src="images/avatar-02.png"></a>
                                                    <a href="">{{$user->nom}} {{$user->prenom}} <span> @if ($user->departement == "HUM")
                                                        Humanities
                                                        @elseif ($user->departement == "BIO")
                                                        Biologie
                                                        @elseif ($user->departement == "PHYS")
                                                        Physique
                                                        @elseif ($user->departement == "CHIMIE")
                                                        Chemie
                                                        @elseif ($user->departement == "INFO")
                                                        Informatique
                                                        @elseif ($user->departement == "MATH")
                                                        mathematique
                                                        @else
                                                        Geologie
                                                        @endif</span></a>
                                                </h2>
                                            </td>
                                            <td>{{$user->som}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @if ($user->admin == 2)
                                                <span class="badge bg-inverse-danger">Decanat</span>
                                                @elseif ($user->admin == 1)
                                                <span class="badge bg-inverse-warning">Chef</span>
                                                @else
                                                <span class="badge bg-inverse-primary">Utilisateur</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('showUsers')}}">Voir touts les employées</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Demandes récents</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Id Demande</th>
                                            <td>Tire Demande</td>
                                            <th>Utilisateur</th>
                                            <th>Type Demande</th>
                                            <th>Duré</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data['demande']->take(7) as $demande)
                                        <tr>
                                            <td><a href="">#Dem-{{$demande->id}}</a></td>
                                            <td>
                                                <h2><a href="#">{{$demande->titre}}</a></h2>
                                            </td>
                                            <td>{{$demande->user->prenom}} {{$demande->user->nom}}</td>
                                            <td>@if ($demande->type == 0)
                                                <span class="badge bg-inverse-warning">Congé</span>
                                                @elseif($demande->type == 1)
                                                <span class="badge bg-inverse-success">Att-Salaire</span>
                                                @else
                                                <span class="badge bg-inverse-primary">Att-Travail</span>
                                            @endif</td>
                                            <td>{{(strtotime($demande->date_F)-strtotime($demande->date_D))/60/60/24,'Day'}} Jour</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('demmandeCheckCong')}}">Voir toutes les demandes</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Les formations récents</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Cadre de formation</th>
                                            <th>Le lieu</th>
                                            <th>Date Début</th>
                                            <th>Durée</th>
                                            <th>Date Fin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['formation']->take(3) as $formation )
                                            {{-- check if the user has "demmandes" and do not return "demmandes" of the same connected user--}}
                                            {{-- also check if the current user has the permession to see other "demmandes" --}}
                                            <tr>
                                                <td>{{$formation->cadreFormation}}</td>
                                                <td>{{$formation->lieu}}</td>
                                                <td>{{$formation->date_D}}</td>
                                                <td>{{(strtotime($formation->date_F)-strtotime($formation->date_D))/60/60/24,'Day'}} Jour</td>
                                                <td>{{$formation->date_F}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('VoirFormation')}}">Voir toutes les formations</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Les jours fériés</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Référence</th>
                                            <th>Date Début</th>
                                            <th>Durée</th>
                                            <th>Date Fin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['jourFeries'] as $jourFerier )
                                            {{-- check if the user has "demmandes" and do not return "demmandes" of the same connected user--}}
                                            {{-- also check if the current user has the permession to see other "demmandes" --}}
                                            <tr>
                                                <td>{{$jourFerier->reference}}</td>
                                                <td>{{$jourFerier->date_D}}</td>
                                                <td>{{(strtotime($jourFerier->date_F)-strtotime($jourFerier->date_D))/60/60/24,'Day'}} Jour</td>
                                                <td>{{$jourFerier->date_F}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('VoirJourFerier')}}">Voir touts les jours fériés</a>
                        </div>
                    </div>
                </div>
            </div>


    </div>
</div>
@endsection
