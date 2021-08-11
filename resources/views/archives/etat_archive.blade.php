@extends('layouts.main')
@section('content')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>

<script type="application/javascript">
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
    <h2 class="text-center alert " style="background-color:darksalmon">Etats des lieux archivés</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">




                </div>
                <div class="table-responsive p-3">

  <table class="table align-items-center table-flush " id="dataTablefacture">

	<thead class="">
		<tr>
		<th>Réf.</th>
		<th>Bien</th>
		<th>Locataire</th>
		<th>Entrée/Sortie</th>
		<th>Date</th>
		
		<th>Location</th>
		
		
		<th width="2%">Action</th>
	  </tr>
	</thead>

	<tbody>

@foreach($etats as $etat)



 <tr>
 <td><a href="{{ url('etat/'.$etat->id)}}">{!! $etat->ref !!}</a></td>
 <td>{{ $etat->location->bien->libelle }}</td>
 <td>{{ $etat->location->locataire->nom.' '.$etat->location->locataire->prenom }}</td>
 <td>{{ $etat->entree_sortie }}</td>
 <td>{{ $etat->date_etat }}</td>

<td>{{ $etat->location->ref }}</td>



<td >


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


















</div>



@endsection
