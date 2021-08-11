<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div>
            <h2 style="text-align: center;">Liste des ventes effectuées</h2>
        </div>

        <br>

        <div>
            <table width="90%"   style="margin:auto">
                <thead>
                <tr>

                        <th>Référencee</th>
                        <th>Acheteur(s)</th>
                        <th>Bien(s)</th>
                        <th>Prix Unitaire</th>

                        <th>Montant Total</th>
                        <th>Payé</th>
                        <th>Reste à payer</th>
                        <th>Statut</th>
                        <th>Date</th>
                </thead>
                <tbody>
                @foreach($ventes as $vente)
                    <tr>
                        <td>{{$vente->reference}}</td>
                        <td>
                        @foreach($acheters as $acheter)
    @if($vente->id == $acheter->vente_id)
        {!! $acheter->locataire->nom.' '.$acheter->locataire->prenom !!}<br>
    @endif

@endforeach
                        </td>
                        <td>{{$vente->bien->libelle}}</td>
                        <td>{{$vente->prix_unitaire}}</td>
                        <td>{{$vente->montant_total}}</td>
                        <td>{{$vente->payer}}</td>
                        <td>{{$vente->reste_payer}}</td>
                        <?php if ($vente->statut == 'soldé') {     ?>
                     <td class="text-success">{{$vente->statut}}</td>
                     <?php  } else { ?>
                        <td class="text-warning">{{$vente->statut}}</td>
                        <?php
                    } ?>

                        <td>{{date('d-m-Y', strtotime($vente->date_vente))}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

    </body>
</html>
