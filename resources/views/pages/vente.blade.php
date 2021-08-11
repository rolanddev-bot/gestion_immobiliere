@extends('layouts.main')
 @section('content')
 
 @include('pages.incl_fonction')
 
 <div class="container-fluid" id="container-wrapper">
      

        <div class="col-lg-12">
        <h2 class="text-center alert alert-secondary">Transaction</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               <p> <a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creervente" style="font-size:15px;" data-target="#modal_vente">
               <i class="fas fa-fw fa-plus-square" style="font-size: 15px"></i>Nouvelle</a> &nbsp;&nbsp; &nbsp;

               </p>
                <p> <a href="{{route('ventequittance_pdf')}}" class="text-center btn btn-success btn-lg" style="font-size:15px;">
                <i class="far fa-file-pdf"></i> &nbsp; PDF</a>
<a href="" class="text-center btn btn-success btn-lg" style="font-size:15px;"><i class="far fa-file-excel"></i> &nbsp; EXCEL</a></p>


                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="datatable_vente">
                    <thead class="thead-light">
                      <tr>

                        <th>Réf.</th>
                        <th>Acheteur(s)</th>
                        <th>Bien</th>
                        <th>Valeur HT</th>

                        <th>Valeur TTC </th>
                        <th>Payé</th>
                        <th>Reste à payer</th>
                        <th>Statut</th>

                        <th>Action</th>

                      </tr>
                    </thead>


                    <tbody>


                    @foreach($ventes as $vente)
                   <tr style="font-size: 13px; width:190px; ">
                   <td><a href="{{ url('vente/'.$vente->id.'/edit') }}">{{ $vente->reference }}</a></td>

                     <td>
@foreach($acheters as $acheter)
    @if($vente->id == $acheter->vente_id)
        {!! $acheter->locataire->nom.' '.$acheter->locataire->prenom !!}<br>
    @endif

@endforeach

                     </td>

                     <td>{{$vente->bien->libelle}}</td>

                     <td>{{ separer($vente->prix_unitaire, 3)  }}</td>

                     <td>{{ separer($vente->montant_total, 3) }}</td>
                     <td>{{ separer($vente->payer,3) }}</td>
                     <td>{{ separer($vente->reste_payer, 3) }}</td>
                     <?php if ($vente->statut == 'soldé') {     ?>
                     <td class="text-success">{{$vente->statut}}</td>
                     <?php  } else { ?>
                        <td class="text-warning">{{$vente->statut}}</td>
                        <?php
                    } ?>
                     <td style="width:10%px">
                     
 <a style="font-size:15px;" href="javascript:void(0)" title="Editer" id="modif_vente" data-id="{{$vente->id}}" data-tva="{{$vente->tva}}" data-bien="{{$vente->bien_id}}" data-pu="{{$vente->prix_unitaire}}"  data-remise="{{$vente->remise}}"  data-commentaire="{{$vente->commentaire}}" data-date_vente="{{$vente->date_vente}}" data-prenom="" class=""> <i class="fas fa-fw fa-edit"></i></a>
 
 
 

 <a style="font-size:15px;" title="Imprimer"  href="{{route('vente_facture',['id' => $vente->id])}}" id="facture_vente"  data-id="{{$vente->id}}" data-mobile2="" data-mobile1="" data-sexe="" data-adresse="" data-id="" data-photo=""  data-email="" data-nom="" data-prenom="" class=""> <i class="fas fa-print"></i></a>


 <a style="font-size:15px;"  href="javascript:void(0)" id="reglement_vente"  data-vente_id="{{$vente->id}}" data-montant_vente="{{$vente->montant_total}}" data-ref_vente="{{$vente->reference}}" data-sexe="" data-adresse="" data-id="" data-photo=""  data-email="" data-nom="" data-prenom="" class=""> <i class="far fa-money-bill-alt"></i></a>
                    
                     </td>
                   </tr>
                   @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
            </div>






   <div class="modal fade bd-example-modal-lg" id="modal_vente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
         <div class="modal-content">

            <div class="modal-header">
            <h2 class="modal-title" style="text-align: center;" id="titrevente"></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">


              <form  name="form_vente" id="form_vente" >
                {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
               <input type="hidden" name="vente_id" id="vente_id">

                  <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Bien <b style="color: red;">*</b></strong>
                                <select name="bien_vente" id="bien_vente" class="form-control">
                                    <option value="">choisir Le bien</option>
                                    @foreach($biens as $bien)
                                    <option value="{{$bien->id}}">{{$bien->libelle.'  ('.$bien->ref.')'}}</option>
                                    @endforeach
                                </select>
                                <div class="alert-danger" id="bienError"></div>

                            </div>
                        </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                <strong>Valeur du Bien<b style="color: red;">*</b></strong>
                                <input type="number" name="pu" id="pu" class="form-control" required  value="">
                                <div class="alert-danger" id="puError"></div>
                            </div>

                        </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6">
                                    <div class="form-group">
                                    <strong>Remise </strong>
                                    <input type="number" placeholder="10%" name="remise" id="remise" class="form-control" required  value="">
                                    <div class="alert-danger" id="remiseError"></div>
                                </div>

                         </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                <strong>Tva </strong>
                                <input type="number" name="tva" id="tva" class="form-control" placeholder="18%" required  value="">
                                <div class="alert-danger" id="tvaError"></div>
                            </div>

                        </div>

                  </div>


                  <div class="row">
                        <div class="col-md-6">
                                        <div class="form-group">
                                            <strong>Commentaire </strong>
                                            <input type="text" name="commentaire" id="commentaire" class="form-control" required  value="">
                                            <div class="alert-danger" id="commentaireError"></div>
                                       </div>

                        </div>


                        <div class="col-md-6">
                           <div class="form-group">
                                <strong>Date de la vente <b style="color: red;">*</b></strong>
                                <input type="date" name="date_vente" id="date_vente" class="form-control" required placeholder="date" value="">
                                <div class="alert-danger" id="date_venteError"></div>

                            </div>
                        </div>

                  </div>

                  <p id="button_acheter"> <a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="add_acheteur" style="font-size:20px;"><i class="fas fa-fw fa-plus-square"></i>Ajouter un Acheteur</a> </p>
                 <div class="acheteur" id="acheteur">


                  <div class="row">
                  <strong>Acheteur <b style="color: red;">*</b></strong>
                  <select name="acheteur[]" id="acheteur" class="form-control col-md-6" value="ok">
                                    <option value="">Achéteur</option>
                                    @foreach($locataires as $locataire)
                                    <option value="{{$locataire->id}}">{{$locataire->nom.''.$locataire->prenom}}</option>
                                    @endforeach
                                </select>
                      &nbsp;&nbsp; &nbsp;  <a href="javascript:void(0)" style="font-size:20px;" class="col-md-2 btn btn-danger" id="supprimer_acheteur"><i class="fas fa-times"></i></a>
                  </div> <br>

                  </div>





                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="save_vente">Enregistrer</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

    </form>

      </div>
    </div>
  </div>
</div>





<!--    ************************modal de modification d'une vente effectuer  *****************************************   -->


<div class="modal fade bd-example-modal-lg" id="modal_vente_modif" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
         <div class="modal-content">

            <div class="modal-header">
            <h2 class="modal-title" style="text-align: center;" id="">Modification de la vente</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">


              <form  name="form_vente_modif" id="form_vente_modif" method="POST" action="{{route('createvente')}}">
                {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
               <input type="hidden" name="vente_id" id="vente_id">

                  <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Bien <b style="color: red;">*</b></strong>
                                <select name="bien_vente" id="bien_vente" class="form-control">
                                    <option value="">choisir Le bien</option>
                                    @foreach($biens as $bien)
                                    <option value="{{$bien->id}}">{{$bien->libelle.'  ('.$bien->ref.')'}}</option>
                                    @endforeach
                                </select>
                                <div class="alert-danger" id="bienError"></div>

                            </div>
                        </div>

                        <div class="col-md-6">
                                <div class="form-group">
                                <strong>Valeur du Bien<b style="color: red;">*</b></strong>
                                <input type="number" name="pu" id="pu" class="form-control" required  value="">
                                <div class="alert-danger" id="puError"></div>
                            </div>

                        </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6">
                                    <div class="form-group">
                                    <strong>Remise </strong>
                                    <input type="number" placeholder="10%" name="remise" id="remise" class="form-control" required  value="">
                                    <div class="alert-danger" id="remiseError"></div>
                                </div>

                         </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                <strong>Tva </strong>
                                <input type="number" name="tva" id="tva" class="form-control" placeholder="18%" required  value="">
                                <div class="alert-danger" id="tvaError"></div>
                            </div>

                        </div>

                  </div>


                  <div class="row">
                        <div class="col-md-6">
                                        <div class="form-group">
                                            <strong>Commentaire </strong>
                                            <input type="text" name="commentaire" id=commentaire" class="form-control" required  value="">
                                            <div class="alert-danger" id="commentaireError"></div>
                                       </div>

                        </div>


                        <div class="col-md-6">
                           <div class="form-group">
                                <strong>Date de la vente <b style="color: red;">*</b></strong>
                                <input type="date" name="date_vente" id="date_vente" class="form-control" required placeholder="date" value="">
                                <div class="alert-danger" id="date_venteError"></div>

                            </div>
                        </div>

                  </div>

                  <p> <a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="add_acheteur" style="font-size:20px;"><i class="fas fa-fw fa-plus-square"></i>Ajouter un Acheteur</a> </p>
                 <div class="acheteur" id="acheteur">


                  <div class="row">
                  <strong>Acheteur <b style="color: red;">*</b></strong>
                  <select name="acheteur[]" id="acheteur" class="form-control col-md-6">
                                    <option value="">Achéteur</option>
                                    @foreach($locataires as $locataire)
                                    <option value="{{$locataire->id}}">{{$locataire->nom.''.$locataire->prenom}}</option>
                                    @endforeach
                                </select>
                      &nbsp;&nbsp; &nbsp;  <a href="javascript:void(0)" style="font-size:20px;" class="col-md-2 btn btn-danger" id="supprimer_acheteur"><i class="fas fa-times"></i></a>
                  </div> <br>

                  </div>





                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="save_vente_modif">Enregistrer</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

    </form>

      </div>
    </div>
  </div>
</div>


<!--   ******************************** fin du modal de modification d'une vente ***********************************   -->


<!--   ******************************** DEBUT du modal de REGLEMENT d'une vente ***********************************   -->


<div>
    <div class="modal fade bd-example-modal-xl" id="modalAfficherReglementVente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;" id="">VENTE N° : <span id="titreModalReglementVente" class="text-danger"></span></h4>

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
            </div>
          <div class="modal-body">
              <p>Montantde la vente : <span id="facture_montant_vente" class="text-danger"></span></p>


           <form name="formReglementVente" id="formReglementVente">
           {{ csrf_field() }}

                <input type="hidden" name="user_id_reglement" value="{{ Auth::user()->id}}">
                <input type="hidden" name="user_nom_reglement"  value="{{ Auth::user()->name}}">
                <input type="hidden" name="vente_id_reglement" id="vente_id_reglement" >

                <div class="input-group mb-3">
                        <input type="number" class="form-control" name="reglement_montant_vente" id="facture_montant_vente"  placeholder="Saisir Montant" aria-label="Recipient's username"
                        aria-describedby="basic-addon2" required>
                        <input type="date" class="form-control" name="reglement_datereglt_vente" id="facture_datereglt_vente"  placeholder="Saisir Date" aria-label="Recipient's username"
                        aria-describedby="basic-addon2" required>
                       <div class="input-group-append">
                           <button class="input-group-text" id="effectuer_reglement">Ajouter</button>
                       </div>
               </div>
           </form> <br>

            <div id="div_reglementvente">
            </div>



         </div>
       </div>
    </div>
   </div>
</div>











 </div>




 @endsection
