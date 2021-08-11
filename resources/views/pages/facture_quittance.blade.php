<div class="container">
<h2 align="center" class="" ><u>QUITTANCE N°{{ $facture->ref}}</u></h2>


<br>
<p>Période: <span id="p_periode">{{ date('d-m-Y', strtotime($facture->date_debut)).'/'.date('d-m-Y', strtotime($facture->date_fin))}}</span></p>

<table width="100%"><tr>
    <td width="50%">
    <p><u>Client</u></p>
        <p>A<br>  <span id="p_bien_libelle">
            {{ $facture->location->locataire->nom.' '.$facture->location->locataire->prenom}}
        </span></p>

    </td>
    <td>
    <p><u>N° facture</u>: <span id="p_location_ref"></span></p>
        <p><u>Date </u>: <span id="">{{ date('d-m-Y') }}</span></p>
        <p><u>Nature prestation</u>: <span id="p_nature">{{ $facture->nature}}</span></p>
        
    </td>
</tr></table>
        
    
<div class="row">
<table width="90%" border="1"  style="margin:auto">
    <tr><td>DESIGNATION</td><td>PU</td><td>QTE(FCFA)</td><td>MONTANT (FCFA)</td></tr>
    <tr><td> {{ $facture->nature}}</td><td align="right">{{ $facture->montant}}</td><td>1</td><td align="right">{{ $facture->montant}}</td></tr>
    <tr><td colspan="3">MONTANT TOTAL </td><td align="right">{{ $facture->montant}}</td></tr>
</table>

<br><br>

<ul style="list-style-type: none;">
    <li>Date facturation: <span id="p_date_facture">{{ $facture->date_facture}}</span></li>
    
</ul>
</div>
<br><br>
<p align="center">
<u>La Comptabilité</u> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
&nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
<u>Visa client</u>
</p>

</div>