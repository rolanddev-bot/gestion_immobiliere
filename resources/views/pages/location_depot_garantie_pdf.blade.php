<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <style>
         .container{
            text-align: center;
             }
        .container1{
            text-align: center;
        }
        table, th, td {
          border: 1px solid black;
           border-collapse: collapse;
          }
          th{
           padding: 5px;
              text-align: center;
          }
          td {
           padding: 5px;
              text-align: left;
          }

        </style>
    </head>
    <body>
        <div class="container">
            <img  style="width: 200px; height:200px" src="{{ public_path('assets/img/entete_logo.png') }}" alt="">
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img  style="width: 200px; height:200px"  src="{{ public_path('assets/img/ente_enical_group.PNG') }}" alt="">
        </div>
        <h2 style="text-align: center;">DEPÔT DE GARANTIE</h2>
        <h4 style="text-align: center;">N° : {{$locations->ref_depot_garantie}}</h4> <br> <br>

        <table width="100%">
            <tr>
                <th width="50%" height="35">BAILLEUR</th>
                <th >LOCATAIRE</th>
            </tr>
            <tr>
                <td width="25%" height="35">SINI PROPERTY <br>
                                     28 BP 1454 ABIDJAN 28
                </td>
                <td>{{$adresse}}</td>
            </tr>
        </table> <br> <br>

        <table width="100%">
            <tr>
                <td width="50%" height="30%">
                Reçu de :{{$locations->locataire->sexe}}  {{$locations->locataire->nom.' '.$locations->locataire->prenom}}<br> <br>
                la somme de : {{$locations->caution}} F CFA  francs CFA <br> <br>
                le : {{date('d-m-y', strtotime($locations->date_location))}} <br> <br>
                pour dépôt de garantie des locaux décrits dans le contrat n° {{$locations->ref}} <br> <br> <br>
                Fait à Abidjan le {{date('d-m-y', strtotime($locations->date_location))}} <br> <br>
                Signature du bailleur

                </td>
                <td>

                    Détail  <br>
                    - {{ $locations->nbre_depot}} mois de loyers <br> <br><br>
                   <b>- Solde à payer : {{$locations->caution}} F CFA</b>

                </td>
            </tr>
        </table> <br><br><br><br>

        <p style="font-size: 9px;">
            <b>SINI PROPERTY SAS au Capital de 30 Millions de Francs CFA</b> <br>
            RCCM N° CI-ABJ-2020-M-06112 – CC N° CC N° 1538214 U <br>
            Agrément Agent immobilier numéro 025 /MHLS/DGLCV/DL/SDH/KFT	 <br>
            Cocody 2 Plateaux 8ème Tranche Rue L 130 – 28 BP 1454 Abidjan 28 <br>
            tél : +225 22 50 38 02 71 63 – Fax : +225 22 50 38 03 <br>
            info@siniproperty.com – www.siniproperty.com

        </p>

    </body>
</html>
