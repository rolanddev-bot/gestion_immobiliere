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
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img  style="width: 175px; height:175px" src="{{ public_path('assets/img/agent_agree1.jpg') }}" alt="">
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img  style="width: 200px; height:200px"  src="{{ public_path('assets/img/ente_enical_group.PNG') }}" alt="">
        </div>
        <h2 style="text-align: center;">AVIS D’ECHEANCE </h2>
        <h4 style="text-align: center;">N° : {{ $facture->ref }} </h4> <br>

        <table width="100%">
            <tr>
                <th width="50%" height="35">BAILLEUR</th>
                <th >LOCATAIRE</th>
            </tr>
            <tr>
                <td width="25%" height="35">SINI PROPERTY <br>
                                     28 BP 1454 ABIDJAN 28
                </td>
                <td>{{ $facture->location->locataire->nom.' '.$facture->location->locataire->prenom }} <br>
                {{ $facture->location->locataire->adresse }}
                </td>
            </tr>
        </table> <br>
        <h4 style="text-decoration: underline; text-align:center">LOYER {{ strtoupper($facture->nature )}}</h4>


        <table width="100%">
            <tr>
                <td width="50%" height="15%">
                loyer  <br> <br>
                Charges
                </td>
                <td>
                  {{ strrev(wordwrap(strrev($facture->location->loyer), 3, ' ', true)) }} F CFA <br> <br>
                  {{ strrev(wordwrap(strrev($mt_charge), 3, ' ', true)) }} F CFA

                </td>
            </tr>
            <tr>
            <td>Somme totale à régler </td>
            <td>{{ strrev(wordwrap(strrev($facture->location->loyer + $mt_charge), 3, ' ', true)) }} F CFA</td>
            </tr>
        </table> <br>

        <p> <b>Nous vous informons que vous êtes redevable du montant de la somme ci-dessus détaillée que nous
              vous invitons à payer au plus tard le 05 du mois en cours.
              Le nom paiement de cette somme à l’échéance indiquée vous expose au paiement de pénalités
              de retard de 10% en plus.
            </b></p>
            <b>Cet avis est une demande de paiement. Il ne peut en aucun cas servir de quittance de loyer.</b>


        <p><b>La comptabilité</b></p> <br>

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
