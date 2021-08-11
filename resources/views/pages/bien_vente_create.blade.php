@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')


<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Bien - {{ $typebien->libelle }} - Ajouter</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">


  <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a>

                </div>
                <div class="table-responsive p-3">


<form  name="form_bien" id="form_bien" method="POST" action="{{ route('bien_vente_store') }}">
        {{ csrf_field() }}

<input type="hidden" name="bien_id" id="bien_id">
<input type="hidden" name="a_vendre" value="1">
<input type="hidden" name="typebien_id" id="typebien_id" value="{{ $typebien->id }}">






 <!--  -------------------------- Identification -----------------------  -->
  <h4 style="color: coral">Identification</h4>
  <hr>

    <div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <strong>Libellé du bien  <b style="color: red;">*</b></strong>
            <input type="text" name="libelle" id="libelle" class="form-control" required  value="">
            <div class="alert-danger" id="libelle_bienError"></div>
        </div>
    </div>


    @if($typebien->id == 4)
<div class="col-md-3">
	<div class="form-group">
	 <strong>Type immeuble<b style="color: red;">*</b></strong>
	 <select class="form-control" name="type_immeuble" id="type_immeuble" required>
		<option value="">Choisir</option>
		<option value="R+1">R+1</option>
		<option value="R+2">R+2</option>
		<option value="R+3">R+3</option>
		<option value="R+4">R+4</option>
		<option value="R+5">R+5</option>
		<option value="R+N">R+N</option>
	 </select>

	</div>
</div>
   @endif



@if($typebien->id != 4)

   @if($typebien->id == 3)
   	@if($typebien->id != 5)
    <div class="col-md-3">
        <div class="form-group">
            <strong>Nom immeuble  <b style="color: red;">*</b></strong>
            <input type="text" name="immeuble" id="immeuble" class="form-control" required  value="">
            <div class="alert-danger" id="libelle_bienError"></div>
        </div>
    </div>
    	@endif
    @endif


@if($typebien->id != 1)
   @if($typebien->id != 3)
   		@if($typebien->id != 5)
<div class="col-md-3">
	<div class="form-group">
	 <strong>Type maison<b style="color: red;">*</b></strong>
	 <select class="form-control" name="type_maison" id="type_maison" required>
		<option value="">Choisir</option>
		<option value="Villa">Villa</option>
		<option value="Duplex">Duplex</option>
		<option value="Triplex">Triplex</option>
	 </select>

	</div>
</div>

		@endif

	@if($typebien->id != 2)


	<div class="col-md-3">
	 <div class="form-group">
			 <strong>Type commerce<b style="color: red;">*</b></strong>
			 <select class="form-control" name="type_commerce" id="type_commerce" required>
				<option value="">Choisir</option>
				<option value="Magasin">Magasin</option>
				<option value="Bureau">Bureau</option>
			 </select>

		</div>
	</div>

		@endif
	 @endif


	 @if($typebien->id != 5)
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

	<div class="col-md-2">
		<div class="form-group">
			<strong>Surface habitable (m²) </strong>
			<input type="text" name="surface_habitable" id="surface_habitable"  class="form-control"  value="">
		</div>
	</div>
		@endif
	@endif



	@if($typebien->id != 5)
	<div class="col-md-2">
		<div class="form-group">
			<strong>Superficie (m²) <b style="color: red;">*</b></strong>
			<input type="text" name="surface" id="surface" class="form-control" required value="">
		<div class="alert-danger" id="surfaceError"></div>
		</div>
	</div>
	@endif


@endif

</div>







<br>
<br>
<!--  -------------------------- Localisation -----------------------  -->
  <h4 style="color: coral">Localisation</h4>
  <hr>

<div class="row">

   <div class="col-md-3">
	<div class="form-group">
		<strong>Adresse </strong>
		<input type="text" name="adresse" id="adresse" class="form-control"   value="">
		<div class="alert-danger" id="libelle_bienError"></div>
	</div>
</div>


<div class="col-md-2">
	<div class="form-group">
		<strong>Section <b style="color: red;">*</b></strong>
		<input type="text" name="section" id="section" class="form-control"  required   value="">
	<div class="alert-danger" id="sectionError"></div>
	</div>
</div>


<div class="col-md-2">
	<div class="form-group">
		<strong>Parcelle <b style="color: red;">*</b></strong>
		<input type="text" name="parcelle" id="parcelle" class="form-control"  required  value="">
		<div class="alert-danger" id="parcelleError"></div>
	 </div>
</div>


<div class="col-md-2">
	<div class="form-group">
		<strong>Lot </strong>
		<input type="text" name="lot" id="lot"  class="form-control" >
		<div class="alert-danger" id="loError"></div>

	</div>
</div>

	<div class="col-md-2">
	   <div class="form-group">
			<strong>Ilot  </strong>
			<input type="text" name="ilot" id="ilot" class="form-control" value="">
			<div class="alert-danger" id="ilotError"></div>

		</div>
	</div>
</div>

<br><br>








   <!--  -------------------------- Elements -----------------------  -->
  <h4 style="color: coral">Eléments</h4>
  <hr>
<div class="row">
@if($typebien->id != 1)
  @if($typebien->id !=4)
   <div class="col-md-1">
	   <div class="form-group">
	   <strong>Meublé </strong>

		   <input type="checkbox" class="form-control" name="meuble" id="meuble"  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
   </div>
	@endif
@endif

  @if($typebien->id !=4)
   <div class="col-md-1">
	<div class="form-group">
		<strong>Libre</strong>
		<input type="checkbox" class="form-control" name="libre" id="libre" checked value="1">

	</div>
	</div>
	@endif


</div>






<div class="row">
 @if($typebien->id != 5)
@if($typebien->id != 1)

	@if($typebien->id != 3)
		@if($typebien->id !=4)
	<div class="col-md-1">
	<div class="form-group">
	   <strong> &nbsp;&nbsp; Garage </strong>
		   <input type="checkbox" class="form-control" name="garage" id="garage"  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
	</div>

		<div class="col-md-1">
		<div class="form-group">
		   <strong> &nbsp;&nbsp; Terrasse </strong>
			   <input type="checkbox" class="form-control" name="terrasse" id="terrasse"  value="1">
			   <div class="alert-danger" id="meubleError"></div>
		   </div>
		</div>
		@endif
	@endif

@if($typebien->id !=4)
<div class="col-md-1">
	<div class="form-group">
	   <strong> Cuisine Af. </strong>
		   <input type="checkbox" class="form-control" name="cuisine" id="cuisine"  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
	</div>
@endif

@if($typebien->id ==2 OR $typebien->id ==3 OR $typebien->id ==4)
	<div class="col-md-1">
	<div class="form-group">
	   <strong> &nbsp;&nbsp; Piscine </strong>
		   <input type="checkbox" class="form-control" name="piscine" id="piscine"  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
	</div>
@endif

@if($typebien->id != 2)
	@if($typebien->id !=4)
	<div class="col-md-1">
	<div class="form-group">
	   <strong> &nbsp;&nbsp; Balcon </strong>
		   <input type="checkbox" class="form-control" name="balcon" id="balcon"  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
	</div>
	@endif




	<div class="col-md-1">
	<div class="form-group">
	   <strong> @if($typebien->id ==4)Parking in. @else &nbsp;&nbsp; Parking  @endif</strong><!-- Parking interne si c'est un immeuble -->
		   <input type="checkbox" class="form-control" name="parking" id="parking"  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
	</div>


		@if($typebien->id != 3)
		<div class="col-md-1">
			<div class="form-group">
			   <strong> Parking ex. </strong>
				   <input type="checkbox" class="form-control" name="parking_externe" id="parking_externe"  value="1">
				   <div class="alert-danger" id="meubleError"></div>
			   </div>
		</div>


		<div class="col-md-1">
			<div class="form-group">
			   <strong> Ascenseur </strong>
				   <input type="checkbox" class="form-control" name="ascenseur" id="ascenseur"  value="1">
				   <div class="alert-danger" id="meubleError"></div>
			   </div>
		</div>
		@endif

	@endif
@endif

	@if($typebien->id != 2 AND $typebien->id != 3)
		@if($typebien->id !=4)
	<div class="col-md-1">
	<div class="form-group">
	   <strong> &nbsp;&nbsp; Viabilisé </strong>
		   <input type="checkbox" class="form-control" name="viabilise" id="viabilise"  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
	</div>
		@endif
	@endif
@endif
</div>







<br>
<br>
<!--  -------------------------- Autres -----------------------  -->
  <h4 style="color: coral">Autres</h4>
  <hr>

<div class="row">


	  <div class="col-md-6">
		  <div class="form-group">
			  <strong>Propriétaire(s) <b style="color: red;">*</b></strong>
			  <select name="proprietaires[]" id="detail" class="form-control" rows="" cols="" multiple="multiple" required>

				@foreach($proprietaires as $pr)
				<option value="{!! $pr->id !!}">{!! $pr->nom.' '.$pr->prenom.' ('.$pr->mobile1.')' !!}</option>
				@endforeach

			  </select>
			  <div class="alert-danger" id="detailError"></div>
			</div>

	  </div>


	  <div class="col-md-6">
		  <div class="form-group">
			  <strong>Détail(s)</strong>
			  <textarea name="detail" id="detail" class="form-control" rows="4" cols="" ></textarea>
			  <div class="alert-danger" id="detailError"></div>
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












</div>



@endsection
