@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
	//Modal
$(document).ready(function(){
    $('#creerRecu').click(function(){
        $('#modalRecu').modal('show');
    })

});
	
 //Archiver
	function archiver(id1, id2){
		var var_id = id1; var archiver = id2; var archiver_info = ''; var id_nvo = 0;

        if (archiver == 0) { archiver_info = 'archiver?'; id_nvo = 1;}
        else archiver_info = 'désarchiver?';

			//alert(var_id+' '+id_nvo); exit();
        if (confirm('Voulez-vous '+archiver_info)) {
            $.ajax({
                data: 'var_id='+var_id+'&id_nvo='+id_nvo,
                url: "reglementdelete",
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) { window.location.reload();  },
                error: function(data) { alert('Error:', data); }
            });
        }
    }

	
	//-------------- FACTURE - RECHERCHE PROPRIETAIRE ---------------

    function method_rech(){
		
		var id = document.getElementById('locataire_rech_recu_id').value;
		
		//alert(id);

        $.ajax({
            data: 'var_id='+id,
            url: "reglement_rech_location",
            type: "POST",
            //processData: false,
            //contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) { document.getElementById('location_rech_recu_id').innerHTML = data; },
            error: function(data) { alert('Error:', data); }
        });

    }
	
	
	//Rech Facture
	 function method_rech_bail(){
		
		var id = document.getElementById('location_rech_recu_id').value;
		
		//alert(id);

        $.ajax({
            data: 'var_id='+id,
            url: "reglement_rech_facture",
            type: "POST",
            //processData: false,
            //contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) { document.getElementById('div_location_facture_rech_id').innerHTML = data; },
            error: function(data) { alert('Error:', data); }
        });
    }
	
	
	//Rech montant facture
	 function method_rech_montant(){
		
		var id = document.getElementById('facture_rech_id').value;
		
		//alert(id);

        $.ajax({
            data: 'var_id='+id,
            url: "reglement_rech_montant",
            type: "POST",
            //processData: false,
            //contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) { 
				document.getElementById('montant').value = data['montant']; 
				document.getElementById('r_facture_id').value = data['id']; 
				
			},
            error: function(data) { alert('Error:', data); }
        });
    }
	 
	
	
</script>



<div class="container-fluid" id="container-wrapper">



    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Reçu loyer </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

<a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creerRecu" style="font-size:15px;" data-target="#creerFacture">
<i class="fas fa-fw fa-plus-square"></i>Nouveau</a>


                </div>
                <div class="table-responsive p-3">

                  <table class="table align-items-center table-flush table-hover" id="dataTablefacture">

                    <thead class="thead-light">
                        <tr>
                        <th>Ref. Avis</th>
                        <th>Ref. Réçu</th>
                        <th>Libellé</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th width="10%">Action</th>
                      </tr>
                    </thead>

                    <tbody>


    @foreach($reglements as $reglement)
    <tr style="font-size: 13px;" >
        <td>{{$reglement->facture->ref}}</td>
        <td>{{$reglement->ref}}</td>
        <td>{{$reglement->facture->nature}}</td>
        <td align="right">{{ separer($reglement->montant, 3) }}</td>
        <td> {{date('d/m/Y',strtotime($reglement->date_reglement))}}</td>
        <td>
       
        <a  href="{{ url('reglement-print/'.$reglement->id)}}" id="" title="Exporter PDF" class=""><i class="fas fa-fw fa-file-pdf" style="font-size:15px"></i></a>
        
         <a  href="{{ url('reglement-print-direct/'.$reglement->id)}}" id="" title="Imprimer" class="" target="_blank"><i class="fas fa-print" style="font-size:15px"></i></a>
        
        <?php $var = $reglement->id; $var_archiver = $reglement->archiver; ?>
        <a href="javascript:void(0)" id="archiver_reglement" title="Archiver" onClick="archiver('{{ $var }}', '{{ $var_archiver }}')"><i class="fas fa-file-archive" style="font-size:15px"></i></a>
                     </td>
                   </tr>
                  @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

<!--  ------------------------  MODAL Ajouter Recu  -->
<div>
<div class="modal fade bd-example-modal-xl" id="modalRecu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center" id="titremodal">Reçu</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    <form  name="form_facture" method="POST"  id="form_facture" action="{{ url('reglement-store') }}">

    {{ csrf_field() }}

    <input type="hidden" name="ruser_id" id="ruser_id" value="{{ Auth::user()->id }}">
    <input type="hidden" name="ruser_nom" id="ruser_nom" value="{{ Auth::user()->name }}">
    <input type="hidden" name="r_facture_id" id="r_facture_id" value="">

    <div class="row">

    <div class="col-md-6">
      <div class="form-group">

		<strong id="lib_loca">Locataire<b style="color: red;">*</b></strong>
		<select class="form-control" id="locataire_rech_recu_id" name="locataire_rech_recu_id" onChange="method_rech()"  required>
			<option value="">Choisir</option>

			@foreach($locataires as $locataire)
			<option value="{!! $locataire->id !!}"> {!! $locataire->nom.' - '.$locataire->prenom.' (
				'.$locataire->mob1.')' !!}</option>

			@endforeach

		</select>

        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
		<strong id="lib_bien">Bail<b style="color: red;">*</b></strong>

		<div id="div_location_rech_recu_id">
		<select class="form-control" id="location_rech_recu_id" name="location_rech_recu_id" onChange="method_rech_bail()" required>
			<option value="">Choisir</option>
		</select>
		</div>
        </div>
    </div>




    </div>
    <div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <strong id="lib_bien">Facture<b style="color: red;">*</b></strong>

<div id="div_location_facture_rech_id">
	<select class="form-control" id="facture_rech_id" name="facture_rech_id" onChange="method_rech_montant()" required>
		<option value="">Choisir</option>
	</select>
</div>
        </div>
    </div>


    <div class="col-md-6">
          <div class="form-group">
              <strong>Montant<b style="color: red;">*</b></strong>
              <input type="nom" name="montant" id="montant"  class="form-control" required>
              <span class="text-danger">{{ $errors->first('date_facture') }}</span>

          </div>
      </div>

</div>


<div class="row">
     
      <div class="col-md-6">
          <div class="form-group">
          <strong>Date paiement <b style="color: red;">*</b></strong>
          <input type="date" name="date_reglement" id="date_reglement"  class="form-control" required>
          </div>
      </div>

</div>

<p align="right">
   <button type="submit" class="btn btn-success" style="width: 150px" id="">Valider</button>
</p>
</form>

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

