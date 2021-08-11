@extends('layouts.main')
@section('content')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">
   
 
    @if(session()->has('ok'))
        <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
        {!! session('ok') !!}
        </div>
    @endif
    
    
    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">IMMEUBLES  </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

<a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="BtnAjouterImmeuble" style="font-size:15px;" data-target="#creerImmeuble">
<i class="fas fa-fw fa-plus-square"></i>Nouvel</a>


                </div>
                
                <div class="table-responsive p-3">
                      
                  <table class="table align-items-center table-flush table-hover" id="dataTableimmeuble">
                      
                    <thead class="thead-light">
                        <tr>
                        <th>Libellé</th>
                        <th>Section/Parcelle</th>
                        <th>Lot/Ilot</th>
                        <th>Commune</th>
                        <th>Adresse</th>
                        
                        <th>Action</th>
                      </tr>
                    </thead>
                   
                    <tbody>

@foreach($immeubles as $immeuble)


@if($immeuble->libelle != 'Aucun')
  <tr  @if($immeuble->archiver == 1) class="fond_desactiver" @endif>
  
        <td>{{ $immeuble->libelle }}</td>

        <td>{{ $immeuble->section.'/'.$immeuble->parcelle }}</td>

        <td>{{ $immeuble->lot.'/'.$immeuble->ilot }}</td>
        
        <td>{{ $immeuble->commune->libelle }}</td>
        <td>{{ $immeuble->adresse }}</td>
  
        <td width="5%">

<!-- Modifier -->
<a href="{{ url('immeuble/'.$immeuble->id.'/edit') }}" title="Modifier" class=""> <i class="fas fa-fw fa-edit" style="font-size:15px"></i></a>
          

<!-- Archiver -->
<a href="javascript:void(0)" id="btnSupprimerImmeuble" data-id="{{ $immeuble->id }}"  
data-libelle="{{ $immeuble->libelle }}" class="">
<i class="fas fa-file-archive" style="font-size:15px"></i></a>

                     </td>
                   </tr>
                   @endif
                  @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>













<!--  ------------------------  MODAL Ajouter immeuble  -->


<div>
<div class="modal fade bd-example-modal-xl" id="modalAjouterImmeuble" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titreModalModif">Ajouter Immeuble</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

 
<form method="POST" action="{{route('immeublestore') }}">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                  <strong>Libellé  <b style="color: red;">*</b></strong>
                    <input type="text" name="libelle_immeuble" id="libelle_immeuble" class="form-control" required  value="">
                    <div class="alert-danger" id="libelle_bienError"></div>
            </div>

        </div>
            <div class="col-md-4">
                <div class="form-group">
                    <strong>Section <b style="color: red;">*</b></strong>
                    <input type="text" name="section_immeuble" id="section_immeuble" class="form-control"  required   value="">
                <div class="alert-danger" id="sectionError"></div>
            </div>
        </div>

            <div class="col-md-4">
                <div class="form-group">
                    <strong>Parcelle <b style="color: red;">*</b></strong>
                    <input type="text" name="parcelle_immeuble" id="parcelle_immeuble" class="form-control"  required  value="">
                    <div class="alert-danger" id="parcelleError"></div>
                 </div>

            </div>
         </div>

         <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <strong>Lot<b style="color: red;">*</b> </strong>
                        <input type="text" name="lot_immeuble" id="lot_immeuble"  class="form-control" required>
                        <div class="alert-danger" id="loError"></div>

                    </div>
                </div>

                    <div class="col-md-3">
                       <div class="form-group">
                            <strong>Ilot <b style="color: red;">*</b> </strong>
                            <input type="text" name="ilot_immeuble" id="ilot_immeuble" class="form-control" value="" required>
                            <div class="alert-danger" id="ilotError"></div>

                        </div>
                    </div>

                    <div class="col-md-3">
                       <div class="form-group">
                       <strong>Commune <b style="color: red;">*</b></strong>
                           <select class="form-control" name="commune_immeuble" id="commune_immeuble" required>
                           <option value="">Choisir</option>
                           @foreach($communes as $commune)
                               <option value="{{$commune->id}}"> {{$commune->libelle}}</option>
                               @endforeach
                           </select>
                           <div class="alert-danger" id="communeError"></div>
                       </div>
                   </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Adresse <b style="color: red;">*</b></strong>
                            <input name="adresse_immeuble" id="adresse_immeuble" class="form-control" required>
                            <div class="alert-danger" id="detailError"></div>
                            </div>
                    </div>

                    </div>

             <div class="row">
                 


                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Détail(s)</strong>
                            <textarea name="detail_immeuble" id="detail_immeuble" class="form-control" rows="4" cols="" ></textarea>
                            <div class="alert-danger" id="detailError"></div>
                            </div>
                    </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

      </form>

</div>
</div>
</div>
</div>
</div>

























<!----------------- MODAL MODIF FACTURE -->

<div>
<div class="modal fade bd-example-modal-xl" id="modalModifierImmeuble" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titreModalModif">Modifier Immeuble</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 
<form  name="formModifierImmeuble22" method="POST"  id="formModifierImmeuble22" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="immeuble_id" id="immeuble_id" value=""/>

    <div class="row">

    <div class="col-md-12">
          <div class="form-group">
              <strong>Libelle <b style="color: red;">*</b></strong>
              <input type="text" name="mlibelle" id="mlibelle"  class="form-control" required>
              <span class="text-danger">{{ $errors->first('date_immeuble') }}</span>

          </div>
      </div>
       
</div>

<div class="row">
      <div class="col-md-12">
          <div class="form-group">
          <strong>Détail</strong>
          <textarea name="mdetail" id="mdetail"  class="form-control"></textarea>
          <span class="text-danger">{{ $errors->first('detail') }}</span>
          </div>
      </div>

</div>

  <button type="submit" class="btn btn-success" id="btnApplImmeuble22">Modifier</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

</form>

</div>
</div>
</div>
</div>
</div>




</div>



@endsection