@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">
   





    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Contrat - Charge </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
<p>
   <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a> |
   <a href="{{ url('location')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
   |
   <a href="{{ url('location/'.$location->id.'/edit')}}" class="" style=""><i class="fas fa-fw fa-edit" style="font-size:15px"></i>Editer</a>
</p>
					
                

                </div>
                <div class="table-responsive p-3">

@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif

 <div class="row">

    <div class="col-md-4">
    N° contrat: <span class="text-primary">{{ $location->ref}}</span><br>
        Bien loué:  <span class="text-primary">{{ $location->bien->libelle}}</span><br>
        
    </div>

    <div class="col-md-4">
    Locataire:  <span class="text-primary">{{ $location->locataire->nom.' '.$location->locataire->prenom}}</span><br>
        Loyer nu:  <span class="text-primary">{{ separer($location->loyer, 3)  }}</span><br>
    </div>
    <div class="col-md-4">
        

    </div>   
</div>
<br>
<br>

  
<form   action="{{ route('appli')}}" method="POST" name="formAppli" id="formAppli">

{{ csrf_field() }}

<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<input type="hidden" name="location_id" id="location_id" value="{{ $location->id }}">

<div class="row">

<div class="col-md-3">
            <div class="form-group">
                <strong>Charges<b style="color: red;">*</b></strong>
                <select class="form-control" id="charge_id" name="charge_id" required>
                    <option value="">Choisir</option>
                   

        @foreach($charges as $charge)
           
            
                <option value="{!! $charge->id !!}"> {!! $charge->libelle !!}</option>
            
  
        @endforeach
        </optgroup>

       

        </select>
        <span class="text-danger">{{ $errors->first('Charge') }}</span>
    </div>
</div>


    <div class="col-md-3">
    <strong>Montant charge<b style="color: red;">*</b></strong>
        <input type="text" name="montant_charge" class="form-control" required />
    </div>

    <div class="col-md-3">
    <br>
        <button type="submit" class="btn btn-success" >Ajouter</button>
    </div>

</div>

</form>


<table class="table align-items-center table-flush table-hover" id="dataTablelocation" style="width:80%">

<thead class="thead-light">

    <tr>
    <th>N°</th>
    <th>Charge</th>
    <th>Type charge</th>
    <th>Montant</th>
    <th>Date</th>
    <th>Action</th>
    </tr>
</thead>


<tbody>
<?php $mt=0; $mtp=0; $i=1; ?>
@foreach($appliquers as $appliquer)
<?php
if($appliquer->charge->type_charge == 'Locataire') $mt = $mt + $appliquer->montant_charge; else $mtp = $mtp + $appliquer->montant_charge; ?>
    <tr>
    <td>{{ $i++ }}</td>
    <td>{{ $appliquer->charge->libelle }}</td>
    <td>{{ $appliquer->charge->type_charge  }}</td>
    <td>{{ separer($appliquer->montant_charge, 3) }}</td>
    <td>{{ date('d/m/Y', strtotime($appliquer->date_charge)) }}</td>
    <td>


<form  name="formApplSup" id="formApplSup" method="POST" action="{{ route('applisupp')}}">
 @csrf

<input type="hidden" name="appliquer_id" value="{{ $appliquer->id }}">
<button id="supprimerAppi" class="btn btn-danger delete-user" onClick="if (confirm('Supprimer cette charge?')) this.formApplSup.submit();"><i class="fas fa-fw fa-trash"></i>
</button>

</form>
                    
    </td>

    @endforeach
                   </tr><tr><td colspan="3">MT charges locatives: {{ separer($mt, 3) }}</td><td colspan="3">MT charges déductibles: {{ separer($mtp, 3) }}</td></tr>
                 
                    </tbody>
                  </table>
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
