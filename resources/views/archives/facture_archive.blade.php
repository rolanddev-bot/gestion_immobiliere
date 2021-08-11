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
    <h2 class="text-center alert " style="background-color:darksalmon">Avis d'échéance archivés</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">


                </div>
                <div class="table-responsive p-3">
<p align="center">


	<a href="{{ url('reglement-archive')}}" class="btn">Reçu</a> |
	<a href="{{ url('relance-archive')}}" class="btn">Relance</a> |
	<a href="{{ url('quittance-archive')}}" class="btn">Quittance</a>
</p>

                  <table class="table align-items-center table-flush table-hover" id="dataTablefacture">

                    <thead class="">
                        <tr>
                        <th>Réf. Appel</th>
                        <th>Bien</th>

                        <th>Loyer</th>
                        <th>Date Echéance</th>
                        <th>Paiement</th>
                        <th>Statut</th><!-- Retard,payer, partiel,en attente -->
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>

@foreach($factures as $facture)

 <?php
$mt_charge =0;

foreach($appliquers as $appliquer){
    if($facture->location->id == $appliquer->location_id AND $appliquer->charge->type_charge == 'Locataire')
    $mt_charge = $mt_charge + $appliquer->montant_charge;
}
?>

    <?php $mt = 0; $statut = ''; $nap_loyer = 0; ?>
    @foreach($reglements as $rg)
        @if($facture->id == $rg->facture_id)
            <?php $mt = $mt + $rg->montant; ?>
        @endif
    @endforeach

    <?php
    $nap_loyer = $facture->location->loyer + $facture->location->charge;
        if ($nap_loyer == $mt) {
            $statut = '<span class="text-success">Soldé</span>';
        } elseif ($nap_loyer > $mt) {
            $statut = '<span class="text-danger">En attente</span>';
        } else {
            $statut = '<span class="text-success">En avance</span>';
        }
    ?>


  <tr  >
        <td title="{{ $facture->nature }}">{{ $facture->ref }}</td>

        <td>{{ $facture->location->bien->libelle.' ('.$facture->location->bien->ref.')' }}<br>
        {{ $facture->location->locataire->nom.' '.$facture->location->locataire->prenom }}</td>



        <td><b>{{ separer($nap_loyer + $mt_charge, 3) }}</b></td>

        <td>{{ $facture->date_echeance }}</td>

        <td>{{ separer($mt, 3) }} </td>

        <td>{!! $statut !!}</td>

        <td>


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







</div>



@endsection
