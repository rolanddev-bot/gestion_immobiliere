//const { extendWith } = require("lodash");



$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //--------------- GERER IMMEUBLE --------------------------------
   /*
	$('#BtnAjouterImmeuble').click(function() {

        $('#modalAjouterImmeuble').modal('show');

    });





    $('body').on('click', '#btnMofifierImmeuble', function() {

        $('#modalModifierImmeuble').modal('show');

        $('#immeuble_id').val($(this).data('immeuble_id'));

        $('#mlibelle').val($(this).data('libelle'));
        $('#mdetail').val($(this).data('detail'));

    });

*/


    //MODIF IMMEUBLE
    $('#btnApplImmeuble22').click(function(e) {
        e.preventDefault();

        var dataForm = $("#formModifierImmeuble22")[0];
        var formData = new FormData(dataForm);

        //alert(myForm); exit();
        $.ajax({
            data: formData,
            url: "immeubleupdate",
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



/*
    //AJOUT IMMEUBLE
    $('#BtnApplImmeuble').click(function(e) {
        var vForm = "#formImmeuble";
        var vSaRoute = "immeublecreate";

        var dataForm = $(vForm)[0];
        var formData = new FormData(dataForm);

        $.ajax({
            data: formData,
            url: vSaRoute,
            type: "POST",
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                alert(data);
                window.location.reload();

            },
            error: function(data) { alert('Error:', data); }

        });
    });

*/

    //DELETE IMMEULBLE

    $('body').on('click', '#btnSupprimerImmeuble', function() {
       
		var immeuble_id = $(this).data('id');
        var archiver = $(this).data('archiver');
        var archiver_info = '';

        if (archiver == 0) archiver_info = 'archiver?';
        else archiver_info = 'désarchiver?';

        if (confirm('Voulez-vous ' + archiver_info)) {

            $.ajax({
                data: { id: immeuble_id },
                url: vChemin,
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




    //-------------- APPART - VISUALISER ---------------
    $('body').on('click', '#btnAfficherAppartement', function() {

        $('#modalAfficherAppart').modal('show');

        $('#aimmeuble_id').val($(this).data('immeuble_id'));
        $('#titreModalAppart').html($(this).data('libelle'));

        var immeuble_id = $(this).data('immeuble_id');


        $.ajax({
            data: 'immeuble_id=' + immeuble_id,
            url: "appartaffiche",
            type: "POST",
            //contentType: false,
            //processData: false,

            success: function(data) {
                //alert(data);
                $('#div_appart').html(data);


            },
            error: function(data) { alert('Error:', data); }
        });

    });


    //-------------- APPART - VISUALISER ---------------
    //AJOUT APPART
    $('#btnAppliAppart11').click(function(e) {
        e.preventDefault();

        var dataForm = $("#formAppart")[0];
        var formData = new FormData(dataForm);

        if ($('#formAppart :selected').hasClass('malist')) {
            alert('Sélectionnez un appartement SVP!');
            exit();
        }

        $.ajax({
            data: formData,
            url: "appartcreate",
            type: "POST",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                alert('Opération effectuée avec succès');
                $('#formAppart').trigger("reset");
                $('#div_appart').html(data);



            },
            error: function(data) {
                alert('Error:', data);

            }
        });


    });


    $('body').on('click', '#supprimerAppart', function() {

        var mavar = $(this).data('bien_id');

        if (confirm('Voulez-vous confirmer? ')) {

            $.ajax({
                data: { id: mavar },
                url: "appartdelete",
                type: "POST",
                // contentType: false,
                // processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    alert('Suppression effectuée!');
                    $('#div_appart').html(data);


                },
                error: function(data) {
                    alert('Error:', data);

                }
            });
        }

    });










    //------------------------------------ GESTION ETAT-----------------------------------------------------------------

    //Ouverture de la Modal Etat
    $('#creerEtat').click(function() {

        $('#formEtat').trigger("reset")
        $('#titremodal').html("Ajouter Etat");

        $('#modalEtat').modal('show');
        // alert('k')


    });




    //-------------- FACTURE - AJOUT ---------------

    $('#btnAjouterEtat').click(function(e) {
        e.preventDefault();

        var dataForm = $("#formEtat")[0];
        var formData = new FormData(dataForm);

        var maRoute = 'etatcreate';

        $.ajax({
            data: formData,
            url: maRoute,
            type: "POST",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                //$('#formEtat').trigger("reset");
                alert('Enregistré avec succès!');
                window.location.reload();

            },
            error: function(data) { alert('Error:', data); }
        });
    });


    //Afficher Modal Modif Etat
    $('body').on('click', '#btnModifierEtat', function() {

        $('#modalModifierEtat').modal('show');
        $('#formModifierEtat').trigger("reset")
        $('#titreModalModif').html("Modifier Etat ");


        $('#metat_id').val($(this).data('etat_id'));
        $('#mmontant').val($(this).data('montant'));
        $('#mdate_etat').val($(this).data('date_etat'));
        $('#mdecision').val($(this).data('decision'));
        $('#mconstat').val($(this).data('constat'));
        $('#mentree_sortie').val($(this).data('entree_sortie'));
    });


    //Afficher Modal Modif Etat
    $('#btnModifierFormEtat').click(function(e) {
        e.preventDefault();

        var dataForm = $("#formModifierEtat")[0];
        var formData = new FormData(dataForm);
        var maRoute = 'etatupdate';

        $.ajax({
            data: formData,
            url: maRoute,
            type: "POST",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                //$('#formEtat').trigger("reset");
                alert(data);
                window.location.reload();

            },
            error: function(data) { alert('Error:', data); }
        });
    });



    












});