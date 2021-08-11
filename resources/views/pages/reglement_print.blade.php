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
       <script type="application/javascript">
		window.print();
		</script>
       
       
        <div class="container">
            <img  style="width: 200px; height:200px" src="{{ url('assets/img/entete_logo.png') }}" alt="">
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img  style="width: 200px; height:200px"  src="{{ url('assets/img/ente_enical_group.PNG') }}" alt="">
        </div>
        <h2 style="text-align: center;">REÇU DE LOYER</h2>
        <h4 style="text-align: center;">N° : {{ $reglement->ref }}</h4> <br> <br>

        <table width="100%">
            <tr>
                <th width="50%" height="35">BAILLEUR</th>
                <th >LOCATAIRE</th>
            </tr>
            <tr>
                <td width="25%" height="35">SINI PROPERTY <br>
                                     28 BP 1454 ABIDJAN 28
                </td>
                <td>
                    @if($reglement->facture->location->locataire->type_locataire_acq=='personne physique')
                    	{{ $reglement->facture->location->locataire->adresse }}
                    @else
                    	{{ $reglement->facture->location->locataire->adresse_societe }}
                    @endif
                </td>
            </tr>
        </table> <br> <br>

<table width="100%">
	<tr>
		<td width="50%" height="30%">
		Reçu de :<b> {{ $reglement->facture->location->locataire->sexe.' '.$reglement->facture->location->locataire->nom.' '.$reglement->facture->location->locataire->prenom }} </b> <br>
		la somme de : {{ strrev(wordwrap(strrev($reglement->facture->montant), 3, ' ', true)) }}  F CFA  francs CFA <br> <br>
		le :  {{ date('d/m/Y', strtotime($reglement->date_reglement)) }}  <br> <br>
		 pour loyer des locaux décrits dans le contrat° {{ $reglement->facture->location->ref }}  <br> <br>

		 en paiement du terme {{ $reglement->facture->nature }}<br> <br>
		 Fait à Abidjan le {{ date('d/m/Y', strtotime($reglement->date_reglement)) }}
		<br> <br>
		<u>Signature du bailleur</u>
<br> <br>
<br> <br>
		</td>
		<td>

                    Détail  <br>
                     - Loyer nu :  {{ strrev(wordwrap(strrev($reglement->facture->location->loyer), 3, ' ', true)) }}  F CFA  <br> 
                     - Charges / Provisions de Charges : {{  strrev(wordwrap(strrev($reglement->facture->location->charge), 3, ' ', true)) }} F CFA <br><br>
                     
                     <b>Montant versé :  {{ strrev(wordwrap(strrev($reglement->montant ), 3, ' ', true)) }}  F CFA</b>

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
