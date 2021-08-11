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
 
<script type="application/javascript"> window.print();</script>
    
        <div class="container">
            <img  style="width: 200px; height:200px" src="{{ url('assets/img/entete_logo.png') }}" alt="">
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img  style="width: 200px; height:200px"  src="{{ url('assets/img/ente_enical_group.PNG') }}" alt="">
        </div>
        <h2 style="text-align: center;">HONORAIRE DE GESTION</h2>
        <h4 style="text-align: center;">N° : {{ $hono->ref }}</h4> <br> <br>

        <table width="100%">
            <tr>
                <th width="50%" height="35">
                <h4>PROPRIETAIRE</h4>
      @foreach($appartenirs as $appart)
        	
        {!! $appart->proprietaire->nom.' '.$appart->proprietaire->prenom !!}
   
        @endforeach
                </th>
                
                
                <th >
                <p>Date : {{ date('d/m/Y', strtotime($hono->created_at)) }}</p>
Nature de la Prestation : Gestion de biens immobiliers
Document de référence : {{ $hono->reversement->mandat->ref}}
Affaire suivie par : {{ $hono->nom_agent }}
</th>
            </tr>
            <tr>
                <td width="25%" height="35"><h4>Identification des biens en gestion </h4>
                                     {{ $hono->reversement->mandat->bien->libelle }}
                </td>
                <td>
                    <h4>Conditions de règlement </h4>
<p>
Délai de Règlement : {{ date('d/m/Y', strtotime($hono->delai)) }}<br>
Mode de règlement : {{ $hono->mode }}
</p>
                </td>
            </tr>
        </table> <br> <br>

  
        <br>
        

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
