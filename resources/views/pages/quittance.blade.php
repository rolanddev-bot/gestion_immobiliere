@extends('layouts.main')
@section('content')

<div class="container-fluid" id="container-wrapper">


   <script type="application/javascript">
	
	 function archiver(id1, id2){
        var quittance_id = id1;
        var archiver = id2;
        var archiver_info = '';

        if (archiver == 0) archiver_info = 'archiver?';
        else archiver_info = 'désarchiver?';

        if (confirm('Voulez-vous ' + archiver_info)) {
            $.ajax({
                data: { id: quittance_id, archiver: archiver },
                url: "archive_quittance",
                type: "POST",
                // contentType: false,
                // processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    window.location.reload();

                },
                error: function(data) {
                    alert('Error:', data);

                }
            });
        }

    }

</script>
   
    <div class="col-lg-12">
        <h2 class="text-center alert alert-secondary">Quittance</h2>
              <div class="card mb-4">

                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="datatablecharge">
                    <thead class="thead-light">
                      <tr>

                        <th>Réf.</th>
                        <th>Locataire</th>
                        <th>Libellé</th>
                        <th>Montant</th>
                        <th>Action</th>

                      </tr>
                    </thead>



                    <tbody>


	@foreach($quittances as $var)
   <tr>
        <td>{{$var->ref }}</td>
        <td>{{$var->facture->location->locataire->nom.' '.$var->facture->location->locataire->prenom}}</td>
		<td>{{$var->facture->nature}}</td>


     <td>{{ strrev(wordwrap(strrev($var->facture->montant), 3, ' ', true)).' '.'FCFA' }}</td>


	 <td style="width:10%">
       
        <a  href="{{ url('quittance_print/'.$var->id)}}" id="" title="Exporter PDF" class=""><i class="fas fa-fw fa-file-pdf" style="font-size:15px"></i></a>
        
        <a  href="{{ url('quittance-print-direct/'.$var->id) }}" id="" title="Imprimer quittance" target="_blank" class=""><i class="fas fa-print" style="font-size:15px"></i></a>
        
        <?php $var1 = $var->id; $var_archiver = $var->archiver; ?>
<a href="javascript:void(0)" id="supprimer_quittance" title="Archiver" onClick="archiver('{{ $var1 }}', '{{ $var_archiver }}')"><i class="fas fa-file-archive" style="font-size:15px"></i></a>
        
	 </td>
   </tr>
  @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>




 <div class="modal fade bd-example-modal-sm" id="modal_charge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titrecharge"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


              <form  name="form_charge" id="form_charge">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
        <input type="hidden" name="charge_id" id="charge_id">


                    <div class="col-md-12">
                            <div class="form-group">
                                <strong>Type charge<b style="color: red;">*</b></strong>
                                <select class="form-control" id="type_charge" name="type_charge" required>
                                        <option value="">Choisir</option>
                                        <option value="Locataire">Charge locative</option>
                                        <option value="Propriétaire">Charge propriétaire</option>
                                </select>
                                <div class="alert-danger" id="type_chargeError"></div>
                            </div>
                        </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Libellé  <b style="color: red;">*</b></strong>
                            <input type="text" name="libelle" id="libelle" required class="form-control">
                            <div class="alert-danger" id="libelleError"></div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="savecharge">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

    </form>

      </div>
    </div>
  </div>
</div>







</div>

@endsection
