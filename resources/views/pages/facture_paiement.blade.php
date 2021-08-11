@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">
   




    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Résumé des paiements </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">


                </div>
                <div class="table-responsive p-3">
                    
 <p style="font-style: italic;">Cette page récapitule les paiements reçus.  </p>



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
            <strong>Locataire </strong>
            
            <select class="form-control" name="mois" id="mois">
                <option value="">Choisir</option>
                @foreach($locataires as $loc)
                <option value="{{ $loc->id }}">{{ $loc->nom.' '.$loc->prenom.' ('.$loc->mob1.')'}}</option>
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


    <table class="table align-items-center table-flush table-hover" id="dataTablelocation">

    <thead class="thead-light">

        <tr>
        <th>Locataire</th>
        <th>Date paiement</th>
        <th>Montant</th>
        <th>Affectation</th>
        </tr>
    </thead>


                    <tbody>
<?php $t_caution=0; $t_charge=0; $t_loyer=0; ?>
@foreach($reglements as $reg)

    <tr style="font-size: 13px;">

<?php
$mt_charge =0; 

$t_loyer= $t_loyer +$reg->montant;

?>
{{ $reg->id }}
    <td>{{ $reg->facture->location->locataire->nom.' '.$reg->facture->location->locataire->prenom.' ('.$reg->facture->location->locataire->mob1.')' }}</td>
    
    <td>{{ date('d/m/Y', strtotime($reg->date_reglement)) }}</td>
    <td align="right">{{ separer($reg->montant, 3)}}</td>
    <td>{{ $reg->facture->location->bien->libelle.'-'.$reg->facture->nature }}</td>

                   </tr>
                  @endforeach

    <tr><tfoot class="text-danger" style="font-weight:bold">
        <td>Total</td>
        <td></td>
        <td align="right">{{ separer($t_loyer, 3) }}</td>
        <td></td>
        
        </tfoot>
    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>







</div>



@endsection
