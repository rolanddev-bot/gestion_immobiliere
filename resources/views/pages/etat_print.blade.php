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

        </style>

    </head>
    <body>
        <div class="container">
            <img  style="width: 300px; height:300px"  src="{{ public_path('assets/img/logo_sini.png') }}" alt="">
        </div>
        <div class="container">
           <img  style="width: 200px; height:200px;"  src="{{ public_path('assets/img/agent_agree.jpg') }}" alt="">
        </div>
        <div class="container">
           <img  style="width: 600px; height:300px;"  src="{{ public_path('assets/img/img_contrat_H.png') }}" alt="">
        </div>
        <div class="container1">
        <p style="text-align: center;"> <h2>ETAT DES LIEUX @if($etat->entre_sortie == 'Entrée') Entrée @else Sortie @endif</h2> </p>
        <p style="text-align: center;"> <h3>LOCATAIRE : {{$etat->location->locataire->nom.' '.$etat->location->locataire->prenom}}</h3> </p>
        <p style="text-align: center;"> <h4>RÉFÉRENCE : N° {{$etat->ref}}</h4> </p>
    </div><br> 

    <div>
        <br><br>
        <h5 style="text-decoration: underline; text-align:center">SOMMAIRE</h5> <br>

       
    </div> 

    <div>
   
		
    <h5 style="text-decoration:underline;">VERIFICATION ELEMENT</h5>
  
		
    
    <h5 style="text-decoration: underline;">AVIS </h5>
  


    <p>Pour le BAILLEUR            Pour le PRENEUR</p>
    </div>
    </body>
</html>
