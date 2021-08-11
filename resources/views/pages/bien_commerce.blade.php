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
        <h2 class="text-center alert alert-secondary">COMMERCE</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <p> <a href="{{ url('commerce_create') }}" class="text-center btn btn-success btn-lg" style="font-size:15px;" >
      <i class="fas fa-fw fa-plus-square"></i>Nouveau</a

               </p>


                </div>

                <div class="table-responsive p-3">

                  <table class="table align-items-center table-flush table-hover" id="datatablebien">
                    <thead class="thead-light">
                      <tr>
                        <th>Libellé</th>
                        <th>Type</th>
                        <th>Parcelle</th>
                        <th>Section</th>
                        <th>Lot/Ilot</th>
                        <th>Superficie(m²)</th>
                        <th>Adresse</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>

                    @foreach($biens as $bien)

                     <tr >
                    <td>   <a href="">{{$bien->libelle}} </a></td>
                     <td>{{$bien->type_commerce}}</td>
                     <td>{{$bien->parcelle}}</td>
                     <td>{{$bien->section}}</td>
                     <td>{{$bien->lot.'/'.$bien->ilot}}</td>
                     <td>{{$bien->superficie}}</td>
                     <td>{{$bien->adresse}}</td>
                     <td style="width:10%;">
                      <a href="{{route('commerce_update',['id' => $bien->id])}}""  class=""><i class="fas fa-fw fa-edit" style="font-size:15px"></i></a>
                      <a href="" id="" class=""> <i class="fas fa-fw fa-eye" style="font-size:15px"></i></a>
                      <a href="javascript:void(0)" id="commerce_archiver" data-id="{{$bien->id}}" data-archiver="{{$bien->archiver}}" class=""><i class="fas fa-file-archive" style="font-size:15px"></i></a>
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
