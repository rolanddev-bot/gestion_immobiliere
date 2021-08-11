$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('#datatabledetails_bien').DataTable({

        "language": {
            "url": "{{route('/assets/French.json')}}"
        },
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'Tous']
        ]
    });

    /* $('#save_details').click(function(e) {
    e.preventDefault();

    var Formdetails = $('#form_details')[0];
    FormDatadetails = new FormData(Formdetails);


    $.ajax({
        data: FormDatadetails,
        url: "detail_biencreate",
        type: 'POST',
        processData: false,
        contentType: false,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(response) {
            console.log(response);
            //  window.location.reload();

        },
        error: function(response) {
            console.log('Error:', response);
            //  $('#libelleError').text(response.responseJSON.errors.libelle);
            // $('#montantError').text(response.responseJSON.errors.montant);
            // $('#delaiError').text(response.responseJSON.errors.delai);
        }



    });

    });*/


    $('body').on('click', '#modif_details', function() {
        //alert('ok')
        var detailbien_id = $(this).data('bien_id');
        var id_detail = $(this).data('id');
        var detail_libelle = $(this).data('libelle');
        var type_detail = $(this).data('type_detail');

        $('#titredetail').html('Modifier cet detail');
        $('#modal_details').modal('show');

        $('#bienidm').val(detailbien_id);
        $('#id_equipementm').val(id_detail);
        $('#libellem').val(detail_libelle);
        $('#type_detailm').val(type_detail);

    }); //

    $('body').on('click', '#supp_details', function() {

        confirm('Voulez-vous vraiment effectuer cette action?')
    })



//-----------Equipement

$('#creerEquipement').click(function() {

    $('#formEquipe').trigger("reset");
    $('#titremodal').html("Ajouter Equipement");

    $('#modal_equipement').modal('show');
    //$('#BTNajouterEquipement').show();
    //$('#btn_appli_modifier_location').hide();

});


$('body').on('click', '#BtnEquipement1', function() {
    $('#formEquipe').trigger("reset");

    $('#modalModifierEquipement').modal('show');
    //$('#BTNajouterEquipement').show();
    //$('#btn_appli_modifier_location').hide();

    $('#mtype').val($(this).data('type'));
    $('#mequipement_id').val($(this).data('id'));
    $('#mlibelle').val($(this).data('libelle'));

});


});