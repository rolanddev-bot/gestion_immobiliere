@extends('layouts.main')
@section('content')

<script type="text/javascript">


</script>

<div class="container-fluid" id="container-wrapper">
  


@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif

    <div class="col-lg-12">
        <h2 class="text-center alert alert-secondary">BIEN - {{ $typebien->libelle }}</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <p> <a href="{{ url('bien/'.$typebien->id.'/create') }}" class="text-center btn btn-success btn-lg" style="font-size:15px;" >
      <i class="fas fa-fw fa-plus-square"></i>Nouveau</a> 
      </p>


                </div>

                <div class="table-responsive p-3">

	  <table class="table align-items-center table-flush table-hover" id="datatablebien">
		<thead class="thead-light">
		  <tr>


			<th>Libellé </th>
			<th>Type bien</th>
			<th>Lot/Ilot</th>
			<th>Section/Parcelle</th>
			<th>Adresse</th>
			<th>Disponible</th>
			<th>Action</th>

		  </tr>
		</thead>


		<tbody>


	@foreach($biens as $bien)
		@if($bien->immeuble_id == 0)
	<tr >

	 <td><a href="{{ url('bien/'.$bien->id) }}" id="details_bien">{{ $bien->libelle }}</a>



	 </td> 

	 <td> {{$bien->typebien->libelle}}</td>

	 <td> {{ $bien->lot.'/'.$bien->ilot }}</td>
	 <td> {{ $bien->section.'/'.$bien->parcelle }}</td>
	 <td>{{$bien->adresse}}</td>

	 <td>@if($bien->libre == 1) Oui @else Non @endif </td>


     <td style="width:10%;">
       
        <a href="{{ url('bien/'.$bien->id.'/edit') }}"  class=""> 
          <i class="fas fa-fw fa-edit" style="font-size:15px"></i></a>
     
     
      <!--  <a href="javascript:void(0)" id="voir_bien"  data-mobile2="" data-mobile1="" data-sexe="" data-adresse="" data-id="" data-photo=""  data-email="" data-nom="" data-prenom="" class="btn btn-warning"> <i class="fas fa-fw fa-eye"></i></a> -->
        <a href="javascript:void(0)" id="supp_bien" data-id="{{$bien->id}}" data-archiver="{{$bien->archiver}}" class="">
        <i class="fas fa-file-archive" style="font-size:15px"></i></a>
                     </td>
                   </tr>
                   @endif
@endforeach

                    </tbody>
                  </table>
                </div>
              </div>
            </div>







<div class="modal fade bd-example-modal-xl" id="modal_bien" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titrebien"></h2>
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







@endsection
