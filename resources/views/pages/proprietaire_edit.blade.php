@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script type="text/javascript">


</script>



<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Propriétaire - Modifier</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

      <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a>


                </div>
                <div class="table-responsive p-3">

<!--
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <strong>Type de propriétaire<b style="color: red;">*</b></strong>
            <select class="form-control" id="type_proprietaire" name="type_proprietaire" required>
                        <option value="{{ $prop->type_proprietaire }}">{{ $prop->type_proprietaire }}</option>


            </select>
        </div>
    </div>
</div>
-->
<!--  ********************** personne physique ************************************  -->

@if($prop->type_proprietaire == 'personne physique')
<form  name="form_propietaire" id="" method="POST" action="{{ url('proprietaire-update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
        <input type="hidden" name="prop_id" id="prop_id" value="{{$prop->id}}">
        <input type="hidden" name="type_proprietaire" id="type_proprietaire" value="personne physique">




        <div id="">
        <div  class="row">

<div class="col-md-3">
      <div class="form-group">
          <strong>Civilité <b style="color: red;">*</b></strong>
          <select class="form-control" id="sexe" name="sexe"required >
          <option value="{{$prop->sexe}}">{{$prop->sexe}}</option>
          <option value="Monsieur">Monsieur</option>
          <option value="Madame">Madame</option>
          <option value="Mademoiselle">Mademoiselle</option>

      </select>

      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <strong>Nom <b style="color: red;">*</b></strong>
          <input type="text" name="nom" id="nom" required  class="form-control"  value="{{$prop->nom}}">
          <span class="text-danger">{{ $errors->first('title') }}</span>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <strong>Prénom(s) <b style="color: red;">*</b></strong>
          <input type="text" name="prenom" id="prenom"  class="form-control"  required  value="{{$prop->prenom}}">
          <span class="text-danger">{{ $errors->first('product_code') }}</span>


            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <strong>Email <b style="color: red;">*</b></strong>
                <input type="email"  id="email" class="form-control" required  name="email" value="{{$prop->emailto}}">
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
        </div>



    </div>



    <div class="row">

<div class="col-md-3">
      <div class="form-group">
          <strong>Photo</strong>
          <input type="file" name="photo" id="photo" class="form-control" placeholder="">

     </div>
</div>

<div class="col-md-3" id="dnt_disp">
         <div class="form-group">
             <strong>Date de Naissance</strong>
             <input type="date" name="date_naissance" id="date_naissance"  class="form-control" value="{{$prop->date_naissance}}">
             <span class="text-danger">{{ $errors->first('image') }}</span>
         </div>
     </div>

<div class="col-md-3" id="ad_disp">
	 <div class="form-group">
		 <strong>Adresse <b style="color: red;">*</b></strong>
		 <input class="form-control"  name="adresse" id="adresse" placeholder="" required value="{{ $prop->adresse }}" />
	 </div>
 </div>
</div>

<div class="row">

<div class="col-md-3">
	<div class="form-group">
		<strong>Contact1 <b style="color: red;">*</b></strong>
		<input type="text" class="form-control" placeholder="" name="mobile1" id="mobile1" value="{{$prop->mobile1}}" required>
		</div>
	</div>

<div class="col-md-3">
	<div class="form-group">
		<strong>Contact2 </strong>
	<input type="text" class="form-control" placeholder="" name="mobile2" id="mobile2" value="{{$prop->mobile2}}">
	</div>
</div>

            <div class="col-md-3">
        <div class="form-group">
            <strong>Type de pièce <b style="color: red;">*</b></strong>
            <select class="form-control" id="type_piece" name="type_piece" required>
                                            <option value="{{$prop->type_piece}}">{{$prop->type_piece}}</option>
                                            <option value="cni">-CNI-</option>
                                            <option value="passeport">-Passeport-</option>
                                        </select>
        </div>
    </div>


     <div class="col-md-3">
        <div class="form-group">
            <strong>Numéro de pièce <b style="color: red;">*</b></strong>
            <input type="text" name="numero_piece" required id="numero_piece" class="form-control"value="{{$prop->numero_piece}}">
            <span class="text-danger">{{ $errors->first('image') }}</span>
         </div>
      </div>

   </div>




    </div>

            <div class="modal-footer">

                <input type="submit" class="btn btn-success" value="Ajouter"  id="">

            </div>

    </form>


<!--  ********************** personne morale *****************************************  -->
@endif

@if($prop->type_proprietaire == 'personne morale')

<form  name="form_propietaire" id="" method="POST" action="{{ url('proprietaire-update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="hidden" name="type_proprietaire" id="" value="personne morale">
        <input type="hidden" name="prop_id" id="prop_id" value="{{$prop->id}}">

        <!---------- moral ------------------------------------------------------- -->


        <div id="">
        <br>
<br>
 <h4 style="color:#00F"> Société</h4><hr>
<div class="row">
    <div class="col-md-3" id="">
            <div class="form-group">
                    <strong>Nom société <b style="color: red;">*</b> </strong>
                <input type="text" name="nom_societe"  id="nom_societe" required class="form-control" value="{{$prop->nom_societe}}">
            </div>
    </div>

    <div class="col-md-3" id="">
            <div class="form-group">
                    <strong>N° RCCM </strong>
                <input type="text" name="numero_registre"  id="numero_registre" class="form-control" value="{{$prop->numero_registre}}">
            </div>
    </div>

    <div class="col-md-4" id="">
        <div class="form-group">
                <strong>PJ RCCM </strong>
                    <input type="file" name="documents[]" multiple="" id="documents" class="form-control" placeholder="">
        </div>
    </div>

                        <div class="col-md-2" id="">
                             <div class="form-group">
                                     <strong>Tél. société </strong>
                                    <input type="text" name="telephone_societe"  id="telephone_societe" class="form-control" value="{{$prop->telephone_societe}}">
                             </div>
                        </div>


 </div>

 <div class="row">
  <div class="col-md-3">
		<div class="form-group">
			<strong>Adresse société<b style="color: red;">*</b></strong>
			<input type="text" class="form-control" col="3"  name="adresse_societe" id="adresse_societe" value="{{$prop->adresse_societe}}" placeholder="" required>
		</div>
    </div>

<div class="col-md-3">
	<div class="form-group">
		<strong>N° CC</strong>
		<input type="text" class="form-control" col="3"   name="compte_contribuable" id="compte_contribuable" value="{{$prop->compte_contribuable}}" placeholder="">
	</div>
    </div>

	<div class="col-md-3">
		<div class="form-group">
			<strong>N° compte bancaire</strong>
			<input type="text" class="form-control" col="3"  name="compte_bancaire" id="compte_bancaire" value="{{$prop->compte_bancaire}}" placeholder="">
		</div>
	</div>


	<div class="col-md-3">
		<div class="form-group">

			<strong>Banque</strong>
			<select type="text" class="form-control" col="3"  name="banque_id" id="banque_id">
				<option value="{{$prop->banque->id }}">{{$prop->banque->libelle }}</option>
				@foreach($banques as $ba)
					<option value="{{ $ba->id }}">{{ $ba->libelle }}</option>
				@endforeach
			</select>
		</div>
    </div>
    </div>

    <h4 style="color:#00F"> Répresentant</h4><hr>
    <div class="row">

    <div class="col-md-3">
      <div class="form-group">
          <strong>Nom <b style="color: red;">*</b></strong>
          <input type="text" name="nom" id="nom" required  class="form-control" value="{{$prop->nom}}">
          <span class="text-danger">{{ $errors->first('title') }}</span>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <strong>Prénom(s) <b style="color: red;">*</b></strong>
          <input type="text" name="prenom" id="prenom"  class="form-control"  required value="{{$prop->prenom}}" >
          <span class="text-danger">{{ $errors->first('product_code') }}</span>


            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <strong>Email <b style="color: red;">*</b></strong>
                <input type="email"  id="email" class="form-control" required  name="email" value="{{$prop->emailto}}">
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
        </div>

            <div class="col-md-3">
                <div class="form-group">
                   <strong>Contact1 <b style="color: red;">*</b></strong>
                    <input type="text" class="form-control" placeholder="" name="mobile1" id="mobile1" value="{{$prop->mobile1}}" required>
                 </div>
            </div>
 </div>
 <div class="row">

              <div class="col-md-3">
                    <div class="form-group">
                         <strong>Contact2 </strong>
                        <input type="text" class="form-control" placeholder="" name="mobile2" id="mobile2" value="{{$prop->mobile2}}">
                     </div>
             </div>

    <div class="col-md-3">
    <div class="form-group">
        <strong>Type de pièce <b style="color: red;">*</b></strong>
        <select class="form-control" id="type_piece" name="type_piece" required>
                <option value="{{$prop->type_piece}}">{{$prop->type_piece}}</option>
                 <option value="cni">-CNI-</option>
                 <option value="passeport">-Passeport-</option>
             </select>
    </div>
</div>


<div class="col-md-3">
    <div class="form-group">
        <strong>Numéro de pièce <b style="color: red;">*</b></strong>
        <input type="text" name="numero_piece" required id="numero_piece" class="form-control" value="{{$prop->numero_piece}}">
        <span class="text-danger">{{ $errors->first('image') }}</span>
    </div>
</div>

</div>




<h4 style="color:#00F"> Personne à contacter</h4><hr>
<hr>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <strong>Nom & prénom(s)  </strong>
            <input type="text" name="nom_representant"  id="nom_representant" class="form-control" value="{{$prop->nom_representant}}">

        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <strong>Contact1</strong>
            <input type="text" name="contact1_representant"  id="contact1_representant" class="form-control" value="{{$prop->contact1_representant}}">

        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <strong>Contact2 </strong>
            <input type="text" name="contact2_representant"  id="contact2_representant" class="form-control" value="{{$prop->contact2_representant}}">

        </div>
    </div>

 </div>

 </div>

     <div class="modal-footer">

        <input type="submit" class="btn btn-success" value="Ajouter"  id="">

      </div>


</form>
@endif


 </div>
</div>
 </div>


</div>

@endsection
