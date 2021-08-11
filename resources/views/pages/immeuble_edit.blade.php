@extends('layouts.main')
@section('content')

<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Immeuble - Ajouter</h2>
              <div class="card mb-3">
                <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between"><a href="{{ route('immeuble')}}">Retour</a>
                </div>
             <div class="table-responsive p-3">


<form method="POST" action="{{route('immeubleupdate') }}">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**************************************** -->
        <input type="hidden" name="id_immeuble" value="{{$immeuble->id}}">

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                  <strong>Libellé  <b style="color: red;">*</b></strong>
                    <input type="text" value="{{$immeuble->libelle}}" name="libelle_immeuble" id="libelle_immeuble" class="form-control" required  value="">
                    <div class="alert-danger" id="libelle_bienError"></div>
            </div>

        </div>
            <div class="col-md-2">
                <div class="form-group">
                    <strong>Section <b style="color: red;">*</b></strong>
                    <input type="text" value="{{$immeuble->section}}" name="section_immeuble" id="section_immeuble" class="form-control"  required   value="">
                <div class="alert-danger" id="sectionError"></div>
            </div>
        </div>

            <div class="col-md-2">
                <div class="form-group">
                    <strong>Parcelle <b style="color: red;">*</b></strong>
                    <input type="text" value="{{$immeuble->parcelle}}" name="parcelle_immeuble" id="parcelle_immeuble" class="form-control"  required  value="">
                    <div class="alert-danger" id="parcelleError"></div>
                 </div>

            </div>
         </div>

         <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                        <strong>Lot </strong>
                        <input type="text" value="{{$immeuble->lot}}" name="lot_immeuble" id="lot_immeuble"  class="form-control" >
                        <div class="alert-danger" id="loError"></div>

                    </div>
                </div>

                    <div class="col-md-2">
                       <div class="form-group">
                            <strong>Ilot </strong>
                            <input type="text" value="{{$immeuble->ilot}}" name="ilot_immeuble" id="ilot_immeuble" class="form-control" value="">
                            <div class="alert-danger" id="ilotError"></div>

                        </div>
                    </div>

                    <div class="col-md-3">
                       <div class="form-group">
                       <strong>Commune <b style="color: red;">*</b></strong>
                           <select class="form-control" name="commune_immeuble" id="commune_immeuble" required>
                           <option value="{{$immeuble->commune_id}}">{{$immeuble->commune->libelle}}</option>
                           @foreach($communes as $commune)
                               <option value="{{$commune->id}}"> {{$commune->libelle}}</option>
                               @endforeach
                           </select>
                           <div class="alert-danger" id="communeError"></div>
                       </div>
                   </div>
                    
                    <div class="col-md-3">
                       <div class="form-group">
                            <strong>Adresse<b style="color: red;">*</b></strong>
                            <input style="height: 50px;" type="text" value="{{$immeuble->adresse}}" rows="4" name="adresse_immeuble" id="adresse_immeuble" class="form-control" value="">
                            <div class="alert-danger" id="ilotError"></div>

                        </div>
                    </div>

                    </div>

             <div class="row">

               

                    <div class="col-md-4">
                       <div class="form-group">
                            <strong>Detail</strong>
 <textarea  style="height: 50px;" name="detail" id="detail" class="form-control">{{ $immeuble->detail }}</textarea>
                            <div class="alert-danger" id="ilotError"></div>

                        </div>
                    </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="">Modifier</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

      </form>
        </div>
        </div>
        </div>


        </div>



@endsection
