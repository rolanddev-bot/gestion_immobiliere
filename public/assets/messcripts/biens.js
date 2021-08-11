$('document').ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var tabletypebien = $('#datatabletypebien').dataTable({
        "language": {
            "url": "{{route('/assets/French.json')}}"
        },
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'Tous']
        ]

    })

    $('#creertypebien').click(function () {
        // alert('ok')
        $('#typebien_id').val(' ');
        $('#form_typebien').trigger("reset");
        $('#libellesError').text(' ');
        $('#detailsError').text(' ');
        $('#titretypebien').html('Ajouter type de bien');
        $('#modal_typebien').modal('show');
    });

    $('body').on('click', '#modif_typebien', function () {
        var type_id = $(this).data('id');
        var type_libelle = $(this).data('libelle');
        var type_details = $(this).data('details');
        $('#titretypebien').html('Modifier ce type de bien');
        $('#modal_typebien').modal('show');
        $('#typebien_id').val(type_id);
        $('#libelle').val(type_libelle);
        $('#details').val(type_details);

    });



    $('body').on('click', '#supp_typebien', function () {
        var typebien_id = $(this).data('id');
        console.log(typebien_id);

        if (confirm('Voulez-vous archiver ce bien?')) {
            ;
            $.ajax({
                data: { id: typebien_id },
                url: "deletetypebien",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    window.location.reload();

                },
                error: function (data) {
                    alert('Error:', data);

                }
            });
        }



    });



    $('#savetypebien').click(function (e) {
        e.preventDefault();
        var datatypebien = $("#form_typebien")[0];
        formData = new FormData(datatypebien)

        $.ajax({
            data: formData,
            url: "createtypebien",
            type: 'POST',
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                if (response == 'ok') {
                    $('#form_typebien').trigger("reset");
                    $('#modal_typebien').modal('hide');
                    window.location.reload();
                    console.log(response);
                } else if (response == 'edit') {
                    $('#form_typebien').trigger("reset");
                    $('#modal_typebien').modal('hide');
                    window.location.reload();

                } else {

                    $('#vide').html("Cet libellé Existe déjà !");
                    $('#libelle').focus(function () {
                        $('#vide').html(" ");
                    });

                }

            },
            error: function (response) {
                // console.log('Error:', data);
                $('#libellesError').text(response.responseJSON.errors.libelle);
                $('#detailsError').text(response.responseJSON.errors.details);



            }

        })



    })







    // ************************************  pour les charges **************************************///

    var tablecharge = $('#datatablecharge').dataTable({
        "language": {
            "url": "{{route('/assets/French.json')}}"
        },
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'Tous']
        ]

    });




    $('#creercharge').click(function () {
        //alert('ok');
        $('#charge_id').val(' ');
        $('#form_charge').trigger("reset");
        $('#libelleError').text(' ');
        $('#montantError').text(' ');
        $('#delaiError').text(' ');
        $('#titrecharge').html('Ajouter une charge');
        $('#modal_charge').modal('show');
    });

    $('#savecharge').click(function (e) {
        e.preventDefault();
        var datatypebien = $("#form_charge")[0];
        formData = new FormData(datatypebien)

        $.ajax({
            data: formData,
            url: "createcharge",
            type: 'POST',
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                console.log(response);
                alert('Charge ajoutée avec succès!');
                window.location.reload();



            },
            error: function (response) {
                // console.log('Error:', data);
                $('#libelleError').text(response.responseJSON.errors.libelle);
                $('#type_chargeError').text(response.responseJSON.errors.type_charge);
                // $('#delaiError').text(response.responseJSON.errors.delai);



            }

        })



    });



    $('body').on('click', '#modif_charge', function () {
        var charge_id = $(this).data('id');
        var charge_libelle = $(this).data('libelle');
        var charge_type_charge = $(this).data('type_charge');

        $('#titrecharge').html('Modifier cette charge');
        $('#modal_charge').modal('show');
        $('#charge_id').val(charge_id);
        $('#libelle').val(charge_libelle);
        $('#type_charge').val(charge_type_charge);


    });




    $('body').on('click', '#supp_charge', function () {
        var charge_id = $(this).data('id');
        console.log(charge_id);
        if (confirm('Voulez-vous archiver cette charge ?')) {
            ;
            $.ajax({
                data: { id: charge_id },
                url: "deletecharge",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data);
                    alert('Supprimer avec succès!')
                    window.location.reload();

                },
                error: function (data) {
                    alert('Error:', data);

                }
            });
        }



    });
    // ************************************  pour les biens **************************************///


    $('#creerbien').click(function () {
        // alert('ok');
        $('#bien_id').val(' ');
        $('#form_bien').trigger("reset");
        $('#typebienError').text(' ');
        $('#lotError').text(' ');
        $('#ilotError').text(' ');
        $('#sectionError').text(' ');
        $('#communeError').text(' ');
        $('#titrebien').html('Ajouter un bien');
        $('#modal_bien').modal('show');
    });


    $('body').on('click', '#modif_bien', function () {
        var bien_id = $(this).data('id');
        var bien_typebien = $(this).data('typebien');
        var bien_ilot = $(this).data('ilot');
        var bien_lot = $(this).data('lot');
        var bien_parcelle = $(this).data('parcelle');
        var bien_section = $(this).data('section');
        var bien_regime = $(this).data('regime');
        // var bien_consistance = $(this).data('consistance');
        var bien_surface = $(this).data('surface');
        var bien_nbre_piece = $(this).data('nbre_piece');
        // var bien_autre_partie = $(this).data('autre_partie');
        var bien_commune_id = $(this).data('commune_id');
        //  var bien_equipement = $(this).data('equipement');
        var bien_detail = $(this).data('detail');
        var bien_meuble = $(this).data('meuble');
        var bien_libelle = $(this).data('libelle');
        var bien_libre = $(this).data('libre');
        console.log(bien_libre);
        $('#titrebien').html('Modifier ce Bien');
        $('#modal_bien').modal('show');
        //console.log(bien_id);
        $('#bien_id').val(bien_id);
        $('#typebien').val(bien_typebien);
        $('#ilot').val(bien_ilot);
        $('#lot').val(bien_lot);
        $('#parcelle').val(bien_parcelle);
        $('#section').val(bien_section);
        $('#regime').val(bien_regime);
        //  $('#consistance').val(bien_consistance);
        $('#surface').val(bien_surface);
        $('#nbre_piece').val(bien_nbre_piece);

        $('#commune_id').val(bien_commune_id);

        $('#detail').val(bien_detail);
        $('#meuble').val(bien_meuble);
        $('#libelle_bien').val(bien_libelle);

        if (bien_libre == 1) {
            //$('#libre').val(bien_libre);
            //$('input[type="checkbox"]').attr("checked", "checked");
            $("#libre").prop("checked", true);
        } else {
            //$('input[type="checkbox"]').attr("checked", "false");
            $("#libre").prop("checked", false);

        }

        if (bien_meuble == 1) {
            //$('#libre').val(bien_libre);
            //$('input[type="checkbox"]').attr("checked", "checked");
            $("#meuble").prop("checked", true);
        } else {
            //$('input[type="checkbox"]').attr("checked", "false");
            $("#meuble").prop("checked", false);

        }


    });

    /*
    
        $('#savebien').click(function(e) {
            e.preventDefault();
    
            var Formbien = $('#form_bien')[0];
            FormDatabien = new FormData(Formbien);
    
            $.ajax({
    
                data: FormDatabien,
                type: 'POST',
                url: "createbien",
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    console.log(response);
    
                    alert('Bien ajouté avec succès!');
    
                    window.location.reload();
               
    
                },
                error: function(response) {
                    console.log('Error:', response);
                    //  $('#libelleError').text(response.responseJSON.errors.libelle);
                    // $('#montantError').text(response.responseJSON.errors.montant);
                    // $('#delaiError').text(response.responseJSON.errors.delai);
    
    
    
                }
    
    
    
            });
    
    
    
        });
    
    */
    $('body').on('click', '#supp_bien', function () {
        var var_id = $(this).data('id');
        var archiver = $(this).data('archiver');
        var etat_nvo = 0;
        var archiver_info = '';

        if (archiver == 0) { archiver_info = 'archiver cet enregistrement?'; etat_nvo = 1; }
        else { archiver_info = 'désarchiver cet enregistrement?'; }

        if (confirm('Voulez-vous ' + archiver_info)) {

            $.ajax({
                //data: { id: var_id, archive_value: etat_nvo },
                data: 'id=' + var_id + '&archive_value=' + etat_nvo,
                url: "/deletebien",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data)
                    window.location.reload();

                },
                error: function (data) {
                    alert('Error:', data);

                }
            });
        }



    });





    //Equipement et element


    $('#creerEquipement').click(function () {

        $('#formEquipe').trigger("reset");
        $('#titremodal').html("Ajouter Equipement");

        $('#modal_equipement').modal('show');
        //$('#BTNajouterEquipement').show();
        //$('#btn_appli_modifier_location').hide();

    });

    $('#creerElement').click(function () {

        $('#form_element').trigger("reset");
        $('#titremodal').html("Ajouter Elément");

        $('#modal_element').modal('show');
        //$('#BTNajouterEquipement').show();
        //$('#btn_appli_modifier_location').hide();

    });


    $('body').on('click', '#BtnEquipement1', function () {
        $('#formEquipe').trigger("reset");

        $('#modalModifierEquipement').modal('show');
        //$('#BTNajouterEquipement').show();
        //$('#btn_appli_modifier_location').hide();

        $('#mtype').val($(this).data('type'));
        $('#mequipement_id').val($(this).data('id'));
        $('#mlibelle').val($(this).data('libelle'));

    });





});
