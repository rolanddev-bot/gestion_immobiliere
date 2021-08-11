<div class="container">
<h2 align="center" class="" ><u>FACTURE</u></h2>

<h2>N°: <span id="p_facture_ref"></span></h2>

<p>Période: <span id="p_periode"></span></p>

<table width="100%">
    <tr>
        <td width="50%">

        <p><u>Client</u></p>
        <p>A<br> MONSIEUR <span id="p_locataire_nom"></span> <br/></b>ACQUEREUR <span id="p_bien_libelle">
            {{$acheter->locataire->nom.' '.$acheter->locataire->prenom}}
        </span></p>

        </td>
        <td>

        <p><u>N° facture</u>: <span id="p_location_ref"> {{$vente->reference}}</span></p>
        <p><u>Date </u>: <span id="">{{ date('d-m-Y') }}</span></p>
        <p><u>Nature prestation</u>: <span id="p_nature">Vente</span></p>
        <p><u>Montant</u>: <span id="p_montant">{{$vente->montant_total}}</span></p>
        </td>

    </tr>

</table>




<div class="row">
<table width="90%" border="1"  style="margin:auto">
    <tr><td>DESIGNATION</td><td>PU</td><td>QTE(FCFA)</td><td>MONTANT (FCFA)</td></tr>
    <tr><td>{{$vente->bien->libelle}}</td><td align="right">{{$vente->montant_total}}</td><td>1</td><td align="right">{{$vente->montant_total}}</td></tr>
    <tr><td colspan="3" align="right">MONTANT TOTAL HT </td><td>{{$vente->montant_total}}</td></tr>
</table>

<br><br>

<ul style="list-style-type: none;">
    <li>Date facturation: <span id="p_date_facture"></span></li>
    <li>Date limite: <span id="p_date_echeance"></span></li>
</ul>
</div>
<br><br>
<u>La Comptabilité</u> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    <u>Visa client</u>

</div>
