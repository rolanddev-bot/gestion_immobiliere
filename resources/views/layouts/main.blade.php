<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="" rel="icon">
    <title>Zenys Immo</title>

<style type="text/css">
.logo_zenys{border-radius:10px; width:100px}
</style>

    <link href="{{url('/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{url('/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{url('/assets/css/ruang-admin.min.css')}}" rel="stylesheet">
    <link href="{{url('/assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{url('/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<!-- Perso -->
    <link href="{{url('/css/style.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ url('js/jquery/jquery.dropdown.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ url('js/jquery/jquery.dropdown.css') }}" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript" src="{{ url('js/jquery/jquery.dropdown.js') }}"></script>
</head>



<body id="page-top" style="font-size:90%" >
    <div id="wrapper">


        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('Dashbord')}}">

                <div class="sidebar-brand-text mx-3" style="background-color: #FFF">
                <img src="{{  url('assets/img/logo_sini.png') }}" alt="" class="logo_zenys">
                </div>
            </a>


            <li class="nav-item active">
                <a class="nav-link" href="{{route('Dashbord')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Gestion locative</span></a>
            </li>

            <hr class="sidebar-divider">





<li class="nav-item">
    <a class="nav-link collapsed" href="{{ url('proprietaire')}}" aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Propriétaire</span>
    </a>
</li>


<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
		<i class="fab fa-fw fa-wpforms"></i>
		<span>Biens</span>
	</a>

	<div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">
		  <!--  <h6 class="collapse-header">Biens</h6>-->
		    <a class="collapse-item" href="{{ url('bien/1/cat') }}">Terrain</a>
			<a class="collapse-item" href="{{ url('bien/2/cat') }}"> Maison</a>
			<a class="collapse-item" href="{{ url('bien/3/cat') }}">Appartement</a>
 			<a class="collapse-item" href="{{ url('bien/4/cat') }}"> Immeuble</a>
			<a class="collapse-item" href="{{ url('bien/5/cat') }}"> Commerce</a>

		</div>
	</div>


</li>


<li class="nav-item">
	<a class="nav-link collapsed" href="{{ url('mandat') }}">
		<i class="fab fa-fw fa-wpforms"></i>
		<span>Mandat</span>
	</a>

</li>


 <li class="nav-item">
	<a class="nav-link collapsed" href="{{ url('locataire') }}" >
		<i class="fas fa-fw fa-table"></i>
		<span>Locataire</span>
	</a>

</li>


<li class="nav-item">
	<a class="nav-link collapsed" href="{{ url('location') }}" >
		<i class="fas fa-fw fa-columns"></i>
		<span>Bail</span>
	</a>

</li>



<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_etat" aria-expanded="true" aria-controls="collapsePage">
				<i class="fas fa-fw fa-columns"></i>
				<span>Etat des lieux</span>
			</a>

   <div id="menu_etat" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">

			<a class="collapse-item" href="{{ url('etat1') }}">Bailleur & Propriétaire</a>
			<a class="collapse-item" href="{{ url('etat') }}">Bailleur & Locataire </a>

		</div>
	</div>

</li>



<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_loyer" aria-expanded="true" aria-controls="collapsePage">
				<i class="fas fa-fw fa-columns"></i>
				<span>Loyer</span>
			</a>

   <div id="menu_loyer" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">

			<a class="collapse-item" href="{{ url('facture') }}">Avis d'échéance</a>
			<a class="collapse-item" href="{{ url('reglement') }}">Reçu</a>
			<a class="collapse-item" href="{{ url('quittance') }}">Quittance</a>
			<a class="collapse-item" href="{{ url('relance') }}">Relance</a>
		</div>
	</div>

</li>




 <li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_facturation" aria-expanded="true" aria-controls="collapsePage">
		<i class="fas fa-fw fa-columns"></i>
		<span>Facturation</span>
	</a>
	<div id="menu_facturation" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">

			<a class="collapse-item" href="{{ route('reversement') }}">Reversement</a>
			<a class="collapse-item" href="{{ url('honoraire') }}">Facture</a>
		</div>
	</div>
</li>



<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_archive" aria-expanded="true" aria-controls="collapsePage">
		<i class="fas fa-fw fa-columns"></i>
		<span>Archive</span>
	</a>

	<div id="menu_archive" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">

			<a class="collapse-item" href="{{ url('proprietaire-archive') }}">Propriétaire</a>


			<a class="collapse-item" href="{{ url('bien-archive')}}">Bien</a>

			<a class="collapse-item" href="{{ url('mandat-archive')}}">Mandat</a>

			<a class="collapse-item" href="{{ url('locataire-archive')}}">Locataire</a>

			<a class="collapse-item" href="{{ url('location-archive')}}">Bail</a>

			<a class="collapse-item" href="{{ url('etat-archive')}}">Etat des lieux</a>

			<a class="collapse-item" href="{{ url('loyer-archive')}}">Loyer</a>

			<a class="collapse-item" href="{{ url('facturation-archive')}}">Facturation</a>


		</div>
	</div>

</li>


		   <li class="nav-item">
				<a class="nav-link collapsed" href="{{ url('rapport') }}" data-toggle="collapse" data-target="#" aria-expanded="true" aria-controls="collapsePage">
					<i class="fas fa-fw fa-columns"></i>
					<span>Rapport</span>
				</a>
            </li>

















<!-- TRANSACTIONS -- <hr class="sidebar-divider">-->



<li class="nav-item active ">
	<a class="nav-link" href="{{route('Dashbord')}}">
		<i class="fas fa-fw fa-tachometer-alt"></i>
		<span>Transaction</span></a>

</li>

<hr class="sidebar-divider">


<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_achat" aria-expanded="true" aria controls="collapsePage">
	<i class="fas fa-fw fa-columns"></i>
		<span>Achat</span>
	</a>

	<div id="menu_achat" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">

			<a class="collapse-item" href="{{route('acquereur')}}">Acquéreur</a>
			<a class="collapse-item" href="{{route('besoin')}}">Besoin</a>
			<a class="collapse-item" href="{{route('budget')}}">Budget</a>

		</div>
			<hr>
	</div>

</li>


  <li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_vente" aria-expanded="true" aria controls="collapsePage">
	<i class="fas fa-fw fa-columns"></i>
		<span>Vente</span>
	</a>

	<div id="menu_vente" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
		<div class="bg-white py-2 collapse-inner rounded">


			<a class="collapse-item" href="{{route('proprietaire_vente')}}">Propriétaire</a>
            <a class="collapse-item" href="{{route('bien_vente')}}">Bien</a>
            <a class="collapse-item" href="{{route('mandat_vente')}}">Mandat</a>
            <a class="collapse-item" href="{{route('mandat')}}">Estimation</a>
			<a class="collapse-item" href="{{route('mandat')}}">Prix de vente</a>
			<a class="collapse-item" href="{{route('mandat')}}">Facturation</a>
		</div>
			<hr>
	</div>

</li>








            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParametre" aria-expanded="true" aria-controls="collapsePage">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Paramètrage</span>
                </a>
                <div id="collapseParametre" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                </a>


                        <a class="collapse-item" href="{{ url('user')}}">Utilisateurs</a>
                        <a class="collapse-item" href="{{ url('banque')}}">Banque & Mode</a>
                        <a class="collapse-item" href="{{ url('agence')}}">Agence</a>
                        <a class="collapse-item" href="{{ url('charge')}}">Charge</a>

                    </div>
                        <hr>
                </div>

            </li>



         <!--   <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecont" aria-expanded="true" aria-controls="collapsePage">
                    <i class="fas fa-fw fa-columns"></i>
                    <span>Contrat</span>
                </a>
                <div id="collapsecont" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="login.html">Contrat</a>
                        <a class="collapse-item" href="register.html">Etat des Lieux</a>
                    </div>
                </div>
            </li> -->





















            <hr class="sidebar-divider">
            <b><div class="version" id="version-ruangadmin"></div></b>
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

                    <ul class="navbar-nav ml-auto">




                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="{{url('/assets/connexion/images/icons/connexion.png')}}" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small"> {{ Auth::user()->name}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Paramètres
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Deconnexion
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->


                    @yield('content')

                <!-- Container Fluid-->

                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright©  <script> document.write(new Date().getFullYear()); </script> - Développé par
              <b><a href="http://enical-technologies.com/" target="_blank">ENICAL TECHNOLOGIES</a></b>
            </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{url('/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{url('/assets/js/ruang-admin.min.js')}}"></script>
    <script src="{{url('/assets/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{url('/assets/js/demo/chart-area-demo.js')}}"></script>

    <script src="{{url('/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>


    <script type="text/javascript" src="{{url('/assets/messcripts/dashboard.js')}}"></script>
    <script type="text/javascript" src="{{url('/assets/messcripts/proprietaire.js')}}"></script>
    <script type="text/javascript" src="{{url('/assets/messcripts/locataire.js')}}"></script>
    <script type="text/javascript" src="{{url('/assets/messcripts/biens.js')}}"></script>
    <script type="text/javascript" src="{{url('/assets/messcripts/vente.js')}}"></script>
    <script type="text/javascript" src="{{url('/assets/messcripts/location.js')}}"></script>
    <script type="text/javascript" src="{{url('/assets/messcripts/mandat.js')}}"></script>
    <script type="text/javascript" src="{{url('/assets/messcripts/details_bien.js')}}"></script>
    <script type="text/javascript" src="{{url('/assets/messcripts/details_bien.js')}}"></script>
    <script type="text/javascript" src="{{url('/assets/messcripts/partie1.js')}}"></script>


    <script type="text/javascript" src="{{url('/assets/messcripts/select2.min.js')}}"></script>

</body>

</html>
