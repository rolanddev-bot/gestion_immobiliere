@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
<script type="application/javascript">
	
	//-------------- FACTURE - RECHERCHE PROPRIETAIRE ---------------

    function rever_rech(){
		
		var id = document.getElementById('select_rech_rever_id').value;

        $.ajax({
            data: 'prop_id='+id,
            url: "rech_rever",
            type: "POST",
            //processData: false,
            //contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) { document.getElementById('div_rech_result').innerHTML = data; },
            error: function(data) { alert('Error:', data); }
        });

    }
	 
	 
	
	
</script>


<div class="container-fluid" id="container-wrapper">
   

    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Reversement - Modifier </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                
<a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a>


                </div>
                <div class="table-responsive p-3">

@if(session()->has('ok'))
    <div class="alert alert-danger alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif

 
<br>
<br>

<form  name="form_rever" id="form_rever" method="post" action="{{ url('reversement-update') }}" >
        {{ csrf_field() }}

    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
    <input type="hidden" name="reversement_id" id="reversement_id" value="{{ $rever->id }}">


<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<strong>Date reversement<b style="color: red;">*</b></strong>
			<input type="date" name="date_revers" id="date_revers" class="form-control" value="{{ $rever->date_revers }}" required>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group">
			<strong>TVA (%) due<b style="color: red;">*</b></strong>
			<input type="text" name="tva" id="tva" class="form-control" value="{{ $rever->tva }}" required>
		</div>
	</div>
	
	
</div>

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<strong>Impôt(%) dû<b style="color: red;">*</b></strong>
			<input type="text" name="impot" id="impot" class="form-control" value="{{ $rever->impot }}" required>
		</div>
	</div>
</div>
 
	
    <div class="row">
<div class="col-md-8">
    <div class="form-group">
        <strong>Détail</strong>
        <textarea name="detail" rows="4" class="form-control">{{ $rever->detail }}</textarea>
    </div>
</div>
</div>    

<p align="center">
    <button type="submit" class="btn btn-success" id="" style="width: %">Appliquer</button>
</p>

	
	

    </form>



                </div>
              </div>
            </div>






</div>



@endsection
