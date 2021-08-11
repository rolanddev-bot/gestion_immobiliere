@extends('layouts.main')
@section('content')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">

    <div class="col-lg-12">

    <h2  @if($besoin->archiver == 1) class="text-center alert " style="background-color:darksalmon" @else class="text-center alert alert-secondary" @endif>Besoin  @if($besoin->archiver == 1) archivé @endif - Détail </h2>

              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

				 @if(session()->has('ok'))
        <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
        {!! session('ok') !!}
        </div>
    @endif


<p>
   <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a> |
   <a href="{{ url('besoin')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
   |
   <a href="{{ route('besoin_edit',['id'=>$besoin->id]) }}" class=""><i class="fas fa-fw fa-edit" style="font-size:15px"></i>Editer</a>
</p>


                </div>
                <div class="table-responsive p-3">

                <h4 class="" style="background-color: #CCC; text-align:center">Besoin</h4>
 <div class="row">

    <div class="col-md-4">
    <br>
        Type bien: &nbsp;  <span class="text-primary"><strong> {{ $besoin->typebien->libelle }} </strong></span><br>
        libellé :  &nbsp;<span class="text-primary"> {{ $besoin->libelle }}</span><br>
        Nombre piéce(s) :  &nbsp;<span class="text-primary">{{ $besoin->nbre_piece }}</span><br>

    </div>
    <div class="col-md-4">
    <br>
    Délai d'acquisition :  &nbsp;<span class="text-primary">{{ date('d/m/Y',strtotime($besoin->delai_acquisition)) }}</span><br>
    Adresse :  &nbsp;<span class="text-primary">{{ $besoin->adresse }}</span><br>
    Détail :  &nbsp;<span class="text-primary">{{ $besoin->detail }}</span><br>
    </div>

</div>



</div>



@endsection
