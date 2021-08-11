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


    <div class="col-lg-10">
    <h2 class="text-center alert alert-secondary">Besoin - Modifier </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
     <a href="{{ route('besoin')}}">Retour</a>


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

<form  name="form_mandat" id="form_mandat" method="post" action="{{ url('besoin_update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

 <input type="hidden" name="besoin_id" id="besoin_id" value="{{$besoin->id}}">
        <div class="row">


        <div class="col-md-3">
      	<div class="form-group">
            <strong id="">Acquéreur <b style="color: red;">*</b></strong>
            <select class="form-control" id="acquereur" name="acquereur"" required>
            <option value="{{ $besoin->locataire->id }}">{{ $besoin->locataire->nom.' '.$besoin->locataire->prenom }}</option>
                @foreach($acquereurs as $acquereurs)
                <option value="{!! $acquereurs->id !!}"> {!! $acquereurs->nom.' '.$acquereurs->prenom !!}</option>
                @endforeach
            </select>


        	</div>
        </div>


	<div class="col-md-3">
      	<div class="form-group">

            <strong id="">Type bien<b style="color: red;">*</b></strong>
            <select class="form-control" id="type_bien" name="type_bien" required>
                <option value="{{ $besoin->typebien->id }}">{{$besoin->typebien->libelle}}</option>
                @foreach($typebiens as $typebien)
                <option value="{!! $typebien->id !!}"> {!! $typebien->libelle !!}</option>

                @endforeach
            </select>


        	</div>
    	</div>


     <div class="col-md-3">
		<div class="form-group">
            <strong>Libellé<b style="color: red;">*</b></strong>
            <input type="text" name="libelle" id="libelle" value="{{ $besoin->libelle }}" class="form-control">

			</div>

        </div>


    </div>
    <div class="row">

    <div class="col-md-3">
			<div class="form-group">
				<strong>Nombre piéce(s) <b style="color: red;">*</b></strong>
				<input type="text" name="nbre_piece" id="nbre_piece"  class="form-control" value="{{$besoin->nbre_piece}}" >

			</div>
        </div>


        <div class="col-md-3">
			<div class="form-group">
				<strong>Superficie <b style="color: red;">*</b></strong>
				<input type="text" name="superficie" id="superficie"  class="form-control" value="{{$besoin->superficie}}">

			</div>
		</div>

                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Date clôture<b style="color: red;">*</b></strong>
                        <input type="date" name="delai" id="delai"  class="form-control" value="{{ $besoin->delai_acquisition }}" >
                    </div>
                </div>

        </div>

	<div class="row">
    <div class="col-md-4">
			<div class="form-group">
				<strong>Adresse <b style="color: red;">*</b></strong>

                <input type="text" name="adresse" id="adresse" value="{{$besoin->adresse}}" class="form-control" style="height:50px;">
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<strong>Détail</strong>
                <input type="text" name="detail" id="detail" value="{{$besoin->detail}}" class="form-control" style="height:50px;">
			</div>
		</div>

    </div>

                <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="">Enregistrer</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

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
