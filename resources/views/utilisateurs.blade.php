@extends('layouts.master')
@section('title')
    Les utilisateur
@endsection
@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
            @if (session()->get('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                        <a href="{{ route('register') }}" class="btn add-btn"><i class="fa fa-plus"></i> Ajoutée des
                            utilisateurs</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" id="searchInput">
                    <label class="focus-label">Rechercher...</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Utilisateur</th>
                                    <th>Som</th>
                                    <th>CIN</th>
                                    <th>Département</th>
                                    <th>Email</th>
                                    <th>Numero </th>
                                    <th>Anniversaire</th>
                                    <th>Role</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if (Auth::user()->id != $user->id)
                                        <tr>
                                            <td>EMP-{{ $user->id }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#show_user{{ $user->id }}" class="avatar">
                                                        @if (!count($user->image))
                                                            <img src="{{ asset('images/avatar-02.png') }}" height="40px"
                                                                alt="">
                                                        @else
                                                            <img src="{{ asset($user->image[0]->path) }}" height="40px"
                                                                alt="">
                                                        @endif
                                                    </a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#show_user{{ $user->id }}">{{ $user->nom }}
                                                        {{ $user->prenom }} <span>{{ $user->sex }}</span></a>
                                                </h2>
                                            </td>
                                            <td>{{ $user->som }}</td>
                                            <td>{{ $user->cin }}</td>
                                            <td>
                                                @if ($user->departement == 'HUM')
                                                    <a href="">Humanities</a>
                                                @elseif ($user->departement == 'BIO')
                                                    <a href="">Biologie </a>
                                                @elseif ($user->departement == 'PHYS')
                                                    <a href="">Physique</a>
                                                @elseif ($user->departement == 'CHIMIE')
                                                    <a href="">Chemie</a>
                                                @elseif ($user->departement == 'INFO')
                                                    <a href="">Informatique</a>
                                                @elseif ($user->departement == 'MATH')
                                                    <a href="">mathematique</a>
                                                @else
                                                    <a href="">Geologie </a>
                                                @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->number)
                                                    {{ $user->number }}
                                                @else
                                                    --------------
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->birthday)
                                                    {{ $user->birthday }}
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
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#edit_user{{ $user->id }}"><i
                                                                class="fa fa-pencil m-r-5"></i> Modifier</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#delete_user{{ $user->id }}"><i
                                                                class="fa fa-times-circle-o m-r-5"></i> Désactiver </a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#restor_user{{ $user->id }}"><i
                                                                class="fa fa-share m-r-5"></i> réinitialiser</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div id="edit_user{{ $user->id }}" class="modal custom-modal fade"
                                            role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modifier l'utilisateur</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('editUser', $user->id) }}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-sm-12 ">
                                                                    <div class="form-group justify-content-center">
                                                                        <label>Employee ID <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text"
                                                                            value="EMP-{{ $user->id }}" disabled
                                                                            class="form-control floating">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Code-Som <span
                                                                                class="text-danger">*</span></label>
                                                                        <input class="form-control"
                                                                            value="{{ $user->som }}" required
                                                                            type="text" name="som">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>CIN <span
                                                                                class="text-danger">*</span></label>
                                                                        <input class="form-control"
                                                                            value="{{ $user->cin }}" required
                                                                            type="text" name="cin">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Prenom <span
                                                                                class="text-danger">*</span></label>
                                                                        <input class="form-control"
                                                                            value="{{ $user->prenom }}" type="text"
                                                                            name="prenom">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Nom <span
                                                                                class="text-danger">*</span></label>
                                                                        <input class="form-control"
                                                                            value="{{ $user->nom }}" type="text"
                                                                            name="nom">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Le role <span
                                                                                class="text-danger">*</span></label><br>
                                                                        <select class="select" name="admin">
                                                                            @if (Auth::user()->admin == 2)
                                                                                <option
                                                                                    @if ($user->admin == 0) selected @endif
                                                                                    value="0">Utilisateur</option>
                                                                                <option
                                                                                    @if ($user->admin == 1) selected @endif
                                                                                    value="1">Chef</option>
                                                                                <option
                                                                                    @if ($user->admin == 2) selected @endif
                                                                                    value="2">Decanat</option>
                                                                            @else
                                                                                <option
                                                                                    @if ($user->admin == 0) selected @endif
                                                                                    value="0">Utilisateur</option>
                                                                                <option
                                                                                    @if ($user->admin == 1) selected @endif
                                                                                    value="1">Chef</option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Email <span
                                                                                class="text-danger">*</span></label>
                                                                        <input
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            value="{{ $user->email }}" type="email"
                                                                            name="email" required>
                                                                        @error('email')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <label>Département</label>
                                                                <select name="departement" class="form-control"
                                                                    id="">
                                                                    <option class="text-align-center"
                                                                        @if ($user->departement == 'MATH') slected @endif
                                                                        value="MATH">Mathématique</option>
                                                                    <option class="text-align-center"
                                                                        @if ($user->departement == 'GEO') slected @endif
                                                                        value="GEO">Géologie</option>
                                                                    <option class="text-align-center"
                                                                        @if ($user->departement == 'INFO') slected @endif
                                                                        value="INFO">Informatique</option>
                                                                    <option class="text-align-center"
                                                                        @if ($user->departement == 'CHIMIE') slected @endif
                                                                        value="CHIMIE">Chémie</option>
                                                                    <option class="text-align-center"
                                                                        @if ($user->departement == 'PHYS') slected @endif
                                                                        value="PHYS">Physique</option>
                                                                    <option class="text-align-center"
                                                                        @if ($user->departement == 'BIO') slected @endif
                                                                        value="BIO">Biologie</option>
                                                                    <option class="text-align-center"
                                                                        @if ($user->departement == 'HUM') slected @endif
                                                                        value="HUM">Humanitiés</option>
                                                                </select>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Adress </label>
                                                                        <input class="form-control"
                                                                            value="{{ $user->adress }}" type="text"
                                                                            name="adress">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>numero de telephone </label>
                                                                        <input class="form-control"
                                                                            value="{{ $user->number }}" type="text"
                                                                            name="number">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Date d'anniversaire </label>
                                                                        <input class="form-control"
                                                                            value="{{ $user->birthday }}" type="date"
                                                                            name="birthday">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Code postal</label>
                                                                        <input class="form-control"
                                                                            value="{{ $user->postalCode }}"
                                                                            type="text" name="postalCode">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="submit-section">
                                                                <button class="btn btn-primary submit-btn"
                                                                    type="submit">Modifier</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="show_user{{ $user->id }}" class="modal custom-modal fade"
                                            role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Informations d'utilisateur
                                                            <strong>{{ strtoupper($user->prenom) }}</strong></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="profile-img-wrap edit-img">
                                                                @if (!count($user->image))
                                                                    <img src="{{ asset('images/avatar-02.png') }}"
                                                                        height="40px" alt="">
                                                                @else
                                                                    <img src="{{ asset($user->image[0]->path) }}"
                                                                        height="40px" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-sm-12 ">
                                                                <div class="form-group justify-content-center">
                                                                    <label>Employee ID</label>
                                                                    <input type="text" value="EMP-{{ $user->id }}"
                                                                        disabled class="form-control floating">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Code-som</label>
                                                                    <input class="form-control" disabled
                                                                        value="{{ $user->som }}" type="text"
                                                                        name="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>CIN</label>
                                                                    <input class="form-control" disabled
                                                                        value="{{ $user->cin }}" type="text"
                                                                        name="cin">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Prenom</label>
                                                                    <input class="form-control" disabled
                                                                        value="{{ $user->prenom }}" type="text"
                                                                        name="prenom">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Nom</label>
                                                                    <input class="form-control" disabled
                                                                        value="{{ $user->nom }}" type="text"
                                                                        name="nom">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Le role</label><br>
                                                                    <select class="select" disabled>
                                                                        @if (Auth::user()->admin == 2)
                                                                            <option
                                                                                @if ($user->admin == 0) selected @endif
                                                                                value="0">Utilisateur</option>
                                                                            <option
                                                                                @if ($user->admin == 1) selected @endif
                                                                                value="1">Chef</option>
                                                                            <option
                                                                                @if ($user->admin == 2) selected @endif
                                                                                value="2">Decanat</option>
                                                                        @else
                                                                            <option
                                                                                @if ($user->admin == 0) selected @endif
                                                                                value="0">Utilisateur</option>
                                                                            <option
                                                                                @if ($user->admin == 1) selected @endif
                                                                                value="1">Chef</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        disabled value="{{ $user->email }}"
                                                                        type="email" name="email" required>
                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 justify-content-center">
                                                                <div class="form-group">
                                                                    <label>Département</label>
                                                                    <select name="departement" class="form-control"
                                                                        disabled id="">
                                                                        <option class="text-align-center"
                                                                            @if ($user->departement == 'MATH') slected @endif>
                                                                            Mathématique</option>
                                                                        <option class="text-align-center"
                                                                            @if ($user->departement == 'GEO') slected @endif>
                                                                            Géologie</option>
                                                                        <option class="text-align-center"
                                                                            @if ($user->departement == 'INFO') slected @endif>
                                                                            Informatique</option>
                                                                        <option class="text-align-center"
                                                                            @if ($user->departement == 'CHIMIE') slected @endif>
                                                                            Chémie</option>
                                                                        <option class="text-align-center"
                                                                            @if ($user->departement == 'PHYS') slected @endif>
                                                                            Physique</option>
                                                                        <option class="text-align-center"
                                                                            @if ($user->departement == 'BIO') slected @endif>
                                                                            Biologie</option>
                                                                        <option class="text-align-center"
                                                                            @if ($user->departement == 'HUM') slected @endif>
                                                                            Humanitiés</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Adress </label>
                                                                    <input class="form-control"
                                                                        value="{{ $user->adress }}" type="text"
                                                                        disabled name="adress">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>numero de telephone </label>
                                                                    <input class="form-control"
                                                                        value="{{ $user->number }}" type="text"
                                                                        disabled name="number">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Date d'anniversaire </label>
                                                                    <input class="form-control"
                                                                        value="{{ $user->birthday }}" type="date"
                                                                        disabled name="birthday">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Code postal</label>
                                                                    <input class="form-control"
                                                                        value="{{ $user->postalCode }}" type="text"
                                                                        disabled name="postalCode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Edit User Modal -->

                                        <!-- Delete User Modal -->
                                        <div class="modal custom-modal fade" id="delete_user{{ $user->id }}"
                                            role="dialog">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="form-header">
                                                            <h3>Désactiver l'utilisateur</h3>
                                                            <p>Voulez-vous vraiment Désactiver ?</p>
                                                        </div>
                                                        <div class="modal-btn delete-action">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <a href="{{ route('deleteUser', $user->id) }}"
                                                                        class="btn btn-primary continue-btn">Désactiver</a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <a href="javascript:void(0);" data-dismiss="modal"
                                                                        class="btn btn-primary cancel-btn">Annuler</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal custom-modal fade" id="restor_user{{ $user->id }}"
                                            role="dialog">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="form-header">
                                                            <h3>Réinitialiser le mot de pass</h3>
                                                            <p>Voulez-vous vraiment réinitialiser le mot de pass
                                                                d'utilisateur ?</p>
                                                        </div>
                                                        <div class="modal-btn delete-action">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <a href="{{ route('resetUserPass', $user->id) }}"
                                                                        class="btn btn-primary continue-btn">Réinitialiser</a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <a href="javascript:void(0);" data-dismiss="modal"
                                                                        class="btn btn-primary cancel-btn">Annuler</a>
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
            <script>
                // Get the input field and table
                console.log('hhhh')
                const input = document.getElementById("searchInput");
                const table = document.getElementById("myTable");

                // Add an event listener to the input field
                input.addEventListener("keyup", function() {
                    // Declare variables to be used
                    let filter = input.value.toUpperCase();
                    let tbody = table.getElementsByTagName("tbody")[0];
                    let tr = tbody.getElementsByTagName("tr");

                    // Loop through all table rows and hide those that don't match the search query
                    for (let i = 0; i < tr.length; i++) {
                        let td = tr[i].getElementsByTagName("td");
                        let match = false;
                        for (let j = 0; j < td.length; j++) {
                            let txtValue = td[j].textContent || td[j].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                match = true;
                                break;
                            }
                        }
                        if (match) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                });
            </script>
        </div>
        <!-- /Page Content -->
        <!-- Edit User Modal -->

        <!-- /Delete User Modal -->
    </div>
@endsection
