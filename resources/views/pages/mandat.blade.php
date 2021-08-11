@extends('layouts.main')
@section('content')

    @include('pages.incl_fonction')


<div class="container-fluid" id="container-wrapper">


<script type="application/javascript">

	 //Archiver
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
        <h2 class="text-center alert alert-secondary">Mandat</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

 <a href="{{ url('mandat-create')}}" class="text-center btn btn-success btn-lg" style="font-size:15px" data-target="#"><i class="fas fa-fw fa-plus-square"></i>Nouveau</a>


                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="mandatdatatable">
                    <thead class="thead-light">
                      <tr style="font-size:;">
                        <th>Réf.</th>
                        
                        <th>Type</th>
                        <th>bien</th>
                        <th>Honoraire (%)</th>
                        <th>Commission</th>
                        <th>Durée</th>
                        <th>Action</th>

                      </tr>
                    </thead>



                    <tbody>


@foreach($mandats as $mandat)
  <tr>
  <td><a href="{{ url('mandat/'.$mandat->id)}}"> {{$mandat->ref}} </a></td>
  <td>{{ $mandat->type_mandat }}</td>
    <td>{{ $mandat->bien->libelle }}</td>

    <td>{{ $mandat->honnoraire }}</td>
    <td>{{ $mandat->commission }}</td>
    <td >{{ $mandat->duree }}</td>


    <td style="width:15%">
    <a title="Modifier" href="{{ url('mandat/'.$mandat->id.'/edit') }}" title="Modifié">
    <i class="fas fa-fw fa-edit"></i></a>



    <a href="{{route('mandat_imprimer',['id' => $mandat->id])}}" id="print" title="Exporter PDF"  data-id=""
    class="" style="font-size:15px;"><i class="fas fa-fw fa-file-pdf" style="font-size:15px"></i></a>

    <a  href="{{ url('mandat_imprimer_direct/'.$mandat->id)}}" id="" title="Imprimer" target="_blank" class=""><i class="fas fa-fw fa-print" ></i></a>

   <?php $var = $mandat->id; $var_archiver = $mandat->archiver; ?>
    <a title="Archiver" href="javascript:void(0)" id="archive_mandat1" onClick="archiver('{{ $var }}', '{{ $var_archiver }}')" class="" style="font-size:15px;">
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
