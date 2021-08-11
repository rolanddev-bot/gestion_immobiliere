@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')



<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>


<div class="container-fluid" id="container-wrapper">
   

@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif

    <div class="col-lg-12">
    <h2 class="text-center alert"  style="background-color:darksalmon">Factures des honoraires archivées</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">



</div>
		<div class="table-responsive p-3">
		<p align="center">
<a href="{{ url('facturation-archive')}}">Reversement</a>
	  </p>
	  
		  <table class="table align-items-center table-flush table-hover" id="dataTablelocation">

			<thead class="">

				<tr>
				<th>Réf. </th>
				<th>Mandat</th>
				<th>Date</th>
				<th>Détail</th>
				<th width="3%">Action</th>
			  </tr>
			</thead>

			<tbody>

<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>











</div>



@endsection
