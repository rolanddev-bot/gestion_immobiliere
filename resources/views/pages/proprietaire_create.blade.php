@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script type="text/javascript">


</script>


<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Propriétaire - Ajouter</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

 <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a>

 @if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif
                </div>
                <div class="table-responsive p-3">


                <div class="row">
             <div class="col-md-3">
                    <div class="form-group">
                        <strong>Type de propriétaire<b style="color: red;">*</b></strong>
                        <select class="form-control" id="type_proprietaire" name="type_proprietaire" required>
                                 <option value="">Choisir</option>
                                 <option value="personne physique">Personne physique</option>
                                 <option value="personne morale">Personne morale</option>

                        </select>
                    </div>
                </div>
        </div>

<form  name="form_propietaire" id="div_physique" method="POST" action="{{ url('proprietaire-store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
        <input type="hidden" name="user_id" id="">
        <input type="hidden" name="type_proprietaire" id="type_proprietaire" value="personne physique">




        <div id="div_physique1">
        <div  class="row">

<div class="col-md-3">
      <div class="form-group">
          <strong>Civilité <b style="color: red;">*</b></strong>
          <select class="form-control" id="sexe" name="sexe"required >
          <option value="">Choisir</option>
          <option value="Monsieur">Monsieur</option>
          <option value="Madame">Madame</option>
          <option value="Mademoiselle">Mademoiselle</option>

      </select>

      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <strong>Nom <b style="color: red;">*</b></strong>
          <input type="text" name="nom" id="nom" required  class="form-control">
          <span class="text-danger">{{ $errors->first('title') }}</span>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <strong>Prénom(s) <b style="color: red;">*</b></strong>
          <input type="text" name="prenom" id="prenom"  class="form-control"  required >
          <span class="text-danger">{{ $errors->first('product_code') }}</span>


            </div>
        </div>

        <div class="col-md-3">
      <div class="form-group">
          <strong>Profession <b style="color: red;">*</b></strong>
          <input type="text" name="profession" id="profession"  class="form-control"  required >
          <span class="text-danger">{{ $errors->first('product_code') }}</span>


            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <strong>Email <b style="color: red;">*</b></strong>
                <input type="email"  id="email" class="form-control" required  name="email">
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <strong>Photo</strong>
            <input type="file" name="photo" id="photo" class="form-control" placeholder="">

          </div>
        </div>

       <div class="col-md-3" id="dnt_disp">
         <div class="form-group">
              <strong>Date de Naissance</strong>
              <input type="date" name="date_naissance" id="date_naissance"  class="form-control" placeholder="">
              <span class="text-danger">{{ $errors->first('image') }}</span>
         </div>
        </div>

        <div class="col-md-3" id="ad_disp">
             <div class="form-group">
                 <strong>Adresse <b style="color: red;">*</b></strong>
                 <input class="form-control"  name="adresse" id="adresse" placeholder="" required />
             </div>
         </div>



    </div>

<div class="row">

<div class="col-md-3">
                <div class="form-group">
                    <strong>Contact 1 <b style="color: red;">*</b></strong>
                <input type="text" class="form-control" placeholder="" name="mobile1" id="mobile1" value="" required>
                </div>
            </div>

        <div class="col-md-3">
                <div class="form-group">
                    <strong>Contact 2 </strong>
                <input type="text" class="form-control" placeholder="" name="mobile2" id="mobile2">
                </div>
            </div>

            <div class="col-md-3">
        <div class="form-group">
            <strong>Type de pièce <b style="color: red;">*</b></strong>
            <select class="form-control" id="type_piece" name="type_piece" required>
                                            <option value="">Choisir</option>
                                            <option value="cni">CNI</option>
                                            <option value="passeport">Passeport</option>
                                            <option value="autre">Autre</option>
                                        </select>
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <strong>Numéro de pièce <b style="color: red;">*</b></strong>
            <input type="text" name="numero_piece" required id="numero_piece" class="form-control" placeholder="">
            <span class="text-danger">{{ $errors->first('image') }}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <strong>Etablie le <b style="color: red;">*</b></strong>
            <input type="date" name="etablie_le" required id="etablie_le" class="form-control" placeholder="">
            <span class="text-danger">{{ $errors->first('image') }}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <strong>Domicilié à <b style="color: red;">*</b></strong>
            <input type="text" name="domicile_a" required id="domicile_a" class="form-control" placeholder="">
            <span class="text-danger">{{ $errors->first('image') }}</span>
        </div>
    </div>

    <div class="col-md-3" id="">
            <div class="form-group">
                    <strong>N° RCCM </strong>
                <input type="text" name="numero_registre"  id="numero_registre" class="form-control">
            </div>
    </div>

 </div>


  </div>

            <div class="modal-footer">

                <input type="submit" class="btn btn-success" value="Ajouter"  id="">

            </div>

    </form>








<form  name="form_propietaire" id="div_moral" method="POST" action="{{ url('proprietaire-store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="hidden" name="type_proprietaire" id="" value="personne morale">
        <!---------- moral ------------------------------------------------------- -->


        <div id="div_moral">
        <br>
<br>
 <h4 style="color:#00F"> Société</h4><hr>
<div class="row">
    <div class="col-md-3" id="">
            <div class="form-group">
                    <strong>Nom société <b style="color: red;">*</b> </strong>
                <input type="text" name="nom_societe"  id="nom_societe" required class="form-control">
            </div>
    </div>

    <div class="col-md-3" id="">
            <div class="form-group">
                    <strong>N° RCCM </strong>
                <input type="text" name="numero_registre"  id="numero_registre" class="form-control">
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
                                    <input type="text" name="telephone_societe"  id="telephone_societe" class="form-control">
                             </div>
                        </div>


 </div>

 <div class="row">
  <div class="col-md-3">
		<div class="form-group">
			<strong>Adresse société<b style="color: red;">*</b></strong>
			<input type="text" class="form-control" col="3"  name="adresse_societe" id="adresse_societe" value="" placeholder="" required>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<strong>N° CC</strong>
			<input type="text" class="form-control" col="3"  name="compte_contribuable" id="compte_contribuable" value="" placeholder="">
		</div>
    </div>

    <div class="col-md-3">
		<div class="form-group">
			<strong>N° compte bancaire</strong>
			<input type="text" class="form-control" col="3"  name="compte_bancaire" id="compte_bancaire" value="" placeholder="">
		</div>
	</div>


	<div class="col-md-3">
		<div class="form-group">
			<strong>Banque</strong>
			<select type="text" class="form-control" col="3"  name="banque_id" id="banque_id">
				<option value="1">Aucune</option>
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
          <input type="text" name="nom" id="nom" required  class="form-control">
          <span class="text-danger">{{ $errors->first('title') }}</span>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
          <strong>Prénom(s) <b style="color: red;">*</b></strong>
          <input type="text" name="prenom" id="prenom"  class="form-control"  required >
          <span class="text-danger">{{ $errors->first('product_code') }}</span>


            </div>
        </div>

        <div class="col-md-3">
      <div class="form-group">
          <strong>Profession <b style="color: red;">*</b></strong>
          <input type="text" name="profession" id="profession"  class="form-control"  required >
          <span class="text-danger">{{ $errors->first('product_code') }}</span>


            </div>
        </div>



        <div class="col-md-3">
            <div class="form-group">
                <strong>Email <b style="color: red;">*</b></strong>
                <input type="email"  id="email" class="form-control" required  name="email">
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
        </div>

            <div class="col-md-3">
                <div class="form-group">
                   <strong>Contact1 <b style="color: red;">*</b></strong>
                    <input type="text" class="form-control" placeholder="" name="mobile1" id="mobile1" value="" required>
                 </div>
            </div>

            <div class="col-md-3">
                    <div class="form-group">
                         <strong>Contact2 </strong>
                        <input type="text" class="form-control" placeholder="" name="mobile2" id="mobile2">
                     </div>
             </div>


        <div class="col-md-3">
            <div class="form-group">
                <strong>Type de pièce <b style="color: red;">*</b></strong>
                <select class="form-control" id="type_piece" name="type_piece" required>
                    <option value="">Choisir</option>
                    <option value="cni">-CNI-</option>
                    <option value="passeport">-Passeport-</option>
               </select>
            </div>
       </div>

       <div class="col-md-3">
          <div class="form-group">
                <strong>Numéro de pièce <b style="color: red;">*</b></strong>
                <input type="text" name="numero_piece" required id="numero_piece" class="form-control" placeholder="">
                <span class="text-danger">{{ $errors->first('image') }}</span>
           </div>
       </div>

 </div>


 <div class="row">


    <div class="col-md-3">
            <div class="form-group">
                <strong>Etablie le <b style="color: red;">*</b></strong>
                <input type="date" name="etablie_le" required id="etablie_le" class="form-control" placeholder="">
                <span class="text-danger">{{ $errors->first('image') }}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <strong>Domicilié à <b style="color: red;">*</b></strong>
                <input type="text" name="domicile_a" required id="domicile_a" class="form-control" placeholder="">
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
            <input type="text" name="nom_representant"  id="nom_representant" class="form-control">

        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <strong>Contact1</strong>
            <input type="text" name="contact1_representant"  id="contact1_representant" class="form-control">

        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <strong>Contact2 </strong>
            <input type="text" name="contact2_representant"  id="contact2_representant" class="form-control">

        </div>
    </div>

 </div>

 </div>





            <div class="modal-footer">

                <input type="submit" class="btn btn-success" value="Ajouter"  id="">

            </div>


</form>



                </div>
              </div>
            </div>












</div>



@endsection
