@extends('layouts.main')

@section('content')

<div class="container-fluid" id="container-wrapper">



    <div class="col-lg-12">
    <h2 class="text-center alert" style="background-color:darksalmon">Locataires archivés</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">




                </div>
                <div class="table-responsive p-3">

                  <table class="table align-items-center table-flush table-hover" id="dataTablelocataire">
                    <thead class="">
                      <tr>

                        <th>Photo</th>
                        <th>Nom & Prénom(s)</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Adresse</th>

                        <th width="2%">Action</th>
                      </tr>
                    </thead>


                    <tbody>


                    @foreach($locataires as $loca)

                   <tr style="font-size:px;">

	 <td>

@if($loca->photo != 'aucun')
<img width="30" class="rounded-circle" height="30" src="{{ url('/assets/dossier/'.$loca->photo) }}">
@else
<img width="30" class="rounded-circle" height="30" src="{{ url('/assets/img/avatar.png') }}">
@endif

	 </td>

	 <td>
	<a href="{{ url('locataire/'.$loca->id) }}">
	 {{ $loca->nom.' '.$loca->prenom}}
	 @if($loca->nom_societe != '') {{ $loca->nom_societe }} @endif
	</a>
	 </td>


	 <td>{{$loca->autres}}</td>
	 <td>

	 @if($loca->mob2 == '') {{ $loca->mob1 }}
	 @else {{ $loca->mob1.' / '.$loca->mob2 }}
	 @endif

	</td><td>

	@if($loca->type_locataire_acq == 'personne physique') {{ $loca->adresse }}
	@else {{ $loca->adresse_societe }} @endif
	</td>
<td>


<a href="javascript:void(0)"  id="archiver_locataire" data-archiver="{{ $loca->archiver }}" data-id="{{ $loca->id }}" title="Desarchiver" class="">
<i class="fas fa-file-archive" style="font-size:15px"></i></a>



                     </td>
                   </tr>
                @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>






















  <div class="modal fade bd-example-modal-xl" id="modal_locataire" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titrelocataire"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <form  name="form_locataire" id="form_locataire" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
        <input type="hidden" name="loca_id" id="loca_id">

        <div class="row">

               <div class="col-md-3">
                    <div class="form-group">
                        <strong>Type d'acquéreur<b style="color: red;">*</b></strong>
                        <select class="form-control" id="type_aquereur" name="type_aquereur" required>
                                 <option value="">Choisir</option>
                                 <option value="personne morale">personne morale</option>
                                <option value="personne physique">personne physique</option>
                        </select>
                    </div>
                </div>

        </div>

        <div id="infos_locataire_societe">
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
                                     <strong>Numéro registre <b style="color: red;">*</b></strong>
                                    <input type="text" name="numero_registre_loc" required id="numero_registre_loc" class="form-control">
                             </div>
                        </div>

                        <div class="col-md-2" id="">
                             <div class="form-group">
                                     <strong>Télephone Société <b style="color: red;">*</b></strong>
                                    <input type="text" name="telephone_societe_loc" required id="telephone_societe_loc" class="form-control">
                             </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <strong>Adresse Société</strong>
                                    <textarea class="form-control" col="3" required name="adresse_societe_loc" id="adresse_societe_loc" placeholder=""></textarea>
                                </div>
                            </div>


                     </div>
                 </div>


                <div id="infos_locataire_entete">


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

                <!--  ************************* FIN DES CHAMPS NOM PRENOM ET EMAIL**********************************************  -->

                <!--  *************************CHAMPS ADRESSE CONTACT ET SEXE**********************************************  -->
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
                            <strong>Type de Preneur</strong>
                                <div>
                                    <label class="checkbox-inline"><input class="" name="client" id="client" type="checkbox" value="client"> <b>client</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="checkbox-inline"><input name="locataire" id="locataire" type="checkbox" value="locataire"><b>locataire</b></label>
                                </div>
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
                        <input type="date" name="date_naissance" id="date_naissance" required class="form-control" placeholder="">

                    </div>
                </div>

                </div>



                    <div class="row" id="Adresse_disp">
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Adresse<b style="color: red;">*</b></strong>
                            <textarea class="form-control" col="3" required name="adresse" id="adresse" ></textarea>

                        </div>
                    </div>


                    </div>


                    <div class="info_representantlocataire" id="info_representantlocataire">


                            <h4  class="col-primary" style="color:#00F" > Personne à contacter </h4><hr>

                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <strong>Nom & prénom(s) </strong>
                                            <input type="text" name="nom_representant_loc" required id="nom_representant_loc" class="form-control">

                                        </div>
                                    </div>


                                   <div class="col-md-3">
                                        <div class="form-group">
                                            <strong>Contact1 </strong>
                                            <input type="text" name="contact1_representant_loc" required id="contact1_representant_loc" class="form-control">

                                        </div>
                                  </div>

                                  <div class="col-md-3">
                                        <div class="form-group">
                                            <strong>Contact2 </strong>
                                            <input type="text" name="contact2_representant_loc" required id="contact2_representant_loc" class="form-control">

                                        </div>
                                  </div>


                            </div>

                        </div>




                    <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="savelocataire">Enregistrer</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

            </div>

    </form>

      </div>
    </div>
  </div>
</div>

<!--    modal de modification ***************************************  -->





<!--    modal de modification ***************************************  -->

















</div>



@endsection
