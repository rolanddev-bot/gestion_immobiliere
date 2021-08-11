//const { extendWith } = require("lodash");



$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('#dataTable').DataTable(); // ID From dataTable
    var table = $('#dataTableHover').DataTable({

        "language": {
            "url": "{{route('/assets/French.json')}}"
        },
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'Tous']
        ]
    }); // ID From dataTable with Hover




    //------------------------------------------------------------------------------
    //-------------- AFFICHER LOCATION ---------------
    // voir les elements
    $('body').on('click', '#btn_afficher_location', function() {

        $('#modalAffichage').modal('show');

        $('#p_ref').html($(this).data('ref'));
        $('#p_locataire_nom').html($(this).data('locataire_nom'));
        $('#p_locataire_adresse').html($(this).data('locataire_adresse'));
        $('#p_locataire_mobile').html($(this).data('locataire_mobile'));

    });







    //------------------------------------------------------------------------------
    //-------------- SUPPRIMER LOCATION ---------------


    $('body').on('click', '#archive_location', function() {
        var location_id = $(this).data('id');
        var archiver = $(this).data('archiver');
        var archiver_info = '';

        if (archiver == 0) archiver_info = 'archiver?';
        else archiver_info = 'désarchiver?';

        if (confirm('Voulez-vous ' + archiver_info)) {
            $.ajax({
                data: { id: location_id, archiver: archiver },
                url: "archive_location",
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

    });








    //-----------------------------------------------------------------------------------------------------------------------
    //------------------------------------ FACTURE LOYER -----------------------------------------------------------------


    //-------------- FACTURE - VISUALISER ---------------

    $('body').on('click', '#btn_afficher_facture', function() {

        $('#modalAfficher').modal('show');

        $('#p_facture_ref').html($(this).data('ref'));
        $('#p_montant').html($(this).data('montant'));
        $('#p_locataire_nom').html($(this).data('locataire_nom'));
        $('#p_date_facture').html($(this).data('date_facture'));

        $('#p_periode').html($(this).data('periode'));
        $('#p_nature').html($(this).data('nature'));
       
        $('#p_location_ref').html($(this).data('location_ref'));
        $('#p_bien_libelle').html($(this).data('bien_libelle'));
        $('#p_date_echeance').html($(this).data('p_date_echeance'));

    });

    //-------------- FACTURE - MODAL ---------------


    //Ouverture de la Modal
    $('#creerFacture').click(function() {

        $('#form_facture').trigger("reset")
        $('#titremodal').html("Ajouter avis d échéance");

        $('#modalFacture').modal('show');
        $('#ajouter_facture').show();
        $('#btn_appli_modifier_facture').hide();

    });


    //-------------- FACTURE - RECHERCHE LOCATAIRE ---------------

    $('#locataire_rech_id').change(function(e) {
        e.preventDefault();


        var dataForm = $("#form_facture_rech_locataire")[0];
        var formData = new FormData(dataForm);
        //var locataire_rech_id= document.getElementById('locataire_rech_id').value;



        $.ajax({
            data: formData,
            url: "facture_rech_locataire",
            type: "POST",

            processData: false,
            contentType: false,

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);

                document.getElementById('div_rech_locataire').innerHTML = data;

            },
            error: function(data) {
                alert('Error:', data);

            }
        });

    });




    //-------------- FACTURE - AJOUT ---------------
    $('#ajouter_facture').click(function(e) {
        e.preventDefault();

        $('#ajouter_facture').show();
        $('#btn_appli_modifier_facture').hide();



        var dataForm = $("#form_facture")[0];
        var formData = new FormData(dataForm);

        $.ajax({
            data: formData,
            url: "createfacture",
            type: "POST",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                alert('Enregistré avec succès!');
                window.location.reload();

            },
            error: function(data) { alert('Error:', data); }
        });
    });



    //-------------- FACTURE - MODIFIER ---------------
    //Afficher modal pour modification
    $('body').on('click', '#btn_modifier_location', function() {

        $('#modalModifFacture').modal('show');
        $('#formModifFacture').trigger("reset")
        $('#titreModalModif').html("Modifier appel loyer N° " + $(this).data('ref'));
        //$('#span_locataire').html("Locataire: "+$(this).data('locataire_nom'));


        $('#mfacture_id').val($(this).data('facture_id'));


        $('#mmontant').val($(this).data('montant'));
        $('#mdate_facture').val($(this).data('date_facture'));
        $('#mnature').val($(this).data('nature'));
        $('#mmontant_lettre').val($(this).data('montant_lettre'));
        $('#mautre').val($(this).data('autre'));
        $('#mdate_debut').val($(this).data('date_debut'));
        $('#mdate_echeance').val($(this).data('date_echeance'));
        $('#mdate_fin').val($(this).data('date_fin'));


    });



    $('#btn_appli_modifier_facture').click(function(e) {
        e.preventDefault();

        var dataForm = $("#formModifFacture")[0];
        var formData = new FormData(dataForm);

        $.ajax({
            data: formData,
            url: "updatefacture",
            type: "POST",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                alert(data);
                window.location.reload();

            },
            error: function(data) { alert('Error:', data); }
        });
    });


    //-------------- SUPPRIMER FACTURE ---------------


    $('body').on('click', '#supprimer_facture', function() {
        var facture_id = $(this).data('id');

        if (confirm('Voulez-vous archiver? ')) {;
            $.ajax({
                data: { id: facture_id },
                url: "facturedelete",
                type: "POST",
                // contentType: false,
                // processData: false,
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




    //-----------------------------------------------------------------------------------------------------------------------
    //------------------------------------ REGLEMENT -----------------------------------------------------------------


    //-------------- REGLEMENT - VISUALISER ---------------
    $('body').on('click', '#btn_afficher_reglement', function() {

        $('#modalAfficherReglement').modal('show');

        $('#r_facture_id').val($(this).data('facture_id'));
        $('#r_facture_montant').html($(this).data('montant'));
        $('#titreModalReglement').html($(this).data('ref'));

        var facture_id = $(this).data('facture_id');


        $.ajax({
            data: 'facture_id=' + facture_id,
            url: "facturereglementaffiche",
            type: "POST",
            //contentType: false,
            //processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                $('#div_reglement').html(data);


            },
            error: function(data) {
                alert('Error:', data);

            }
        });

    });



    //-------------- REGLEMENT - Ajouter ---------------
    $('#btn_appli_reglement').click(function(e) {
        e.preventDefault();


        if (confirm('Voulez-vous effectuer le paiement ? ')) {

            var dataForm = $("#formReglement")[0];
            var formData = new FormData(dataForm);

            $.ajax({
                data: formData,
                url: "reglementajouter",
                type: "POST",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    alert('Opération effectuée avec succès');
                    $('#reglementajouter').trigger("reset");
                    $('#div_reglement').html(data);



                },
                error: function(data) {
                    alert('Error:', data);

                }
            });
        }

    });


    //-------------- SUPPRIMER REGLEMENT ---------------


    $('body').on('click', '#supprimerReglement', function() {

        var mavar = $(this).data('reglement_id');

        if (confirm('Voulez-vous archiver règlement? ')) {

            $.ajax({
                data: { id: mavar },
                url: "reglementdelete",
                type: "POST",
                // contentType: false,
                // processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    alert('Suppression effectuée!');
                    $('#div_reglement').html(data);


                },
                error: function(data) {
                    alert('Error:', data);

                }
            });
        }

    });




    //-------------------------------------------------------------------------------------------
	//QUittance archivage
	/*
	 $('body').on('click', '#archiver_quittance', function() {
        var quittance_id = $(this).data('id');
        var archiver = $(this).data('archiver');
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

    });
	*/


});