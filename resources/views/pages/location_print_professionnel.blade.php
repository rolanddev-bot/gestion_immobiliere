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
            <img  style="width: 300px; height:300px"  src="{{ public_path('assets/img/logo_sini.png') }}" alt=""> <br>


        </div>

            <div class="container">
                <img  style="width: 200px; height:200px;"  src="{{ public_path('assets/img/agent_agree1.jpg') }}" alt="">
            </div>

        <div class="container">
           <img  style="width: 500px; height:200px;"  src="{{ public_path('assets/img/img_contrat_pro.jpg') }}" alt="">
        </div>
        <div class="container1">
        <p style="text-align: center;"> <h2>BAIL A USAGE PROFESSIONNEL</h2> </p>
        <p style="text-align: center;"> <h3>PRENEUR : {{$locationsper_morale->locataire->nom.' '.$locationsper_morale->locataire->prenom}}</h3> </p>
        <p style="text-align: center;"> <h4>RÉFÉRENCE : N° {{$locations->ref}}</h4> </p>
    </div><br> <br><br> <br> <br> <br> <br> <br>

    <div>
        <p><h5 style="text-decoration: underline; text-align:center">SOMMAIRE</h5></p>
<table width="100%">

<tr><td  width="80%">B A I L</td><td>.........4</td></tr>
<tr><td>DESIGNATION</td><td>..........4</td></tr>
<tr><td>ETAT DES LIEUX</td><td>..........4</td></tr>
<tr><td>ARTICLE 1 - DUREE DU BAIL</td><td>..........5</td></tr>
<tr><td>ARTICLE 2 – RENOUVELLEMENT DU BAIL</td><td>..........5</td></tr>
<tr><td>ARTICLE 4 – DISPENSE DU PAIEMENT DE L’INDEMNITE D’EVICTION</td><td>..........5</td></tr>
<tr><td>ARTICLE 5 – LOYER</td><td>..........6</td></tr>
<tr><td>ARTICLE  6 – REVISION DU LOYERR</td><td>..........6</td></tr>
<tr><td>ARTICLE 7 – DEPOT DE GARANTIE (ou CAUTION)</td><td>..........7</td></tr>
<tr><td>ARTICLE 8 – DESTINATION DES LIEUX</td><td>..........7</td></tr>
<tr><td>ARTICLE 9 – MOBILIER</td><td>..........8</td></tr>
<tr><td>ARTICLE 10 – CESSIONS DE BAIL OU SOUS-LOCATION</td><td>..........8</td></tr>
<tr><td>ARTICLE 11 – ENTRETIEN  REPARATIONS ET JOUISSANCE</td><td>...........9</td></tr>
<tr><td>ARTICLE 12 – DEGRADATIONS ET VOLSR</td><td>..........10</td></tr>
<tr><td>ARTICLE 13 – AMENAGEMENTS-TRANSFORMATIONS-CONSTRUCTIONS</td><td>..........10</td></tr>
<tr><td>ARTICLE 14 – TRANSMISSION DU BAIL ENTRE VIFS</td><td>..........10</td></tr>
<tr><td>ARTICLE 15 – DECES DU PRENEUR</td><td>..........10</td></tr>
<tr><td>ARTICLE 16 – MISE EN LIQUIDATION DU PRENEUR</td><td>..........11</td></tr>
<tr><td>ARTICLE 18 – IMPOTS-PATENTES-TAXES LOCATIVES</td><td>..........11</td></tr>
<tr><td>ARTICLE 19 – ASSURANCES</td><td>..........11</td></tr>
<tr><td>ARTICLE 20 – ENSEIGNES ET ETALAGES</td><td>..........11</td></tr>
<tr><td>ARTICLE 21 – CONTROLE ETAT D’ENTRETIEN ANNUEL</td><td>..........12</td></tr>
<tr><td>ARTICLE 22 – VISITE DES LIEUX</td><td>..........12</td></tr>
<tr><td>ARTICLE 23 – REMISE DES CLES</td><td>..........12</td></tr>
<tr><td>ARTICLE 24 – CLAUSE RESOLUTOIRE</td><td>..........12</td></tr>
<tr><td>ARTICLE 25 – MENTION - FRAIS</td><td>..........13</td></tr>
<tr><td>ARTICLE  26 – ENREGISTREMENT</td><td>..........13</td></tr>
<tr><td>ARTICLE  28 – MONNAIE ET LANGUE</td><td>..........13</td></tr>


</table>
    </div> <br> <br><br><br><br><br><br><br><br><br><br><br><br><br><br> <br>

    <div>
    <br><br> <br><br><br><br><br><br>
    <p style="text-decoration: underline;">Entre les soussignés</p>
        <p><b>{{ $agence->denomination }}</b>, {{$agence->forme}} au Capital de {{$agence->capital}}  millions de francs CFA
        dont le siège social est à {{ $agence->adresse }} , immatriculée au Registre de Commerce et du
             Crédit Mobilier sous le numéro {{ $agence->num_rccm }}, Agrément Agent Immobilier numéro
             {{ $agence->numero_agrement }},
            membre de la Chambre du Droit des Affaires et de l’Immobilier en abrégé « C.DA.IM. », représentée par {{ $agence->sexe_representant }}
            {{ $agence->representer_par }}, {{ $agence->poste_representant }} ;   </p>
        <p>Ci-après dénommée <b> le BAILLEUR ou l’AGENCE,</b></p>
        <p>D’UNE PART</p>

        <p>{{$locationsper_morale->locataire->nom_societe}}, {{$locationsper_morale->locataire->regime_societe}}
         au capital de {{$locationsper_morale->locataire->capital_societe}} Francs CFA
             dont le siège social est à {{$locationsper_morale->locataire->adresse_societe}} ,
              représentée par {{$locationsper_morale->locataire->nom_representant}}</p>

         <p>Ci-après dénommée <b> le PRENEUR</b>,</p>
         <p>D’AUTRE PART</p>
         <p>Individuellement et solidairement dénommées respectivement « La Partie » et « Les Parties ».</p>

         <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

         <h5 style="text-decoration: underline; text-align:center">B A I L</h5>
         <p>Le BAILLEUR donne à bail à loyer à <b> USAGE PROFESSIONNEL</b>, régi par les dispositions des articles 101 à
             134 du Traité de l’OHADA portant sur le Droit Commercial Général, pour la durée, sous les conditions
              et moyennant le prix ci-après indiqué ;</p>

        <p>Au PRENEUR qui accepte, les biens et droits immobiliers dont la désignation suit : </p>

        <h5 style="text-align: center; text-decoration:underline">DESIGNATION</h5>

              <!--  les informations du prenneur    -->
            <p>Le bien loué est situés à {{$locationsper_morale->bien->adresse}} et comprend:
            </p>
            <p>
              @foreach($equipers  as $eqp)
                  <u> {{ $eqp->description->libelle }}</u> :<br>
                    @foreach($elements as $elts)
                       @if($elts->equiper_descript->id == $eqp->id)
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   {!! '- '.$elts->libelle !!}; <br>
                        @endif
                      @endforeach <br>
               @endforeach
              </p>



     <h5 style="text-decoration: underline; text-align:center;"> ETAT DES LIEUX </h5>
     <p>Le PRENEUR prendra les lieux loués dans l’état où ils se trouveront lors de l’entrée en jouissance et les
          rendra en fin de bail tels qu’il les aura reçus suivant l’état des lieux qui aura été dressé à la date du
          …………………….………………. contradictoirement entre les parties .
    </p>
    <p>Le PRENEUR disposera d’un délai de huit (8) jours à compter de la date de l’état des lieux pour faire parvenir
       par lettre remise contre décharge, ses observations ou réserves éventuelles sur ledit état des lieux.
    </p>
     <p>Passé ce délai, plus aucune réclamation ne sera recevable et les lieux seront considérés comme ayant été loués
        en parfait état de réparations de toute espèce.
    </p>
     <p>Le PRENEUR veillera à la remise des lieux dans leur état primitif  (agencement, enduit peinture intérieure, etc.).
      A l’expiration du bail, un pré-état des lieux sera dressé un mois au moins avant l’expiration du bail
    .</p>
    </div>

    <div>
        <h4 style="text-align: center;">TITRE I - CLAUSES ET CONDITIONS PARTICULIERES </h4>
        <h5 style="text-decoration: underline; text-align:center;">Article 1: DUREE DU BAIL </h5>
   <p>Le présent bail est consenti et accepté pour une durée de {{'0'.$locationsper_morale->duree}} , qui court à compter du  {{date('d-m-Y', strtotime($locationsper_morale->date_echeance))}}

    </p>
    <h5 style="text-decoration: underline; text-align:center;">Article 2 : RENOUVELLEMENT DU BAIL</h5>
    <p>En vertu l’article 123 du traité OHADA portant Droit Commercial Général, le droit au  renouvellement du bail
         est acquis au PRENEUR qui justifie avoir exploité, conformément aux stipulations du bail, l'activité prévue
          pendant une durée minimale de deux ans.</p>
    <p>Le PRENEUR qui a droit au renouvellement de son bail en vertu de l’article 123 susvisé, doit, sous peine de
        déchéance, en demander le renouvellement par acte d’huissier de justice ou par lettre contre décharge, au
        plus tard trois (3) mois avant l’expiration du bail. Conformément à l’article 124 alinéa 3 du même texte,
        le BAILLEUR devra, au plus tard un (1) mois avant l’expiration du bail, faire connaître sa réponse à la
         demande de renouvellement. A défaut, il sera réputé avoir accepté le renouvellement du bail.</p>

     <b>Aucune stipulation du contrat et autre ne peuvent faire échec au droit au renouvellement en
     vertu de l’article 123 alinéa 2.</b> <br>

    <p>En cas de renouvellement exprès ou tacite, le bail est conclu pour une durée minimale de
    trois (3) ans en vertu de l’ article 123 alinéa 3.</p>

        <h5 style="text-decoration: underline; text-align:center">ARTICLE 3 – INDEMNITE D’EVICTION </h5>

        <p>En vertu de l’article 126 dudit traité, le BAILLEUR peut s’opposer au droit au renouvellement du
            bail en réglant au PRENEUR une indemnité d’éviction.
        </p>

        <p>A défaut d'accord sur le montant de cette indemnité, celle-ci est fixée par la juridiction compétente
         en tenant compte notamment du montant du chiffre d'affaires, des investissements réalisés par le PRENEUR,
        de la situation géographique du local et des frais de déménagement imposés par le défaut de renouvellement.
        </p>

        <h5 style="text-decoration: underline;"> ARTICLE 4 – DISPENSE DU PAIEMENT DE L’INDEMNITE D’EVICTION </h5>

     <p>Le BAILLEUR peut s'opposer au droit au renouvellement du bail sans avoir à régler l'indemnité d'éviction,
     dans les cas suivants :
    </p>

     <p>
     1°) s'il justifie d'un motif grave et légitime à l'encontre du PRENEUR sortant. Ce motif doit consister soit
      dans l'inexécution par le locataire d'une obligation substantielle du bail, soit encore dans la cessation de
       l'exploitation de l’activité ;
     </p>
     <p>
     Ce motif ne peut être invoqué que si les faits se sont poursuivis ou renouvelés plus de deux mois après une
      mise en demeure du BAILLEUR, par signification d'huissier de justice ou notification par tout moyen permettant
      d'établir la réception effective par le destinataire, d'avoir à les faire cesser.
     </p>
     <p>
     2°) s'il envisage de démolir l'immeuble comprenant les lieux loués, et de le reconstruire. Le BAILLEUR doit dans
      ce cas justifier de la nature et de la description des travaux projetés. Le  PRENEUR a le droit de rester dans
    les lieux jusqu'au commencement des travaux de démolition, et il bénéficie d'un droit de priorité pour se voir
     attribuer un nouveau bail dans l'immeuble reconstruit. Si les locaux reconstruits ont une destination différente
     de celle des locaux objet du bail, ou s'il n'est pas offert au PRENEUR un bail dans les nouveaux locaux, le BAILLEUR
     doit verser au PRENEUR l'indemnité d'éviction prévue à l'article 3 ci-dessus.
     </p>

    <h5 style="text-decoration:underline; text-align:center">ARTICLE 5 – LOYER </h5>

    <p>Le présent bail est consenti et accepté moyennant un loyer mensuel de {{ $locationsper_morale->loyer + $montant_charge}} FRANCS CFA payable
       de façon {{ $locationsper_morale->periodicite_loyer}} et d’avance au plus tard le 05 du mois en cours (ou le 5 du 1er mois de la periodicité),
       {{ $locationsper_morale->mode_paiement}} à l’AGENCE. En cas de chèque impayé, le PRENEUR sera tenu de payer 10 000 F CFA pour
       les frais de recouvrement dudit chèque.
    </p>
    <p>
    Le loyer est portable et non quérable payé contre une quittance numérotée délivrée immédiatement par l’AGENCE.
    </p>
    <p>
    Passé le 15 du mois, le PRENEUR sera assujetti à des pénalités pour  retard de paiement fixé à  10% du montant des
    loyers impayés.
    </p>

    <h5 style="text-decoration:underline; text-align:center;">ARTICLE  6 – REVISION DU LOYER </h5>

    <p>Les parties conviennent que le loyer pourra être révisé tous les deux {{ $locationsper_morale->revision_annuelle_loyer}} ans. A défaut d’accord entre les
     parties, le nouveau montant du loyer prendra en compte le taux de référence des loyers fixé annuellement
     par le Chambre du Droit des Affaires et de l’Immobilier (C.DA.IM) dont la décision tiendra compte des éléments suivants :
    </p>
    <p>
   &nbsp;&nbsp; 1.	La situation des locaux ; <br>
   &nbsp;&nbsp;2.	Leur superficie ;<br>
   &nbsp;&nbsp;3.	L’état de vétusté ;<br>
   &nbsp;&nbsp; 4.	Le  prix des loyers commerciaux couramment pratiqués dans le voisinage pour des locaux similaires.
    </p>
    <p>
    Si la sentence arbitrale ne satisfait pas l’une des parties, elle pourra toujours saisir le tribunal compétent pour
     connaître de cette affaire.
    </p>
    <h5 style="text-decoration:underline; text-align:center;">ARTICLE 7 – DEPOT DE GARANTIE (ou CAUTION) </h5>
    <p>
    A titre de provision et pour la garantie de l’exécution des clauses du présent contrat, le PRENEUR a versé
    entre les mains du BAILLEUR, la somme de {{ $locationsper_morale->caution}} FRANCS CFA représentant {{'0'.$locationsper_morale->nbre_depot}}
    mois de loyer en guise de dépôt de garantie (ou caution). <br>
    Laquelle somme sera conservée par le BAILLEUR  pour le compte du PRENEUR durant toute la durée du bail.
     Elle est non productive d’intérêts et ne pourra pas servir au paiement du loyer en fin de bail.
    </p>
    <p>
    A l’expiration dudit bail, elle sera restituée au PRENEUR après paiement de tous les loyers dus par lui et
    exécution de toutes les réparations lui incombant, ainsi que des résiliations des abonnements CIE et SODECI.
    </p>
    <h5 style="text-decoration:underline; text-align:center;">ARTICLE 8 – DESTINATION DES LIEUX</h5>
    <p>
    Les lieux loués devront servir au PRENEUR à un usage professionnel pour exercer à titre principale,
    l’activité de <b>{{ $locationsper_morale->locataire->secteur_societe}}</b>  et de toutes activités accessoires et annexes à l’activité principale à l’exclusion
     de tout autre, même temporairement.
    </p>
    <p>
    En cas de changement de l’activité prévue au contrat, le PRENEUR doit obtenir l’accord préalable et exprès du
     BAILLEUR qui peut s’y opposer pour des motifs sérieux.
    </p>
    <p>
    Le <b> PRENEUR</b> ne pourra, sous aucun prétexte, changer la destination des lieux loués, sauf à obtenir l’autorisation
     du <b>BAILLEUR</b>  à ce changement de destination.
    </p>
    <p>
    En particulier, il ne pourra affecter tout ou partie desdits locaux à l’usage d’habitation, que ce soit pour lui-même ou
    pour toute autre personne, même par simple prêt, à titre temporaire.
    </p>
    <p>
    Le PRENEUR fera son affaire personnelle de toutes les conséquences pouvant résulter de l’activité professionnelle
     exercée en ces lieux : obtention d’autorisations administratives, paiement des taxes et redevances, etc.
     Il devra l’assurer en conformité rigoureuse avec les prescriptions légales et administratives pouvant s’y
    rapporter. Il devra exécuter à ses frais tous travaux qui pourraient être demandés ou imposés par tel service
    ou administration concernée.
    </p>
    <p>
    En ce qui concerne les travaux d’aménagement imposés par l’exercice de son activité, le PRENEUR en fera également
     son affaire personnelle mais ne pourra procéder à aucune démolition de murs, de sols ou de cloisons, ni aucune
     modification aux ouvertures existantes sans l’autorisation expresse et par écrit du BAILLEUR.
    </p>
    <p>
    Le BAILLEUR ne garantit aucune exclusivité ou non-concurrence sur d’autres locaux dépendant de l’immeuble dans lequel
    se trouvent les locaux, objets du présent bail.
    </p> <br> <br><br> <br><br> <br><br> <br><br>
   <h4 style="text-align: center;">TITRE II - CHARGES ET CONDITIONS GENERALES</h4>
   <p>
   Le présent bail est consenti et accepté sous les charges et conditions ordinaires et de droit en pareille matière que
   le PRENEUR, s’oblige à exécuter et accomplir sous peine de tous dommages-intérêts et même de résiliation immédiate et
   de plein droit du présent bail si bon semblait au BAILLEUR, savoir :
   </p>
   <h5 style="text-align: center; text-decoration:underline">ARTICLE 9 – MOBILIER </h5>
   <p>
   Les lieux sont loués nus et le PRENEUR s’engage à garnir et tenir constamment garni les
    lieux loués de meubles, marchandises et objets mobiliers de valeur et quantité suffisante
     pour garantir le BAILLEUR du paiement des loyers et de l’exécution de toutes les conditions du bail.
   </p>
   <h5 style="text-align: center; text-decoration:underline">ARTICLE 10 – CESSIONS DE BAIL OU SOUS-LOCATION  </h5>
    <p>
    Toute cession ou sous-location du bail doit être constatée par acte notarié ou sous seing privé, et signifiée au
    BAILLEUR par acte extrajudiciaire ou tout autre moyen écrit contenant les mentions prévues à l’article 118 de
    l’Acte Uniforme portant sur le Droit Commercial Général.
   </p>
   <p>
    A défaut de signification, dans les conditions ci-dessus, la cession ou la sous-location sera inopposable au BAILLEUR.
   </p>
   <p>
   Le <b> BAILLEUR</b> dispose d’un délai d’un (1) mois à compter de cette signification, pour s’opposer, le cas échéant
   à celle-ci et saisir à bref délai la juridiction compétente, en justifiant les motifs sérieux et légitimes qui
    pourraient s’opposer à cette cession.
   </p>
   <p>
   La violation par le <b> PRENEUR</b> des obligations du bail et notamment le non-paiement du loyer constitue un motif
   sérieux et légitime de s’opposer à la cession.
   </p>
   <p>
   Pendant toute la durée de la procédure, le cédant demeure tenu aux obligations du bail.
   </p>
   <p>
   En cas de sous-location préalablement autorisée, l’acte doit être porté à la connaissance du <b> BAILLEUR</b> par tout moyen écrit.
    A défaut, la sous-location lui est inopposable.
   </p>
   <p>
   Lorsque le loyer de la sous-location totale ou partielle est supérieur au prix du bail principal, le <b> BAILLEUR</b>
   a la faculté d’exiger une augmentation correspondante du prix du bail principal, augmentation qui à défaut
   d’accord entre les parties, est fixée soit par commission d’arbitrage de la C.DA.IM, soit par la juridiction
   compétente, en tenant compte des éléments visés à l’article 117 de l’Acte Uniforme portant Droit Commercial
   Général,  rappelés à  « l’article 6 – REVISION DU BAIL » qui précède.
   </p>

   <h5 style="text-align: center; text-decoration:underline;">ARTICLE 11 – ENTRETIEN  REPARATIONS ET JOUISSANCE </h5>
   <p style="text-align: center;text-decoration:underline;">A. Droits et obligations du PRENEUR</p>
   <p>
   Le PRENEUR entretiendra les lieux loués en bon état de réparation locative, en jouira en bon père de famille, suivant
    leur destination et ne pourra en aucun cas, rien faire ni laisser, qui puisse les détériorer.
   </p>
   <p>
   Il supportera toutes réparations qui deviendraient nécessaires par la suite et toutes dégradations
   résultant de son fait, soit de celui de son personnel ou de ses visiteurs dans les lieux loués.
   Le remplacement de ces installations sera à la charge exclusive du <b>PRENEUR</b>, même si leur remplacement
    était rendu nécessaire par suite d’usure, de vétusté majeure ou d’exigence administrative.
   </p>
   <p>Il aura entièrement à sa charge, sans recours contre le BAILLEUR, l’entretien complet de la plomberie,
      de l’électricité, des peintures, enduits et aménagements intérieurs.
    </p>
    <p>
    La vidange des fosses d’aisance est à la charge du PRENEUR.
    </p>
    <p>
    Les bris de glaces, et détérioration des fenêtres, à l’exception de ceux provoqués par les guerres civiles,
     les troubles à l’ordre public (émeutes, insurrections, mutineries, putschs) et les tremblements de terre,
      resteront à la charge du PRENEUR qui en supportera les conséquences.
    </p>
    <p>
    Le PRENEUR devra aviser le BAILLEUR, en temps utile, par lettre remise contre décharge ou par téléphone, des grosses
     réparations qu’il serait nécessaire d’effectuer dans les lieux loués
    </p>
    <p>
    Lorsque le BAILLEUR refuse d’assumer les grosses réparations qui lui incombent, le PRENEUR peut se faire autoriser
     par la juridiction compétente, statuant à bref délai, à les exécuter conformément aux règles de l'art, pour
      le compte du BAILLEUR. Dans ce cas, la juridiction compétente, statuant à bref délai, fixe le montant de
      ces réparations et les modalités de leur remboursement
    </p>
    <p>
    En mettant fin au bail, le PRENEUR, un mois (1) avant la fin de la location,  devra faire établir
    contradictoirement avec le BAILLEUR, lui-même étant présent ou lui dûment appelé, un état des réparations
    lui incombant. A défaut d'exécution, le PRENEUR devra régler le montant desdites réparations, sans pouvoir
    élever la moindre objection
    </p>
    <p style="text-decoration: underline; text-align:center;">B. Droits et Obligations du BAILLEUR</p>
    <p>
    Le BAILLEUR ne sera tenu d’exécuter, au cours du bail, que les grosses réparations qui pourraient devenir
    nécessaires et urgentes (toiture, gros œuvres, etc. …) ; toutes autres réparations quelles qu’elles soient,
     restant à la charge du PRENEUR.
    </p>
    <p>
    Outre les dommages résultant de vices de construction, le BAILLEUR ne sera en aucun cas responsable des
    dégâts ou accidents occasionnés par fuite d’eau ou de gaz et par l’humidité et généralement pour tous autres
     cas de force majeure ainsi que pour tout ce qui pourrait en être la conséquence directe ou indirecte.
    </p>
    <p>
    Bien que les réparations intéressant la toiture soient à la charge du propriétaire, le PRENEUR devra aviser,
   en temps utile le BAILLEUR, par lettre recommandée, des réparations qu'il apparaît nécessaire d'y effectuer
   au cours du bail. En en raison du caractère de cas fortuit et de cas de force majeure que revêtent en Afrique
   les tornades, le BAILLEUR ne pourra en aucune façon être tenu pour responsable des dégâts causés directement.
   ou indirectement par la pluie, la rouille, la foudre ou le vent, aux meubles meublants, matériels et marchandises
   se trouvant dans les lieux loués, s'il n'a été mis en demeure depuis huit (8) jours au moins, par lettre
   recommandée d'avoir à effectuer les réparations devenues nécessaires.
    </p>
    <p>
    Le PRENEUR souffrira les grosses réparations et toutes transformations nécessaires que le BAILLEUR  serait
     tenu d’effectuer au cours du bail, quelles qu’en soient l’importance et la durée. Il devra laisser pénétrer
      les ouvriers dans les lieux loués pour travaux jugés utiles par le BAILLEUR.
    </p>
   <p>
   Le BAILLEUR ne peut, de son seul gré, ni apporter des changements à l’état de l’IMMEUBLE donné à bail,
   ni en restreindre l’usage.
   </p>
   <p>
   Le BAILLEUR est responsable envers le PRENEUR du trouble de jouissance survenu de son fait, ou du fait
   de ses ayant droits ou de ses préposés
   </p>
   <p>
   Si les réparations urgentes ou troubles quelconques sont de telle nature qu’elles rendent impossible la
    jouissance du bail, le PRENEUR pourra en demander la résiliation judiciaire ou sa suspension pendant la
     durée des travaux.
   </p>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 12 – DEGRADATIONS ET VOLS</h5>
   <p>
   Le PRENEUR est responsable de toutes dégradations ou vols quelconques qui pourraient être commis par lui ou
    par des tiers dans les locaux loués.
   </p>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 13 – AMENAGEMENTS-TRANSFORMATIONS-CONSTRUCTIONS</h5>
   <p>
   Le PRENEUR ne pourra faire aucun aménagement, aucune modification ou transformation dans l’état où la disposition
    des locaux, sans l’autorisation préalable, expresse et écrite du BAILLEUR.
   </p>
   <p>
   Tous aménagements, embellissements, améliorations ou constructions nouvelles, meubles fixés aux murs, sols
   ou plafonds, appartiendront de plein droit au BAILLEUR en fin de bail sans indemnité, à moins qu'il ne préfère
  la remise en état des lieux, aux frais du PRENEUR tels qu'ils se trouvaient au moment de l'entrée en jouissance
   </p>

   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 14 – TRANSMISSION DU BAIL ENTRE VIFS</h5>
   <p>
   Le bail ne prend pas fin par la cessation des droits du BAILLEUR sur les locaux donnés à bail.Dans ce cas, le
    nouveau BAILLEUR est substitué de plein droit dans les obligations de l’ancien BAILLEUR et doit poursuivre
     l’exécution du bail.
   </p>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 15 – DECES DU PRENEUR </h5>
   <p>
   Le bail ne prend pas fin par le décès de l'une ou l'autre des parties.
   </p>
   <p>
   En cas de décès du PRENEUR, personne physique, le bail se poursuit avec les conjoint, ascendants ou
    descendants en ligne directe, qui en ont fait la demande au BAILLEUR par signification d’huissier de
    justice ou notification par tout moyen permettant d’établir la réception effective par le BAILLEUR, dans un
     délai de trois mois à compter du décès.
   </p>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 16 – MISE EN LIQUIDATION DU PRENEUR  </h5>
   <p>
   La dissolution du PRENEUR personne morale, n’entraîne pas, de plein droit, la résiliation du bail des immeubles
    affectés à l’activité du PRENEUR. Le liquidateur est tenu d’exécuter les obligations du PRENEUR, dans les
    conditions fixées par les parties. Le bail est résilié de plein droit après une mise en demeure adressée au
    liquidateur, restée plus de soixante (60) jours sans effet.
   </p>
   <h5  style="text-decoration: underline; text-align:center;">ARTICLE 17 – REGLEMENTS URBAINS : </h5>
   <p>
   Le PRENEUR satisfera en lieu et place du BAILLEUR à toutes les prescriptions de police, de voirie et
    d’hygiène et à tous règlements administratifs, établis ou à établir, de manière que le BAILLEUR ne soit pas
    inquiété à cet égard.
   </p> <br> <br>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 18 – IMPOTS-PATENTES-TAXES LOCATIVES</h5>
   <p>
   Le PRENEUR s’acquittera, à partir du jour de l’entrée en jouissance, en sus du loyer ci-dessus fixé, toutes
    contributions, taxes et autres, tous impôts afférents à son activité, y compris la patente, à l’exception des
     impôts fonciers qui resteront à la charge du BAILLEUR
   </p> <br>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 19 – ASSURANCES</h5>
   <p>
   Le PRENEUR  s’engage, dès la signature du présent bail,  à assurer contre l’incendie, son mobilier, son
   matériel, ses marchandises ainsi que les risques locatifs, le bris de glaces et les recours des voisins et
   à maintenir cette assurance pendant le cours du présent bail, à en acquitter exactement les primes et
    cotisations annuelles et à justifier du tout à la première réquisition du BAILLEUR.
   </p>
   <p>
   Enfin il s’engage à prévenir immédiatement le BAILLEUR de tout sinistre sous peine de tous dommages et intérêts
    pour indemniser le BAILLEUR du préjudice qui pourrait lui être causé par l’inobservation de cette clause.
   </p>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 20 – ENSEIGNES ET ETALAGES</h5>
   <p>
   Les enseignes et plaques relatives à la profession, au commerce ou à l’activité du PRENEUR devront avoir des
    dimensions conformes à la réglementation et aux usages.
   </p>
   <h5  style="text-decoration: underline; text-align:center;">ARTICLE 21 – CONTROLE ETAT D’ENTRETIEN ANNUEL</h5>
   <p>
   Les parties conviennent de procéder à un contrôle de l’état d’entretien du bien loué tous les ans dans le mois
    de l’anniversaire du bail. Le BAILLEUR devra prévenir le PRENEUR par lettre ou par téléphone au moins 3 jours
    à l’avance et convenir du jour et de l’heure de la visite.
   </p>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 22 – VISITE DES LIEUX</h5>
   <p>
   En cas de mise en vente ou de relocation du bien par le propriétaire et également en cas de contrôle de l’état
    d’entretien, le PRENEUR devra laisser visiter le BAILLEUR, ou les acquéreurs et locataires éventuels des lieux
     loués, chaque fois que le BAILLEUR le jugerait utile, à charge pour lui de prévenir le PRENEUR par lettre ou
      par téléphone au moins 24 heures à l’avance.
   </p>
   <p>
   En cas de difficulté, les parties conviennent dès à présent, de fixer lesdites visites à trois jours  par semaine,
    les mardi, jeudi et  samedi de quinze (15) à dix-huit (18) heures.
   </p>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 23 – REMISE DES CLES</h5>
   <p>
   Le jour de l’expiration de la location, le PRENEUR devra remettre au BAILLEUR les clés des locaux. Dans le
    cas où, par le fait du PRENEUR, le BAILLEUR n’aurait pu mettre en location ou laisser visiter les lieux ou
     encore faire la livraison à un nouveau locataire ou même en reprendre la libre disposition, à l’expiration
      de la location, il aurait droit à une indemnité égale à un mois de loyer, sans préjudice de tous dommages
      et intérêts
   </p>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 24 – CLAUSE RESOLUTOIRE </h5>
   <p>
   A défaut de paiement d’un seul terme de loyer ou de charges, à son échéance exacte ou d’inexécution de
   l’une quelconque des clauses et conditions du présent bail, celui-ci sera résilié de plein droit, si bon
   semble au BAILLEUR, et sans formalités judiciaires, un mois après un commandement de payer ou de remplir les
   conditions en souffrance, par acte extrajudiciaire, énonçant la volonté du BAILLEUR d’user du bénéfice de la
  présente clause, et demeurer sans effet quelle que soit la cause de cette carence et nonobstant toutes consignations
  ultérieures.
   </p>
   <p>
   Tous frais et honoraires engagés à cet effet seront supportés par le locataire qui  s’y oblige.
   </p>
   <h5 style="text-decoration: underline; text-align:center;">ARTICLE 25 – MENTION - FRAIS</h5>
   <p>
   Mention des présentes est consentie pour avoir lieu partout où besoin sera.
   </p>
   <p>
   Tous les frais, droits et honoraires des présentes et de leurs suites,
    seront supportés par le PRENEUR qui s’y oblige.
   </p>  <br><br><br><br><br><br>
  <h4 style="text-align: center;">TITRE III – ENREGISTREMENT ET REGLEMENT DES LITIGES</h4> <br><br>

  <h5 style="text-decoration: underline; text-align:center;">ARTICLE  26 – ENREGISTREMENT  </h5>
  <p>L’enregistrement du présent bail est requis pour  deux (2) années aux frais du PRENEUR. </p>
  <p>
  Les parties conviennent que le BAILLEUR sera chargé de faire tous les actes, déclaration et paiements
  ultérieurs relatifs à l’enregistrement du renouvellement du bail. Tous droits, frais et honoraires du
  renouvellement du bail seront à la charge du PRENEUR, à savoir :
  </p>
  <p>
  &nbsp;&nbsp;  -	DROITS D’ENREGISTREMENT    = loyer triennal X 2,5% <br>
  &nbsp;&nbsp;  -	FRAIS & HONORAIRES DE FORMALITE = loyer triennal X 2,5% conformément à l’article 30  de la tarification.
  </p>
  <p>Toutes amendes ou double droit resteront à la charge du PRENEUR sauf cas de négligence de l’AGENCE.</p>
  <h5 style="text-decoration: underline; text-align:center;">ARTICLE  27 – ELECTION DE DOMICILE ET ATTRIBUTION DE JURIDICTION :</h5>
 <p>Pour l’exécution des présentes et de leurs suites, les parties font élection de domicile, en leur domicile
 et social indiqué au début des présentes.</p>
 <p>En cas de litige, l’AGENCE et PRENEUR, consentent à recourir tout d’abord à l’arbitrage de la Commission d’Arbitrage,
 de l’Ethique et de Discipline de la C.DA.IM (Chambre du Droit des Affaires et de l’Immobilier). Si la sentence arbitrale
 e les satisfaisait pas,  elles pourront toujours saisir le Tribunal compétent.
</p>

<h5 style="text-decoration: underline; text-align:center;">ARTICLE  28 – MONNAIE ET LANGUE</h5>
<p>La monnaie de référence est le franc CFA. La langue de communication et de procédure est le français.
Fait et passé à Abidjan en trois (3) exemplaires originaux à enregistrer le 13 mai 2020.
</p> <br> <br>











    <p>Pour le BAILLEUR            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;              Pour le PRENEUR</p>

    </body>
</html>
