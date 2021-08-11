@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script type="text/javascript">

    $('body').on('click', '#btnAjouterElement', function() {
        var equipement_id = $(this).data('equipement_id1');
        var equiper_id = $(this).data('equiper_id1');


        $('#equipement_id1').val(equipement_id);
        $('#equiper_id').val(equiper_id);

        var libelle = $(this).data('libelle');

        $('#titremodal').html('Elément '+libelle);

        $('#modalElement').modal('show');
    });


    //Supprimer élément
    $('body').on('click', '#btnSuppElement', function() {
        //var localelement_id = $(this).data('localelement_id');
        var datatypebien = $("#form_typebien")[0];
        formData = new FormData(datatypebien);

        if (confirm('Voulez-vous supprimer cet élément?')) {;
            $.ajax({
                data: formData,
                url: "localelementdelete",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    alert(data);
                    window.location.reload();
                },
                error: function(data) {
                    alert('Error:', data);

                }
            });
        }



    });

</script>

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">

    @if(session()->has('ok'))
        <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5">
        <span aria-hidden="true">&times;</span></button>

        {!! session('ok') !!}
        </div>
    @endif


    <div class="col-lg-12">
    <h3 @if($bien->archiver == 1) class="text-center alert " style="background-color:darksalmon" @else class="text-center alert alert-secondary" @endif >Bien @if($bien->archiver == 1) archivé @endif  - {{ $bien->typebien->libelle}} - Détail </h3>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

<p>
   <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a> |
    @if($bien->typebien->id ==1)
    <a href="{{ route('bien_vente')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
    @elseif($bien->typebien->id ==2)
    <a href="{{ route('bien_maison_vente')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
    @elseif($bien->typebien->id ==3)
    <a href="{{ route('bien_appart_vente')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
    @elseif($bien->typebien->id ==4)

    <a href="{{ route('bien_immeuble_vente')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
    @elseif($bien->typebien->id ==5)
   <a href="{{ route('bien_commerce_vente')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>

    @endif
   |
   <a href="{{ url('bien_vente_edit/'.$bien->id.'/edit') }}" class=""><i class="fas fa-fw fa-edit" style="font-size:15px"></i>Modifier</a>
</p>



                </div>
                <div class="table-responsive p-3">



 <div class="row">

    <div class="col-md-4">
       <p class="" style="background-color: #CCC">Identification</p>

        Type bien:  <span class="text-primary">{{ $bien->typebien->libelle}}</span><br>

        @if($bien->typebien->id == 4)
        Type immeuble:  <span class="text-primary">{{ $bien->type_immeuble}}</span><br>
        @endif

        Libellé:  <span class="text-primary">{{ $bien->libelle}}</span><br>



@if($bien->typebien->id != 4)

        @if($bien->typebien->id == 3)
        	@if($bien->typebien->id != 5)
        Immeuble:  <span class="text-primary">{{ $bien->immeuble }}</span><br>
        	@endif
        @endif


        @if($bien->typebien->id != 1)
        	@if($bien->typebien->id != 3)
        		@if($bien->typebien->id != 5)
        Type maison:  <span class="text-primary">{{ $bien->type_maison}}</span><br>
        		@endif

        @if($bien->typebien->id != 2)
        Type commerce:  <span class="text-primary">{{ $bien->type_commerce }}</span><br>
        	@endif
        @endif

         	@if($bien->typebien->id != 5)
        Nbre pièce:  <span class="text-primary">{{ $bien->nbre_piece }}</span><br>
        Surface habitable:  <span class="text-primary">{{ $bien->surface_habitable }}</span><br>
        	@endif
        @endif

        @if($bien->typebien->id != 5)
        Surface (m2):  <span class="text-primary">{{ $bien->surface }}</span><br>
        @endif
@endif





        <br>
        <p class="" style="background-color: #CCC">Localisation</p>

        Section/Parcelle:  <span class="text-primary">{{ $bien->section.'/'.$bien->parcelle }}</span><br>
        Lot/Ilot:  <span class="text-primary">{{ $bien->lot.'/'.$bien->ilot }}</span><br>
        Adresse:  <span class="text-primary">{{ $bien->adresse }}</span><br>

    </div>




    <div class="col-md-4">
       <p class="" style="background-color: #CCC">Elément</p>

@if($bien->typebien->id != 1)
       	@if($bien->typebien->id != 4)
        Meublé:  <span class="text-primary"> @if($bien->meuble==1) Oui @else Non @endif</span><br>
        @endif
@endif
       @if($bien->typebien->id != 4)
        Libre:  <span class="text-primary"> @if($bien->libre==1) Oui @else Non @endif</span><br>
        @endif

@if($bien->typebien->id != 5)

  @if($bien->typebien->id != 1)

		@if($bien->typebien->id != 3)
			@if($bien->typebien->id != 4)
			Garage:  <span class="text-primary"> @if($bien->garage==1) Oui @else Non @endif</span><br>
			Terrasse:  <span class="text-primary"> @if($bien->terrasse==1) Oui @else Non @endif</span><br>
			@endif
		@endif

        @if($bien->typebien->id !=4)
        Cuisine Afr.:  <span class="text-primary"> @if($bien->libre==1) Oui @else Non @endif</span><br>
        @endif

        @if($bien->typebien->id ==2 OR $bien->typebien->id ==3 OR $bien->typebien->id ==4)
        Piscine:  <span class="text-primary"> @if($bien->piscine==1) Oui @else Non @endif</span><br>
    	@endif



        @if($bien->typebien->id != 2)
        	@if($bien->typebien->id !=4)
        Balcon:  <span class="text-primary"> @if($bien->balcon==1) Oui @else Non @endif</span><br>
        	@endif


         @if($bien->typebien->id ==4)Parking int. @else &nbsp;&nbsp; Parking  @endif:  <span class="text-primary"> @if($bien->parking==1) Oui @else Non @endif</span><br>

			@if($bien->typebien->id != 3)
			Parking ext.:  <span class="text-primary"> @if($bien->parking_externe==1) Oui @else Non @endif</span><br>
			Ascenseur:  <span class="text-primary"> @if($bien->ascenseur==1) Oui @else Non @endif</span><br>
			@endif
        @endif
        @endif


        @if($bien->typebien->id != 2 AND $bien->typebien->id != 3)
        	@if($bien->typebien->id !=4)
        Viabilise:  <span class="text-primary"> @if($bien->viabilise==1) Oui @else Non @endif</span><br>
        	@endif
        @endif
@endif
    </div>





    <div class="col-md-4">
        <p class="" style="background-color: #CCC">Autre</p>

        Propriétaire:  <br>

        @foreach($appartenirs as $appart)
        {!! '<span class="text-primary">'.$appart->proprietaire->nom.' '.$appart->proprietaire->prenom.'</span>, ' !!}
        @endforeach

        <br><br>
        Détail:  <br><span class="text-primary">{{ $bien->detail }}</span><br>


        @if($bien->typebien->id == 4)
        	<p class="" style="background-color: #CCC">Bilan des appartements</p>
        	Studio:  <span class="text-primary">{{ $app_1 }}</span><br>
        	2 pièces:  <span class="text-primary">{{ $app_2 }}</span><br>
        	3 pièces:  <span class="text-primary">{{ $app_3 }}</span><br>
        	4 pièces:  <span class="text-primary">{{ $app_4 }}</span><br>
        	+5 pièces: <span class="text-primary">{{ $app_5 }}</span><br>

        @endif

    </div>

</div>
<br>
<br>



<!-- ------------------- APPARTEMENT --------------------------------- -->

 @if($bien->typebien->id ==4)

 <p align="center">
<button style="width:400px" class="btn btn-warning" data-toggle="modal" data-target="#modalEtatEntrant" >Nouvel appartement</button>
 </p>


 <h4>Appartement du bien {{ $bien->libelle }}</h4>

 <table class="table align-items-center table-flush " id="dataTablebien" style="width:100%">

<thead  style="background-color:#999; color:#FFF">

    <tr>
    <th width="">Libellé</th>
    <th width="">Nbre pièce</th>
    <th>Piscine</th>
    <th>Balcon</th>
    <th>Cuisine</th>
    <th>Meuble</th>
    <th>Disponible</th>
   <th>Action</th>
    </tr>
</thead>


<tbody>
<?php $mt=0; $mtp=0; $i=1; ?>

@foreach($apparts as $appart)
  <tr>
     <td title="{{ $appart->detail }}" style="color:crimson" title="$appart->detail">{{ $appart->libelle }}</td>
     <td>{{$appart->nbre_piece}}</td>
	 <td>@if($appart->piscine == 1) Oui @else Non @endif</td>
	 <td>@if($appart->balcon == 1) Oui @else Non @endif</td>
	 <td>@if($appart->cuisine == 1) Oui @else Non @endif</td>
	 <td> @if($appart->meuble == 1) Oui @else Non @endif </td>
	 <td> @if($appart->libre == 1) Oui @else Non @endif </td>

<td style="width:5%">
<a href="{{ url('bien/'.$appart->id.'/edit') }}" class="" id="appart_id"  data-surface="{{$bien->surface}}"><i class="fas fa-fw fa-edit" style="font-size:15px"></i></a>

<a href="javascript:void(0)" id="btnSupprimerImmeuble" data-id="{{$bien->id}}" data-archiver="{{$bien->archiver}}" class=""><i class="fas fa-file-archive" style="font-size:15px"></i></a>
</td>


   </tr>

@endforeach

</table>



<div class="modal fade bd-example-modal-xl" id="modalEtatEntrant" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" style="text-align: center;" id="titremodal">AJOUTER APPARTEMENT</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


<form  name="formlocalEL" method="POST"  action="{{ route('bienstore') }}"  id="form_modal_appart" >
    {{ csrf_field() }}

    <input type="hidden" name="bien_id" id="bien_id" value="{{ $bien->id }}">

<input type="hidden" name="typebien_id" id="typebien_id" value="{{ $bien->typebien->id }}">
<input type="hidden" name="lot" id="lot" value="{{ $bien->lot }}">
<input type="hidden" name="ilot" id="ilot" value="{{ $bien->ilot }}">
<input type="hidden" name="section" id="section" value="{{ $bien->section }}">
<input type="hidden" name="parcelle" id="parcelle" value="{{ $bien->parcelle }}">

    <input type="hidden" name="immeuble_id" id="immeuble_id" value="{{ $bien->id}}">

<h4 style="color: coral">Identification</h4>
  <hr>

 <div class="row">
		<div class="col-md-4">
			<div class="form-group">
			   <strong>Libellé<b style="color: red;">*</b></strong>
			   <input type="text" name="libelle" id="libelle" class="form-control" required  value="">
			   <div class="alert-danger" id="libelle_bienError"></div>
		   </div>
		</div>


        <div class="col-md-2">
            <div class="form-group">
               <strong>Superficie (m2) </strong>
               <input type="number" name="surface" id="surface"  class="form-control"  value="">
               <div class="alert-danger" id="surfaceError"></div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <strong>Surface habitable (m2) </strong>
                 <input type="number" name="surface_habitable" id="surface_habitable"  class="form-control"  value="">
            </div>
        </div>


        <div class="col-md-2">
            <div class="form-group">
               <strong>Nombre pièce</strong>
                <select class="form-control" name="nbre_piece" id="nbre_piece">
                   <option value="">Choisir</option>
                   <option value="1">1</option>
                   <option value="2">2</option>
                   <option value="3">3</option>
                   <option value="4">4</option>
                   <option value="5">5</option>
                  <option value="+5">+5</option>
               </select>
           </div>
        </div>
 </div>


<br>
<!--  -------------------------- Localisation -----------------------  -->
  <h4 style="color: coral">Elément</h4>
  <hr>
 <div class="row">


<div class="col-md-1">
	<div class="form-group">
		<strong>&nbsp;&nbsp; Libre</strong>
		<input type="checkbox" class="form-control" name="libre" id="libre" checked  value="1">

	</div>
	</div>

<div class="col-md-1">
	   <div class="form-group">
	   <strong>&nbsp;&nbsp; Meublé </strong>

		   <input type="checkbox" class="form-control" name="meuble" id="meuble"  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
   </div>



        <div class="col-md-1">
            <div class="form-group">
                 <strong> &nbsp;&nbsp; Balcon </strong>
                 <input type="checkbox" class="form-control" name="balcon" id="balcon"  value="1">
                 <div class="alert-danger" id="meubleError"></div>
            </div>
        </div>

        <div class="col-md-1">
            <div class="form-group">
                <strong> &nbsp;&nbsp; Piscine </strong>
                <input type="checkbox" class="form-control" name="piscine" id="piscine"  value="1">
                <div class="alert-danger" id="meubleError"></div>
            </div>
        </div>



        <div class="col-md-1">
            <div class="form-group">
                 <strong> Cuisine(A) </strong>
                 <input type="checkbox" class="form-control" name="cuisine" id="cuisine"  value="1">
                <div class="alert-danger" id="meubleError"></div>
            </div>
        </div>
        </div>



        <br>
        <h4 style="color: coral">Autre</h4>
  <hr>
        <div class="row">
			<div class="col-md-6">
			<div class="form-group">
				<strong>Détail </strong>
				<textarea  name="detail" id="detail" rows="4" class="form-control"></textarea>
			</div>
			</div>
		</div>

<button type="submit" class="btn btn-success" id="">Enregistrer</button>
</form>



                </div>
            </div>
        </div>
    </div>

 @endif























<!-------------------- AUTRE ---------------------------- -->

 @if($bien->typebien->id !=1 AND $bien->typebien->id !=4)


<!-- Masquer automatiquement orsqu'il s'agit d'un immeuble -->
  @if($bien->archiver == 0)

<form class="" method="POST" action="{{ route('equipercreate') }}" style="border:1px solid #333; width:78%; padding:10px; margin:10px">
  @csrf


<input type="hidden" name="bien_id" id="bien_id" value="{{ $bien->id }}">

<div class="row" >

<div class="col-md-5">
    <div class="form-group">
        <select class="form-control" id="equipement_id" name="equipement_id" required>
            <option value="">Choisir localisation</option>

        @foreach($equipements as $eq)
            <option value="{!! $eq->id !!}"> {!! $eq->libelle !!}</option>
        @endforeach
        </optgroup>
        </select>
        <span class="text-danger">{{ $errors->first('Charge') }}</span>
    </div>
</div>


    <div class="col-md-5">
        <input type="text" name="detail" class="form-control" placeholder="Détail"/>
    </div>

    <div class="col-md-1">

        <button type="submit" class="btn btn-success" >Ajouter</button>
    </div>

</div>

</form>

@endif






<h4>Composant du Bien</h4>
<table class="table align-items-center table-flush " id="dataTablebien" style="width:80%">

<thead  style="background-color:#999; color:#FFF">

    <tr>
    <th width="2%">N°</th>
    <th>Localisation</th>
    <th>Détail</th>


    <th width="5%">Action</th>


    </tr>
</thead>


<tbody>
<?php $mt=0; $mtp=0; $i=1; ?>
@foreach($equipers as $eqp)

    <tr style="background-color:#EFEFEF">
    <td>{{ $i++ }}</td>
    <td>{{ $eqp->equipement->libelle  }}</td>
    <td>{{ $eqp->detail }} </td>
    <td>



 @if($bien->archiver == 0)
 <a href="javascript:void(0)" data-equipement_id1="{{ $eqp->equipement->id }}" data-equiper_id1="{{ $eqp->id }}"  data-libelle="{{ $eqp->equipement->libelle }}"
  data-target="#modalElement" id="btnAjouterElement" > <i class="fas fa-fw fa-plus-square"></i></a>

		<a href="{{ url('equipersup/'.$eqp->id) }}" id="" class=""><i class="fas fa-fw fa-trash"></i></a>
    @endif
    </td></tr>


    @foreach($elts as $elt)

        @if($elt->equiper_id == $eqp->id)
            <tr ><td></td><td colspan="2">

            {!! $elt->element->libelle !!}

            @if($elt->detail != '') - {{ $elt->detail }} @endif

            </td><td>

 @if($bien->archiver == 0)
            <a href="{{ url('local-element-delete/'.$elt->id) }}" class="">
            <i class="fas fa-fw fa-trash"></i>
            </a>
@endif
            </td></tr>
         @endif

    @endforeach



    @endforeach

                    </tbody>
                  </table>













@endif



   <br><br>

   <!----------------------------- --------- --------------------------------------------->
   <!----------------------------- LOCATION/BAIL --------------------------------------------->
   <hr>

<h4>Bail(s) connu(s)</h4>

<table class="table align-items-center table-flush " id="dataTablebien" style="width:100%">

<thead  style="background-color:#999; color:#FFF">

    <tr>
    <th width="">Réf</th>
    <th width="">Date location</th>
    <th width="">Loyer nu</th>
    <th>Locataire</th>
    <th>Réf Dépôt g.</th>
    <th>Mt Dépôt g.</th>
    <th>Etat</th>
    </tr>
</thead>


<tbody>
<?php $mt=0; $mtp=0; $i=1; ?>

@foreach($locations as $loca)
  <tr>
      <td>{{ $loca->ref }}</td>

      <td>{{ date('d/m/Y', strtotime($loca->date_location)) }}</td>
      <td>{{ separer($loca->loyer,3)  }}</td>
      <td>{{ $loca->locataire->nom.' '.$loca->locataire->prenom }}</td>
      <td>{{ $loca->ref_depot_garantie }}</td>
      <td>{{ separer($loca->caution,3) }}</td>
      <td>{{ $loca->etat }}</td>

   </tr>

@endforeach

</table>

                </div>
              </div>
            </div>



























<div>
    <div class="modal fade bd-example-modal-xl" id="modalElement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-ld">
        <div class="modal-content">

        <div class="modal-header">
            <h2 class="modal-title" style="text-align: center;" id="titremodal"></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

<form  name="formlocalEL" method="POST" action="{{ url('local-element-store') }}"  id="formlocalEL" >
    {{ csrf_field() }}

    <input type="hidden" name="equipement_id" id="equipement_id1" value="">
    <input type="hidden" name="equiper_id" id="equiper_id" value="">


<div class="row">

    <div class="col-md-12">
        <div class="form-group">
        <strong>Elément <b style="color: red;">*</b></strong>
            <select name="element_id" class="form-control" required>
            <option value="">Choisir</option>

            @foreach($elements as $el)
            <option value="{!! $el->id !!}">{!! $el->libelle !!}</option>
            @endforeach

            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
        <strong>Détail </strong>
            <textarea name="detail" id="detail" class="form-control"></textarea>
        </div>
    </div>

</div>

<button type="submit" class="btn btn-success" id="">Ajouter</button>
</form>

        </div>
    </div>
    </div>
    </div>
</div>




</div>



@endsection
