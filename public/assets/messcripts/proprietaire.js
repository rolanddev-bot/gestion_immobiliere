$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('#dataTable').DataTable(); // ID From dataTable
    var table = $('#dataTableprop').DataTable({

        "language": {
            "url": "{{route('/assets/French.json')}}"
        },
        pageLength: 20,
        lengthMenu: [
            [20, 30, 50, -1],
            [20, 30, 50, 'Tous']
        ]
    });


    var table = $('#datatablebien').DataTable({

        "language": {
            "url": "{{route('/assets/French.json')}}"
        },
        pageLength: 20,
        lengthMenu: [
            [20, 30, 50, -1],
            [20, 30, 50, 'Tous']
        ]
    });


    var table = $('#dataTablelocation').DataTable({
        "language": { "url": "{{route('/assets/French.json')}}" },
        pageLength: 20,
        lengthMenu: [
            [20, 30, 50, -1],
            [20, 30, 50, 'Tous']
        ]
    });


    var table = $('#dataTableimmeuble').DataTable({
        "language": { "url": "{{route('/assets/French.json')}}" },
        pageLength: 20,
        lengthMenu: [
            [20, 30, 50, -1],
            [20, 30, 50, 'Tous']
        ]
    });


    var table = $('#dataTablefacture').DataTable({
        "language": { "url": "{{route('/assets/French.json')}}" },
        pageLength: 20,
        lengthMenu: [
            [20, 30, 50, -1],
            [20, 30, 50, 'Tous']
        ]
    });


    //    $('#div_physique').show();
    $('#div_moral').hide();
    //document.getElementById('div_physique').style.display = "block";
    // document.getElementById('div_moral').style.display = "none";




    // voir les elements
    $('body').on('click', '#voir_prop', function() {
        // var prop_id = $(this).data('id');
        var prop_nom = $(this).data('nom');
        var prop_prenom = $(this).data('prenom');
        var prop_email = $(this).data('email');
        var prop_telephone = $(this).data('telephone');
        var prop_mobile1 = $(this).data('contact1');
        var prop_mobile2 = $(this).data('contact2');
        var prop_adresse = $(this).data('adresse');
        var prop_sexe = $(this).data('sexe');
        var prop_numero_piece = $(this).data('numero_piece');
        var prop_type_piece = $(this).data('type_piece');
        var prop_photo = $(this).data('photo');
        var prop_document = $(this).data('documents');

        var prop_date_naissance = $(this).data('date_naissance');

        $('#modalprovoir').modal('show')
            // console.log(prop_id);
        console.log(prop_nom);

        //console.log(prop_prenom);
        // $('#nom').val(prop_id);
        $('#nomv').val(prop_nom);
        $('#prenomv').val(prop_prenom);
        $('#emailv').val(prop_email);
        $('#contactv').val(prop_telephone);
        $('#contact1v').val(prop_mobile1);
        $('#contact2v').val(prop_mobile2);
        $('#adressev').val(prop_adresse);
        $('#sexev').val(prop_sexe);
        $('#numero_piecev').val(prop_numero_piece);
        $('#type_piecev').val(prop_type_piece);

        //$('#photov').append('<p> ok <p/>')
        // $('#documents').val(prop_document);
        //  $('#image_piece').val(prop_image_piece);
        $('#date_naissancev').val(prop_date_naissance);




    });




$('body').on('click', '#arhiver_proprietaire', function() {
        var prop_id = $(this).data('id');
        var archiver = $(this).data('archiver');
        var archiver_info = '';

        if (archiver == 0) archiver_info = 'archiver?';
        else archiver_info = 'désarchiver?';

        if (confirm('Voulez-vous ' + archiver_info)) {
            $.ajax({
                data: { id: prop_id, archiver: archiver },
                url: "proprietaire-delete",
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





    // fin


    /*$('#creerpro').click(function() {
        $('#prop_id').val('');
        $('#form_propietaire').trigger("reset")
        $('#titremodal').html("Ajouter un propriétaire");

        $('#modalpro').modal('show');

    });*/





    $('#modifier').click(function(e) {
        e.preventDefault();

        var myForm = $("#form_propietairemodif")[0];
        formData = new FormData(myForm)



        $.ajax({
            data: formData,
            url: "updateproprietaire",
            type: "POST",
            processData: false,
            contentType: false,

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);


                if (confirm('Modifié avec succes!')) {;

                    $('#form_propietairemodif').trigger("reset");
                    $('#modal_modifpro').modal('hide');
                    window.location.reload();



                }
            },
            error: function(data) {
                alert('Error:', data);


            }

        })

    });
    /*
        $('#info_representant').hide()
        $('#infos_proprietaire_entete').hide()
        $('#nom_societeOK').hide()
        $('#infos_proprietaire_societe').hide()
        $('#registre_societeOK').hide()
    */
    $('#type_proprietaire').change(function() {
        var type = $('#type_proprietaire').val();
        console.log(type)

        if (type == 'personne physique') {
            // alert('ok')
            // $('#div_physique').show();
            //$('#div_moral').hide();
            document.getElementById('div_physique').style.display = "block";
            document.getElementById('div_moral').style.display = "none";

        } else {
            //$('#div_physique').hide();
            //$('#div_moral').show();
            document.getElementById('div_physique').style.display = "none";
            document.getElementById('div_moral').style.display = "block";

        }
    });

















    $('#enregistrer').click(function(e) {
        e.preventDefault();
        // formData = new FormData($(this)[0]);
        // var form = $("#form_propietaire");
        // var formData = new FormData("#form_propietaire");
        var myForm = $("#form_propietaire")[0];
        formData = new FormData(myForm)


        $.ajax({
            data: formData,
            url: "createproprietaire",
            type: "POST",
            processData: false,
            contentType: false,

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                if (confirm('Ajouter avec succes!)')) {;

                    $('#form_propietaire').trigger("reset");
                    $('#dmodalpro').modal('hide');
                    window.location.reload();
                    //  $('#dataTableHover').draw();


                }
            },
            error: function(data) {
                alert('Error:', data);


            }

        });


    });



});