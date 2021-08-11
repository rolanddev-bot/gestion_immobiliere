@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script type="text/javascript">

$('#info_representant').hide()
    $('#infos_proprietaire_entete').hide()
    $('#nom_societeOK').hide()
    $('#infos_proprietaire_societe').hide()
    $('#registre_societeOK').hide()
</script>



<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Locataire - Ajouter</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

 <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a>


                </div>
                <div class="table-responsive p-3">

                <div class="row">
             <div class="col-md-3">
                    <div class="form-group">
                        <strong>Type locataire<b style="color: red;">*</b></strong>
                        <select class="form-control" id="type_locataire" name="type_locataire" required>
                                 <option value="">Choisir</option>
                                 <option value="personne physique">Personne physique</option>
                                 <option value="personne morale">Personne morale</option>

                        </select>
                    </div>
                </div>
        </div>


        <div id="locataire_physique">

 <form  name="form_locataire" id="" method="POST" action="{{ route('locataire_store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!--  ************************* personne physique **********************************************  -->
        <input type="hidden" name="locataire_id" id="">
        <input type="hidden" name="type_locataire" id="type_locataire" value="personne physique">

        <div class="row">

    <div class="col-md-3">
         <div class="form-group">
             <strong>Civilité</strong>
             <select class="form-control" id="sexe" name="sexe" required>
                      <option value="">Choisir</option>
                     <option value="Mr">Monsieur</option>
                     <option value="Mdme">Madame</option>
                     <option value="Mdle">Mademoiselle</option>

              </select>
         </div>
     </div>

     <div class="col-md-3">
         <div class="form-group">
             <strong>Nom<b style="color: red;">*</b></strong>
             <input type="text" name="nom" id="nom" required class="form-control" >

         </div>
     </div>
     <div class="col-md-3">
         <div class="form-group">
             <strong>Prénom(s) <b style="color: red;">*</b></strong>
             <input type="text" name="prenom" id="prenom" required class="form-control" >
         </div>
     </div>

     <div class="col-md-3">
         <div class="form-group">
             <strong>Nationalité <b style="color: red;">*</b></strong>
             <input type="text" name="nationalite" id="nationalite" required class="form-control" >
         </div>
     </div>


     <div class="col-md-3">
         <div class="form-group">
             <strong>Email <b style="color: red;">*</b> </strong>
             <input class="form-control" type="email" name="emaila" id="emaila" value="">
         </div>
     </div>

       <div class="col-md-3">
             <div class="form-group">
                  <strong>Contact1<b style="color: red;">*</b></strong>
                 <input type="text" class="form-control"  name="mobile1" id="mobile1" value="" required>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <strong>Contact2</strong>
                <input type="text" class="form-control"  name="mobile2" id="mobile2">
            </div>
        </div>

     <div class="col-md-3">
        <div class="form-group">
            <strong>Type de pièce<b style="color: red;">*</b></strong>
            <select class="form-control" id="type_piece" name="type_piece" required>
                    <option value="">choisir</option>
                    <option value="cni">-CNI-</option>
                    <option value="passeport">-Passeport-</option>
                    <option value="permis">-Permis-</option>
            </select>
        </div>
    </div>

</div>

    <div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <strong>Numéro de pièce<b style="color: red;">*</b></strong>
            <input type="text" name="numero_piece" required id="numero_piece" class="form-control" >
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

        <div class="col-md-3">
		<div class="form-group">
			<strong>N° CC</strong>
			<input type="text" class="form-control" col="3"   name="compte_contribuable" id="compte_contribuable" value="" placeholder="">
		</div>
    </div>


           <div class="col-md-4" id="photo_disp">
                <div class="form-group">
                    <strong>Photo du Preneur</strong>
                    <input type="file" name="photo" id="photo" class="form-control" placeholder="">
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                </div>
            </div>

            <div class="col-md-4" id="DateN_disp">
                <div class="form-group">
                    <strong>Date de Naissance<b style="color: red;">*</b></strong>
                    <input type="date" name="date_naissance" id="date_naissance" required class="form-control" placeholder="">

                </div>
            </div>

            <div class="col-md-3">
                    <div class="form-group">
                        <strong>Adresse<b style="color: red;">*</b></strong>
                        <input type="text" class="form-control" col="3" required name="adresse" id="adresse" >

                    </div>
            </div>

        </div>

        <div class="modal-footer">
         <input type="submit" class="btn btn-success" value="Ajouter"  id="">

         </div>
</form>

</div>

 <!--  ************************* personne morale **********************************************  -->

    <div id="locataire_morale">


 <form  name="form_locataire" method="POST" action="{{ route('locataire_store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="hidden" name="locataire_id" id="">
        <input type="hidden" name="type_locataire" id="type_locataire" value="personne morale">

        <div id="">
 <h4  class="col-primary" style="color:#00F" > Société </h4><hr>

 <div class="row">
	<div class="col-md-3" id="">
		 <div class="form-group">
				 <strong>Nom Société <b style="color: red;">*</b></strong>
				<input type="text" name="nom_societe_loc" required id="nom_societe_loc" class="form-control">
		 </div>
	</div>

	<div class="col-md-3" id="">
		 <div class="form-group">
				 <strong>N° RCCM <b style="color: red;">*</b></strong>
				<input type="text" name="numero_registre_loc" required id="numero_registre_loc" class="form-control">
		 </div>
	</div>

    <div class="col-md-3">
			<div class="form-group">
				<strong>Capital Société<b style="color: red;">*</b></strong>
				<input type="text" class="form-control"  required name="capital_societe" id="capital_societe">
			</div>
		</div>

	<div class="col-md-3" id="">
		<div class="form-group">
				<strong>PJ RCCM </strong>
				 <input type="file" name="documents[]" multiple="" id="documents" class="form-control" placeholder="">
		</div>
	</div>

	<div class="col-md-2" id="">
		 <div class="form-group">
				 <strong>Télephone Société <b style="color: red;">*</b></strong>
				<input type="text" name="telephone_societe_loc" required id="telephone_societe_loc" class="form-control">
		 </div>
	</div>


	<div class="col-md-3">
			<div class="form-group">
				<strong>Adresse Société<b style="color: red;">*</b></strong>
				<input type="text" class="form-control" col="3" required name="adresse_societe_loc" id="adresse_societe_loc" placeholder="">
			</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
			<strong>N° CC</strong>
			<input type="text" class="form-control" col="3"   name="compte_contribuable" id="compte_contribuable" value="" placeholder="">
		</div>
    </div>


		<div class="col-md-2">
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
 </div>

                <div id="">


                    <h4  class="col-primary" style="color:#00F" > Représentant </h4><hr>
                </div>
        <div class="row">

               <div class="col-md-3">
                        <div class="form-group">
                            <strong>Civilité</strong>
                            <select class="form-control" id="sexe" name="sexe" required>
                                     <option value="">Choisir</option>
                                    <option value="Mr">Monsieur</option>
                                    <option value="Mdme">Madame</option>
                                    <option value="Mdle">Mademoiselle</option>

                             </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Nom<b style="color: red;">*</b></strong>
                            <input type="text" name="nom" id="nom" required class="form-control" >

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Prénom(s) <b style="color: red;">*</b></strong>
                            <input type="text" name="prenom" id="prenom" required class="form-control" >
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Email <b style="color: red;">*</b> </strong>
                            <input class="form-control" type="email" name="emaila" id="emaila" value="">
                        </div>
                    </div>
             </div>


            <div class="row">

                     <div class="col-md-3">
                            <div class="form-group">
                                 <strong>Contact1<b style="color: red;">*</b></strong>
                                <input type="text" class="form-control"  name="mobile1" id="mobile1" value="" required>
                                </div>
                     </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Contact2</strong>
                           <input type="text" class="form-control"  name="mobile2" id="mobile2">
                        </div>
                    </div>


                    <div class="col-md-3">
                    <div class="form-group">
                        <strong>Type de pièce<b style="color: red;">*</b></strong>
                          <select class="form-control" id="type_piece" name="type_piece" required>
                                 <option value="">choisir</option>
                                 <option value="cni">-CNI-</option>
                                 <option value="passeport">-Passeport-</option>
                                <option value="permis">-Permis-</option>
                          </select>
                    </div>
                </div>

             </div>

             <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Numéro de pièce<b style="color: red;">*</b></strong>
                        <input type="text" name="numero_piece" required id="numero_piece" class="form-control" >
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    </div>
                </div>


                <div class="col-md-4" id="photo_disp">
                        <div class="form-group">
                            <strong>Photo du Preneur</strong>
                            <input type="file" name="photo" id="photo" class="form-control" placeholder="">
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>
                    </div>

                <div class="col-md-3" id="DateN_disp">
                    <div class="form-group">
                        <strong>Date de Naissance<b style="color: red;">*</b></strong>
                        <input type="date" name="date_naissance" id="date_naissance" class="form-control" placeholder="">

                    </div>
                </div>

                </div>



	<div class="row" id="Adresse_disp">
	<div class="col-md-3">
		<div class="form-group">
			<strong>Adresse<b style="color: red;">*</b></strong>
			<input type="text" class="form-control" col="3"  name="adresse" id="adresse" >

		</div>
	</div>


   </div>


     <div class="" id="">

          <h4  class="col-primary" style="color:#00F" > Personne à contacter </h4><hr>

            <div class="row">
        <div class="col-md-3">
             <div class="form-group">
               <strong>Nom & prénom(s) </strong>
                 <input type="text" name="nom_representant_loc"  id="nom_representant_loc" class="form-control">

              </div>
    </div>


             <div class="col-md-3">
              <div class="form-group">
                        <strong>Contact1 </strong>
                        <input type="text" name="contact1_representant_loc" id="contact1_representant_loc" class="form-control">

                        </div>
                        </div>

                     <div class="col-md-3">
                 <div class="form-group">
                      <strong>Contact2 </strong>
                            <input type="text" name="contact2_representant_loc" id="contact2_representant_loc" class="form-control">
                   </div>
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
            </div>












</div>



@endsection
