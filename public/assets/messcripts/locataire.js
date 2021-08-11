$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('#dataTable').DataTable(); // ID From dataTable
    var table = $('#dataTablelocataire').DataTable({

        "language": {
            "url": "{{route('/assets/French.json')}}"
        },
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'Tous']
        ]
    }); // ID From dataTable with Hover


    // voir les elements
    $('#creerlocataire').click(function() {


        $('#loca_id').val('');
        $('#form_locataire').trigger("reset");
        $('#titrelocataire').html('Ajouter locataire ')
        $('#modal_locataire').modal('show');

    });

    $('#savelocataire').click(function(e) {
        e.preventDefault();

        var Formlocataire = $('#form_locataire')[0];
        FormDatalocat = new FormData(Formlocataire);

        //alert('ok');

        $.ajax({
            data: FormDatalocat,
            url: "createlocataire",
            type: "POST",
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                console.log(response);
                alert('Enregistré avec succès');
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

    $('body').on('click', '#modif_loca', function() {
        // alert('ok');
        var locataire_id = $(this).data('id');
        var locataire_nom = $(this).data('nom');
        var locataire_prenom = $(this).data('prenom');
        var locataire_autres = $(this).data('email'); //email
        var locataire_client = $(this).data('client');
        var locataire_locataire = $(this).data('locataire');
        var locataire_sexe = $(this).data('sexe');
        var locataire_numero_piece = $(this).data('numero_piece');
        var locataire_type_piece = $(this).data('type_piece');
        var locataire_date_naissance = $(this).data('date_naissance');
        var locataire_mobile1 = $(this).data('mobile1');
        var locataire_mobile2 = $(this).data('mobile2');
        var locataire_adresse = $(this).data('adresse');
        var locataire_photo = $(this).data('photo');

        var locataire_type_acquereur = $(this).data('type_acquereur');
        var locataire_nom_societe_loc = $(this).data('nom_societe_loc');
        var locataire_nom_representant_loc = $(this).data('nom_representant_loc');
        var locataire_contact1_representant_loc = $(this).data('contact1_representant_loc');
        var locataire_contact2_representant_loc = $(this).data('contact2_representant_loc');

        var locataire_numero_registre_loc = $(this).data('numero_registre_loc');
        var locataire_telephone_societe_loc = $(this).data('telephone_societe_loc');
        var locataire_adresse_societe_loc = $(this).data('adresse_societe_loc');

        var locataire_adresse_representant_loc = $(this).data('adresse_representant_loc');
        // console.log(bien_id);

        if (locataire_type_acquereur == 'personne physique') {
            $('#infos_locataire_entete').hide();
            $('#nom_societeaquereur').hide();
            $('#info_representantlocataire').hide();
            $('#infos_locataire_societe').hide();
            $('#Adresse_disp').show();
            $('#DateN_disp').show();


        } else {
            $('#info_representantlocataire').show();
            $('#nom_societeaquereur').show();
            $('#infos_locataire_entete').show();
            $('#infos_locataire_societe').show();
            $('#photo_disp').hide();
            $('#Adresse_disp').hide();
            $('#DateN_disp').hide();

            // $('#registre_societeOKm').show();
            // $('#info_representantm').show();


        }
        $('#titrelocataire').html('Modification Locataire');
        $('#modal_locataire').modal('show');

        $('#loca_id').val(locataire_id);
        $('#nom').val(locataire_nom);
        $('#prenom').val(locataire_prenom);
        $('#emaila').val(locataire_autres);
        $('#client').val(locataire_client);
        $('#locataire').val(locataire_locataire);
        $('#sexe').val(locataire_sexe);
        $('#numero_piece').val(locataire_numero_piece);
        $('#type_piece').val(locataire_type_piece);
        $('#date_naissance').val(locataire_date_naissance);
        $('#mobile1').val(locataire_mobile1);
        $('#mobile2').val(locataire_mobile2);
        $('#adresse').val(locataire_adresse);

        $('#type_aquereur').val(locataire_type_acquereur);
        $('#nom_societe_loc').val(locataire_nom_societe_loc);
        $('#nom_representant_loc').val(locataire_nom_representant_loc);
        $('#contact1_representant_loc').val(locataire_contact1_representant_loc);
        $('#contact2_representant_loc').val(locataire_contact2_representant_loc);
        $('#adresse_representant_loc').val(locataire_adresse_representant_loc);
        //
        $('#numero_registre_loc').val(locataire_numero_registre_loc);
        $('#telephone_societe_loc').val(locataire_telephone_societe_loc);
        $('#adresse_societe_loc').val(locataire_adresse_societe_loc);
        //$('#photo').val(locataire_photo);
    });

    //******************************** archivage de locataire ****************** */
 //******************************** archivage de locataire ****************** */

     $('body').on('click', '#archiver_locataire', function() {
        var locataire_id = $(this).data('id');
        var archiver = $(this).data('archiver');
        var archiver_info = '';

        if (archiver == 0) archiver_info = 'archiver?';
        else archiver_info = 'désarchiver?';

        if (confirm('Voulez-vous ' + archiver_info)) {
            $.ajax({
                data: { id: locataire_id, archiver: archiver },
                url: "archive_locataire",
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



    $('#locataire_morale').hide()


    $('#type_locataire').change(function() {
        var type = $('#type_locataire').val();
        console.log(type)

        if (type == 'personne physique') {
            $('#locataire_morale').hide()
            $('#locataire_physique').show()


        } else {
            $('#locataire_physique').hide()
            $('#locataire_morale').show()

        }
    });


















});