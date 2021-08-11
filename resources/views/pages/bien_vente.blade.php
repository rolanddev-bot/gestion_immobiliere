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
        <h2 class="text-center alert"  style="background-color:#A9A9A9">Bien Terrain - vente </h2>
              <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                </div>



                <div class="table-responsive p-3">
<p align="center">
 <a href="{{ url('bien_maison_vente') }}" class="btn">Maison</a> |
<a href="{{ url('bien_appart_vente') }}" class="btn">Appartement</a>  |
<a href="{{ url('bien_immeuble_vente') }}" class="btn">Immeuble</a> |
<a href="{{ url('bien_commerce_vente') }}" class="btn">Commerce</a>
   </p>

   <a href="{{ url('bien/1/catvente') }}" class="text-center btn btn-success btn-lg" style="font-size:15px" data-target="#"><i class="fas fa-fw fa-plus-square"></i>Nouveau</a>
   <br> <br>
                  <table class="table align-items-center table-flush " id="datatablebien">
                    <thead class="">
                      <tr>
                        <th>Libellé</th>
                        <th>Lot/Ilot</th>
                        <th>Surface(m²)</th>
                        <th>Adresse</th>
                        <th>Disponible</th>
                        <th>Action</th>

                      </tr>
                    </thead>


                    <tbody>


                    @foreach($biens as $bien)
                   <tr>

                     <td><a href="{{ url('bien_vente_detail/'.$bien->id) }}" id="details_bien">{{$bien->libelle}}</a>

                     </td>

                     <td> {{$bien->lot.'/'.$bien->ilot}}</td>
                     <td>{{$bien->surface}}</td>
                     <td>{{$bien->adresse}}</td>
                     <td>@if($bien->libre == 0) Oui @else Non @endif </td>


                     <td style="width:2%">

                     <a href="{{ url('bien_vente_edit/'.$bien->id.'/edit') }}"  class="">
          <i class="fas fa-fw fa-edit" style="font-size:15px"></i></a>

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
