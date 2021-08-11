@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')


<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Bien - Appartement - Modifier</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
   
                
  <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a>

               
                </div>
                <div class="table-responsive p-3">


<form  name="form_appart" id="form_appart" method="POST" action="{{ route('appartementupdate') }}">
        {{ csrf_field() }}
        
<input type="hidden" name="appart_id" id="appart_id" value="{{ $appart->id }}">
 
 
 <!--  -------------------------- Identification -----------------------  -->
  <h4 style="color: coral">Identification</h4>
  <hr>
   
    <div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <strong>Libellé du appart  <b style="color: red;">*</b></strong>
            <input type="text" name="libelle" id="libelle" class="form-control" required  value="{{ $appart->libelle }}">
            <div class="alert-danger" id="libelle_appartError"></div>
        </div>
    </div>
    
    
	 <div class="col-md-2">
		<div class="form-group">
			<strong>Nombre pièce</strong>
			<select class="form-control" name="nbre_piece" id="nbre_piece">
				<option value="{{ $appart->nbre_piece }}">{{ $appart->nbre_piece }}</option>
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
			<input type="number" name="surface_habitable" id="surface_habitable"  class="form-control"  value="{{ $appart->surface_habitable }}">
		</div>
	</div>
	
	<div class="col-md-2">
		<div class="form-group">
			<strong>Surface (m²) <b style="color: red;">*</b></strong>
			<input type="number" name="surface" id="surface" class="form-control" required value="{{ $appart->surface }}">
		<div class="alert-danger" id="surfaceError"></div>
		</div>
	</div>


</div>






       
                
                 
                 
                 
                 
                 
                  
   <!--  -------------------------- Elements -----------------------  -->
  <h4 style="color: coral">Eléments</h4>
  <hr>     
<div class="row">
   <div class="col-md-1">
	   <div class="form-group">
	   <strong>Meublé </strong>

		   <input type="checkbox" class="form-control" name="meuble" id="meuble" @if($appart->meuble== 1) checked @endif  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
   </div>

  
   <div class="col-md-1">
	<div class="form-group"> 
		<strong>Libre </strong>
		<input type="checkbox" class="form-control" name="libre" id="libre" @if($appart->libre== 1) checked @endif  value="1">

	</div>
	</div>


</div>





  
<div class="row">
 

<div class="col-md-1">
	<div class="form-group">
	   <strong> Cuisine Af. </strong>
		   <input type="checkbox" class="form-control" name="cuisine" id="cuisine" @if($appart->cuisine == 1) checked @endif  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
	</div>

	<div class="col-md-1">
	<div class="form-group">
	   <strong> &nbsp;&nbsp; Piscine </strong>
		   <input type="checkbox" class="form-control" name="piscine" id="piscine" @if($appart->piscine == 1) checked @endif  value="1">
		   <div class="alert-danger" id="meubleError"></div>
	   </div>
	</div>

	
	<div class="col-md-1">
	<div class="form-group">
	   <strong> &nbsp;&nbsp; Balcon </strong>
		   <input type="checkbox" class="form-control" name="balcon" id="balcon" @if($appart->balcon == 1) checked @endif value="1">

		   <div class="alert-danger" id="meubleError"></div>
	   </div>
	</div>
	

	
</div>







<br>
<br>
<!--  -------------------------- Autres -----------------------  -->
  <h4 style="color: coral">Autres</h4>
  <hr>  

<div class="row">
              



	  <div class="col-md-6">
		  <div class="form-group">
			  <strong>Détail(s)</strong>
			  <textarea name="detail" id="detail" class="form-control" rows="4" cols="" >{{ $appart->detail }}</textarea>
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
