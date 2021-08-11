<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="{{url('/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div class="container">
<h2 align="center" class="" ><u>Reçu de paiement</u></h2>

<h2>N°: <span id=""></span></h2>

<p>Période: <span id=""></span></p>

    <div>


        <p>Client :LEGA Roland   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    Acheteur : {{$infosventes->locataire->nom}}</p>




            <p>Référence vente :{{$infosventes->vente->reference}} </p>
            <p><u>Date du jour </u>: <span id="">{{ date('d-m-Y') }}</span></p>
            <p style="text-align: center;"><u>Nature prestation</u>: Vente <span ></span></p>

    </div>



<div >
<table width="90%" border="1"  style="margin:auto">
   <thead>
    <tr>
        <th>Date vente</th>
        <th>bien</th>
        <th>montant vente</th>
        <th>montant règlement</th>

    </tr>
   </thead>
   <tbody>
       <tr>
           <td>{{$infosventes->vente->date_vente}}</td>
           <td>{{$infosventes->vente->bien->libelle}}</td>
           <td>{{$infosventes->vente->montant_total}}</td>
           <td>{{$reglements->montant_reglement}}</td>
       </tr>

   </tbody>

</table>

<br><br>

<ul style="list-style-type: none;">
    <li>Date règlement: {{$reglements->date_reglement}}</li>

</ul>
</div>
<br><br>

<div style="text-align: center;">
<p><u>La Comptabilité</u>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <u>Visa client</u> </p>

</div>

</div>
    </body>
</html>
