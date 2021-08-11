@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">


<script type="application/javascript">
	 //------------------------- Archiver -------------------
	function archiver(id1, id2){
		var var_id = id1;
        var archiver = id2;
        var archiver_info = '';
		var id_nvo = 0;

        if (archiver == 0) { archiver_info = 'archiver?'; id_nvo = 1;}
        else archiver_info = 'désarchiver?';

        if (confirm('Voulez-vous '+archiver_info)) {
            $.ajax({
                data: 'var_id='+var_id+'&id_nvo='+id_nvo,
                url: "facturedelete",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) { window.location.reload(); },
                error: function(data) { alert('Error:', data); }
            });
        	}
    	}

</script>




    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Avis d'échéance </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

<a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creerFacture" style="font-size:15px;" data-target="#creerFacture">
<i class="fas fa-fw fa-plus-square"></i>Nouveau</a>



                </div>
                <div class="table-responsive p-3">

                  <table class="table align-items-center table-flush table-hover" id="dataTablefacture">

                    <thead class="thead-light">
                        <tr>
                        <th>Réf. Avis</th>
                        <th>Bien (locataire)</th>

                        <th>Loyer</th>
                        <th>Date</th>
                        <th>Période</th>
                        <th>Soldé</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>

@foreach($factures as $facture)
  <?php $mt_charge = 0; ?>

  <tr style="font-size: 13px;" >
        <td title="{{ $facture->nature }}">{{ $facture->ref }}</td>

        <td>{{ $facture->location->bien->libelle.' ('.$facture->location->locataire->nom.' '.$facture->location->locataire->prenom.')' }}</td>



        <td><b>{{ separer($facture->montant, 3) }}</b></td>

        <td>{{ date('d/m/Y', strtotime($facture->date_facture)) }}</td>

        <td><span title="{{ date('d/m/Y', strtotime($facture->date_debut)).'/-'.date('d/m/Y', strtotime($facture->date_fin)) }}" style="color: blue">{{ $facture->nature }}</span></td>

        <td style="color: red">@if($facture->solde == 0) Non @else Oui @endif</td>


        <td>

<a  href="{{url('facture-print',$facture->id)}}" id="" title="Imprimer avis" class="">
<i class="fas fa-print" style="font-size:15px"></i></a>

<?php $var = $facture->id; $var_archiver = $facture->archiver; ?>
<a href="javascript:void(0)" id="" title="Archiver" onClick="archiver('{{ $var }}', '{{ $var_archiver }}')">
<i class="fas fa-file-archive" style="font-size:15px"></i></a>
                     </td>
                   </tr>
                  @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>













<!--  ------------------------  MODAL Ajouter facture  -->


<div>
<div class="modal fade bd-example-modal-xl" id="modalFacture" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titremodal"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <!-- Formulaire recherche locataire -->
      <form name="form_facture_rech_locataire" method="POST"  id="form_facture_rech_locataire" class="form-inline">

      <div class="col-md-12">
      <div class="form-group">

            <strong id="lib_loca">Locataire<b style="color: red;">*</b></strong>
            <select class="form-control" id="locataire_rech_id" name="locataire_rech_id"  required>
                <option value="">Choisir</option>

                @foreach($locataires as $locataire)
                <option value="{!! $locataire->id !!}"> {!! $locataire->nom.' - '.$locataire->prenom.' (
                    '.$locataire->mob1.')' !!}</option>

                @endforeach

            </select>
            <span class="text-danger">{{ $errors->first('Location') }}</span>

        </div>
    </div>

      </form>



<form  name="form_facture" method="POST"  id="form_facture" enctype="multipart/form-data">

    {{ csrf_field() }}

    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" name="user_nom" id="user_nom" value="{{ Auth::user()->name}}">





<div class="row">


    <div class="col-md-6">
        <div class="form-group">
            <strong id="lib_bien">Bien<b style="color: red;">*</b></strong>

            <div id="div_rech_locataire">
                        <select class="form-control" id="location_id" name="location_id" required>
                            <option value="">Choisir</option>
                        </select>
            </div>
            <span class="text-danger">{{ $errors->first('Location') }}</span>
        </div>
    </div>


    <div class="col-md-6">
          <div class="form-group">
              <strong>Montant  <b style="color: red;">*</b></strong>
              <input type="nom" name="montant" id="montant"  class="form-control" required>
              <span class="text-danger">{{ $errors->first('date_facture') }}</span>

          </div>
      </div>



</div>

<div class="row">


    <div class="col-md-6">
        <div class="form-group">
            <strong>Nature <b style="color: red;">*</b></strong>
            <input type="nature" name="nature" id="nature"  class="form-control" required>
            <span class="text-danger">{{ $errors->first('nature') }}</span>

        </div>
    </div>

      <div class="col-md-3">
          <div class="form-group">
          <strong>Date début <b style="color: red;">*</b></strong>
          <input type="date" name="date_debut" id="date_debut"  class="form-control" required>
          <span class="text-danger">{{ $errors->first('date_debut') }}</span>
          </div>
      </div>

      <div class="col-md-3">
          <div class="form-group">
          <strong>Date fin <b style="color: red;">*</b></strong>
          <input type="date" name="date_fin" id="date_fin"  class="form-control" required>
          <span class="text-danger">{{ $errors->first('date_fin') }}</span>
          </div>
      </div>
</div>

<div class="row">
      <div class="col-md-3">
          <div class="form-group">
          <strong>Date avis <b style="color: red;">*</b></strong>
          <input type="date" name="date_facture" id="date_facture"  class="form-control" required>
          <span class="text-danger">{{ $errors->first('date_facture') }}</span>
          </div>
      </div>


      <div class="col-md-3">
          <div class="form-group">
            <strong>Date écheance <b style="color: red;">*</b></strong>
            <input type="date" name="date_lega" id="date_lega"  class="form-control" required>
            <span class="text-danger">{{ $errors->first('date_facture') }}</span>
          </div>
      </div>



</div>

   <div class="row">
      <div class="col-md-6">
          <div class="form-group">
          <strong>Montant en lettre </strong>
          <textarea name="montant_lettre" id="montant_lettre"  class="form-control"></textarea>
          <span class="text-danger">{{ $errors->first('montant_lettre') }}</span>
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group">
          <strong>Info. complémentaire</strong>
          <textarea name="detail" id="detail"  class="form-control"></textarea>
          <span class="text-danger">{{ $errors->first('detail') }}</span>
          </div>
      </div>

   </div>

   <button type="submit" class="btn btn-success" id="ajouter_facture">Ajouter</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

</form>

</div>
</div>
</div>
</div>
</div>



























<!----------------- MODAL MODIF FACTURE -->

<div>
<div class="modal fade bd-example-modal-xl" id="modalModifFacture" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titreModalModif"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">





<form  name="formModifFacture" method="POST"  id="formModifFacture" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="muser_id" value="{{ Auth::user()->id }}">
    <input type="hidden" name="muser_nom" id="muser_nom" value="{{ Auth::user()->name}}">
    <input type="hidden" name="mfacture_id" id="mfacture_id" value="">



<div class="row">

<div class="col-md-2">
          <div class="form-group">
              <strong>Exonérer pénalité <b style="color: red;">*</b></strong>
          </div>
      </div>

      <div class="col-md-1">
          <div class="form-group">
              <input type="checkbox" name="exonerer" id="exonerer" class="form-check-input" value="1">
          </div>
      </div>

</div>

    <div class="row">
    <div class="col-md-6">
          <div class="form-group">
              <strong>Montant Facture <b style="color: red;">*</b></strong>
              <input type="text" name="mmontant" id="mmontant"  class="form-control" required>
              <span class="text-danger">{{ $errors->first('montant_facture') }}</span>

          </div>
      </div>


      <div class="col-md-3">
          <div class="form-group">
          <strong>Date facture <b style="color: red;">*</b></strong>
          <input type="date" name="mdate_facture" id="mdate_facture"  class="form-control" required>
          <span class="text-danger">{{ $errors->first('date_facture') }}</span>
          </div>
      </div>

      <div class="col-md-3">
          <div class="form-group">
            <strong>Date écheance <b style="color: red;">*</b></strong>
            <input type="date" name="mdate_echeance" id="mdate_echeance"  class="form-control" required>
            <span class="text-danger">{{ $errors->first('date_facture') }}</span>
          </div>
      </div>




</div>

<div class="row">


    <div class="col-md-6">
        <div class="form-group">
            <strong>Nature <b style="color: red;">*</b></strong>
            <input type="nature" name="mnature" id="mnature"  class="form-control" required>
            <span class="text-danger">{{ $errors->first('nature') }}</span>

        </div>
    </div>

      <div class="col-md-3">
          <div class="form-group">
          <strong>Date début <b style="color: red;">*</b></strong>
          <input type="date" name="mdate_debut" id="mdate_debut"  class="form-control" required>
          <span class="text-danger">{{ $errors->first('date_debut') }}</span>
          </div>
      </div>

      <div class="col-md-3">
          <div class="form-group">
          <strong>Date fin <b style="color: red;">*</b></strong>
          <input type="date" name="mdate_fin" id="mdate_fin"  class="form-control" required>
          <span class="text-danger">{{ $errors->first('date_fin') }}</span>
          </div>
      </div>
</div>

<div class="row">



</div>

   <div class="row">
      <div class="col-md-6">
          <div class="form-group">
          <strong>Montant en lettre </strong>
          <textarea name="mmontant_lettre" id="mmontant_lettre"  class="form-control"></textarea>
          <span class="text-danger">{{ $errors->first('montant_lettre') }}</span>
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group">
          <strong>Info. complémentaire</strong>
          <textarea name="mautre" id="mautre"  class="form-control"></textarea>
          <span class="text-danger">{{ $errors->first('detail') }}</span>
          </div>
      </div>

   </div>

  <button type="submit" class="btn btn-success" id="btn_appli_modifier_facture">Modifier</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

</form>

</div>
</div>
</div>
</div>
</div>





<div>
    <div class="modal fade bd-example-modal-xl" id="modalAfficher" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">

        <div class="modal-header">
            <h2 class="modal-title" style="text-align: center;" id="titremodal"></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

           @include('pages.facture_print')



        </div>
    </div>
    </div>
    </div>
</div>




<!----------------- MODAL REGLEMENT-->
<div>
    <div class="modal fade bd-example-modal-xl" id="modalAfficherReglement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" align="center" style="text-align:" id="">PAIEMENT LOYER </h4>



            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>


          </div>
          <div class="modal-body">
          <p> N° APPEL LOYER: <span id="titreModalReglement" class="text-danger"></span></p>
          <p>MONTANT LOYER: <span id="r_facture_montant" class="text-danger"></span></p>


           <form name="formReglement" id="formReglement" method="POST">
           {{ csrf_field() }}

           <input type="hidden" name="ruser_id" value="{{ Auth::user()->id}}">
            <input type="hidden" name="ruser_nom"  value="{{ Auth::user()->name}}">
           <input type="hidden" name="r_facture_id" id="r_facture_id" >

            <div class="input-group mb-3">
            <input type="number" class="form-control" name="r_facture_montant2" id="r_facture_montant2"  placeholder="Saisir Montant" aria-label="Recipient's username"
                aria-describedby="basic-addon2" required>
                <input type="date" class="form-control" name="r_facture_datereglt" id="r_facture_datereglt"  placeholder="Saisir Date" aria-label="Recipient's username"
                aria-describedby="basic-addon2" required>
            <div class="input-group-append">
                <button class="input-group-text" id="btn_appli_reglement">Ajouter</button>
            </div>
            </div>
           </form>
<br>

            <div id="div_reglement">



                </div>



        </div>
    </div>
    </div>
    </div>
</div>




</div>



@endsection
