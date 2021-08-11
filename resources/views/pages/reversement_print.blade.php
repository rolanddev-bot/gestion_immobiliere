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
            text-align: center;
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
      <script type="application/javascript"> window.print();</script>

        <div class="container">
            <img  style="width: 200px; height:200px" src="{{ url('assets/img/entete_logo.png') }}" alt="">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img  style="width: 200px; height:200px"  src="{{ url('assets/img/ente_enical_group.PNG') }}" alt="">
        </div>
        <p style="">Abidjan, le {{ date('d/m/Y',strtotime($rever->date_revers ))}} </p> <br>
        <p>
             <b>@foreach($props as $prop) {{ $prop->proprietaire->sexe.' '.$prop->proprietaire->nom.' '.$prop->proprietaire->prenom }} @endforeach</b><br>
             <b>PROPRIETAIRE DU BIEN :{{ $mandat->bien->libelle }}</b><br>
             <b>{{ $mandat->bien->adresse }}</b><br>
        </p>
        <h5 style="text-decoration: underline;"> ABIDJAN – COTE D’IVOIRE</h5>
        <h4 style="text-decoration: underline;"> Reversement loyer(s)</h4>

        <p>
             <b>Numéro : {{ $rever->ref }} </b><br>
             <b>Période : </b><br>
        </p>

        <table style="width:100%;">
            <tr>
                <th width="" height="">DESIGNATION</th>
                <th >QTE</th>
                <th >PU (F CFA)</th>
                <th >MONTANT (F CFA)</th>
            </tr>
            <tr>
                <td width="" height="">Loyers encaissés</td>
                <td>{{ $nbre_rever }}</td>
                 @if($nbre_rever==1)
                 <td>  @foreach($mont_rever as $mont_res) {{ $mont_res->montant }}   @endforeach </td>
                 @else
                 <td>  @foreach($mont_rever as $mont_res) {{ $mont_res->montant }} ;  @endforeach </td>
                 @endif
                <td>{{ $somm_rever }}</td>
            </tr>
            <tr>
                <td width="" height="">Honoraire </td>
                <td>10%</td>
                <td>{{ $somm_rever }}</td>
                <td>{{ ($somm_rever*10)/100 }}  </td>
            </tr>
            <tr>
                <td width="" height="">TVA sur honoraires </td>
                <td>18%</td>
                <td>{{ ($somm_rever*10)/100 }} </td>
                <td> {{ ((($somm_rever*10)/100)*18)/100 }} </td>
            </tr>

            <tr>
                <td style="text-align: center;" colspan="3">TOTAL NET A REVERSER* </td>

                <td>{{ $somm_rever - (($somm_rever*10)/100) - (((($somm_rever*10)/100)*18)/100)  }}</td>
            </tr>
        </table> <br>

        <p> <b>A reverser à @foreach($props as $prop) {{ $prop->proprietaire->sexe.' '.$prop->proprietaire->nom.' '.$prop->proprietaire->prenom }} @endforeach
              la somme nette de trois cent dix-sept mille cinq cent vingt francs CFA.</b></p>

        <b style="color:brown">*Nous rappelons que @foreach($props as $prop) {{ $prop->proprietaire->sexe.' '.$prop->proprietaire->nom.' '.$prop->proprietaire->prenom }} @endforeach
          doit reverser à l’administration fiscale 12% des sommes facturées au locataire au titre de l’impôt foncier. Le non reversement
          par elle de cet impôt ne peut en aucun cas être imputable à SINI PROPERTY.</b> <br> <br>


            <table style="width:100%;" border="">
                <td > Visa <br>Comptabilité</td>
                <td>Visa <br>Propriétaire</td>

            </table><br> <br>

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
