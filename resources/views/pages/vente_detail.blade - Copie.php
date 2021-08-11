@extends('layouts.main')
 @section('content')
 @include('pages.incl_fonction')

    <div class="container-fluid" id="container-wrapper">
        <div class="row">
            <h2>&nbsp;&nbsp;DETAIL VENTE</h2>

        </div><br>
        <hr class="sidebar-divider my-0" style="border: solid ">  <br><br>
        <p><a href="{{ url('vente')}}">Retour</a></p>
            <div class="row" >
                <div class="col-md-3">

                    @foreach($ventes as $vente)
                   <p style="font-size: px;"> Libellé bien  :  <b style="color:#6d071a;">{{$vente->bien->libelle}}</b></p>
                   <p style="font-size: px;"> Prix unitaire : <b  style="color:#6d071a;">{{ separer($vente->prix_unitaire, 3) }}</b></p>
                   <p style="font-size: px;"> Prix unitaire : <b  style="color:#6d071a;">{{ separer($vente->montant_total, 3) }}</b></p>

                    @endforeach

                </div>
                <div class="col-md-3">
                @foreach($ventes as $vente)
                <br>
                <p style="font-size: px;"> Remise :  <b  style="color:#6d071a;">{{$vente->remise.' '.'(%)'}}</b></p>
                <p style="font-size: px;"> Tva :  <b  style="color:#6d071a;">{{$vente->tva.' '.'(%)'}}</b></p>

                @endforeach

                </div>
                <div class="col-md-3">
                @foreach($ventes as $vente)

                <br>
                <p style="font-size: px;"> Date vente :  <b  style="color:#6d071a;">{{$vente->date_vente}}</b></p>
                <p style="font-size: px;"> Commenetaire :  <b  style="color:#6d071a;">{{$vente->commentaire}}</b></p>

                @endforeach

                </div>
         </div>
         <hr class="sidebar-divider my-0" style="border: 1px solid; width:100%"> <br>
            <h2>&nbsp;&nbsp;ACQUEREUR(S)</h2>

            <div class="col-lg-9">

              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creer_acheteur" style="font-size:20px;" data-target="#modal_bien"><i class="fas fa-fw fa-plus-square"></i></a>
                </div>
                <div class="table-responsive p-3">

                  <table class="table align-items-center table-flush table-hover" id="" >
                  <thead class="thead-light">
                      <tr>
                      <th>Nom & prénom(s)</th>
                      <th>Contact </th>
                        <th>Email</th>
                        <th>Action</th>

                      </tr>
                    </thead>

                    <tbody>
                    @foreach($acheters as $acheter)
                   <tr style="font-size: 13px; width:150px; ">
                     <td>{{$acheter->locataire->nom.' '.$acheter->locataire->prenom}}</td>


                     <td>{{$acheter->locataire->mob1}}</td>


                     <td>{{$acheter->locataire->autres}}</td>
                     <td style="width:200px;">
                     <a href="javascript:void(0)" id="modif_vente_detail" data-id="{{$acheter->id}}" data-vente_id="{{$acheter->vente_id}}" data-locataire_id="{{$acheter->locataire_id}}"   data-bien_id=""  data-email="" data-nom="" data-prenom="" class="btn btn-info"> <i class="fas fa-fw fa-edit"></i></a>
                    <!-- <a href="javascript:void(0)" id="voir_loca"  data-mobile2="" data-mobile1="" data-sexe="" data-adresse="" data-id="" data-photo=""  data-email="" data-nom="" data-prenom="" class="btn btn-warning"> <i class="fas fa-fw fa-eye"></i></a>  -->
                     <a  href="{{route('deleteventedetail',['vente_id' => $acheter->vente_id, 'acheter_id'=>$acheter->id])}}" onclick="return confirm('voulez-vous vraiment supprimer cet acheteur ?')" id="supp_vente_detail" data-id="{{$acheter->id}}" class="btn btn-danger delete-user"><i class="fas fa-fw fa-trash"></i></a>
                     </td>
                   </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>












            <!--              Modal d'ajout des acheteurs            -->

        <div class="modal fade bd-example-modal-sm" id="modal_vente_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title" style="text-align: center;" id="titrevente_detail"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                    <form  name="form_vente_detail" id="form_vente_detail" method="GET" action="{{route('createventedetail')}}">
                {{ csrf_field() }}
                <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
                <input type="hidden" name="acheter_id" id="acheter_id">
                @foreach($ventes as $vente)
                <input type="hidden" name="vente_id" id="vente_id" value="{{$vente->id}}">
                    @endforeach

                        <div class="row">
                            <strong>Acheteur <b style="color: red;">*</b></strong>
                                <select name="acheteur[]" id="acheteur" class="form-control col-md-6" >
                                    <option value="">Achéteur</option>
                                    @foreach($locataires as $locataire)
                                    <option value="{{$locataire->id}}">{{$locataire->nom.' '.$locataire->prenom}}</option>
                                    @endforeach
                                    </select>

                        </div>
                        <br>




                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="save_ventedetail">ajouter</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>

                            </div>

            </form>

            </div>
            </div>
        </div>
        </div>



 <!--              Modal de modification des acheteurs            -->

 <div class="modal fade bd-example-modal-sm" id="modal_modif_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="">Modification </h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


     <form  name="form_modif_detail" id="form_modif_detail" method="GET" action="{{route('updateventedetail')}}">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
        <input type="hidden" name="acheter_idm" id="acheter_idm">

        <input type="hidden" name="vente_idm" id="vente_idm">


                  <div class="row">
                     <strong>Acheteur <b style="color: red;">*</b></strong>
                          <select name="acheteurm" id="acheteurm" class="form-control col-md-6" >
                            <option value="">Achéteur</option>
                             @foreach($locataires as $locataire)
                            <option value="{{$locataire->id}}">{{$locataire->nom.''.$locataire->prenom}}</option>
                            @endforeach
                            </select>

                  </div>
                  <br>




         <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="save_vente_modifdetail">modifier</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">annuler</button>

        </div>

    </form>

      </div>
    </div>
  </div>
</div>














</div>



 @endsection
