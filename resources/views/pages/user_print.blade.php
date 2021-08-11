

@include('incl_tete')

<br/><br/><br/>

<h3 class="h3_titre_principal" align="center"><u>FICHE UTILISATEUR </u></h3>


<br/><br/>

<table width="" style="width:90%; margin:auto" class="tab_align"><tr><td width="40%">


<p><u>Photo</u></p>

<img src="{{ url('images/user/'.$user->photo) }}" style="width:170px; height:190px" alt="Photo"/>

<br/><br/>
<p><u>Logo société</u></p>

<img src="{{ url('images/societe/'.$user->societe_logo) }}" style="width:200px; height:px" alt="Photo"/>









</td><td style="border-left:; padding:5px">

<p><u>Identité</u></p>

<p class="p_print" style="line-height:1.5">
Id : <span class="span_rep">{!! $user->id !!} </span><br/>
Nom : <span class="span_rep">{!! $user->nom !!} </span><br/>
Prénom(s) : <span class="span_rep">{!! $user->prenom !!} </span><br/>
Pseudo : <span class="span_rep">{!! $user->name !!} </span><br/>
Contact : <span class="span_rep">{!! $user->contact !!} </span><br/>
Email : <span class="span_rep">{!! $user->email !!} </span><br/>
Fonction : <span class="span_rep">{!! $user->poste !!} </span><br/>
Objectif : <span class="span_rep">{!! separer($user->objectif, 3).' FCFA' !!} </span><br/>

</p>


<p><u>Employeur</u></p>
<p class="p_print" style="line-height:1.5">
Employeur : <span class="span_rep">{!! $user->societe_nom !!} </span><br/>
Société capital : <span class="span_rep">{!! separer($user->societe_capital, 3).' FCFA' !!} </span><br/>
Société adresse : <span class="span_rep">{!! $user->societe_adresse !!} </span><br/>
Société N°RCC : <span class="span_rep">{!! $user->societe_rcc !!} </span><br/>
Société tél : <span class="span_rep">{!! $user->societe_telephone !!} </span><br/>
Raison sociale : <span class="span_rep">{!! $user->societe_raison !!} </span><br/>

</p>







</td></tr></table>




@include('incl_pied')

