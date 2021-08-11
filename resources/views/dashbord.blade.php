@extends('layouts.main')

@section('content')


<div class="container-fluid" id="container-wrapper" style="">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Accueill</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tableau de bord</li>
                            </ol>
                      </div>
                        

@if($fact_nb_gle>0)
     <div class="alert alert-danger alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
     
 <p>Il y  a <a href="#"class="" data-toggle="modal" 
data-target="#modalEtatEntrant" style="color: #fff">{{ $fact_nb_gle }} avis d'échéance</a>  en attentes.</p>
   
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    
    </div>            
@endif

<p></p>

<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-center" style="font-size:20px;">PROPRIETAIRE</div><br>
                        <div class=" mb-0 font-weight-bold text-gray-800"><a href="" class="text-success">Actif: {{ $proprietaire_nba }}</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="" class="text-warning text-right">Inactif: {{ $proprietaire_nbi }}</a> </div>


                    </div>
                    <!-- <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>-->
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-center" style="font-size:20px;">LOCATAIRES </div><br>
                        <div class=" mb-0 font-weight-bold text-gray-800"><a href="" class="text-success">Actif: {{ $locataire_nba }}</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="" class="text-warning text-right">Inactif: {{ $locataire_nbi }}</a> </div>


                    </div>
                    <!-- <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
                            <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-center" style="font-size:20px;">CONTRATS</div><br>
                        <div class=" mb-0 font-weight-bold text-gray-800"><a href="" class="text-success">Actif: {{ $contrat_nba }}</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="" class="text-warning text-right">Inactif: {{ $contrat_nbi }}</a> </div>


                    </div>
                    <!-- <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>-->
                </div>
            </div>
        </div>
    </div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1 text-center" style="font-size:20px;">BIENS</div><br>
                    <div class="mb-0 font-weight-bold text-gray-800"><a href="" class="text-success">Actif: {{ $bien_nba }}</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="" class="text-warning text-right">Inactif: {{ $bien_nbi }}</a> </div>


                </div>
            </div>
        </div>
    </div>
</div>




                            <!-- Message From Customer-->

                        </div>

<br>


<p align="center" style="font-size:px;"><img src="{{  url('assets/img/logo_sini.png') }}" style="width: 35%" alt="" class=""></p>


                    </div>






@endsection



