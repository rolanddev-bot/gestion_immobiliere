@extends('layouts.main')

@section('content')
<div class="container-fluid" id="container-wrapper">

@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif


    <div class="col-lg-12">
    <h2 class="text-center alert" style="background-color:darksalmon">Propriétaires archivés </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">


</div>


                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush " id="dataTableprop" >
                    <thead class=""  style="background-color:#">
                      <tr>

                        <th>Photo</th>
                        <th>Nom & Prénom(s)</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Adresse</th>
                        <th width="2%">Action</th>
                      </tr>
                    </thead>


                    <tbody>


@foreach($proprietaires as $prop)
      <?php $datenow = \Carbon\Carbon::now()->format('Y'); ?>

        <tr>


        <td>
        @if($prop->photo != 'aucun')
        <img width="30" class="rounded-circle" height="30" src="{{ url('/assets/dossier/'.$prop->photo) }}">
        @else
        <img width="30" class="rounded-circle" height="30" src="{{ url('/assets/img/avatar.png') }}">
        @endif

        </td>

        <td><a href="{{ url('proprietaire/'.$prop->id) }}" title="{{ $prop->type_proprietaire }}">
        @if($prop->nom_societe !='')
            {{ $prop->nom.' '.$prop->prenom.' - '.$prop->nom_societe }}
        @else
            {{ $prop->nom.' '.$prop->prenom }}
        @endif
        </a>
        </td>

        <td>{{ $prop->emailto }}</td>
        <td>
        @if($prop->mobile2 != '')  {{$prop->mobile1.' / '.$prop->mobile2}}
        @else {{$prop->mobile1}}
        @endif
        </td>
        <td>
            @if ($prop->type_proprietaire == 'personne morale')  {{ $prop->adresse_societe }}
            @else {{ $prop->adresse }}
            @endif
        <td>


    <a href="javascript:void(0)" title="Archiver" id="arhiver_proprietaire" data-id="{{ $prop->id }}" data-archiver="{{ $prop->archiver }}" class="">
    <i class="fas fa-file-archive" style="font-size:15px"></i></a>
                        </td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
</div>

@endsection
