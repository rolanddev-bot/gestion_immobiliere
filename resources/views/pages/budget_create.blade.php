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


    function rech_besoin(){
        var id_locataire = document.getElementById('acquereur').value;

        $.ajax({
            data:'locataire_id = ' +id_locataire,
            url:"search_besoin",
            type:"POST",
            headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

        });


    }




</script>


<div class="container-fluid" id="container-wrapper">


    <div class="col-lg-10">
    <h2 class="text-center alert alert-secondary">Budget - Ajouter </h2>
              <div class="card mb-4">

     <a href="{{ route('budget')}}">Retour</a>
         <div class="table-responsive p-3">

<form  name="form_mandat" id="form_mandat" method="post" action="{{ url('budget_store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

    <div class="row">


      <div class="col-md-4">
      	<div class="form-group">

            <strong id="">Acquéreur <b style="color: red;">*</b></strong>
            <select class="form-control" id="acquereur" name="acquereur" required>
                <option value="">Choisir</option>
                @foreach($acquereur as $acq)
                <option value="{!! $acq->id !!}"> {!! $acq->nom.' - '.$acq->prenom !!}</option>

                @endforeach
            </select>


        	</div>
    	</div>

        <div class="col-md-4">
      	<div class="form-group">

            <strong id="">Besoin <b style="color: red;">*</b></strong>
            <select class="form-control" id="besoin_id" name="besoin_id" required>
                <option value="">Choisir</option>
                @foreach($besoins as $besoin)
                <option value="{!! $besoin->id !!}"> {!! $besoin->libelle.' - '.$besoin->adresse !!}</option>

                @endforeach
            </select>


        	</div>
    	</div>




        <div class="col-md-3">
		   <div class="form-group">
            <strong>Montant<b style="color: red;">*</b></strong>
            <input type="text" name="montant" id="montant" value="" class="form-control">

			</div>

        </div>

        <div class="col-md-3">
            <div class="form-group">

                <strong id="">Modalité <b style="color: red;">*</b></strong>
                <select class="form-control" id="modalite" name="modalite"" required>
                    <option value="">Choisir</option>
                    <option value="1 tranche">1 tranche</option>
                    <option value="2 tranches"> 2 tranches</option>
                    <option value="3 tranches"> 3 tranches</option>
                    <option value="4 tranches"> 4 tranches</option>
                    <option value="5 tranches"> 5 tranches</option>
                </select>
                </div>
            </div>


            <div class="col-md-3">
            <div class="form-group">
                <strong id="">Mode paiement <b style="color: red;">*</b></strong>
                <select class="form-control" id="mode_id" name="mode_id"" required>
                    <option value="">Choisir</option>
                    @foreach($modes as $mode)
                    <option value="{!! $mode->id !!}"> {!! $mode->libelle !!}</option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<strong>Détail</strong>
				<textarea name="detail" id="detail" rows="3"  class="form-control" ></textarea>
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
