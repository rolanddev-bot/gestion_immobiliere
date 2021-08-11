@extends('layouts.main')
@section('content')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>

<script type="application/javascript">
	
	//-------------- FACTURE - RECHERCHE PROPRIETAIRE ---------------

    function mandat_rech(){
		
		var id = document.getElementById('select_rech_mandat_id').value;

        $.ajax({
            data: 'prop_id='+id,
            url: "rech_mandat",
            type: "POST",
            //processData: false,
            //contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) { document.getElementById('div_rech_result').innerHTML = data; },
            error: function(data) { alert('Error:', data); }
        });

    }
	 
	 
	 //Archiver
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
                url: "etatdelete",
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(data) { window.location.reload();  },
                error: function(data) { alert('Error:', data); }
            });
        }
    }
	
</script>

<div class="container-fluid" id="container-wrapper">
   
    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Etat des lieux -  Bailleur & Propriétaire</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

<a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creerEtat" style="font-size:15px;" data-target="#modalEtat">

<i class="fas fa-fw fa-plus-square" style="font-size:15px;"></i>Nouvel</a>


                </div>
	<div class="table-responsive p-3">

	  <table class="table align-items-center table-flush table-hover" id="dataTablefacture">

		<thead class="thead-light">
			<tr>

			<th>Réf.</th>
			<th>Bien</th>
			<th>Entrée/Sortie</th>
			<th>Date</th>
			
			<th width="with:5%">Action</th>
		  </tr>
		</thead>

		<tbody>

@foreach($etats as $etat)

<tr >

<td><a href="{{ url('etat1/'.$etat->id)}}">{!! $etat->ref !!}</a></td>
 <td>{{ $etat->mandat->bien->libelle }}</td>
 <td>{{ $etat->entree_sortie }}</td>
<td>{!! date('d/m/Y', strtotime($etat->date_etat)) !!}</td>

<td>

<?php $var = $etat->id; $var_archiver = $etat->archiver; ?>
<a href="javascript:void(0)" id="" class="" onClick="archiver('{{ $var }}', '{{ $var_archiver }}')">
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
<div class="modal fade bd-example-modal-xl" id="modalEtat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titremodal"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <!-- Formulaire recherche locataire -->
     


<form  name="formEtat1" id="formEtat1" action="{{ url('etat1-store') }}" method="POST" >

    {{ csrf_field() }}

    <input type="hidden" name="user_id" value="{!! auth::user()->id !!}">
    <input type="hidden" name="user_nom" id="user_nom" value="{!! auth()->user()->nom.' '.auth()->user()->prenom !!}">


<div class="row">


        
	<div class="col-md-6">
      	<div class="form-group">

            <strong id="lib_loca">Propriétaire<b style="color: red;">*</b></strong>
            <select class="form-control" id="select_rech_mandat_id" name="select_rech_mandat_id" onChange="mandat_rech()" required>
                <option value="">Choisir</option>
                @foreach($props as $prop)
                <option value="{!! $prop->id !!}"> {!! $prop->nom.'  '.$prop->prenom.' (
                    '.$prop->mobile1.' '.$prop->mobile2.') ' !!}</option>

                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('Location') }}</span>

        	</div>
    	</div>
        

     <div class="col-md-6">
		<div class="form-group">
			<strong>Bien(s)<b style="color: red;">*</b></strong>
			
			<div id="div_rech_result">
			
			<select class="form-control" id="bien_id" name="bien_id" required>
				<option value="">Choisir</option>
				
			 </select>
			 
			</div>
			
		</div>
	</div>


	
	

</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<strong>Entrée/Sortie<b style="color: red;">*</b></strong>
			<select class="form-control" id="entree_sortie" name="entree_sortie" required>

			<option value="">Choisir</option>
			<option value="Entrée">Entrée</option>
			<option value="Sortie">Sortie</option>
			</select>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group">
			<strong>Date établ. <b style="color: red;">*</b></strong>
			<input type="date" name="date_etat" id="date_etat"  class="form-control" required>
			<span class="text-danger">{{ $errors->first('date_etat') }}</span>
		</div>
	</div>
        
        
</div>


  

  

   <p align="right">

   <button type="submit" class="btn btn-success" id="" style="width:150px ">Ajouter</button>
</p>

</form>

</div>
</div>
</div>
</div>
</div>



























<!----------------- MODAL MODIF ETAT -->

<div>
<div class="modal fade bd-example-modal-xl" id="modalModifierEtat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titreModalModif"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">





<form  name="formModifierEtat" method="POST"  id="formModifierEtat" >
    {{ csrf_field() }}

    <input type="hidden" name="muser_id" value="{!! auth()->user()->id !!}">
    <input type="hidden" name="metat_id" id="metat_id" value="">





    <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                <strong>Date établ. <b style="color: red;">*</b></strong>
                <input type="date" name="mdate_etat" id="mdate_etat"  class="form-control" required>
                <span class="text-danger">{{ $errors->first('date_etat') }}</span>
                </div>
            </div>


        <div class="col-md-4">
              <div class="form-group">
                  <strong>Montant réparation</strong>
                  <input type="number" name="mmontant" id="mmontant"  class="form-control" >
                  <span class="text-danger">{{ $errors->first('date_facture') }}</span>

              </div>
          </div>
    </div>


       <div class="row">
          <div class="col-md-6">
              <div class="form-group">
              <strong>Constat</strong>
              <textarea name="mconstat" id="mconstat"  class="form-control"></textarea>
              <span class="text-danger">{{ $errors->first('constat') }}</span>
              </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
              <strong>Décision</strong>
              <textarea name="mdecision" id="mdecision"  class="form-control"></textarea>
              <span class="text-danger">{{ $errors->first('detail') }}</span>
              </div>
          </div>

       </div>

       <div class="row">

        <div class="col-md-3">

        <div class="form-group">
            <strong>Entrée/Sortie<b style="color: red;">*</b></strong>
            <select class="form-control" id="mentree_sortie" name="mentree_sortie" required>

                <option value="Entrée">Entrée</option>
                <option value="Sortie">Sortie</option>
            </select>

        </div></div>



       </div>

       <p align="right">

       <button type="submit" class="btn btn-success" id="btnModifierFormEtat">Modifier</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
    </p>

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




        </div>
    </div>
    </div>
    </div>
</div>








</div>



@endsection
