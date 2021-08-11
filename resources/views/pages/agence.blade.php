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
    
    <h2 class="text-center alert alert-secondary">INFOS AGENCE</h2>
             
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

    <a href="javascript:void(0)" class="text-center " data-toggle="modal"  style="font-size:15px;"  data-target="#modalAgence"><i class="fas fa-fw fa-edit"  style="font-size:15px;" ></i>Modifier</a>


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
        Dénomination:  <span class="text-primary">{{ $agence->denomination }}</span><br><br>
        Forme juridique:  <span class="text-primary">{{ $agence->forme }}</span><br><br>
        N°registre de commerce:  <span class="text-primary">{{ $agence->numero_registre }}</span><br><br>
        Capital:  <span class="text-primary">{{ separer($agence->capital, 3)  }}</span><br><br>
        Adresse:  <span class="text-primary">{{ $agence->adresse }}</span><br><br>
        Email:  <span class="text-primary">{{ $agence->email_agence }}</span><br><br>
        Siège:  <span class="text-primary">{{ $agence->siege }}</span><br><br>
        Tél.:  <span class="text-primary">{{ $agence->telephone }}</span><br><br>


    </div>

    <div class="col-md-4">

        N° RCCM:  <span class="text-primary">{{ $agence->num_rccm }}</span><br><br>
        N° agrément :  <span class="text-primary">{{ $agence->numero_agrement }}</span><br><br>
        Représenté par:  <span class="text-primary">{{ $agence->sexe_representant.' '.$agence->representer_par }}</span><br><br>
        Poste  Représentant:  <span class="text-primary">{{ $agence->poste_representant }}</span><br><br>
        Date  relance:  <span class="text-primary">{{ date('d/m/Y', strtotime($agence->date_relance)) }}</span><br> <br>
        Détail:  <span class="text-primary">{{ $agence->detail }}</span><br>

    </div>
    <div class="col-md-4">


    </div>
</div>
<br>
<br>











<div>
    <div class="modal fade bd-example-modal-xl" id="modalAgence" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">

          <div class="modal-header">
            <h2 class="modal-title" style="text-align: center;" id="titremodal">Modifier infos agence</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

<form action="{{ route('agenceupdate')}}" method="POST" class="form inline">

{{ csrf_field() }}

<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<input type="hidden" name="agence_id" id="agence_id" value="{{ $agence->id }}">


<div class="row">
    <div class="col-md-4">
      <div class="form-group">
          <strong>Dénomination<b style="color: red;">*</b></strong>
          <input type="text" name="denomination" id="denomination"  class="form-control" value="{{ $agence->denomination }}" required>
      </div>
     </div>


    <div class="col-md-4">
        <div class="form-group">
            <strong>Forme juridique<b style="color: red;">*</b></strong>
            <select class="form-control" id="forme" name="forme" required>
                    <option value="{{ $agence->forme }}">{{ $agence->forme }}</option>
                    <option value="Société à Responsabilité Limité">Société à Responsabilité Limité (SARL)</option>
                    <option value="Société par Actions Simplifiée">Société par Actions Simplifiée (SAS)</option>
                    <option value="Société Anonyme">Société Anonyme (SA)</option>
            </select>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <strong>N° Régistre de commerce </strong>
            <input type="text" name="numero_registre" id="numero_registre"  value="{{ $agence->numero_registre }}"  class="form-control">
    </div>
    </div>

</div>





<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <strong>Capital </strong>
            <input type="number" name="capital" id="capital" value="{{ $agence->capital }}"  class="form-control">
         </div>
   </div>

    <div class="col-md-4">
        <div class="form-group">
            <strong>Adresse </strong>
            <input type="text" name="adresse" id="adresse" value="{{ $agence->adresse }}"  class="form-control">
       </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <strong>Email </strong>
            <input type="text" name="email_agence" id="email" value="{{ $agence->email_agence }}"  class="form-control">
       </div>
    </div>

</div>




<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <strong>Siège </strong>
            <input type="text" name="siege" id="siege" value="{{ $agence->siege }}"  class="form-control">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <strong>Tél. </strong>
            <input type="text" name="telephone" id="telephone" value="{{ $agence->telephone }}"  class="form-control">
       </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <strong>N° RCCM </strong>
            <input type="text" name="numero_rccm" id="numero_rccm" value="{{ $agence->num_rccm }}"  class="form-control">
       </div>
    </div>

</div>


<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <strong>N° d'agrément </strong>
            <input type="text" name="numero_agrement" id="numero_agrement" value="{{ $agence->numero_agrement }}"  class="form-control">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <strong>Sexe</strong>
            <select class="form-control" name="sexe_representant" id="sexe_representant">
                <option value="{{ $agence->sexe_representant }}">{{ $agence->sexe_representant }}</option>
                <option value="Monsieur">Monsieur</option>
                <option value="Madame">Madame</option>
                <option value="Mademoiselle">Mademoiselle</option>

            </select>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <strong>Représentant </strong>
            <input type="text" name="representer_par" id="representer_par" value="{{ $agence->representer_par }}"  class="form-control">
       </div>
    </div>

</div>

<div class="row">
   <div class="col-md-4">
        <div class="form-group">
            <strong>Poste représentant </strong>
            <input type="text" name="poste_representant" id="poste_representant" value="{{ $agence->poste_representant }}"  class="form-control">
       </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <strong>Date relance </strong>
            <input type="date" name="date_relance" id="date_relance" value="{{ $agence->date_relance }}"  class="form-control">
       </div>
    </div>

</div>


<div class="row"><div class="col-md-6">
    <div class="form-group">
        <strong>Détail </strong>
        <textarea name="detail" rows="4" class="form-control">{{ $agence->detail }}</textarea>
</div></div></div>

<div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="">Appliquer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>
</form>

          </div>
        </div>
      </div>





    </div>
</div>





</div>



@endsection
