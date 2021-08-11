@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">



    <div class="col-lg-12">


 <h2  @if($reversement->archiver == 1) class="text-center alert " style="background-color:darksalmon" @else class="text-center alert alert-secondary" @endif>Reversement @if($reversement->archiver == 1) archivé @endif - Détail </h2>


              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

<p>
   <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a> |
   <a href="{{ url('reversement')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
   |
   <a href="{{ url('reversement/'.$reversement->id.'/edit')}}" class="" style=""><i class="fas fa-fw fa-edit" style="font-size:15px"></i>Editer</a>
</p>

@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif

                </div>
                <div class="table-responsive p-3">



 <div class="row">

    <div class="col-md-4">
       <p class="" style="background-color: #CCC">Reversement</p>
        Réf:  <span class="text-primary">{{ $reversement->ref }}</span><br>
        TVA(%) due:  <span class="text-primary">{{ $reversement->tva }}</span><br>
        Impôt(%) dû:  <span class="text-primary">{{ $reversement->impot }}</span><br>

        Date:  <span class="text-primary">{{ date('d/m/Y', strtotime($reversement->date_revers)) }}</span><br>
        Détail:  <span class="text-primary">{{ $reversement->detail }}</span><br>

    </div>


    <div class="col-md-4">
    	<p class="" style="background-color: #CCC">Mandat</p>
        Réf. mandat:  <span class="text-primary">{{ $reversement->mandat->ref  }}</span><br>
        Honoraire (%):  <span class="text-primary">{{ $reversement->mandat->honnoraire  }}</span><br>
        Date mandat:  <span class="text-primary">{{ date('d/m/Y', strtotime($reversement->mandat->date_enregistrement )) }}</span><br>

    </div>


    <div class="col-md-4">
        <p class="" style="background-color: #CCC">Propriétaire(s)</p>

        @foreach($appartenirs as $appart)

        {!! '<span class="text-primary">'.$appart->proprietaire->nom.' '.$appart->proprietaire->prenom.'</span>, ' !!}


        @endforeach
    </div>


</div>
<br>




 <hr>

 <h2>Quittances reversées</h2>
<table class="table align-items-center table-flush " id="dataTablebien" style="width:70%">

<thead  style="background-color:#999; color:#FFF">

    <tr>
    <th width="2%">N°</th>
    <th>Réf</th>
    <th>Montant</th>
    <th>Date</th>
    </tr>
</thead>


<tbody>
<?php $mt = 0; $mtp = 0; $i = 1; $mt_total = 0; $mt_total1 = 0; ?>
@foreach($quittances_r as $qui)
<?php $mt = $mt + $qui->facture->montant; ?>
    <tr>
    <td>{{ $i++ }}</td>
    <td>{{ $qui->ref  }}</td>
    <td>{{ $qui->facture->montant  }}</td>
    <td align="right">{{ date('d/m/Y', strtotime($qui->date_quittance))  }}</td>
    </tr>


    @endforeach
   <tr style="font-weight: bold;color: #F00">
   <td align="right" colspan="2"> TOTAL QUITTANCE</td>
   <td align="right" colspan="2">{{ separer($mt, 3) }}</td>
  </tr>

   <tr style="font-weight: bold;color: #F00">
   <td align="right" colspan="2"> Honoraire (%)</td>
   <td align="right" colspan="2">{{ $reversement->mandat->honnoraire }}</td>
  </tr>

    <!-- <tr style="font-weight: bold;color: #F00">
   <td align="right" colspan="2"> Impôt (%)</td>
   <td align="right" colspan="2">{{ $reversement->impot }}</td>
  </tr> -->
  <tr style="font-weight: bold;color: #F00">
   <td align="right" colspan="2"> Tva (%)</td>
   <td align="right" colspan="2">18</td>
  </tr>
<?php
    $mt_total = ($reversement->mandat->honnoraire * $mt) / 100;
    $mt_total1 = (18 * $mt_total) / 100;
    $montant_total = $mt - $mt_total - $mt_total1;
?>
  <tr style="font-weight: bold;color: #F00">
   <td align="right" colspan="2"> TOTAL A REVERSE</td>
   <td align="right" colspan="2">{{ separer($montant_total, 3) }}</td>
  </tr>

                    </tbody>
                  </table>
           <br><Br>

<!--
   <h2>Quittances non versées</h2>
<table class="table align-items-center table-flush " id="dataTablebien" style="width:70%">

<thead  style="background-color:#999; color:#FFF">

    <tr>
    <th width="2%">N°</th>
    <th>Réf</th>
    <th>Montant</th>
    <th>Date</th>
    <th width="5%">Action</th>
    </tr>
</thead>


<tbody>
<?php $mt = 0; $mtp = 0; $i = 1; ?>
@foreach($quittances as $quit)

    <tr style="background-color:#">
    <td>{{ $i++ }}</td>
    <td>{{ $quit->ref  }}</td>
    <td>{{ $quit->facture->montant  }}</td>
    <td>{{ date('d/m/Y', strtotime($quit->date_quittance))  }}</td>
    <td>

<input type="hidden" name="reversement_id" value="{{ $reversement->id}}">

    </td></tr>



    @endforeach

	</tbody>
  </table>
-->


		</div>
	  </div>
	</div>

</div>


@endsection
