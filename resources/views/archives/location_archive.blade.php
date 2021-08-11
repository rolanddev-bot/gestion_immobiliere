@extends('layouts.main')
@section('content')


@include('pages.incl_fonction')



<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">




    <div class="col-lg-12">
    <h2 class="text-center alert "  style="background-color:darksalmon">Bails archivés</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">



@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif



</div>
<div class="table-responsive p-3">



	  <table class="table align-items-center table-flush " id="dataTablelocation">

		<thead>

			<tr>
			<th>Réf. Contrat</th>
			<th>Bien</th>
			<th>Locataire</th>
			<th>Loyer nu</th>
			<th>Charge</th>
			<th>Date Location</th>

			<th width="2%">Action</th>
		  </tr>
		</thead>


		<tbody>

@foreach($locations as $location)

<tr>

<?php
$mt_charge =0;

foreach($appliquers as $appliquer){
    if($location->id == $appliquer->location_id AND $appliquer->charge->type_charge == 'Locataire')
    $mt_charge = $mt_charge + $appliquer->montant_charge;
}
?>

<td><a href="{{ url('location/'.$location->id) }}">{{ $location->ref }}</a></td>
<td>{{ $location->bien->libelle }}</td>
<td>{{ $location->locataire->nom.' '.$location->locataire->prenom }}</td>
<td>{{ separer($location->loyer, 3) }}</td>
<td>{{ separer($mt_charge, 3) }}</td>

<td>{{ date('d/m/Y', strtotime($location->date_location)) }}</td>

<td >


<a href="javascript:void(0)" id="archive_location" title="Archiver" data-archiver="{{ $location->archiver }}" data-id="{{ $location->id }}"  title="Desrchiver">
<i class="fas fa-file-archive" style="font-size:15px"></i></a>
                     </td>
                   </tr>
                  @endforeach


                    </tbody>
                  </table>
                </div>
              </div>
            </div>













<!--  ------------------------  MODAL Ajouter location  -->


<div>
<div class="modal fade bd-example-modal-xl" id="modalLocation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titremodal"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


</form>

</div>
</div>
</div>
</div>
</div>




<div>
    <div class="modal fade bd-example-modal-xl" id="modalAffichage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">

        <div class="modal-header">
            <h2 class="modal-title" style="text-align: center;" id="titremodal"></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            @include('pages.location_print')


        </div>
    </div>
    </div>
    </div>
</div>




</div>



@endsection
