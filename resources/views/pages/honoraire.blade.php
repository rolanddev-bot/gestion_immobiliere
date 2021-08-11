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
                url: "honorairedelete",
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
    <h2 class="text-center alert alert-secondary">Facture</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

<a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="" style="font-size:15px;" data-toggle="modal" 
 data-target="#modalHonoraire">
<i class="fas fa-fw fa-plus-square" style="font-size:15px"></i>Nouveau</a>


                </div>
	<div class="table-responsive p-3">

	  <table class="table align-items-center table-flush table-hover" id="dataTablehonoraire">

		<thead class="thead-light">
			<tr>
			<th>Réf. facture</th>
			<th>Réf. Revers.</th>

			<th>Agent</th>
			<th>Mode</th>
			<th>Délai</th>
			<th>Date création</th>
			<th>Action</th>
		  </tr>
		</thead>

		<tbody>

@foreach($honoraires as $honoraire)
  <?php $mt_charge=0; ?>

  <tr style="font-size: 13px;" >
        <td title="{{ $honoraire->nature }}">{{ $honoraire->ref }}</td>

        <td>{{ $honoraire->reversement->ref }}</td>
        <td>{{ $honoraire->nom_agent }}</td>
        <td>{{ $honoraire->mode }}</td>

        <td>{{ date('d/m/Y', strtotime($honoraire->delai)) }}</td>
        <td>{{ date('d/m/Y', strtotime($honoraire->created_at)) }}</td>

        

        <td>

<a  href="{{ url('honoraire-print/'.$honoraire->id)}}" id="" title="Exporter PDF" class=""><i class="fas fa-fw fa-file-pdf" style="font-size:15px"></i></a>
        
<a  href="{{ url('honoraire-print-direct/'.$honoraire->id) }}" id="" title="Imprimer quittance" target="_blank" class=""><i class="fas fa-print" style="font-size:15px"></i></a>


<?php $var = $honoraire->id; $var_archiver = $honoraire->archiver; ?>
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













<!--  ------------------------  MODAL Ajouter honoraire  -->


<div>
<div class="modal fade bd-example-modal-xl" id="modalHonoraire" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titremodal">Facture</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      


<form  name="form_honoraire" method="POST" action="{{ url('honoraire-store')}}"  id="form_honoraire">

    {{ csrf_field() }}

    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" name="user_nom" id="user_nom" value="{{ Auth::user()->name}}">





<div class="row">


    <div class="col-md-6">
        <div class="form-group">
            <strong id="lib_bien">Reversement (bien)<b style="color: red;">*</b></strong>

            <div id="div_rech_locataire">
                        <select class="form-control" id="reversement_id" name="reversement_id" required>
                            <option value="">Choisir</option>
                            @foreach($revers as $rev)
                            <option value="{{ $rev->id }}">{{ $rev->ref.' ('.$rev->mandat->bien->libelle.')' }}</option>
                            @endforeach
                        </select>
            </div>
            <span class="text-danger">{{ $errors->first('Location') }}</span>
        </div>
    </div>


    <div class="col-md-6">
          <div class="form-group">
              <strong>Affaire suivie par  </strong>
              <input type="text" name="nom_agent" id="nom_agent"  class="form-control" >
              <span class="text-danger">{{ $errors->first('date_honoraire') }}</span>

          </div>
      </div>



</div>

<div class="row">


      <div class="col-md-3">
          <div class="form-group">
          <strong>Mode règlement <b style="color: red;">*</b></strong>
          <input type="text" name="mode" id="mode"  class="form-control" required>
          <span class="text-danger">{{ $errors->first('mode') }}</span>
          </div>
      </div>
         
         <div class="col-md-3">
          <div class="form-group">
          <strong>Délai <b style="color: red;">*</b></strong>
          <input type="date" name="delai" id="delai"  class="form-control" required>
          <span class="text-danger">{{ $errors->first('delai') }}</span>
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

   <button type="submit" class="btn btn-success" id="ajouter_honoraire">Ajouter</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

</form>

</div>
</div>
</div>
</div>
</div>






























<div>
</div>








</div>



@endsection
