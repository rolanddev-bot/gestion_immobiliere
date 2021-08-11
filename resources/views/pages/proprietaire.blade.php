@extends('layouts.main')

@section('content')
<div class="container-fluid" id="container-wrapper">

@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif


    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Propriétaire </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
<a href="{{ url('proprietaire-create') }}" style="font-size: 15px " class="text-center btn btn-success btn-lg"
><i class="fas fa-fw fa-plus-square" ></i>Nouveau</a>

</div>




                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableprop" >
                    <thead class="thead-light">
                      <tr>

                        <th>Photo</th>
                        <th>Nom & Prénom(s)</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Adresse</th>
                        <th>Action</th>
                      </tr>
                    </thead>


                    <tbody>


@foreach($proprietaire as $prop)
      <?php $datenow = \Carbon\Carbon::now()->format('Y'); ?>

        <tr>


        <td>
        <a href="{{ url('proprietaire/'.$prop->id) }}" title="Voir détail">
        @if($prop->photo != 'aucun')
        <img width="30" class="rounded-circle" height="30" src="{{ url('/assets/dossier/'.$prop->photo) }}">
        @else
        <img width="30" class="rounded-circle" height="30" src="{{ url('/assets/img/avatar.png') }}">
        @endif
			</a>
        </td>

        <td>
        <a href="{{ url('proprietaire/'.$prop->id) }}" title="Voir détail {{ $prop->type_proprietaire }}">
        @if($prop->nom_societe !='')
            {{ $prop->nom.' '.$prop->prenom.' - '.$prop->nom_societe }}
        @else
            {{ $prop->nom.' '.$prop->prenom }}
        @endif
        </a>
        </td>


        <td>{{ $prop->emailto }}</td>
        <td>
        @if($prop->mobile2 != '')  {{$prop->mobile1.' / '.$prop->mobile2}}
        @else {{$prop->mobile1}}
        @endif
        </td>
        <td>
            @if ($prop->nom_societe !='')  {{ $prop->adresse_societe }}
            @else {{ $prop->adresse }}
            @endif
        <td>
<a href="{{ url('proprietaire/'.$prop->id.'/edit') }}"  title="Modifier" >
<i class="fas fa-fw fa-edit"  style="font-size:15px"></i></a>

    &nbsp;

    <a href="javascript:void(0)" title="Archiver" id="arhiver_proprietaire" data-id="{{ $prop->id }}" data-archiver="{{ $prop->archiver }}" class="">
    <i class="fas fa-file-archive" style="font-size:15px"></i></a>
                        </td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
</div>


<!-- ---------------------------- Ajout Propriétaire------------------------ -->

<div>
<div class="modal fade bd-example-modal-xl" id="modalpro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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






<!--     **********************model affichage  ***************************************-->



<div>
<div class="modal fade bd-example-modal-xl" id="modal_modifpro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titremodal">Modification</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


              <form  name="form_propietairemodif" id="form_propietairemodif" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
        <input type="hidden" name="prop_idm" id="prop_idm">


<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <strong>Type de propriétaire<b style="color: red;">*</b></strong>
            <select class="form-control" id="type_proprietairem" name="type_proprietairem" required>
                        <option value="">Choisir</option>
                        <option value="personne morale">Personne morale</option>
                    <option value="personne physique">Personne physique</option>
            </select>
        </div>
    </div>



</div>


                <div id="infos_proprietaire_societem">

                     <h4 class="text-center" style="text-decoration:underline;" > Société</h4>

                     <div class="row">
                         <div class="col-md-3" id="">
                             <div class="form-group">
                                 <strong>Nom Société <b style="color: red;">*</b></strong>
                                <input type="text" name="nom_societem" required id="nom_societem" class="form-control">
                           </div>
                    </div>

                          <div class="col-md-3" id="">
                              <div class="form-group">
                                  <strong>Numéro registre <b style="color: red;">*</b></strong>
                                 <input type="text" name="numero_registrem" required id="numero_registrem" class="form-control">
                             </div>
                         </div>

                       <div class="col-md-4" id="registre_disp">
                             <div class="form-group">
                                  <strong>Registre de commerce </strong>
                                 <input type="file" name="documentsm[]" multiple id="documentsm" class="form-control" placeholder="">
                            </div>
                      </div>

                     <div class="col-md-2" id="">
                           <div class="form-group">
                                 <strong>Télephone Société <b style="color: red;">*</b></strong>
                               <input type="text" name="telephone_societem" required id="telephone_societem" class="form-control">
                            </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <strong>Adresse Société</strong>
                            <textarea class="form-control" col="3" required name="adresse_societem" id="adresse_societem" placeholder=""></textarea>
                        </div>
                    </div>

                </div>
                </div>

             <div id="infos_proprietaire_entetem">

               <h4 class="text-center" style="text-decoration:underline;" > Représentant </h4>
            </div>
           <div class="row">

           <div class="col-md-3">
                        <div class="form-group">
                            <strong>Civilité</strong>
                            <select class="form-control" id="sexem" name="sexem" required>
                                                            <option value="">Choisir</option>

                                                            <option value="Mlle">Mademoiselle</option>
                                                            <option value="Mdme">Madame</option>
                                                            <option value="Mr">Monsieur</option>

                                                        </select>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Nom<b style="color: red;">*</b></strong>
                            <input type="text" name="nomm" id="nomm" required class="form-control" placeholder="Enter le nom">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Prénom(s) <b style="color: red;">*</b></strong>
                            <input type="text" name="prenomm" id="prenomm" required class="form-control" placeholder="Enter le prenom">
                            <span class="text-danger">{{ $errors->first('product_code') }}</span>


                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Email <b style="color: red;">*</b></strong>
                            <input type="email"  id="emailm" class="form-control"  name="emailm" placeholder="Enter l'email" required>
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                </div>

                <!--  ************************* FIN DES CHAMPS NOM PRENOM ET EMAIL**********************************************  -->

                <!--  *************************CHAMPS ADRESSE CONTACT ET SEXE**********************************************  -->
            <div class="row">

                <div class="col-md-3">
                        <div class="form-group">
                            <strong>contact1</strong>
                           <input type="text" class="form-control" placeholder="" name="telephonem" id="telephonem" value="" required>
                        </div>
                    </div>


            <div class="col-md-3">
                        <div class="form-group">
                            <strong>contact 2<b style="color: red;">*</b></strong>
                           <input type="text" class="form-control" placeholder="" name="mobile1m" id="mobile1m">
                        </div>
                    </div>


                    <div class="col-md-3">
                    <div class="form-group">
                        <strong>Type de pièce<b style="color: red;">*</b></strong>
                        <select class="form-control" id="type_piecem" name="type_piecem" required>
                                                        <option value="">-Type de pièce-</option>
                                                        <option value="cni">-CNI-</option>
                                                        <option value="passeport">-Passeport-</option>
                                                    </select>
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Numéro de pièce<b style="color: red;">*</b></strong>
                        <input type="text" name="numero_piecem" required id="numero_piecem" class="form-control" placeholder="numero de pièce">
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    </div>
                </div>


             </div>

             <div class="row">

             <div class="col-md-3" id="photom_disp">
                        <div class="form-group">
                            <strong>Changer la photo :</strong>
                            <input type="file" name="photom" id="photom" class="form-control" placeholder="">
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>
                    </div>

                <div class="col-md-3" id="date_naissancem_disp">
                    <div class="form-group">
                        <strong>Date de Naissance<b style="color: red;">*</b></strong>
                        <input type="date" name="date_naissancem" id="date_naissancem" required class="form-control" placeholder="">
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    </div>
                </div>

                <div class="col-md-3" id="adressem_disp">
                        <div class="form-group">
                            <strong>Adresse<b style="color: red;">*</b></strong>
                            <textarea class="form-control" col="3" required name="adressem" id="adressem" placeholder="Adresse du Propritaire"></textarea>
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>
                    </div>

            </div>
                    <div class="info_representantm" id="info_representantm">
                            <hr>
                            <h2 class="text-center"> -- Personne à contacter --</h2>
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <strong>Nom & prénom(s)  </strong>
                                            <input type="text" name="nom_representantm" required id="nom_representantm" class="form-control">

                                        </div>
                                    </div>


                                   <div class="col-md-3">
                                        <div class="form-group">
                                            <strong>Contact1</strong>
                                            <input type="text" name="contact1_representantm" required id="contact1_representantm" class="form-control">

                                        </div>
                                  </div>

                                  <div class="col-md-3">
                                        <div class="form-group">
                                            <strong>Contact2</strong>
                                            <input type="text" name="contact2_representantm" required id="contact2_representantm" class="form-control">

                                        </div>
                                  </div>
                            </div>



                        </div>
<div class="row">

<div class="col-md-1">
        <div class="form-group">
            <label><strong>Archiver</strong></label>

        </div>
    </div>

    <div class="col-md-1">
        <div class="form-group">
            <input type="checkbox" name="desactiver"  class="form-check-input" value="1" id="desactiver">
        </div>
    </div>

</div>



                    <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="Appliquer">Modifier</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

            </div>

    </form>

      </div>
    </div>
  </div>
</div>
</div>














      </div>
    </div>
    </div>
<!-- **************************fin affichage ********************************************f-->






@endsection
