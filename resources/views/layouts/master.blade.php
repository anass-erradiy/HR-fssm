<!DOCTYPE html>
<html lang="fr">
    <head>
        @yield('css')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>@yield('title')</title>

		<!-- Datatable CSS -->
		<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">


		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/css/select2.min.css">

		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="images/logo/logo.png">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets/css/line-awesome.min.css">

		<!-- Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">



         {{-- start assets1 --}}
        {{-- <!-- Favicon -->
        <link rel="icon" href="{{URL::asset('assets1/img/brand/favicon.png')}}" type="image/x-icon"/>
        <!-- Icons css --> --}}
        {{-- <link href="{{URL::asset('assets1/css/icons.css')}}" rel="stylesheet"> --}}
        <!---Skinmodes css-->
        <link href="{{URL::asset('assets1/css-rtl/skin-modes.css')}}" rel="stylesheet">
        {{-- end assets1 --}}
		{{-- <link rel="stylesheet" href="https://kit.fontawesome.com/6fcae89691.css" crossorigin="anonymous"> --}}
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
	<body class="main-body app sidebar-mini">
        <div class="main-wrapper">

			<!-- Header -->
            <div class="header">

				<!-- Logo -->
                <div class="header-left">
                    <a href="/home" class="logo">
						<img src="assets/img/logo.png" width="40" height="40" alt="">
					</a>
                </div>
				<!-- /Logo -->

				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>

				<!-- Header Title -->
                <div class="page-title-box">
					<h3>FSSM Ressources Humaines </h3>
                </div>
				<!-- /Header Title -->

				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

				<!-- Header Menu -->
				<ul class="nav user-menu">
					<!-- Flag -->
					<li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
							<img src="assets/img/flags/fr.png" alt="" height="20"> <span>Francais</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets/img/flags/fr.png" alt="" height="16"> Francais
							</a>
						</div>
					</li>
					<!-- /Flag -->
					<!-- Notifications -->
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            @if (auth()->user()->unreadNotifications->count())
							<span class="badge badge-pil">{{auth()->user()->unreadNotifications->count()}}</span>
                            @endif
						</a>
                        @if (auth()->user()->unreadNotifications->count())
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="{{route('markAllAsRead')}}" class="clear-noti"> Tout effacer </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                        <li class="notification-message">
                                                    <a href="{{route($notification->data['routeName'],$notification->id)}}">
                                                <div class="media">
                                                    <span class="avatar">
                                                        <img alt="" src="{{asset($notification->data['imagePath'])}}" height="40px">
                                                    </span>
                                                    <div class="media-body">
                                                            <p class="noti-details"><span class="noti-title">{{$notification->data['userName']}}</span>
                                                                    {{$notification->data['body']}}
                                                                <span class="noti-title">Appuyez pour voir les détails</span></p>
                                                        <p class="noti-time"><span class="notification-time">{{$notification->created_at}}</span></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="">Votre notifications</a>
							</div>
						</div>
                        @else
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<div class="media-body">
													<h3 class="noti-details"><span class="noti-title"></span> Vous n'avez pas des notifications</h3>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="">Accune notifications</a>
							</div>
						</div>
                        @endif
					</li>
					<!-- /Notifications -->

					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            @if(!isset(auth()->user()->image->first()->path))
							<span class="user-img"><img src="{{asset('images/avatar-02.png')}}" alt="">
                            @else
							<span class="user-img"><img height="31px" src="{{asset(auth()->user()->image->first()->path)}}" alt="">
                            @endif
							<span class="status online"></span></span>
							<span>{{Auth::user()->nom}}</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="/profile"><i class="fa fa-user m-r-5"></i> Mon profile</a>
							<a class="dropdown-item" href="{{route('settings')}}"><i class="fa fa-gear m-r-5"></i>Paramètre</a>
							<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="la la-lock"></i>
                                        {{ __('Se deconnecter') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->

				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="/profile"><i class="fa fa-user m-r-5"></i> Mon profile</a>
						<a class="dropdown-item" href="{{route('settings')}}"><i class="fa fa-gear m-r-5"></i> Paramètre</a>
						<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="la la-lock"></i>
                                        {{ __('deconnecter') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
					</div>
				</div>
				<!-- /Mobile Menu -->

            </div>
			<!-- /Header -->

			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title">
                                @if (Auth::user()->admin == 0)
								<strong>Page d'accueil</strong>
                                @else
								<strong>Tableau De Board</strong>
                                @endif
							</li>
                            <li>
                                @if (Auth::user()->admin == 0)
                                <a href="/home"><i class="la la-home"></i> <span>Accueil </span> </a>
                                @else
                                <a href="/home"><i class="la la-dashboard"></i> <span>Le tableau de board </span> </a>
                                @endif
							</li>

								{{-- <a href="{{route('home')}}"><i class="la la-dashboard"></i> <span>Le tableau de board </span> </a> --}}
							<li class="menu-title">
								<strong>Demmande</strong>
							</li>
							<li class="submenu">
								<a href="#"><i class="la la-plus"></i> <span> Crée une demande </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('créeDemmandeCong')}}">Demmande de congé </a></li>
									<li><a href="{{route('créeDemmandeSal')}}">Attestation de salaire</a></li>
									<li><a href="{{route('créeDemmandeTrav')}}">Attestation de travail</a></li>
								</ul>
							</li>
                            <li class="submenu">
								<a href="#"><i class="la la-file-text"></i><span>Mes demmandes</span><span class="menu-arrow"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="{{route('demmandeCong')}}">Demmandes de congée</a></li>
                                            <li><a href="{{route('demmandeSal')}}">Attestations de salaire</a></li>
                                            <li><a href="{{route('demmandeTrav')}}"> Attestation de travail</a></li>
                                        </ul>
                            </li>
                            @if (Auth::user()->admin >= 1)
							<li class="menu-title">
								<span><strong>Administration</strong></span>
							</li>
                            @if (Auth::user()->admin == 1)
                            <li class="submenu">
                                <a href="#"><i class="la la-check"></i><span>Les demmandes</span><span class="menu-arrow"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="{{route('demmandeCheckCong')}}">Demmandes de congée</a></li>
                                            <li><a href="{{route('demmandeCheckSal')}}">Attestations de salaire</a></li>
                                            <li><a href="{{route('demmandeCheckTrav')}}"> Attestation de travail</a></li>
                                        </ul>
                            </li>
                            @endif
							<li class="submenu">
								<a href="#"><i class="la la-users"></i> <span> Les utilisateurs </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('showUsers')}}">La list des utilisateurs </a></li>
									<li><a href="{{route('register')}}"> Ajouter des utilisateurs </a></li>
									<li><a href="{{route('deletedUsers')}}">Les utilisatures désactiver </a></li>
								</ul>
							</li>
                            <li class="submenu">
								<a href="#"><i class="la la-bullhorn"></i> <span> Les annonces </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('AjouterAnnonce')}}">Ajouter une annonce </a></li>
									<li><a href="{{route('VoirAnnoce')}}">Voir Modifier les annonces</a></li>
								</ul>
							</li>
                            <li class="submenu">
								<a href="#"><i class="la la-calendar"></i> <span> Les jours fériés </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('AjouterJourFerier')}}">Ajouter jour férié </a></li>
									<li><a href="{{route('VoirJourFerier')}}">Voir Modifier jours firiers</a></li>
								</ul>
							</li>
                            <li class="submenu">
								<a href="#"><i class="la la-graduation-cap"></i> <span>Les formations </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('AjouterFormation')}}">Ajouter une formation </a></li>
									<li><a href="{{route('VoirFormation')}}">Voir Modifier formations</a></li>
								</ul>
							</li>
                            @endif
                            @if (Auth::user()->admin == 0)
                                <li class="menu-title">
                                    <span><strong>Événements</strong></span>
                                </li>
                                <li >
                                    <a href="{{route('VoirAnnoce')}}"><i class="la la-bullhorn"></i> <span> Les annonces </span></a>
                                </li>
                                <li >
                                    <a href="{{route('VoirJourFerier')}}"><i class="la la-calendar"></i> <span> Les jours fériés </span></a>
                                </li>
                                <li>
                                    <a href="{{route('VoirFormation')}}"><i class="la la-graduation-cap"></i> <span>Les formations </span></a>
                                </li>
                            @endif

							<li class="menu-title">
								<span><strong>Sécurité</strong> </span>
							</li>
                            <li>
								<a href="{{route('settings')}}"><i class="la la-gear"></i> <span>Paramètre</span></a>
							</li>
							<li class="menu-title">
								<span><strong>Mes informations</strong></span>
							</li>
							<li >
								<a href="{{route('showProfile')}}"><i class="la la-user"></i> <span>Le profile </span></a>
							</li>
                            _______________________________
							<li>
								<a class="fssm-hr-app" href="javascript:void(0);"><i class="la la-info"></i> <span>FSSM-HR-APP</span> <span class="badge badge-primary ml-auto ">v1.0</span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
			<!-- Page Wrapper -->
            @yield('content')
        </div>
	</body>
    @yield('js')


            <!-- Chart JS -->
            <script src="assets/plugins/morris/morris.min.js"></script>
            <script src="assets/plugins/raphael/raphael.min.js"></script>
            <script src="assets/js/chart.js"></script>

            <!-- Custom JS -->
            <script src="assets/js/app.js"></script>

            <!-- jQuery -->
            <script src="assets/js/jquery-3.5.1.min.js"></script>

            <!-- Bootstrap Core JS -->
            <script src="assets/js/popper.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>

            <!-- Slimscroll JS -->
            <script src="assets/js/jquery.slimscroll.min.js"></script>

            <!-- Select2 JS -->
            <script src="assets/js/select2.min.js"></script>

            <!-- Datetimepicker JS -->
            <script src="assets/js/moment.min.js"></script>
            <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

            <!-- Tagsinput JS -->
            <script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

            <!-- Custom JS -->
            <script src="assets/js/app.js"></script>

            {{-- 9999999999999999999 --}}

            <!-- Datatable JS -->
            <script src="assets/js/jquery.dataTables.min.js"></script>
            <script src="assets/js/dataTables.bootstrap4.min.js"></script>

            {{-- dsfasdfasdfasdf --}}
</html>
