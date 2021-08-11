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
	
	//Rechercher quittance
	  function method_quittance(){
		
		var id = document.getElementById('bien_id').value;
//alert(id); exit();
		  
        $.ajax({
            data: 'var_id='+id,
            url: "rech_quittance",
            type: "POST",
            //processData: false,
            //contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data) { document.getElementById('div_rech_result_quittance').innerHTML = data; },
            error: function(data) { alert('Error:', data); }
        });

    }
	 
</script>



<div class="container-fluid" id="container-wrapper">
   

@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif

    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Reversement loyer</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">




<a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="" style="font-size:15px;" data-toggle="modal" 
 data-target="#modalRevers">
<i class="fas fa-fw fa-plus-square" style="font-size:15px"></i>Nouveau</a>

</div>
		<div class="table-responsive p-3">

		  <table class="table align-items-center table-flush table-hover" id="dataTablelocation">

			<thead class="thead-light">

				<tr>
				<th>Réf. </th>
				<th>Mandat</th>
				<th>Date</th>
				<th>Détail</th>
				<th>Action</th>
			  </tr>
			</thead>

			<tbody>

@foreach($revers as $rever)

    <tr style="">

    <td><a href="{{ url('reversement/'.$rever->id) }}">{{ $rever->ref }}</a></td>
    <td>{{ $rever->mandat->ref.' - '.$rever->mandat->bien->libelle }}</td>
    <td>{{ date('d/m/Y', strtotime($rever->date_revers)) }}</td>
    <td>{{ $rever->detail }}</td>
    <td >
    
<a href="javascript:void(0)" title="Editer" class="" id="btn_modifier_revers"
data-id="{{ $rever->id }}" data-ref="{{ $rever->ref }}" data-mandat_id="{{ $rever->mandat_id }}"
data-bien_id="{{ $rever->date_revers }}"> 
<i class="fas fa-fw fa-edit"  style="font-size:15px"></i></a>


 
 <a  href="{{ url('reversement-print/'.$rever->id) }}" id="" title="Exporter PDF " class=""><i class="fas fa-fw fa-file-pdf" style="font-size:15px"></i></a>
 
 <a  href="{{ url('reversement-print-direct/'.$rever->id)}}" id="" title="Imprimer" class="" target="_blank"><i class="fas fa-print" style="font-size:15px"></i></a>


 &nbsp; 
<a href="javascript:void(0)" id="" data-rever_id="{{ $rever->id }}" class="">
<i class="fas fa-file-archive" style="font-size:15px"></i></a>
                     </td>
                   </tr>
                  @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>













<!--  ------------------------  MODAL Ajouter  -->


<div>
<div class="modal fade bd-example-modal-xl" id="modalRevers" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titremodal">Ajouter Reversement</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        
<form  name="form_rech_prop" method="POST" action="{{ route ('reversementstore') }}"  id="form_rech_prop">
    {{ csrf_field() }}

    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
    <input type="hidden" name="reversement_id" id="reversement_id" value="">


<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<strong>Date reversement<b style="color: red;">*</b></strong>
			<input type="date" name="date_revers" id="date_revers" class="form-control" required>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group">
			<strong>TVA (%) due<b style="color: red;">*</b></strong>
			<input type="text" name="tva" id="tva" class="form-control" value="18" required>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group">
			<strong>Impôt(%) dû<b style="color: red;">*</b></strong>
			<input type="text" name="impot" id="impot" class="form-control" required>
		</div>
	</div>
</div>
   
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
			<select class="form-control" id="bien_id" name="bien_id"  onChange="method_quittance()" required>
				<option value=""></option>	
			 </select>
			</div>
		</div>
	 </div>

	
	
</div>


<div class="row">

<div class="col-md-8">
    <div class="form-group">
        <strong>Loyer(s) dû(s) <b style="color: red;">*</b></strong><br>
        <span style="font-size: 80%; font-style: italic; color: brown">Dans le champs ci-dessous, veuillez sélectionner les quittances à reversées.</span>
        
        <div id="div_rech_result_quittance">
        
        <select class="form-control" id="quittance" name="quittance[]" required multiple>
            <option value=""></option>
            
        </select>
		
   		</div>
   		
    
    </div>
	</div>
</div>




<div class="row">
<div class="col-md-8">
    <div class="form-group">
        <strong>Détail</strong>
        <textarea name="detail" rows="4" class="form-control"></textarea>
    </div>
</div>
</div>



  
<p align="center">
    <button type="submit" class="btn btn-success" id="" style="width: 30%">Valider</button>
</p>
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

           

        </div>
    </div>
    </div>
    </div>
</div>




</div>



@endsection
