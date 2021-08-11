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
        <h2 class="text-center alert alert-secondary">Budget</h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

 <a href="{{ url('budget_create')}}" class="text-center btn btn-success btn-lg" style="font-size:15px" data-target="#"><i class="fas fa-fw fa-plus-square"></i>Nouveau</a>


                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="mandatdatatable">
                    <thead class="thead-light">
                      <tr>

                        <th>Acquéreur </th>
                        <th>Besoin</th>
                        <th>Monant</th>
                        <th> Mode paiement</th>
                        <th>Modalité</th>
                        <th>Action</th>

                      </tr>
                    </thead>



                    <tbody>
            @foreach($budgets as $budget)
            <tr>
               <td><a href=""> {{ $budget->besoin->locataire->nom.' '.$budget->besoin->locataire->prenom }} </a></td>
                <td> {!! $budget->besoin->libelle.' - '.$budget->besoin->adresse !!} </td>
                <td>{{ strrev(wordwrap(strrev($budget->montant), 3, ' ', true)).' F CFA' }}</td>

                <td>{{ $budget->mode->libelle }}</td>
                <td>{{ $budget->modalite }}</td>
    <td style="width:15%">
    <a title="Modifier" href=" {{route('budget_edit',['id'=>$budget->id])}} " title="Modifié"><i class="fas fa-fw fa-edit"></i></a>
    <!--  <a title="Détail" href=""class="" style="font-size:15px;"> <i class="fas fa-fw fa-eye"></i></a>
    <a title="Imprimer" href="" id="print"  class="" style="font-size:15px;"><i class="fas fa-fw fa-print" ></i></a>  -->
    <a title="Archiver" href="javascript:void(0)" id="archive_budget" class="" data-archiver="{{ $budget->archiver }}" data-id="{{ $budget->id }}" style="font-size:15px;">
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
