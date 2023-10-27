@extends('layouts.master')
@section('css')
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
Demmande attestation de salaire
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
                        <a href="{{route('créeDemmandeSal')}}" class="btn add-btn"><i class="fa fa-plus"></i>Crée une demmande att-salaire</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    @if (!count($data))
                        <h2>Vous n'avez pas des demmandes</h2>
                    @else
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Type demande</th>
                                <th>Date de début</th>
                                <th>Le délai</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item )
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->titre}}</td>
                                <td>Att-Salaire</td>
                                <td>{{$item->date_D}}</td>
                                <td>{{(strtotime($item->date_F)-strtotime($item->date_D))/60/60/24,'Day'}} Jour</td>
                                <td>@if ($item->status == 0)
                                    <a href="" data-target="#status_info{{$item->id}}" data-toggle="modal"><span class="badge bg-inverse-warning">Envoyée</span></a>
                                    @elseif ($item->status == 1)
                                    <a href="" data-target="#status_info{{$item->id}}" data-toggle="modal"><span class="badge bg-inverse-success">Accepter</span></a>
                                    @else
                                    <a href="" data-target="#status_info{{$item->id}}" data-toggle="modal"><span class="badge bg-inverse-danger">Reffuser</span></a>
                                @endif</td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                                @if (!$item->status)
                                                <a class="dropdown-item" href="" data-target="#demmande_info{{$item->id}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i>Modifier</a>
                                                @else
                                                <a class="dropdown-item" href="" data-target="#demmande_info{{$item->id}}" data-toggle="modal"><i class="fa fa-eye m-r-5"></i>Voir detials</a>
                                                @endif
                                                </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div id="demmande_info{{$item->id}}" class="modal custom-modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Informations de demmande</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('aupdateDemmande',$item->id)}}" method="POST">
                                                @method('post')
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Titre de demmande</label>
                                                        <input type="text" class="form-control" @if($item->status) disabled @endif value="{{$item->titre}}" name="titre">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea  class="form-control" @if($item->status) disabled @endif  name="description">{{$item->description}}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Type de demmande</label>
                                                        <select  class="form-control" disabled name="type">
                                                            <option value="1" selected>Salaire</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date de debut</label><br>
                                                        <input type="date" class="form-control" @if($item->status) disabled @endif  value="{{$item->date_D}}" name="date_D">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Date de fin</label><br>
                                                        <input type="date" class="form-control" @if($item->status) disabled @endif  value="{{$item->date_F}}" name="date_F">
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($item->status)
                                            <div class="text-right">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">D'accord</span>
                                            </button>
                                            </div>
                                            @else
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary">Mettre a jour</button>
                                            </div>
                                            @endif
                                            </form>
                                        </div>
                            </div>
                                </div>
                            </div>
                            <div id="status_info{{$item->id}}" class="modal custom-modal fade" role="dialog">
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
                                                        <input type="text" class="form-control" disabled value="{{$item->titre_reponse}}" name="titre">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Justification</label>
                                                        <textarea  class="form-control" name="description" disabled >{{$item->justification}}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select  class="form-control" name="status" disabled>
                                                            @if ($item->status)
                                                                @if ($item->status == 1)
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
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->

@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection
