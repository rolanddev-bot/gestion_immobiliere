@extends('layouts.main')
@section('content')

<div class="container-fluid" id="container-wrapper">
    

    <div class="col-lg-12">
        <h2 class="text-center alert alert-secondary">Charges Locatives & Déductibles </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
           
                </div>
                <div class="table-responsive p-3">

  
 <form  name="form_facture" method="POST"  id="form_facture" enctype="multipart/form-data">

{{ csrf_field() }}

<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<input type="hidden" name="user_nom" id="user_nom" value="{{ Auth::user()->name}}">


<div class="row">
<div class="col-md-1">
<div class="form-group">
    <strong>Année </strong>
    <input type="number" maxlength="4" name="annee" id="annee"  class="form-control" value="{{ date('Y') }}">
    <span class="text-danger">{{ $errors->first('date_facture') }}</span>

</div>
</div>


<div class="col-md-2">
<div class="form-group">
    <strong>Mois </strong>
    
    <select class="form-control" name="mois" id="mois">
        <option value="">Janvier</option>
        <option value="">Février</option>
        <option value="">Mars</option>
        <option value="">Avril</option>
        <option value="">Mai</option>
        <option value="">Juin</option>
        <option value="">Juillet</option>
        <option value="">Août</option>
        <option value="">Septembre</option>
        <option value="">Octobre</option>
        <option value="">Novembre</option>
        <option value="">Décembre</option>
    </select>
    
    <span class="text-danger">{{ $errors->first('date_facture') }}</span>

</div>
</div>


<div class="col-md-3">
    <div class="form-group">
        <strong>Bien </strong>
        
        <select class="form-control" name="mois" id="mois">
            <option value="">Choisir</option>
            @foreach($locations as $loc)
            <option value="{{ $loc->id }}">{{ $loc->bien->libelle.' (REF CONTRAT: '.$loc->ref.')'}}</option>
            @endforeach
        </select>
        
        <span class="text-danger">{{ $errors->first('date_facture') }}</span>

    </div>
</div>

<div class="col-md-3">
    <div class="form-group"><br>
    <button id="BTNExportPaiement" style="float:right">Exporter données</button>

    </div>
</div>


</div>
</form>


                  <table class="table align-items-center table-flush table-hover" id="" style="width:60%">
                    <thead class="thead-light">
                      <tr>
                      <th>Type charge</th>
                        <th>Libellé</th>
                        <th>Montant</th>

                      </tr>
                    </thead>
                    <tbody>

<?php $mt = 0; ?>
  @foreach($charges as $charge)
  <?php $mt= $mt + 0; ?>
  <tr >
    <td>{{$charge->type_charge}}</td>
    <td>{{$charge->libelle}}</td>
    <td style="width:150px;" align="right">{{ $mt }}</td>
  </tr>
  
                  @endforeach

<tr style="font-size: 13px; width:150px; ">

  <td>Total Revenu</td>
  <td></td>
  <td align="right">{{ $mt }}</td>

</tr>

<tr style="font-size: 13px; width:150px; ">

  <td>Total Dépense</td>
  <td></td>
  <td align="right">{{ $mt }}</td>

</tr>


<tr style="font-size: 13px; width:150px; ">
<tfoot class="text-danger" style="font-weight:bold">
  <td>SOLDE</td>
  <td></td>
  <td align="right">{{ $mt }}</td>
</tfood>
</tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>







</div>

@endsection
