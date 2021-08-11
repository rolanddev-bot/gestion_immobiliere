$(document).ready(function() {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('#dataTable').DataTable(); // ID From dataTable
    var table = $("#datatable_vente").DataTable({

        "language": {
            "url": "{{route('/assets/French.json')}}"
        },
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'Tous']
        ]
    });

    $('#creervente').click(function() {
        //  alert('ok')

        $('#vente_id').val('');
        $('#form_vente').trigger("reset");
        $('#date_venteError').text(' ');
        $('#puError').text(' ');
        $('#titrevente').html('Effectuer une vente')
        $('#modal_vente').modal('show');

    });

    $('#save_vente').click(function(e) {
        e.preventDefault();

        var Form_Vente = $('#form_vente')[0];

        FormDatavente = new FormData(Form_Vente);

        $.ajax({
            data: FormDatavente,
            type: "POST",
            url: "createvente",
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                console.log(response);
                window.location.reload();

            },
            error: function(response) {
                console.log('Error:', response);
                $('#date_venteError').text(response.responseJSON.errors.date_vente);
                $('#puError').text(response.responseJSON.errors.pu);
                // $('#delaiError').text(response.responseJSON.errors.delai);
            }

        });



    });

    $('body').on('click', '#modif_vente', function() {
        // alert('ok')

        var vente_id = $(this).data('id');
        var vente_tva = $(this).data('tva');
        var vente_bien = $(this).data('bien');
        var vente_pu = $(this).data('pu');
        var vente_remise = $(this).data('remise');
        var vente_commentaire = $(this).data('commentaire');
        var vente_date_vente = $(this).data('date_vente');
        $('#button_acheter').hide();
        $('#acheteur').hide();

        $('#titrevente').html('Modifier cette vente');
        $('#modal_vente').modal('show');

        $('#vente_id').val(vente_id);
        $('#bien_vente').val(vente_bien);
        $('#tva').val(vente_tva);
        $('#pu').val(vente_pu);
        $('#remise').val(vente_remise);
        $('#commentaire').val(vente_commentaire);
        $('#date_vente').val(vente_date_vente);



    });

    $('#add_acheteur').click(function() {
        $.ajax({
            url: "ajout_acheteur",
            // type: 'GET',
            // dataType: 'json',
            success: function(data) {
                // var len = 0;
                console.log(data)
                $('#acheteur').append(data);

            },
            error: function(data) {
                    alert('Error:', data);

                }
                // $('#acheteur').append(ach);






        });
    });




    function addrow() {
        var ach = '<div class="row"><strong>Acheteur <b style="color: red;">*</b></strong><select name="acheteur[]" id="acheteur" class="form-control col-md-6"> <option value="">Acheteur</option>  @foreach($biens as $bien)<option value="{{$bien->id}}">{{ $bien->id}} </option> @endforeach </select> &nbsp;&nbsp; &nbsp; <a href="javascript:void(0)" id="supprimer_acheteur" style="font-size:20px;"class="col-md-2 btn btn-danger"> <i class="fas fa-times" > </i></a> </div> <br> ';
        $('#acheteur').append(ach);
    };

    $('body').on('click', '#supprimer_acheteur', function() {
        $(this).closest(".row").remove();
        // alert('ok');

    });




    // *************gestion des detail de vente***************

    $('#creer_acheteur').click(function() {
        $('#acheter_id').val('');
        $('#form_vente_detail').trigger("reset");
        //$('#date_venteError').text(' ');
        // $('#puError').text(' ');
        $('#titrevente_detail').html('Ajouter acheteur')
        $('#modal_vente_detail').modal('show');

    });


    $('#save_ventedetail').click(function() {
        alert('ajouter avec succès !')
    });
    $('#save_vente_modifdetail').click(function() {
        alert('modifier avec succès !')
    });




    $('body').on('click', '#modif_vente_detail', function() {
        var vente_id = $(this).data('vente_id');
        var acheteur_id = $(this).data('id');
        var locataire_id = $(this).data('locataire_id');

        // $('#titredetail').html('Modifier cet detail');
        $('#modal_modif_detail').modal('show');

        $('#vente_idm').val(vente_id);
        $('#acheter_idm').val(acheteur_id);
        $('#acheteurm').val(locataire_id);

    });



    $('body').on('click', '#reglement_vente', function() {
        // alert('o')

        $('#modalAfficherReglementVente').modal('show');
        $('#titreModalReglementVente').html($(this).data('ref_vente'));
        $('#facture_montant_vente').html($(this).data('montant_vente'));
        $('#vente_id_reglement').val($(this).data('vente_id'));

        var vente_id = $(this).data('vente_id')
        $.ajax({
            data: 'vente_id=' + vente_id,
            url: "ventereglementaffiche",
            type: "POST",
            //contentType: false,
            //processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                $('#div_reglementvente').html(data);


            },
            error: function(data) {
                alert('Error:', data);

            }
        });



    });




    $('#effectuer_reglement').click(function(e) {
        e.preventDefault();
        //alert('ok');

        if (confirm('Voulez-vous effectuer le paiement ? ')) {

            var dataForm = $("#formReglementVente")[0];
            var formData = new FormData(dataForm);

            $.ajax({
                data: formData,
                url: "reglementventeajouter",
                type: "POST",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data == 'pas possible') {
                        alert('Le montant saisi depasse le montant restant!');
                        $('#formReglementVente').trigger("reset");
                        //$('#div_reglementvente').html(data);

                    } else {
                        alert('Opération effectuée avec succès');
                        $('#formReglementVente').trigger("reset");
                        $('#div_reglementvente').html(data);

                    }





                },
                error: function(data) {
                    alert('Error:', data);

                }
            });
        }


    });


    $('body').on('click', '#supprimerReglementvente', function() {

        var reglement_id = $(this).data('reglementvente_id');

        if (confirm('Voulez-vous supprimer règlement? ')) {

            $.ajax({
                data: { id: reglement_id },
                url: "reglementventedelete",
                type: "POST",
                // contentType: false,
                // processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {

                    alert('Suppression effectuée!');
                    $('#div_reglementvente').html(data);


                },
                error: function(data) {
                    alert('Error:', data);

                }
            });
        }

    });




    //******** ajout de plusierus besoin  *********** */

    $('#add_besoin').click(function() {
        $.ajax({
            url: "ajout_besoin",
            // type: 'GET',
            // dataType: 'json',
            success: function(data) {
                // var len = 0;
                console.log(data)
                $('#besoin').append(data);

            },
            error: function(data) {
                alert('Error:', data);

            }
        });
    });

    $('body').on('click', '#supprimer_besoin', function() {
        $(this).closest(".besoin_remove").remove();
        // alert('ok');

    });


});