$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var tablemandat = $('#mandatdatatable').dataTable({
        "language": {
            "url": "{{route('/assets/French.json')}}"
        },
        pageLength: 5,
        lengthMenu: [
            [10, 20, 30, -1],
            [10, 20, 30, 'Tous']
        ]

    });

    //  $('.select2prop').select2()

    $('#creermandat').click(function() {
        // alert('ok')
        $('#mandat_id').val('');
        $('#form_mandat').trigger("reset");
        $('#titremandat').html('Créer un mandat ')
        $('#modal_mandat').modal('show');
    });


    $('#savemandat').click(function(e) {
        e.preventDefault();
        var form_mandat = $('#form_mandat')[0];
        FormMandat = new FormData(form_mandat);
        // alert('ok')

        $.ajax({
            data: FormMandat,
            url: 'createmandat',
            type: 'POST',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                window.location.reload();

            },
            error: function(data) {
                // alert('Error:', data);
                console.log(data);




            }

        });
    });

    $('body').on('click', '#modif_mandat', function() {
        //  alert('ok')

        var mandat_id = $(this).data('id');
        var mandat_ref = $(this).data('ref');
        var mandat_bien_id = $(this).data('bien_id');
        var mandat_proprietaire_id = $(this).data('proprietaire_id');
        var mandat_duree = $(this).data('duree');
        var mandat_frequence = $(this).data('frequence');
        var mandat_honnoraire = $(this).data('honnoraire');
        var mandat_commission = $(this).data('commission');
        var mandat_prise_effet = $(this).data('prise_effet');
        var mandat_date_enregistrement = $(this).data('date_enregistrement');
        var mandat_renouvellement = $(this).data('renouvellement');
        var mandat_type_mandat = $(this).data('type_mandat');



        // console.log(bien_id);
        $('#titremandat').html('Modifier ce mandat');
        $('#modal_mandat').modal('show');

        $('#mandat_id').val(mandat_id);
        $('#bien_id').val(mandat_bien_id);
        $('#proprietaire_id').val(mandat_proprietaire_id);
        $('#commission').val(mandat_commission);
        $('#honnoraire').val(mandat_honnoraire);
        $('#duree').val(mandat_duree);
        $('#frequence').val(mandat_frequence);
        $('#date_prise_effet').val(mandat_prise_effet);
        $('#date_enregistrement').val(mandat_date_enregistrement);
        $('#renouvellement').val(mandat_renouvellement);
        $('#type_mandat').val(mandat_type_mandat);

    });



 /*
 $('body').on('click', '#archive_mandat', function() {
        var mandat_id = $(this).data('id');
        var archiver = $(this).data('archiver');
        var archiver_info = '';

        if (archiver == 0) archiver_info = 'archiver?';
        else archiver_info = 'désarchiver?';

        if (confirm('Voulez-vous ' + archiver_info)) {
            $.ajax({
                data: { id: mandat_id, archiver: archiver },
                url: "archivemandat",
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