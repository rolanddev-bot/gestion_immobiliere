@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
<script type="application/javascript">

	//-------------- FACTURE - RECHERCHE PROPRIETAIRE ---------------

    function mandat_rech(){

		var id = document.getElementById('select_rech_mandat_id').value;

        $.ajax({
            data: 'prop_id='+id,
            url: "rech_mandat",
            type: "POST",
            //processData: false,
            //contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) { document.getElementById('div_rech_result').innerHTML = data; },
            error: function(data) { alert('Error:', data); }
        });

    }




</script>


<div class="container-fluid" id="container-wrapper">


    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Mandat - Modifier </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

<a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a>


                </div>
                <div class="table-responsive p-3">

@if(session()->has('ok'))
    <div class="alert alert-danger alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif


<br>
<br>

<form  name="form_mandat" id="form_mandat" method="post" action="{{ route('mandat_vente_update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

      <input type="hidden" name="mandat_id" id="mandat_id" value="{{ $mandat->id }}">

<h4  class="col-primary" style="color:#00F" > <u>Infos mandat </u></h4>
  <div class="row">

	<div class="col-md-3">
		<div class="form-group">
			<strong>Type mandat<b style="color: red;">*</b></strong>
			<select class="form-control" id="type_mandat" name="type_mandat" required>
				<option value="{{ $mandat->type_mandat }}">{{ $mandat->type_mandat }}</option>
				 <option value="Habitation">Habitation</option>
				 <option value="Commercial">Commerciale</option>
			 </select>

		</div>
	</div>


	<div class="col-md-3">
			<div class="form-group">
				<strong>Date d'enregistrement<b style="color: red;">*</b></strong>
				<input type="date" name="date_enregistrement" id="date_enregistrement" value="{{ $mandat->date_enregistrement }}" required class="form-control" >
			</div>
		</div>


	<div class="col-md-3">
			<div class="form-group">
				<strong>Date prise d'effet<b style="color: red;">*</b></strong>
				<input type="date" name="date_prise_effet" id="date_prise_effet" value="{{ $mandat->date_prise_effet}}" required class="form-control" >
			</div>
		</div>

        </div>

        <div class="row">

	  <div class="col-md-2">
			<div class="form-group">
				<strong>Honnoraire (%) <b style="color: red;">*</b></strong>
				<input type="number" name="honnoraire" id="honnoraire" value="{{ $mandat->honnoraire }}" required class="form-control" >
			</div>
		</div>


	 	<div class="col-md-2">
			<div class="form-group">
				<strong>Durée (an) <b style="color: red;">*</b></strong>
				<input type="number" name="duree" id="duree" value="{{ $mandat->duree }}" required class="form-control" >

			</div>
		</div>


		<div class="col-md-2">
			<div class="form-group">
				<strong>Frequence CR (Mois)<b style="color: red;">*</b></strong>
				<input type="text" name="frequence_compte_rendu" id="frequence_compte_rendu" value="{{ $mandat->frequence_compte_rendu }}" required class="form-control" >
			</div>
		</div>

        <div class="col-md-2">
			<div class="form-group">
				<strong>Frais de clôture dossier</strong>
				<input type="number" name="frais_cloture" id="frais_cloture" value="{{ $mandat->frais_cloture }}" required class="form-control" >
			</div>
		</div>


        <div class="col-md-2">
			<div class="form-group">
				<strong>Renouvellement (an)<b style="color: red;">*</b></strong>
				<input type="number" name="nbre_renouvellement" id="nbre_renouvellement" value="{{ $mandat->nbre_renouvellement }}" required class="form-control" >
			</div>
		</div>

        </div>


             <h4  class="col-primary" style="color:#00F" > <u>Qui paiera l'impôt? </u></h4>
    <div class="row">

    <div class="col-md-2">
		<div class="form-group">
			<strong>Propriétaire</strong>
			<input type="radio" name="impot" id="impot1" value="1" @if($mandat->impot ==1) checked @endif class="form-control" required >
		</div>
	</div>

    <div class="col-md-2">
		<div class="form-group">
			<strong>Bailleur</strong>
			<input type="radio" name="impot" id="impot2" value="2" @if($mandat->impot ==2) checked @endif class="form-control" >
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<strong>Locataire</strong>
			<input type="radio" name="impot" id="impot3" value="3" @if($mandat->impot ==3) checked @endif class="form-control" >
		</div>
	</div>

    </div>
    <br>

  <h4  class="col-primary" style="color:#00F" > <u>Autres infos </u></h4>

	<div class="row">

		<div class="col-md-6">
			<div class="form-group">
				<strong>Détail</strong>
				<textarea name="detail" id="detail" rows="4"  class="form-control" > {{ $mandat->detail }} </textarea>
			</div>
		</div>

    </div>

                <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="">Enregistrer</button>

            </div>

    </form>



                </div>
              </div>
            </div>










<!-- Modal -->

<div>
    <div class="modal fade bd-example-modal-xl" id="modalAffichage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">

        <div class="modal-header">
            <h2 class="modal-title" style="text-align: center;" id="titremodal"></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">




        </div>
    </div>
    </div>
    </div>
</div>




</div>



@endsection
