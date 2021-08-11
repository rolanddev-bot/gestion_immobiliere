$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('#dataTable').DataTable(); // ID From dataTable
    /* var table = $('#dataTableHover').DataTable({

        "language": {
            "url": "{{route('/assets/French.json')}}"
        },
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'Tous']
        ]
    });*/ // ID From dataTable with Hover




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
    //-------------- AJOUTER LOCATION ---------------

    //Ouverture de la Modal
    $('#creerlocation').click(function() {
        //$('#prop_id').val('');
        $('#form_location').trigger("reset")
        $('#titremodal').html("Ajouter Contrat");

        $('#modalLocation').modal('show');
        $('#ajouter_location').show();
        $('#btn_appli_modifier_location').hide();

    });



    $('#ajouter_location').click(function(e) {
        e.preventDefault();

        var dataForm = $("#form_location")[0];
        var formData = new FormData(dataForm);

        $.ajax({
            data: formData,
            url: "createlocation",
            type: "POST",
            processData: false,
            contentType: false,

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                $('#form_location').trigger("reset");

                //if (confirm('Ajouter avec succes!)')) {;


                //$('#modalLocation').modal('hide');
                window.location.reload();
                //$('#dataTableHover').draw();


                //}
            },
            error: function(data) {
                alert('Error:', data);


            }

        });


    });




    //------------------------------------------------------------------------------
    //-------------- MODIFICATION CHAMP LOCATION 1 ---------------

  

    $('body').on('click', '#btn_modifier_location', function() {
        
        $('#modalLocation').modal('show');
        $('#form_location').trigger("reset")
        $('#titremodal').html("Modifier Contrat " + $(this).data('ref'));

        $('#ajouter_location').hide();
        $('#btn_appli_modifier_location').show();


        //alert($(this).data('location_id'));

        //Recup et insert
        $('#location_id').val($(this).data('id'));

        $('#locataire_id').val($(this).data('locataire_id'));
        $('#proprietaire_id').val($(this).data('proprietaire_id'));
        $('#bien_id').val($(this).data('bien_id'));
        $('#loyer').val($(this).data('loyer'));
        $('#caution').val($(this).data('caution'));
        $('#charge').val($(this).data('charge'));
        $('#frais_enregistrement').val($(this).data('frais_enregistrement'));
        $('#frais_agence').val($(this).data('frais_agence'));
        $('#revision_annuelle_loyer').val($(this).data('revision_annuelle_loyer'));

        $('#duree').val($(this).data('duree'));
        $('#periodicite_loyer').val($(this).data('periodicite_loyer'));

        $('#detail').val($(this).data('detail'));
        $('#date_location').val($(this).data('date_location'));
        $('#ref').val($(this).data('ref'));
        $('#etat').val($(this).data('etat'));



    });






    //------------------------------------------------------------------------------
    //-------------- MODIFIER LOCATION 2 ---------------

    $('#btn_appli_modifier_location').click(function(e) {
        e.preventDefault();

        //var location_id = document.getElementById("location_id").value;
        //alert(location_id);

        var myForm = $("#form_location")[0];
        formData = new FormData(myForm)


        $.ajax({
            data: formData,
            url: "updatelocation",
            type: "POST",
            processData: false,
            contentType: false,

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                if (data = 'OK') { window.location.reload(); } else { alert("Erreur détectée!!") }

            },
            error: function(data) {
                alert('Error:', data);


            }

        });


    });





    //------------------------------------------------------------------------------
    //-------------- SUPPRIMER LOCATION ---------------


    $('body').on('click', '#supprimer_location', function() {
        var location_id = $(this).data('id');

        if (confirm('Voulez-vous archiver?')) {;
            $.ajax({
                data: { id: location_id },
                url: "deletelocation",
                type: "POST",
                // contentType: false,
                // processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    window.location.reload();
                    //alert(data);

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
        $('#titremodal').html("Ajouter avis échéance");

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
        $('#titreModalModif').html("Modifier Avis échéance " + $(this).data('ref'));
        //$('#span_locataire').html("Locataire: "+$(this).data('locataire_nom'));


        $('#mfacture_id').val($(this).data('facture_id'));


        $('#mmontant').val($(this).data('montant'));
        $('#mdate_facture').val($(this).data('date_facture'));
        $('#mnature').val($(this).data('nature'));
        $('#mmontant_lettre').val($(this).data('montant_lettre'));
        $('#mautre').val($(this).data('autre'));
        $('#mdate_debut').val($(this).data('date_debut'));
        $('#mdate_fin').val($(this).data('date_fin'));

        /* $('#loca_id').val($(this).data('locataire_id'));
        $('#loc_id').val($(this).data('location_id'));
        */



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
                    $('#formReglement').trigger("reset");
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


    


});