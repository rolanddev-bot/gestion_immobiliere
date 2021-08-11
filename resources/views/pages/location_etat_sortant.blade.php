



  
<div style="width:80%">


<form  name="form_etat_entrant" method="POST"  id="form_etat_entrant" action="{{ url('etatupdate') }}" enctype="multipart/form-data">
    {{ csrf_field() }}


<table class="table align-items-center table-flush " id="dataTablebien" style="width:">

<thead style="background-color:#; color:#FFF" class="bg-navbar">

    <tr>
    <th width="2%">N°</th>
    <th>Localisation</th>
    <th>Détail</th>
    <th width="20%"></th>
    

    </tr>
</thead>


<tbody>
<?php $mt=0; $mtp=0; $i=1; $j=0; ?>
@foreach($equipers as $eqp)

    <tr style="background-color:#EFEFEF" >
    <td>{{ $i++ }}</td>
    <td>{{ $eqp->equipement->libelle  }}</td>
    <td>{{ $eqp->detail }} </td>
    <td colspan="6">

Observation

        
    </td></tr>


    @foreach($elts as $elt)
        @if($elt->equiper_id == $eqp->id)
        
<tr><td></td><td colspan="2">
    
 {!! $elt->element->libelle.' - '.$elt->detail !!} {!! $elt->id !!}
       
</td>

<td colspan="">

<input type="text" name="note{{ $j }}" style="height:25px"  class="form-control" value="{{ $elt->note?$elt->note:'RAS' }}" @if($etats->cloture == 1) disabled  @endif>

<input type="checkbox" name="equiper_id[]" class="form-control" checked="checked" value="{{ $elt->id.'-'.$j }}" style="visibility:hidden" >



</td>
</tr>
<?php $j++; ?>
    @endif
    
    @endforeach

@endforeach
                 
</tbody>
</table>


     
    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
    <input type="hidden" name="location_id" id="location_id" value="{{ $location->id }}">
    <input type="hidden" name="etat_id" id="etat_id" value="{{ $etats->id }}">
    <input type="hidden" name="entree_sortie" id="entree_sortie" value="Sortie">
    <input type="hidden" name="nbre_champ" id="nbre_champ" value="{{ $j }}">

<div class="row">

<div class="col-md-4">
    <div class="form-group">
        <strong>Date état des lieux<b style="color: red;">*</b></strong>
        <input type="date" name="date_etat" id="date_etat" @if($etats->cloture == 1) disabled  @endif class="form-control" value="{{ $etats->date_etat }}" required>
        <span class="text-danger">{{ $errors->first('image') }}</span>
    </div>
</div>
</div>
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <strong>Avis du locataire</strong>
                <textarea name="avis_locataire" class="form-control" @if($etats->cloture == 1) disabled  @endif>{{ $etats->avis_locataire }}</textarea>
                <span class="text-danger">{{ $errors->first('image') }}</span>
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <strong>Avis du bailleur</strong>
                <textarea  name="avis_bailleur" class="form-control" @if($etats->cloture == 1) disabled  @endif>{{ $etats->avis_bailleur }} </textarea>
                <span class="text-danger">{{ $errors->first('Locataire') }}</span>
            </div>
        </div>
</div>


<div class="row">


<div class="col-md-12">
    <div class="form-group">
        <strong>Conclusion</strong>
        <textarea  name="detail" class="form-control" @if($etats->cloture == 1) disabled  @endif >{{ $etats->detail }} </textarea>
        <span class="text-danger">{{ $errors->first('Locataire') }}</span>
    </div>
</div>


</div>

<div class="row">


<div class="col-md-12">
    <div class="form-group">
        <strong>Clôturer</strong> &nbsp; &nbsp;
        <input type="checkbox"  name="cloture" value="1" class="" @if($etats->cloture == 1 ) checked="checked" disabled  @endif >
        <span class="text-danger">{{ $errors->first('Locataire') }}</span>
    </div>
</div>


</div>

<p align="right">
<button type="submit" class="btn btn-success" id="" @if($etats->cloture == 1 OR $location->archiver ==1) disabled="disabled" @endif >Enregistrer </button>


<a href="{{ url('etat-print/'.$location->id) }}" type="submit" class="btn btn-warning" id="" 
@if($etat->cloture == 0 ) disabled="disabled" @endif >Imprimer </a>
</p>




</form>

</div>

</div>