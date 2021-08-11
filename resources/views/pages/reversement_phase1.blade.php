@extends('layouts.main')
@section('content')

<script type="text/javascript">

    $('body').on('click', '#btnAjouterElement', function() {
        var equipement_id = $(this).data('equipement_id1');
        var equiper_id = $(this).data('equiper_id1');
        

        $('#equipement_id1').val(equipement_id);
        $('#equiper_id').val(equiper_id);

        var libelle = $(this).data('libelle');

        $('#titremodal').html('Elément '+libelle);
        
        $('#modalElement').modal('show');
    });
    

    //Supprimer élément
    $('body').on('click', '#btnSuppElement', function() {
        //var localelement_id = $(this).data('localelement_id');
        var datatypebien = $("#form_typebien")[0];
        formData = new FormData(datatypebien);
        
        if (confirm('Voulez-vous supprimer cet élément?')) {;
            $.ajax({
                data: formData,
                url: "localelementdelete",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    alert(data);
                    window.location.reload();
                },
                error: function(data) {
                    alert('Error:', data);

                }
            });
        }



    });

</script>

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">



    @if(session()->has('ok'))
        <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
        {!! session('ok') !!}
        </div>
    @endif


    <div class="col-lg-12">
    <h3 class="text-center alert alert-secondary">Bien N°{{ $bien->ref}} - Détail </h3>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
     <a href="{{ route('bien')}}">Retour</a>


                </div>
                <div class="table-responsive p-3">

   

 <div class="row">

    <div class="col-md-4">
        Désignation:  <span class="text-primary">{{ $bien->libelle}}</span><br>
        Lot/Ilot:  <span class="text-primary">{{ $bien->lot.'/'.$bien->ilot}}</span><br>
        Commune:  <span class="text-primary">{{ $bien->commune->libelle }}</span>
    </div>

    <div class="col-md-4">
        
    </div>
    <div class="col-md-4">
        

    </div>   
</div>
<br>
<br>

  

<form class="" method="POST" action="{{ route('equipercreate') }}" style="border:1px solid #333; width:78%; padding:10px; margin:10px">
  @csrf


<input type="hidden" name="bien_id" id="bien_id" value="{{ $bien->id }}">

<div class="row" >

<div class="col-md-5">
    <div class="form-group">
        <select class="form-control" id="equipement_id" name="equipement_id" required>
            <option value="">Choisir localisation</option>

        @foreach($equipements as $eq)
            <option value="{!! $eq->id !!}"> {!! $eq->libelle !!}</option>
        @endforeach
        </optgroup>
        </select>
        <span class="text-danger">{{ $errors->first('Charge') }}</span>
    </div>
</div>


    <div class="col-md-5">
        <input type="text" name="detail" class="form-control" placeholder="Détail"/>
    </div>

    <div class="col-md-1">
  
        <button type="submit" class="btn btn-success" >Ajouter</button>
    </div>

</div>

</form>


<table class="table align-items-center table-flush " id="dataTablebien" style="width:80%">

<thead  style="background-color:#999; color:#FFF">

    <tr>
    <th width="2%">N°</th>
    <th>Localisation</th>
    <th>Détail</th>
    <th width="5%">Action</th>
    </tr>
</thead>


<tbody>
<?php $mt=0; $mtp=0; $i=1; ?>
@foreach($equipers as $eqp)

    <tr style="background-color:#EFEFEF">
    <td>{{ $i++ }}</td>
    <td>{{ $eqp->equipement->libelle  }}</td>
    <td>{{ $eqp->detail }} </td>
    <td>




 <a href="javascript:void(0)" data-equipement_id1="{{ $eqp->equipement->id }}" data-equiper_id1="{{ $eqp->id }}"  data-libelle="{{ $eqp->equipement->libelle }}"
  data-target="#modalElement" id="btnAjouterElement" > <i class="fas fa-fw fa-plus-square"></i></a>

  <a href="{{ url('equipersup/'.$eqp->id) }}" id="" class=""><i class="fas fa-fw fa-trash"></i>
                    
    </td></tr>


    @foreach($elts as $elt)
    
        @if($elt->equiper_id == $eqp->id)
            <tr ><td></td><td colspan="2">
            
            {!! $elt->element->libelle !!}

            @if($elt->detail != '') - {{ $elt->detail }} @endif
                
            </td><td>
                

            <a href="{{ url('local-element-delete/'.$elt->id) }}" class="">
            <i class="fas fa-fw fa-trash"></i>
            </a>

            </td></tr>
         @endif
    
    @endforeach



    @endforeach
                 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>












<div>
    <div class="modal fade bd-example-modal-xl" id="modalElement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-ld">
        <div class="modal-content">

        <div class="modal-header">
            <h2 class="modal-title" style="text-align: center;" id="titremodal"></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

<form  name="formlocalEL" method="POST" action="{{ url('local-element-store') }}"  id="formlocalEL" >
    {{ csrf_field() }}

    <input type="hidden" name="equipement_id" id="equipement_id1" value="">
    <input type="hidden" name="equiper_id" id="equiper_id" value="">


<div class="row">

    <div class="col-md-12">
        <div class="form-group">
        <strong>Elément <b style="color: red;">*</b></strong>
            <select name="element_id" class="form-control" required>
            <option value="">Choisir</option>

            @foreach($elements as $el)
            <option value="{!! $el->id !!}">{!! $el->libelle !!}</option>
            @endforeach

            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
        <strong>Détail </strong>
            <textarea name="detail" id="detail" class="form-control"></textarea>
        </div>
    </div>

</div>

<button type="submit" class="btn btn-success" id="">Ajouter</button>
</form>




        </div>
    </div>
    </div>
    </div>
</div>




</div>



@endsection
