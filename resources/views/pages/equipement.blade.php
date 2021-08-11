@extends('layouts.main')
@section('content')

<div class="container-fluid" id="container-wrapper">


    <div class="col-lg-12">
        <h2 class="text-center alert alert-secondary">Localisation & élément </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

   <a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creerEquipement" style="font-size:15px;" data-target="#modal_equipement">
  <i class="fas fa-fw fa-plus-square"></i>Nouvel équipement</a> &nbsp;&nbsp; &nbsp;


  <a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creerElement" style="font-size:15px;" data-target="#modal_equipement">
  <i class="fas fa-fw fa-plus-square"></i>Nouvel élément</a>



</div>


@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
 @endif

  <div class="table-responsive p-3">


<div class="row">
  <div class="col-md-6">
  <h2 style="text-align: center;">Equipement(s)</h2>

  <table class="table align-items-center table-flush " id="datatableequipement" style="margin:; width:">
      <thead class="thead-light">
        <tr>

          <th>Libellé</th>
          <th>Détail</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>


@foreach($equipements as $equipement)
<tr style="font-size: 13px; " @if($equipement->archiver == 1) class="fond_desactiver" @endif>

<td>{{ $equipement->libelle }}</td>
<td>{{ $equipement->detail }}</td>


<td style="width:20%">


  <form  name="formEquipSup" id="formEquipSup" method="PUT" action="{{ route('equipementsup')}}">
  @csrf

  <!--<a href="javascript:void(0)" id="BtnEquipement1" title="Modifier" data-id="{{$equipement->id}}" data-libelle="{{$equipement->libelle}}"
      data-type="{{ $equipement->type }}" class=""> <i class="fas fa-fw fa-edit"></i></a>  -->

  <input type="hidden" name="equipement_id" value="{{ $equipement->id }}">
  <input type="hidden" name="archiver" value="{{ $equipement->archiver}}">
  <button id="supprimerAppi" class="" onClick="if (confirm('Archiver/Désarchiver cet élément?')) this.formApplSup.submit();"><i class="fas fa-fw fa-trash"></i>
  </button>

  </form>



</td>
                   </tr>
                  @endforeach
                    </tbody>
                  </table>

  </div>





<!-- ---------------------------------- ELEMENTS --------------------------------- -->
  <div class="col-md-6">
  <h2 style="text-align: center;">Elément(s)</h2>

  <table class="table align-items-center table-flush " id="datatableequipement" style="margin:; width:">
      <thead class="thead-light">
        <tr>

          <th>Libellé</th>
          <th>Détail</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>


@foreach($elts as $elt)

<tr style="font-size: 13px;" @if($elt->archiver == 1) class="fond_desactiver" @endif>

<td>{{ $elt->libelle }}</td>
<td>{{ $elt->detail }}</td>



<td style="width:20%">
  <form  name="formEquipSup" id="formEquipSup" method="PUT" action="{{ route('elementsup')}}">
  @csrf
  <input type="hidden" name="element_id" value="{{ $elt->id }}">
  <input type="hidden" name="archiver" value="{{ $elt->archiver }}">
  <button id="supprimerAppi" class="" onClick="if (confirm('Archiver/Désarchiver cet élément?')) this.formApplSup.submit();"><i class="fas fa-fw fa-trash"></i>
  </button>

  </form>



</td>
                   </tr>
                  @endforeach
                    </tbody>
                  </table>

  </div>


                  </div>

                </div>
              </div>
            </div>



<!--  ************************* AJOUT **********************************************  -->
 <div class="modal fade bd-example-modal-sm" id="modal_equipement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titreequipement">Nouvel équipement</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <form  name="form_equipement" action="{{ route('equipementstore') }}" id="form_equipement">
        {{ csrf_field() }}

        <input type="hidden" name="equipement_id" id="equipement_id">




                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Libellé  <b style="color: red;">*</b></strong>
                            <input type="text" name="libelle" id="libelle" required class="form-control">
                            <div class="alert-danger" id="libelleError"></div>

                        </div>
                    </div>


                    <div class="col-md-12">
                            <div class="form-group">
                                <strong>Détail</strong>
                                <textarea name="detail" class="form-control"></textarea>
                                <div class="alert-danger" id="type_equipementError"></div>
                            </div>
                        </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="BTNajouterEquipement">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

    </form>

      </div>
    </div>
  </div>
</div>




<!-- ------------------------- MODIFIER ------------------- -->

<div class="modal fade bd-example-modal-sm" id="modalModifierEquipement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titreMode">Modifier équipement</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <form  name="form_equipement" action="{{ route('equipementupdate') }}" id="form_equipement">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
        <input type="hidden" name="mequipement_id" id="mequipement_id">


                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Libellé  <b style="color: red;">*</b></strong>
                            <input type="text" name="mlibelle" id="mlibelle" required class="form-control">
                            <div class="alert-danger" id="libelleError"></div>

                        </div>
                    </div>


                    <div class="col-md-12">
                            <div class="form-group">
                                <strong>Détail</strong>
                                <textarea name="detail" class="form-control"></textarea>
                                <div class="alert-danger" id="type_equipementError"></div>
                            </div>
                        </div>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="BTNajouterEquipement">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

    </form>

      </div>
    </div>
  </div>
</div>







<!--************************** fin des elments  ********************* -->



<div class="modal fade bd-example-modal-sm" id="modal_element" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="">Nouvel élement</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <form  name="form_element" action="{{ route('element_store') }}" id="form_element">
        {{ csrf_field() }}

        <input type="hidden" name="element_id" id="element_id">




                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Libellé  <b style="color: red;">*</b></strong>
                            <input type="text" name="libelle" id="libelle" required class="form-control">
                            <div class="alert-danger" id="libelleError"></div>

                        </div>
                    </div>


                    <div class="col-md-12">
                            <div class="form-group">
                                <strong>Détail</strong>
                                <textarea name="detail" class="form-control"></textarea>
                                <div class="alert-danger" id="type_equipementError"></div>
                            </div>
                        </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="BTNajouterEquipement">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

    </form>

      </div>
    </div>
  </div>
</div>





<!--************************** fin des elments  ********************* -->











</div>

@endsection
