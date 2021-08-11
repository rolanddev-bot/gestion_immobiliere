@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>

<script type="application/javascript">
	
	 function archiver(id1, id2){
        var quittance_id = id1;
        var archiver = id2;
        var archiver_info = '';

        if (archiver == 0) archiver_info = 'archiver?';
        else archiver_info = 'désarchiver?';

        if (confirm('Voulez-vous ' + archiver_info)) {
            $.ajax({
                data: { id: quittance_id, archiver: archiver },
                url: "archive_quittance",
                type: "POST",
                // contentType: false,
                // processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    window.location.reload();

                },
                error: function(data) {
                    alert('Error:', data);

                }
            });
        }

    }

</script>

<div class="container-fluid" id="container-wrapper">
   




    <div class="col-lg-12">
    <h2 class="text-center alert " style="background-color:darksalmon">Quittances archivées</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">


                </div>
                <div class="table-responsive p-3">
<p align="center">
	
	<a href="{{ url('loyer-archive')}}" class="btn">Avis d'échéance</a> |
	<a href="{{ url('reglement-archive')}}" class="btn">Reçu</a> | 
	<a href="{{ url('relance-archive')}}" class="btn">Relance</a> 
	 
</p>
                 
                  <table class="table align-items-center table-flush table-hover" id="dataTablequittance">

                    <thead class="">
                        <tr>
                        <th>Réf. quittance</th>
                        <th>Facture</th>

                        <th>Bien</th>
                        <th>Date délivrance</th>
                        <th>Période couverte</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>

@foreach($quittances as $quittance)


  <tr  >
        <td>{{ $quittance->ref }}</td>
        
        <td>{{ separer($quittance->facture->montant, 3) }}</td>

        <td>{{ $quittance->facture->location->bien->libelle.' ('.$quittance->facture->location->bien->ref.')' }}<br>
        {{ $quittance->facture->location->locataire->nom.' '.$quittance->facture->location->locataire->prenom }}</td>


        <td>{{ date('d/m/Y', strtotime($quittance->date_quittance)) }}</td>

        <td>{{ date('d/m/Y', strtotime($quittance->facture->date_debut)).' - '.date('d/m/Y', strtotime($quittance->facture->date_fin)) }} </td>


        <td>

<?php $var = $quittance->id; $var_archiver = $quittance->archiver; ?>
<a href="javascript:void(0)" id="supprimer_quittance" title="Archiver" onClick="archiver('{{ $var }}', '{{ $var_archiver }}')"><i class="fas fa-file-archive" style="font-size:15px"></i></a>
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
