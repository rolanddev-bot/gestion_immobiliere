@extends('layouts.main')
@section('content')

<script type="text/javascript">
$(document).ready(function(){

    $('#creer_banque').click(function() {
        // alert('ok')
       // $('#mandat_id').val('');
        $('#form_banque').trigger("reset");
        $('#titrebanque').html('Ajouter nouvelle banque ')
        $('#modal_banque').modal('show');
    });
    //  appel du modal de mode de paiement

    $('#creer_mode').click(function() {
        // alert('ok')
       // $('#mandat_id').val('');
        $('#form_mode').trigger("reset");
        $('#titremode').html('Ajouter nouveau mode ')
        $('#modal_mode').modal('show');
    });



    $('body').on('click','#modif_banque', function(){

        var banque_id = $(this).data('id');
        var libelle = $(this).data('libelle');
        var detail = $(this).data('detail');

        $('#titrebanque').html('Modification')
        $('#modal_banque').modal('show');

        $('#banque_id').val(banque_id);
        $('#libelle').val(libelle);
        $('#detail').val(detail);
    });

    //*************** modification de mode*********** */

    $('body').on('click','#modif_mode', function(){

        var mode_id = $(this).data('id');
        var libelle = $(this).data('libelle');

        $('#titremode').html('Modification')
        $('#modal_mode').modal('show')

        $('#mode_id').val(mode_id);
        $('#libelle_mode').val(libelle);
        });
});
</script>

<div class="container-fluid" id="container-wrapper">

<div class="row">

    <div class="col-lg-6">
        <h2 class="text-center alert alert-secondary">Banques </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	
	<p><a href="javascript:void(0)" class="text-center btn btn-success btn-lg" title="Ajouter Banque" id="creer_banque" style="font-size:10px;" data-target="#modal_banque"><i class="fas fa-fw fa-plus-square" style="font-size:10px;"></i>
	</a> </p>

        @if(session()->has('ok'))
            <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
            {!! session('ok') !!}
            </div>
        @endif

                


                </div>
	<div class="table-responsive p-3">
	  <table class="table align-items-center table-flush table-hover" id="datatablecharg">
		<thead class="thead-light">
		  <tr>

			<th>Libellé</th>
			<th>Détail</th>
			<th>Action</th>

		  </tr>
		</thead>



                    <tbody>


	@foreach($banques as $banque)
  @if($banque->libelle != 'Aucune')
   <tr>
	 <td>{{$banque->libelle}}</td>
	 <td>{{$banque->detail}}</td>
	 <td style="width:10%">

	 <a href="javascript:void(0)" id="modif_banque" data-id="{{$banque->id}}" data-libelle="{{$banque->libelle}}" data-detail="{{$banque->detail}}" class=""> <i class="fas fa-fw fa-edit" style="font-size:15px"></i></a>
	 </td>
   </tr>
   @endif
  @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


<!--  *****************************  affichage des mode de paiements **************************   -->

     <div class="col-lg-6">
        <h2 class="text-center alert alert-secondary">Modes </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

	<p><a href="javascript:void(0)" class="text-center btn btn-success btn-lg" id="creer_mode" data-target="#modal_banque" style="font-size:10px;"><i class="fas fa-fw fa-plus-square" style="font-size:10px;"></i>
	</a> </p>
            
   

        @if(session()->has('ok1'))
            <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
            {!! session('ok1') !!}
            </div>
        @endif

               


                </div>
	<div class="table-responsive p-3">
	  <table class="table align-items-center table-flush table-hover" id="datatable_mode">
		<thead class="thead-light">
		  <tr>

			<th>Libellé</th>

			<th>Action</th>

		  </tr>
		</thead>



                    <tbody>


            @foreach($modes as $mode)

        <tr>
            <td>{{$mode->libelle}}</td>
            <td style="width:10%">

            <a href="javascript:void(0)" id="modif_mode" data-id="{{$mode->id}}" data-libelle="{{$mode->libelle}}" class=""> <i class="fas fa-fw fa-edit" style="font-size:15px"></i></a>
            </td>
        </tr>

        @endforeach
      </tbody>
     </table>
        </div>
        </div>
     </div>
 </div>




 <div class="modal fade bd-example-modal-sm" id="modal_banque" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titrebanque"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


              <form  name="form_banque" id="form_banque" method="POST" action="{{route('banque_store')}}">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
            <input type="hidden" name="banque_id" id="banque_id">


                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Libellé  <b style="color: red;">*</b></strong>
                            <input type="text" name="libelle" id="libelle" required class="form-control">
                            <div class="alert-danger" id="libelleError"></div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Détail  <b style="color: red;">*</b></strong>
                            <input type="text" name="detail" id="detail" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

    </form>

      </div>
    </div>
  </div>
</div>


   <!--     ************************ modal de mode de paiment*******************************   -->

   <div class="modal fade bd-example-modal-sm" id="modal_mode" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

    <div class="modal-header">
        <h2 class="modal-title" style="text-align: center;" id="titremode"></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


              <form  name="form_mode" id="form_mode" method="POST" action="{{route('mode_store')}}">
        {{ csrf_field() }}
        <!--  *************************CHAMPS NOM PRENOM ET EMAIL**********************************************  -->
            <input type="hidden" name="mode_id" id="mode_id">


                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Libellé  <b style="color: red;">*</b></strong>
                            <input type="text" name="libelle_mode" id="libelle_mode" required class="form-control">
                            <div class="alert-danger" id="libelleError"></div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>

    </form>

      </div>
    </div>
  </div>
</div>







</div>

@endsection
