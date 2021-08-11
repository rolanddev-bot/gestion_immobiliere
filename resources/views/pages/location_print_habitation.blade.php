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
            <img  style="width: 300px; height:300px"  src="{{ url('assets/img/logo_sini.png') }}" alt="">
        </div>
        <div class="container">
           <img  style="width: 200px; height:200px;"  src="{{ url('assets/img/agent_agree1.jpg') }}" alt="">
        </div>
        <div class="container">
           <img  style="width: 600px; height:300px;"  src="{{ url('assets/img/img_contrat_H.png') }}" alt="">
        </div>
        <div class="container1">
        <p style="text-align: center;"> <h2>BAIL D’HABITATION</h2> </p>
        <p style="text-align: center;"> <h3>PRENEUR : {{$locationsper_physique->locataire->nom.' '.$locationsper_physique->locataire->prenom}}</h3> </p>
        <p style="text-align: center;"> <h4>RÉFÉRENCE : N° {{$locations->ref}}</h4> </p>
    </div><br> <br><br>

    <div>
        <h5 style="text-decoration: underline; text-align:center">SOMMAIRE</h5> <br>

        <table width="100%" align="center">
        <tr><td  width="80%">Article 1 : VALEUR JURIDIQUE DU PREAMBULE</td><td>..........4</td></tr>
        <tr><td>Article 2 : OBJET</td><td>..........4</td></tr>
        <tr><td>Article 3 : DESIGNATION</td><td>..........4</td></tr>
        <tr><td>Article 4 : ETAT DES LIEUX</td><td>..........4</td></tr>
        <tr><td>Article 5 : DUREE DU BAIL</td><td>..........5</td></tr>

        <tr><td>Article 6 : RENOUVELLEMENT DU BAIL</td><td>..........5</td></tr>
        <tr><td>Article 7 : LOYER</td><td>..........5</td></tr>
        <tr><td>Article 8 : REVISION DU LOYER</td><td>..........5</td></tr>

        <tr><td>Article 9 : DEPOT DE GARANTIE</td><td>..........5</td></tr>
        <tr><td>Article 10 : DESTINATION DES LIEUX</td><td>..........6</td></tr>
        <tr><td>Article 11 : CESSION DE BAIL OU SOUS-LOCATION</td><td>..........6</td></tr>

        <tr><td>Article 12 : MOBILIER</td><td>..........6</td></tr>
        <tr><td>Article 13 : ENTRETIEN ET REPARATIONS</td><td>..........6</td></tr>
        <tr><td>Article 14 : GROSSES REPARATIONS</td><td>..........7</td></tr>

        <tr><td>Article 15 : DEGRADATIONS ET VOLS</td><td>..........7</td></tr>
        <tr><td>Article 16 : AMENAGEMENTS-TRANSFORMATIONS-CONSTRUCTIONS</td><td>..........7</td></tr>
        <tr><td>Article 17 : REGLEMENTS URBAINS</td><td>..........8</td></tr>

        <tr><td>Article 18 : IMPOTS-PATENTES-TAXES LOCATIVES</td><td>..........8</td></tr>
        <tr><td>Article 19 : ASSURANCES</td><td>..........8</td></tr>
        <tr><td>Article 20 : VISITE DES LIEUX</td><td>..........8</td></tr>

        <tr><td>Article 21 : CONTROLE ANNUEL DE L’ ETAT D’ENTRETIEN DU BIEN</td><td>..........8</td></tr>
        <tr><td>Article 22 : REMISE DES CLES</td><td>..........8</td></tr>
        <tr><td>Article  23 : CLAUSE RESOLUTOIRE</td><td>..........9</td></tr>

        <tr><td>Article 24 : ENREGISTREMENT</td><td>..........9</td></tr>
        <tr><td>Article  25 : ELECTION DE DOMICILE  ET ATTRIBUTION DE JURIDICTION</td><td>..........9</td></tr>
        <tr><td>Article 26 : MONNAIE ET LANGUE</td><td>..........9</td></tr>

        </table>
    </div> <br> <br><br><br><br><br><br><br><br><br><br><br><br><br><br> <br>

    <div>
    <br><br> <br>
        <p style="text-decoration: underline;">Entre les soussignés</p>
        <p><b>{{ $agence->denomination }}</b>, {{$agence->forme}} au Capital de {{$agence->capital}}  millions de francs CFA
        dont le siège social est à {{ $agence->adresse }} , immatriculée au Registre de Commerce et du
             Crédit Mobilier sous le numéro {{ $agence->num_rccm }}, Agrément Agent Immobilier numéro
             {{ $agence->numero_agrement }},
            membre de la Chambre du Droit des Affaires et de l’Immobilier en abrégé « C.DA.IM. », représentée par {{ $agence->sexe_representant }}
            {{ $agence->representer_par }}, {{ $agence->poste_representant }} ;   </p>
        <p>Ci-après dénommée <b> le BAILLEUR ou l’AGENCE,</b></p>
        <p>D’UNE PART</p>

        <p>Et {{$locationsper_physique->locataire->sexe}} {{$locationsper_physique->locataire->nom.' '.$locationsper_physique->locataire->prenom}},
             de nationalité {{$locationsper_physique->locataire->nationalite}} détenteur
        de la CNI numéro {{$locationsper_physique->locataire->numero_piece}}
         établie le {{date('d-m-Y', strtotime($locationsper_physique->locataire->etablie_le))}}  au {{$locationsper_physique->locataire->cni_valide_au}},
         domicilié à {{$locationsper_physique->locataire->domicile_a}}, Téléphone: {{$locationsper_physique->locataire->mob1}}.</p>
         <p>Ci-après dénommée <b> le PRENEUR</b>,</p>
         <p>D’AUTRE PART</p>
         <p>Individuellement et solidairement dénommées respectivement « La Partie » et « Les Parties ».</p>
         <h5 style="text-decoration: underline;">PREAMBULE</h5>
         <p>Le PRENEUR, après avoir visité les lieux objet des présentes, a manifesté son intérêt de les prendre
             en location à usage d’habitation. Le PRENEUR confirme avoir la capacité financière requise pour
              supporter les loyers et tous les frais associés pendant toute la durée de la période du bail.</p>

              <!--  les informations du prenneur    -->
         <p>Aussi, par les présentes, le BAILLEUR donne-t-il à bail à {{$locationsper_physique->locataire->sexe}} {{$locationsper_physique->locataire->nom.' '.$locationsper_physique->locataire->prenom}}, en qualité le
              PRENEUR, qui accepte, les locaux dont la désignation est indiquée à l’article 3 ci-dessous.</p>

    </div> <br>

    <div>
        <h5 style="text-decoration:underline;">Article 1: VALEUR JURIDIQUE DU PREAMBULE</h5>
        <p>Les Parties attestent de l’exactitude de l’exposé ci-dessus et s’accordent à lui conférer la même
            valeur juridique que l’ensemble des dispositions du présent contrat dont il fait partie intégrante.
            </p>
            <h5 style="text-decoration: underline;">Article 2: OBJET</h5>
            <p>Le présent contrat a pour objet de déterminer les modalités générales par lesquelles le BAILLEUR
                donne à bail au LOCATAIRE la villa ci-dessous désignée.
            </p>
            <h5 style="text-decoration: underline;">Article 3 : DESIGNATION</h5>
            <p>Le(s) bien(s) mis en location concernent un(e) {{$locationsper_physique->bien->libelle}}
            @if($locationsper_physique->bien->typebien->libelle=='Terrain' OR $locationsper_physique->bien->typebien->libelle=='Immeuble' )
            @else
            de {{ $locationsper_physique->bien->nbre_piece }} pièces
            @endif
           située à {{ $locationsper_physique->bien->adresse }}. Elle comprend :<br>

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



             <h5 style="text-decoration: underline;">Article 4 : ETAT DES LIEUX </h5>

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
        <h5 style="text-decoration: underline;">Article 5: DUREE DU BAIL </h5>
        <p>Le présent bail est consenti et accepté pour une durée de {{$locationsper_physique->duree}} annéé(s) entière, qui court à compter du {{date('d-m-Y', strtotime($locationsper_physique->date_echeance))}}
             pour se terminer le {{$fin_contrat}} <br>
             Il ne peut pas être rompu avant le  terme de la première (1ère) année pour quelque raison que ce soit.
        </p>
        <p>En cas de résiliation avant terme, la partie qui aura pris l’initiative de la résiliation du bail devra payer à l’autre une
            indemnité forfaitaire égale à deux (2) mois de loyer qui sont exigibles au plus tard à la fin du préavis de
         trois (3) mois, période pendant laquelle les loyers restent dus.
         </p>
         <h5 style="text-decoration: underline;">Article 6 : RENOUVELLEMENT DU BAIL</h5>
         <p>A l’expiration de la première année, ledit bail se renouvellera par tacite reconduction ou de manière expresse ; et il pourra
              également être résilié  à tout moment, à charge par celle des parties qui voudra faire cesser le présent bail
              de donner à l’autre un préavis de trois (3) mois par lettre remise contre décharge ou par acte extrajudiciaire.
        </p>
        <h5 style="text-decoration: underline;">Article 7: LOYER</h5>
        <p>Le présent bail est consenti et accepté moyennant un loyer mensuel de {{$locationsper_physique->loyer + $montant_charge}}  FRANCS CFA payable
             de façon {{$locationsper_physique->periodicite_loyer}} et d’avance au plus tard le 05 du mois en cours (ou le 5 du 1er mois du trimestre),
               par {{$locationsper_physique->mode_paiement}} à l’AGENCE. En cas de chèque impayé, le PRENEUR sera tenu de payer 10 000 F CFA pour
              les frais de recouvrement dudit chèque.
        </p>

        <p>Le loyer est portable et non quérable payé contre une quittance numérotée délivrée immédiatement par l’AGENCE.
        </p>

        <p>Passé le 15 du mois, le PRENEUR sera assujetti à des pénalités pour  retard de paiement fixé à  10% du montant
         des loyers impayés.
        </p>
        <h5 style="text-decoration: underline;">Article 8 : REVISION DU LOYER</h5>
        <p>Les parties conviennent que le loyer pourra être révisé tous {{$locationsper_physique->revision_annuelle_loyer}} ans. A défaut d’accord
            entre les parties, le nouveau montant du loyer prendra en compte le taux de référence
             des loyers fixé annuellement par le Chambre du Droit des Affaires et de l’Immobilier (C.DA.IM).
         </p>

         <h5 style="text-decoration:underline">Article 9 : DEPOT DE GARANTIE </h5>
         <p>A titre de provision et pour la garantie de l’exécution des clauses du présent contrat, le PRENEUR a
              versé entre les mains du BAILLEUR, la somme de {{ $locationsper_physique->caution }} FRANCS CFA représentant
              {{ $locationsper_physique->nbre_depot }} mois de loyer en guise de dépôt de garantie (ou caution).
            </p>

            <p>Laquelle somme sera conservée par le BAILLEUR  pour le compte du PRENEUR durant toute la durée du bail.
                 Elle est non productive d’intérêts et ne pourra pas servir au paiement du loyer en fin
            </p>
        <p>A l’expiration dudit bail, elle sera restituée au PRENEUR après paiement de tous les loyers dus par lui
             et exécution de toutes les réparations lui incombant, ainsi que des résiliations des abonnements CIE et
             SODECI.
         </p>
         <h5 style="text-decoration: dashed;">Article 10 : DESTINATION DES LIEUX</h5>
         <p>Les lieux loués devront servir au PRENEUR à un usage d’habitation à l’exclusion de tout autre usage,
              même temporairement.
            </p>
            <h5 style="text-decoration:underline">Article 11 : CESSION DE BAIL OU SOUS-LOCATION</h5>
            <p>La présente location a été consentie au PRENEUR « intuitu personae ». Toute cession de bail,
                 sous-location ou simple occupation en tout ou partie des lieux par un tiers, est rigoureusement
                 interdite à peine de résiliation immédiate du présent contrat de location à la simple constatation
                  de l’infraction et sans qu’il soit besoin de recourir à la procédure de mise en demeure.
            </p>
            <h5 style="text-decoration: underline;">Article 12 : MOBILIER </h5>
            <p>Le PRENEUR s’engage à garnir et à tenir constamment garni les lieux loués, de meubles et objets mobiliers
            lui appartenant personnellement en qualité et de valeurs suffisantes pour répondre du paiement de loyers
             et de l’exécution de toutes les conditions du bail.
            </p>
            <h5 style="text-decoration: underline;">Article 13 : ENTRETIEN ET REPARATIONS</h5>
            <p>Le PRENEUR entretiendra les lieux loués en bon état de réparation locative, en jouira en bon père de famille,
                suivant leur usage et ne pourra en aucun cas, rien faire ni laisser, qui puisse les détériorer.
            </p>
            <p>Il supportera toutes réparations qui deviendraient nécessaires par la suite et toutes dégradations résultant de son
                fait ou de celui de son personnel.
            </p>
            <p> Il aura entièrement à sa charge, sans recours contre le BAILLEUR, l’entretien complet de la plomberie,
            de l’électricité, des aménagements intérieurs, des enduits, des sols en marbre, des sols carrelés, de tous
            les sanitaires sans exception et également la réfection des peintures intérieures tous les deux (2) ans.
             </p>
             <p>Il est formellement interdit de changer les couleurs de l’intérieur et de l’extérieur de la villa sans
                l’autorisation préalable, expresse et par écrit du BAILLEUR
            </p>
            <p>Il veillera également au bon entretien du jardin (tondre régulièrement) à l’intérieure et aux abords de la villa.
            </p>
            <p>
                Les bris de glaces, détérioration des fenêtres, des baies vitrées, des châssis naccos, des grilles et
                 volets métalliques dus au fait que le PRENEUR ne les a pas fait fonctionnés régulièrement à l’exception
                 de ceux provoqués par les guerres civiles, les émeutes et tremblement de terre, resteront à la charge du
                  PRENEUR qui en supportera les réparations.
             </p>
            <p>
              Il est formellement interdit de marcher sur les toits en tôles et tuiles pour poser des antennes de
              toute nature. Le PRENEUR supportera toutes dégradations résultant de son fait ou de celui de son
              personnel dues à la pose d’une antenne.
            </p>
            <p>
                Le PRENEUR ne pourra faire aucune installation électrique, câblage téléphonique et réseau internet, sans avoir
                présenté le schéma de ces installations et obtenu l’accord préalable, express et par écrit du BAILLEUR.
            </p>
     <p>
     Le PRENEUR devra installer les appareils de climatisation conformément aux règles de l’art et le moteur de ces appareils
     à l’extérieur sur des socles appropriés.
    </p>
    <p>
     Le PRENEUR devra  mettre des tuyaux pour l’écoulement de l’eau des moteurs de climatisation de sorte que l’eau
     ne s’écoule pas sur les balcons, les terrasses, les grilles métalliques, les volets roulants, les naccos et
     les baies vitrées. Le PRENEUR aura entièrement à sa charge, toutes les dégradations résultant de son fait ou
     de celui de son personnel.
    </p>
    <p>La vidange des fosses d’aisance est à la charge du PRENEUR ;

    </p>
    <p>Le PRENEUR devra aviser le BAILLEUR, en temps utile, par lettre remise contre décharge ou par téléphone, des
       grosses réparations qui seraient nécessaires d’effectuer dans les lieux loués.
     </p>
       <h5 style="text-decoration: underline;">Article 14 : GROSSES REPARATIONS</h5>
        <p>Article 14 : GROSSES REPARATIONS LE BAILLEUR ne sera tenu d’exécuter, au cours du bail, que les grosses
            réparations qui pourraient devenir nécessaires (toiture, étanchéité, gros œuvres, etc. …) ; toutes autres
             réparations quelles qu’elles soient, restant à la charge du PRENEUR</p>
     <p>
      Outre les dommages résultant de vices de construction, le BAILLEUR ne sera en aucun cas responsable des
      dégâts ou accidents occasionnés par les fuites d’eau ou de gaz et par l’humidité et généralement pour tous
       autres cas de force majeure ainsi que pour tout ce qui pourrait en être la conséquence directe ou indirecte
     </p>
     <p>
     Le PRENEUR souffrira les grosses réparations et toutes transformations nécessaires que le BAILLEUR  serait
      tenu d’effectuer au cours du bail, quelles qu’en soient l’importance et la durée sans pouvoir demander
       aucune indemnité ni diminution ou non-paiement du loyer.
     </p>
     <h5 style="text-decoration: underline;">Article 15 : DEGRADATIONS ET VOLS</h5>
     <p>Le PRENEUR est responsable de toutes dégradations ou vols quelconques qui pourraient être commis par lui ou par des tiers dans les
         locaux loués.
        </p>
        <h5 style="text-decoration: underline;">Article 16 : AMENAGEMENTS-TRANSFORMATIONS-CONSTRUCTIONS</h5>
        <p>Le PRENEUR ne pourra faire aucun aménagement, aucune modification ou transformation de l’état ou de la
        disposition des locaux, sans avoir fait la proposition au BAILLEUR en joignant le plan et le descriptif
        et estimatif des travaux sollicités et sans l’autorisation préalable, expresse et par écrit du BAILLEUR.
       </p>
    <h5 style="text-decoration: underline;">Article 17 : REGLEMENTS URBAINS</h5>
    <p>
        Le PRENEUR satisfera en lieu et place du BAILLEUR à toutes les prescriptions de police, de voirie et d’hygiène de manière que
        le BAILLEUR ne soit pas inquiété à cet égard.
    </p>
    <h5 style="text-decoration: underline;">Article 18 : IMPOTS-PATENTES-TAXES LOCATIVES</h5>
    <p>
      Le PRENEUR s’acquittera, à partir du jour de l’entrée en jouissance, en sus du loyer ci-dessus fixé, toutes
      contributions, taxes et autres, tous impôts afférents à son occupation, à l’exception des impôts fonciers
      qui resteront à la charge du BAILLEUR.
    </p>
    <h5 style="text-decoration: underline;">Article 19 : ASSURANCES</h5>
    <p>
     Le PRENEUR  s’engage, dès la signature du présent bail,  à assurer contre l’incendie, son mobilier, son
     matériel ainsi que les risques locatifs, le bris de glaces et les recours des voisins et à maintenir cette
     assurance pendant le cours du présent bail, à en acquitter exactement les primes et cotisations annuelles et
     à justifier du tout à la première réquisition du BAILLEUR.
    </p>
    <p>
        Enfin il s’engage à prévenir immédiatement le BAILLEUR de tout sinistre sous peine de tous dommages et
        intérêts pour indemniser le BAILLEUR du préjudice qui pourrait lui être causé par l’inobservation de cette
        clause.
    </p>
    <h5 style="text-decoration:underline;">Article 20 : VISITE DES LIEUX</h5>
    <p>
    En cas de mise en vente ou de relocation de la villa par le propriétaire, le PRENEUR devra laisser visiter
     le BAILLEUR, ou les acquéreurs et locataires éventuels les lieux loués, chaque fois que le BAILLEUR le
     jugerait utile, à charge pour lui de prévenir le PRENEUR par lettre ou par téléphone au moins 24 heures à
     l’avance.
    </p>
    <p>
      En cas de difficulté, les parties conviennent dès à présent, de fixer lesdites visites à trois jours  par semaine,
      les mardis,  jeudi et  samedi de quinze (15) à dix-huit (18) heures.
    </p>
    <h5 style="text-decoration: underline;">Article 21 : CONTROLE ANNUEL DE L’ ETAT D’ENTRETIEN DU BIEN </h5>
  <p>
    Les parties conviennent de procéder à un contrôle de l’état d’entretien du bien loué tous les ans dans le mois
    de l’anniversaire du bail. Le BAILLEUR devra prévenir le PRENEUR par lettre ou par téléphone au moins 3 jours
     à l’avance et convenir du jour et de l’heure de la visite.
  </p>
    <h5 style="text-decoration:underline;">Article 22 : REMISE DES CLES</h5>
    <p>Le jour de l’expiration de la location, le PRENEUR devra remettre au BAILLEUR les clés des locaux. Dans le
      cas où, par le fait du PRENEUR, le BAILLEUR n’aurait pu mettre en location ou laisser visiter les lieux ou
     encore faire la livraison à un nouveau locataire ou même en reprendre la libre disposition, à l’expiration de
     la location, il aurait droit à une indemnité égale à un mois de loyer, sans préjudice de tous dommages et
      intérêts.
    </p>
    <h5 style="text-decoration: underline;">Article  23 : CLAUSE RESOLUTOIRE</h5>
    <p>
    A défaut de paiement d’un seul terme de loyer  à son échéance exacte ou d’inexécution de l’une quelconque
     des clauses et conditions du présent bail, celui-ci sera résilié de plein droit, si bon semble au BAILLEUR,
      et sans formalités judiciaires, dix jours après un commandement de payer ou de remplir les conditions en
      souffrance, par acte extrajudiciaire, énonçant la volonté du BAILLEUR d’user du bénéfice de la présente
       clause, et demeurer sans effet quelle que soit la cause de cette carence et nonobstant toutes consignations
       ultérieures ; l'expulsion sera prononcée par simple ordonnance de référé, le tout sans préjudice de tous
       dommages et intérêts.
    </p>

    <p>
    Tous frais et honoraires engagés à cet effet seront supportés par le locataire qui  s’y oblige.
    </p>
    <h5 style="text-decoration: underline;">Article 24 : ENREGISTREMENT</h5>
    <p>L’enregistrement du présent bail est requis pour  une année aux frais du PRENEUR. </p>
    <p>Les parties conviennent que l’AGENCE sera chargé de faire tous les actes, déclaration et paiements
         ultérieurs relatifs à l’enregistrement du renouvellement du bail. Tous droits, frais et honoraires du
          renouvellement du bail seront à la charge du PRENEUR, à savoir :
    </p>
    <p>
     &nbsp;&nbsp; -	DROITS D’ENREGISTREMENT    = loyer annuel X 2,5% <br>
     &nbsp;&nbsp;-	FRAIS & HONORAIRES DE RENOUVELLEMENT = loyer annuel X 1,5% conformément à l’article 30 de la tarification.
    </p>
    <p>Toutes amendes ou tout double droit resteront à la charge du PRENEUR sauf cas de négligence de l’AGENCE.
    </p>
  <h5 style="text-decoration: underline;">Article  25 : ELECTION DE DOMICILE  ET ATTRIBUTION DE JURIDICTION</h5>
  <p>Pour l’exécution des présentes et de leurs suites, les parties font élection de domicile en leur domicile ou
       siège social indiqués au début des présentes.
    </p>
    <p>En cas de litige, l’AGENCE et PRENEUR, consentent à recourir tout d’abord à l’arbitrage de la Commission
     d’Arbitrage, de l’Ethique et de Discipline de la  C.DA.IM (Chambre du Droit des Affaires et de
     l’Immobilier). Si la sentence arbitrale ne les satisfaisait pas,  elles pourront toujours saisir le
     Tribunal compétent.
    </p>
    <h5 style="text-decoration: underline;">Article 26 : MONNAIE ET LANGUE</h5>
    <p>
    La monnaie de référence est le franc CFA. La langue de communication et de procédure est le français. <br>

    </p>
    <p>Fait et passé à Abidjan le 08 octobre 2020 en trois (3) exemplaires originaux à enregistrer </p>
    <br><br>


    <p>Pour le BAILLEUR            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;              Pour le PRENEUR</p>
    </div>
    </body>
</html>
