@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">



    <div class="col-lg-12">
    <h2  @if($prop->archiver == 1) class="text-center alert " style="background-color:darksalmon" @else class="text-center alert alert-secondary" @endif>Propriétaire @if($prop->archiver == 1) archivé @endif - Détail </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

 <p>
   <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a> |
   <a href="{{ route('proprietaire_vente')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
   |
   <a href="{{route('proprietaire_v_edit',['id'=> $prop->id])}}" class=""><i class="fas fa-fw fa-edit" style="font-size:15px"></i>Editer</a>
</p>

@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif

                </div>
                <div class="table-responsive p-3">


<p align="center">
   @if($prop->photo != 'aucun')
        <img width="100" class="" height="100" src="{{ url('/assets/dossier/'.$prop->photo) }}" class="img-thumbnail">
    @else
        <img width="100" class="" height="100" src="{{ url('/assets/img/avatar.png') }}" class="img-thumbnail">
    @endif
 </p>


 <div class="row">



    <div class="col-md-4">
        <p class="" style="background-color: #CCC">Personne physique</p>

        Proprietaire:  <span class="text-primary">{{ $prop->nom.' '.$prop->prenom}}</span><br>
        Type:  <span class="text-primary">{{ $prop->type_proprietaire }}</span><br>
        Mobile:  <span class="text-primary">{{ $prop->mobile1.' '.$prop->mobile2}}</span><br>
        Adresse:  <span class="text-primary">{{ $prop->adresse}} </span><br>
        N° pièce:  <span class="text-primary">{{ $prop->numero_piece  }}</span><br>
        Type pièce:  <span class="text-primary">{{ $prop->type_piece }}</span><br>
        Date naissance:  <span class="text-primary">{{ date('d/m/Y', strtotime($prop->date_naissance))  }}</span><br>
        Civilité:  <span class="text-primary">{{ $prop->sexe  }}</span><br>
        Email:  <span class="text-primary">{{ $prop->emailto  }}</span><br>

    </div>

   @if($prop->type_proprietaire == 'personne morale')
    <div class="col-md-4">
    	<p class="" style="background-color: #CCC">Personne morale</p>
        Nom :  <span class="text-primary">{{ $prop->nom_societe  }}</span><br>
        N° RCCM :  <span class="text-primary">{{ $prop->numero_registre  }}</span><br>
        Pj RCCM :  <span class="text-primary">{{ $prop->nom_societe  }}</span><br>
        N°CC :  <span class="text-primary">{{ $prop->compte_contribuable  }}</span><br>
        N° compte bancaire :  <span class="text-primary">
        @if($prop->compte_bancaire =='') Aucun @else
        	{{ $prop->compte_bancaire.' ('.$prop->banque->libelle.') '  }}
        @endif
        </span><br>
        Téléphone :  <span class="text-primary">{{ $prop->telephone_societe  }}</span><br>
        Adresse :  <span class="text-primary">{{ $prop->adresse_societe  }}</span><br>

        <br>
        <span class="">Représentant</span>
        Nom et prénom(s):  <span class="text-primary">{{ $prop->nom_representant  }}</span><br>
        Contact:  <span class="text-primary">{{ $prop->contact1_representant.' '.$prop->contact2_representant  }}</span><br>

    </div>
    @endif

    <div class="col-md-4">
       <p class="" style="background-color: #CCC">Autre</p>
        Date enregistrement :  <span class="text-primary">{{ date('d/m/Y', strtotime($prop->created_at))  }}</span><br>

	</div>
</div>


<br>
<br>
<h4><u>Bien(s) associé(s)</u></h4>

<table class="table align-items-center table-flush " id="dataTablebien" style="width:80%">

<thead  style="background-color:#CCC; color:#FFF">

    <tr>
    <th width="2%">Libellé</th>
    <th>Localisation</th>
    <th>Section/Parcelle</th>
    <th>Lot/Ilot</th>
    <th>Action</th>
    </tr>
</thead>


<tbody><?php $i = 1; ?>
@foreach($apparts as $appart)

    <tr >
    <td>{{ $i++ }}</td>
    <td>{{ $appart->bien->libelle  }}</td>
    <td>{{ $appart->bien->section.'/'.$appart->bien->parcelle }} </td>
    <td>{{ $appart->bien->lot.'/'.$appart->bien->ilot }} </td>
    <td>
<a href="{{ url('bien/'.$appart->bien->id)}}">Voir</a></td></tr>


    @endforeach

                    </tbody>
                  </table>


	</div>
  </div>
</div>


<div>




@endsection
