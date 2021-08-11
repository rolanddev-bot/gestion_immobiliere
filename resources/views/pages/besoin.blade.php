@extends('layouts.main')
@section('content')

    @include('pages.incl_fonction')


<div class="container-fluid" id="container-wrapper">


<script type="application/javascript">
	function archiver(id1, id2){
		var var_id = id1;
        var archiver = id2;
        var archiver_info = '';
		var id_nvo = 0;

        if (archiver == 0) { archiver_info = 'archiver?'; id_nvo = 1;}
        else archiver_info = 'désarchiver?';

			//alert(var_id+' '+id_nvo); exit();
        if (confirm('Voulez-vous '+archiver_info)) {
            $.ajax({
                data: 'var_id='+var_id+'&id_nvo='+id_nvo,
                url: "archivemandat",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
					window.location.reload();
										},
                error: function(data) { alert('Error:', data); }
            });
        }

    }

</script>

@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif



            <div class="col-lg-12">
        <h2 class="text-center alert alert-secondary">Besoin</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

 <a href="{{ url('besoin_create')}}" class="text-center btn btn-success btn-lg" style="font-size:15px" data-target="#"><i class="fas fa-fw fa-plus-square"></i>Nouveau</a>


                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="mandatdatatable">
                    <thead class="thead-light">
                      <tr>
                        <th>libellé</th>
                        <th>Type bien</th>
                        <th>Acquéreur </th>

                        <th>Nombre piéce(s)</th>

                        <th>Délai(jours)</th>
                        <th>Adresse</th>
                        <th>Statut</th>
                        <th>Action</th>

                      </tr>
                    </thead>



                    <tbody>
            @foreach($besoins as $besoin)
            <tr>
               <td><a href="{{ route('besoin_show',['id'=>$besoin->id]) }}"> {{ $besoin->libelle }} </a></td>
                <td>{{ $besoin->typebien->libelle }}</td>
                <td>{{ $besoin->locataire->nom.' '.$besoin->locataire->prenom }}</td>
                <td>{{ $besoin->nbre_piece }}</td>
                <td>{{ date('d/m/Y',strtotime($besoin->delai_acquisition)) }}</td>

                <td >{{ $besoin->adresse }}</td>
                @if($besoin->statut==0) <td class="text-success">En cours</td> @else <td class="text-danger">Expiré</td> @endif



    <td style="width:15%">
    <a title="Modifier" href="{{ route('besoin_edit',['id'=>$besoin->id]) }}" title="Modifié"><i class="fas fa-fw fa-edit"></i></a>
    <!--  <a title="Détail" href=""class="" style="font-size:15px;"> <i class="fas fa-fw fa-eye"></i></a>
    <a title="Imprimer" href="" id="print"  class="" style="font-size:15px;"><i class="fas fa-fw fa-print" ></i></a>  -->
    <a title="Archiver" href="javascript:void(0)" id="archive_besoin" class="" data-archiver="{{ $besoin->archiver }}" data-id="{{ $besoin->id }}" style="font-size:15px;">
       <i class="fas fa-file-archive" style="font-size:15px"></i></a>
    </td>
  </tr>

  @endforeach


                    </tbody>
                  </table>
                </div>
              </div>
            </div>





 <div class="modal fade bd-example-modal-lg" id="modal_mandat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titremandat"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">







<p></p>



      </div>
    </div>
  </div>
</div>






    </div>



@endsection
