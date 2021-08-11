@extends('layouts.main')

@section('content')
<div class="container-fluid" id="container-wrapper">

  
 <div class="col-lg-12">
        <h2 class="text-center alert alert-secondary">Types de bien </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <p><a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creertypebien" style="font-size:15px;" 
    data-target="#modal_typebien"><i class="fas fa-fw fa-plus-square"></i>Nouveau</a> 
    
    
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="datatabletypebien" style="width:80%">
                    <thead class="thead-light">
                      <tr>
                        <th>Libellé</th>
                        <th>Details</th>

                        <th>Action</th>

                      </tr>
                    </thead>


                    <tbody>


                    @foreach($typebiens as $tybien)
                   <tr style="font-size: px; " @if($tybien->archiver == 1) class="fond_desactiver" @endif>

                     <td>{{$tybien->libelle}}</td>
                     <td>{{$tybien->details}}</td>

                     <td style="width:px;">
<a href="javascript:void(0)" id="modif_typebien" data-id="{{$tybien->id}}" title="Modifier" data-libelle="{{$tybien->libelle}}" 
data-details="{{$tybien->details}}" class=""> <i class="fas fa-fw fa-edit"  style="font-size:15px"></i></a>

 
 <a href="javascript:void(0)" id="supp_typebien" data-id="{{$tybien->id}}" title="Supprimer" class="">
 <i class="fas fa-file-archive" style="font-size:15px"></i></a>
                     </td>
                   </tr>
                  @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>





    <div class="modal fade bd-example-modal-sm" id="modal_typebien" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titretypebien"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


              <form  name="form_typebien" id="form_typebien">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
        <input type="hidden" name="typebien_id" id="typebien_id">


                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Libellé<b style="color: red;">*</b></strong>
                            <input type="text" name="libelle" id="libelle" required class="form-control" >
                            <div id="vide" class="text-danger"></div>
                            <div class="alert-danger" id="libellesError"></div>
                        </div>
                    </div>
                        <div class="col-md-12">
                           <div class="form-group">
                                <strong>Détail(s):</strong>
                                <textarea name="details" id="details" class="form-control" rows=""   cols=""></textarea>
                                <div class="alert-danger" id="detailsError"></div>

                            </div>
                        </div>





                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="savetypebien">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

    </form>

      </div>
    </div>
  </div>
</div>








@endsection
