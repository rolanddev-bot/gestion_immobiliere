@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">

	
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
</script>

<div class="container-fluid" id="container-wrapper">
   




    <div class="col-lg-12">
    <h2 class="text-center alert " style="background-color:darksalmon">Reçus archivés</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">


                </div>
                <div class="table-responsive p-3">
<p align="center">
	
	<a href="{{ url('loyer-archive')}}" class="btn">Avis d'échéance</a> |
	<a href="{{ url('quittance-archive')}}" class="btn">Quittance</a> | 
	<a href="{{ url('relance-archive')}}" class="btn">Relance</a> 
	 
</p>
                 
                  <table class="table align-items-center table-flush table-hover" id="dataTablequittance">

                    <thead class="">
                        <tr>
                        <th>Réf. reçu</th>
                        <th>Montant reçu</th>
                        <th>Avis d'échéance</th>

                        <th>Bien</th>
                        <th>Date établi.</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>

@foreach($reglements as $reglement)


 <tr>
	<td>{{ $reglement->ref }}</td>
	<td>{{ date('d/m/Y', strtotime($reglement->montant)) }}</td>

	<td>{{ $reglement->facture->ref }}</td>

	<td>{{ $reglement->facture->location->bien->libelle.' ('.$reglement->facture->location->bien->ref.')' }}<br>
	{{ $reglement->facture->location->locataire->nom.' '.$reglement->facture->location->locataire->prenom }}</td>


	<td>{{ date('d/m/Y', strtotime($reglement->date_reglement)) }}</td>



	<td>

<a  href="" id="" title="Imprimer appel" class=""><i class="fas fa-print" style="font-size:15px"></i></a>

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







</div>



@endsection
