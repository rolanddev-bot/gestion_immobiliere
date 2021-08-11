@extends('layouts.main')
@section('content')

<div class="container-fluid" id="container-wrapper">
    

    <div class="col-lg-12">
        <h2 class="text-center alert alert-secondary">Charges Locatives & propriétaires </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
 <p><a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creercharge" style="font-size:15px;" data-target="#modal_charge"><i class="fas fa-fw fa-plus-square"></i>Nouvelle charge</a> &nbsp;&nbsp; &nbsp;

                </p>


                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="datatablecharge">
                    <thead class="thead-light">
                      <tr>
                      <th>Type charge</th>
                        <th>Libellé</th>
                        <th>Action</th>

                      </tr>
                    </thead>



                    <tbody>


	@foreach($charges as $charge)
   <tr style="font-size: 13px; width:150px; ">

	 <td>{{$charge->type_charge}}</td>
	 <td>{{$charge->libelle}}</td>
	 <td style="width:10%">
	 
	 <a href="javascript:void(0)" id="modif_charge" data-id="{{$charge->id}}" data-libelle="{{$charge->libelle}}" data-type_charge="{{$charge->type_charge}}"   data-photo=""  data-email="" data-nom="" data-prenom="" class=""> <i class="fas fa-fw fa-edit" style="font-size:15px"></i></a>

	 <a href="javascript:void(0)" id="supp_charge" data-id="{{$charge->id}}" class=""><i class="fas fa-fw fa-trash" style="font-size:15px"></i></a>
	 </td>
   </tr>
  @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>




 <div class="modal fade bd-example-modal-sm" id="modal_charge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titrecharge"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


              <form  name="form_charge" id="form_charge">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
        <input type="hidden" name="charge_id" id="charge_id">


                    <div class="col-md-12">
                            <div class="form-group">
                                <strong>Type charge<b style="color: red;">*</b></strong>
                                <select class="form-control" id="type_charge" name="type_charge" required>
                                        <option value="">Choisir</option>
                                        <option value="Locataire">Charge locative</option>
                                        <option value="Propriétaire">Charge propriétaire</option>
                                </select>
                                <div class="alert-danger" id="type_chargeError"></div>
                            </div>
                        </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Libellé  <b style="color: red;">*</b></strong>
                            <input type="text" name="libelle" id="libelle" required class="form-control">
                            <div class="alert-danger" id="libelleError"></div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="savecharge">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

    </form>

      </div>
    </div>
  </div>
</div>







</div>

@endsection
