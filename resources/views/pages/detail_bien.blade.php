@extends('layouts.main')
@section('content')

<div class="container-fluid" id="container-wrapper">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Details</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashbord')}}">Accueill</a></li>
                    <li class="breadcrumb-item active" aria-current="page">details</li>
                </ol>
        </div>
        @foreach($datas as $data)
        <h2 class="text-center alert alert-secondary">Détail bien No: {{$data->ref}} </h2>


<div class="container">


  <table class="table">
    <thead>
      <tr>
        <th>Type de bien</th>
        <th>Libellé</th>
        <th>Lot/Ilot</th>
        <th>Nbre Pièce</th>
        <th>Surface(m²)</th>
        <th>Commune</th>
        <th>Disponible</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$data->typebien->libelle}}</td>
        <td>{{$data->libelle}}</td>
        <td>{{$data->lot.'/'.$data->ilot}}</td>
        <td>{{$data->nbre_piece}}</td>
        <td>{{$data->surface}}</td>
        <td>{{$data->commune->libelle}}</td>
        <td>@if($data->libre == 0) Oui @else Non @endif </td>
      </tr>
    </tbody>
  </table>
</div>
        @endforeach
        <br><br>

    <form  name="form_details" id="form_details" method="GET" action="{{route('detail_biencreate')}}">
    <h2 style="text-align: center;">Ajouter un détail</h2>

        @foreach($datas as $data)
        <input type="hidden" name="bienid" id="bienid" value="{{$data->id}}">
        <input type="hidden" name="id_equipement" id="id_equipement" >
        @endforeach
            <div class="row">
            <div class="col-md-2">
            </div>
                   <div class="col-md-3">
                        <div class="form-group">
                             <strong>Type détail <b style="color: red;">*</b></strong>
                             <select class="form-control" id="type_detail" name="type_detail" required>
                                 <option value="">Choisir</option>
                                <option value="Equipement">Equipement</option>
                                <option value="Autre">Autre</option>
                             </select>
                            <div class="alert-danger" id="type_detailError"></div>
                        </div>
                   </div>

                    <div class="col-md-3">
                         <div class="form-group">
                             <strong>Désignation <b style="color: red;">*</b></strong>
                            <input type="text" name="libelle" id="libelle" required class="form-control">
                             <div class="alert-danger" id="libelleError"></div>

                        </div>

                   </div>
                   <div><br>
                   <button type="submit" class="btn btn-success mb-1" id="save_details">Enregistrer</button>
                   </div>

            </div>
    </form>


    <div class="col-lg-12">

              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                </div>
                <div class="table-responsive p-3">
                <a href="{{route('bien')}}" class="text-center btn btn-success btn-lg" style="font-size:20px;"><i class="fas fa-fw fa-bars"></i>Biens</a>
                  <table class="table align-items-center table-flush table-hover" id="datatabledetails_bien">
                    <thead class="thead-light">
                      <tr>
                      <th>Libellé du bien</th>
                      <th>Type </th>
                        <th>Libellé</th>
                        <th>Action</th>

                      </tr>
                    </thead>



                    <tbody>


                    @foreach($details as $detail)
                   <tr style="font-size: 13px; width:150px; ">

                     <td>{{$detail->bien->libelle}}</td>
                     <td>{{$detail->type_detail}}</td>
                     <td>{{$detail->libelle}}</td>
                     <td style="width:150px;">
                     <a href="javascript:void(0)" id="modif_details" data-id="{{$detail->id}}" data-type_detail="{{$detail->type_detail}}" data-libelle="{{$detail->libelle}}"   data-bien_id="{{$detail->bien_id}}"  data-email="" data-nom="" data-prenom="" class="btn btn-info"> <i class="fas fa-fw fa-edit"></i></a>
                    <!-- <a href="javascript:void(0)" id="voir_loca"  data-mobile2="" data-mobile1="" data-sexe="" data-adresse="" data-id="" data-photo=""  data-email="" data-nom="" data-prenom="" class="btn btn-warning"> <i class="fas fa-fw fa-eye"></i></a>  -->
                     <a  href="{{route('deletedetails',['detailid' => $detail->id, 'id'=>$detail->bien_id])}}" id="supp_details" data-id="{{$detail->id}}" class="btn btn-danger delete-user"><i class="fas fa-fw fa-trash"></i></a>
                     </td>
                   </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>















        <div class="modal fade bd-example-modal-sm" id="modal_details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title" style="text-align: center;" id="titredetail"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                    <form name="form_details" id="form_details" method="GET" action="{{route('detail_bienupdate')}}">
                {{ csrf_field() }}
                <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->

        <input type="hidden" name="bienidm" id="bienidm">
        <input type="hidden" name="id_equipementm"  id="id_equipementm" >


                            <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Type detail <b style="color: red;">*</b></strong>
                                        <select class="form-control" id="type_detailm" name="type_detailm" required>
                                            <option value="">Choisir</option>
                                            <option value="equipement">equipement</option>
                                            <option value="autre">autre</option>
                                        </select>
                                        <div class="alert-danger" id="type_detailError"></div>
                                    </div>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                         <strong>Nom de l'equipement <b style="color: red;">*</b></strong>
                                         <input type="text" name="libellem" id="libellem" required class="form-control">
                                        <div class="alert-danger" id="libelleError"></div>

                                    </div>

                                </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="savedetails">Enregistrer</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                            </div>

            </form>

            </div>
            </div>
        </div>
        </div>












</div>

@endsection
