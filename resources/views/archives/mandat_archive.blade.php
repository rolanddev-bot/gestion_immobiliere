@extends('layouts.main')
@section('content')
    
    @include('pages.incl_fonction')

    <div class="container-fluid" id="container-wrapper">


<script type="application/javascript">
	//-------------- FACTURE - RECHERCHE PROPRIETAIRE ---------------

  
	 //Archiver
	function archiver(id1, id2){
		var var_id = id1;
        var archiver = id2;
        var archiver_info = '';
		var id_nvo = 0;

        if (archiver == 0) { archiver_info = 'archiver?'; id_nvo = 1;}
        else archiver_info = 'désarchiver?';

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


            <div class="col-lg-12">
        <h2 class="text-center alert"  style="background-color:darksalmon">Mandats archivés</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
               


                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="mandatdatatable">
                    <thead >
                      <tr >
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
  <td><a href="{{ url('mandat/'.$mandat->id) }}"> {{$mandat->ref}} </a></td>
  <td>{{$mandat->type_mandat}}</td>
    <td>{{$mandat->bien->libelle}}</td>

    <td>{{$mandat->honnoraire}}</td>
    <td>{{$mandat->commission}}</td>
    <td>{{$mandat->duree}}</td>

    
    <td style="width:5%">
    
  
    <a title="Imprimer" href="{{route('mandat_imprimer',['id' => $mandat->id])}}" id="print" data-id="" 
    class="" style="font-size:15px;"><i class="fas fa-fw fa-print" ></i></a>

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







    </div>



@endsection
