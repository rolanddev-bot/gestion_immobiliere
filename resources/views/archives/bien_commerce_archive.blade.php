@extends('layouts.main')
@section('content')

<script type="text/javascript">


</script>

<div class="container-fluid" id="container-wrapper">
  


@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif

    <div class="col-lg-12">
        <h2 class="text-center alert"  style="background-color:darksalmon">Bien - Commerces archivés </h2>
              <div class="card mb-4">
               
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    


                </div>

                <div class="table-responsive p-3">
<p align="center"> 
 <a href="{{ url('bien-archive') }}" class="btn">Terrain</a> | 
<a href="{{ url('bien-appartement-archive') }}" class="btn">Appartement</a>  | 
<a href="{{ url('bien-immeuble-archive') }}" class="btn">Immeuble</a> | 
<a href="{{ url('bien-commerce-archive') }}" class="btn">Commerce</a>                
   </p>              
                 
                  <table class="table align-items-center table-flush " id="datatablebien">
                    <thead class="">
                      <tr>

                        
                        <th>Libellé (Immeuble)</th>
                        <th>Type bien</th>
                        <th>Lot/Ilot</th>
                        <th>Nbre Pièce</th>
                        <th>Surface(m²)</th>
                        <th>Commune</th>
                        <th>Disponible</th>
                        <th>Action</th>

                      </tr>
                    </thead>


                    <tbody>


                    @foreach($biens as $bien)
                   <tr>
                     
                     <td><a href="{{ url('bien/'.$bien->id) }}" id="details_bien">{{$bien->libelle}}</a>
                     
                     @if($bien->Immeuble->libelle != 'Aucun') - {{ $bien->Immeuble->libelle }}  @endif

                     </td> 
                     
                     <td> {{$bien->typebien->libelle}}</td>
                     
                     <td> {{$bien->lot.'/'.$bien->ilot}}</td>
                     
                     <td>{{$bien->nbre_piece}}</td>
                     
                     <td>{{$bien->surface}}</td>
                     
                     <td>{{$bien->commune->libelle}}</td>


                     <td>@if($bien->libre == 0) Oui @else Non @endif </td>


                     <td style="width:2%">
        
        <a href="javascript:void(0)" id="supp_bien" data-id="{{$bien->id}}" class="">
        <i class="fas fa-file-archive" style="font-size:15px"></i></a>
                     </td>
                   </tr>
                   @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
            </div>







<div class="modal fade bd-example-modal-xl" id="modal_bien" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titrebien"></h2>
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







@endsection
