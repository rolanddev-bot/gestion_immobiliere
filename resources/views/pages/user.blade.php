@extends('layouts.main')

@section('content')

<div class="container-fluid" id="container-wrapper">
    


    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Utilisateur</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
<a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creerusertaire" style="font-size:15px;" data-target="#modal_usertaire">
<i class="fas fa-fw fa-plus-square" style="font-size: 15px"></i>Nouvel</a>


                </div>
                <div class="table-responsive p-3">

                  <table class="table align-items-center table-flush table-hover" id="dataTableusertaire">
                    <thead class="thead-light">
                      <tr>

                       
                        <th>Nom & Prénom(s)</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Adresse</th>

                        <th>Action</th>
                      </tr>
                    </thead>


                    <tbody>


                    @foreach($users as $user)

                   <tr style="">

                 
                     <td>{{ $user->nom.' '.$user->prenom}}  
                     
                     </td>
                     <td>{{$user->name}}</td>
                     <td>{{$user->email}}</td>
                     <td>

                   {{$user->mobile1}}
                    </td>
                    <td> ---</td>
<td>

<a href="javascript:void(0)" id="modif_user"  class=""> 
<i class="fas fa-fw fa-edit"></i></a>

<a href="javascript:void(0)" id="supp_user" data-id="{{ $user->id }}" title="Archiver" class="">
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
