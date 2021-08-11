@include('pages.incl_fonction')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <style>
            .containerv{
            width: 150px;
            height: 150px;
            text-align: center;
           }
           .container1{
            text-align: center;
           }

        </style>
  </head>
    </head>
    <body>
       <script type="application/javascript">
		window.print();
		</script>

        <br><br><br>
    <div class="container">
     <center>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
        <img style="width: 300px; height:300px"  src="{{ public_path('assets/img/logo_sini.png') }}" >
     <br>
     

    <img style="width:400px; height:200PX"  src="{{ public_path('assets/img/mandat_com.jpg') }}" > </center>
    </div> <br>

    <div class="container1">
        <p style="text-align: center;"> <h2>MANDAT DE GESTION IMMOBILIERE</h2> </p>
        <p style="text-align: center;"> <h3>BIEN A USAGE COMMERCIAL</h3> </p>
        <p style="text-align: center;"> <h4>Mandant : @foreach($proprietaire as $prop) {{ $prop->proprietaire->nom.' '.$prop->proprietaire->prenom }} <br> @endforeach</h4> </p>
        <p style="text-align: center;"> <h5>RÉFÉRENCE : N° {{$mandats->ref}} </h5> </p>
    </div><br><br><br><br><br><br><br><br><br><br><br><br> 

    <div>
        <p style="text-decoration: underline;">Entre les soussignés</p>
        <p><b>{{ $agence->denomination }}</b>, {{$agence->forme}} au Capital de {{$agence->capital}}  millions de francs CFA
        dont le siège social est à {{ $agence->adresse }} , immatriculée au Registre de Commerce et du
             Crédit Mobilier sous le numéro {{ $agence->num_rccm }}, Agrément Agent Immobilier numéro
             {{ $agence->numero_agrement }},
            membre de la Chambre du Droit des Affaires et de l’Immobilier en abrégé « C.DA.IM. », représentée par {{ $agence->sexe_representant }}
            {{ $agence->representer_par }}, {{ $agence->poste_representant }} ;   </p>

         <p>Ci-après dénommée le Mandataire,</p>

         <p>D’UNE PART</p>

         <p>@foreach($proprietaire as $prop) {{ $prop->proprietaire->nom.' '.$prop->proprietaire->prenom }} <br> @endforeach
         , @foreach($proprietaire as $prop) {{ $prop->proprietaire->profession.', ' }} @endforeach
          détentrice de @foreach($proprietaire as $prop) {{ $prop->proprietaire->type_piece.', ' }} @endforeach
         numéro @foreach($proprietaire as $prop) {{ $prop->proprietaire->numero_piece.', ' }} @endforeach
          établie à @foreach($proprietaire as $prop) {{ $prop->proprietaire->domicile_a.', ' }} @endforeach</p><br>

         <p>Ci-après dénommé le Mandant,</p>

         <p>D’AUTRE PART</p>

         <p>IL A ETE ARRETE ET CONVENU CE QUI SUIT</p>

         <p>Le présent mandat est consenti et accepté aux conditions particulières ainsi qu’aux conditions
             générales suivantes : </p>

         
    </div>
    <br><br><br><br><br><br><br><br><br><br> <br> <br> <br><br><br><br><br><br> <br> <br><br> <br> <br>

    <div class="container">
      
      <center><img  src="{{ public_path('assets/img/img2.PNG') }}" ></center> 
    </div> <br>
    <div>
     <h5>ARTICLE 1 : DESCRIPTION DES BIENS A LOUER</h5>
     <p>Le Mandant confère par le présent mandat au Mandataire, qui l’accepte, de gérer tant activement que
          passivement les biens et droits immobiliers lui appartenant et dont les caractéristiques sont les
           suivantes :</p>
     <u>Type de biens</u>  : &nbsp;  <span >{{ $mandats->bien->typebien->libelle }}</span><br>
     <u>Adresse</u>  : &nbsp;  <span >{{ $mandats->bien->adresse }}</span><br>
     <u>Usage</u>  : &nbsp;  <span >Commerciale</span><br>
     <u>Désignation</u>  : &nbsp;  <span >{{ $mandats->bien->libelle }}</span> <br> <br>


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

    <p>Un point des meubles et équipements dans la villa sera joint à l’état des lieux qui sera réalisé avec le
         Mandant.</p>
    </div>  <br><br>

    <div>  <!-- il a une mise a jour ici  -->
      <h5>ARTICLE 2 : LOYER CONVENU</h5>
      <p>Le loyer mensuel de base est de {{ separer($loyer,3) }} francs CFA. Le Mandant déclare, sous sa
          responsabilité, ne faire l’objet d’aucune procédure de saisie immobilière. Le Mandataire sera seul
           habilité en droit et en fait à percevoir les loyers, charges et prestations auprès des locataires. </p>
       <br><br>

      <h5>ARTICLE 3 : REDDITION DES COMPTES</h5>
      <p>Le Mandataire devra tenir à tout moment à la disposition du Mandant tous les livres et documents permettant de suivre la gestion. Le Mandataire  adressera au Mandant, par trimestre civil, par courrier ou par email, un décompte détaillé de sa gérance, accompagné de la somme des loyers termes à échoir.
         Les reversements de loyers au Mandant par le Mandataire interviendront entre le 5 et le 15 du premier mois de chaque trimestre termes à échoir par virement bancaire sur le compte du Mandant ou par chèque à son ordre. Le Mandataire en déduira toutefois avec l’accord du Mandant les sommes nécessaires pour faire face aux dépenses d’exploitation, d’entretien et réparation incombant au Mandant, ainsi que le montant de sa rémunération.
         Si au cours d’un trimestre, le compte présentait un solde débiteur, le Mandant s’engage à en régler le montant à réception du décompte envoyé par le Mandataire.
       </p> <br><br>

    <h5>ARTICLE 4 : ASSURANCES </h5>
    <p>Le Mandant déclare accepter, s’il ne peut le faire lui-même, que le Mandataire contracte sur le bien une assurance multirisque comprenant notamment les assurances incendie, dégâts des eaux, bris de glaces… La prime d’assurance est supportée exclusivement par le Mandant. </p>
    <br> <br>

    <h5>ARTICLE 5 : REMUNERATION - HONORAIRES DE GESTION</h5>
    <p>En rémunération des services énumérés ci-dessus, à compter de la prise d’effet des présentes,
    le Mandataire aura le droit de facturer par mois aux locataires retenus pour jouir des lieux un
    montant qui ne saurait être supérieur à {{ $mandats->honnoraire }}% du montant du loyer mensuel brut. Cette rémunération qui
    représente ses honoraires est supposée toute taxe comprise. Ces honoraires s’entendent pour une
    administration générale normale du bien immobilier. Ces honoraires ne couvrent pas les frais engagés par
     le Mandataire à l’occasion du recouvrement des sommes non payées à leur échéance par les locataires.  </p>
   </div> <br> <br><br> <br> <br>


   <div class="container">
      <center><img  src="{{ public_path('assets/img/img3.PNG') }}" ></center> 
    </div> <br><br>

    <div>
        <h5>ARTICLE 6 : DUREE</h5> <br> <!-- -- des données a mettyre à jour içi   -->
        <p>Le présent mandat de gestion est donné pour une durée de {{ $mandat_comms->duree }} ans qui prendra effet à compter
            du {{ date('d-m-Y', strtotime($mandat_comms->date_prise_effet)) }}. Il se renouvellera ensuite, par tacite reconduction, par période triennale.
             Les parties pourront résilier le contrat à l’issue de chaque période triennale en signifiant leur
              intention, par lettre recommandée avec accusé de réception ou par courrier contre décharge ou encore
               par courrier électronique, six (6) mois avant l’expiration de la période initiale ou de chacune des
               reconductions triennales. Le mandat se terminera, en tout état de cause, par la perte de son objet.
                Des frais de clôture de dossier d’un montant de {{ separer($mandat_comms->frais_cloture,3) }} francs CFA seront perçus
                par le Mandataire pour la radiation du mandat.</p>

                <p>Les parties conviennent que le présent mandat de gestion ne pourra être résilié par anticipation que
                     pour motif grave et légitime dûment justifié notamment l’inexécution par le Mandataire de l’une des
                     obligations lui incombant. Toute autre cause de résiliation anticipée entraînera l’application d’une
                      pénalité égale à trois (3) mois d’honoraires.  Le décès du Mandant n’emportera pas résiliation de plein
                       droit du présent mandat qui se poursuivra avec les ayants droits du Mandant fussent-ils mineurs ou
                       autrement incapables sous réserve bien entendu de la faculté de résiliation dans les conditions fixées
                        ci-dessus. </p> <br>
    <h5>ARTICLE 7 : DEFINITION DES MISSIONS DU MANDATAIRE</h5>
    <p>Le Mandataire s’oblige à apporter tous ses soins à la bonne gestion des biens immobiliers qui lui sont
         confiés et à se conformer aux directives qu’il recevra du Mandant, lui seul ayant qualité pour les
          établir, et auquel il aura à rendre compte de sa mission. Les personnes qui pourraient se prévaloir
           soit d’une instruction spéciale écrite, soit d’une délégation régulière émanant de sa part, sont les
           seules qualifiées pour engager ou représenter envers lui l’autorité du propriétaire. Il est rappelé
           que le Mandataire dans le cadre de la réalisation de sa mission a une obligation de moyens et non de
           résultats. En conséquence du présent mandat, le Mandant autorise expressément le Mandataire, dans le
           cadre de sa mission, à accomplir tous actes d’administration et lui donne notamment les pouvoirs
            nécessaires afin d’effectuer les opérations suivantes, sans que l’énumération de celles-ci ait un
             caractère limitatif : </p>
    </div> <br><br><br>

    <div>
        <h5>A - GESTION DES BIENS </h5>
        <p> <b> a)<u>Gérance</u></b> </p>
        <p>
            &nbsp;&nbsp; - recevoir, informer et mettre en place les locataires ;  <br>
            &nbsp;&nbsp;- dresser ou faire dresser tous constats d’état des lieux ; <br>
            &nbsp;&nbsp;- vérifier les assurances multi risques habitation et incendie prises par les locataires ; <br>
            &nbsp;&nbsp;- rechercher des locataires, louer et relouer les biens après avoir avisé le Mandant de leur
            &nbsp;&nbsp;   vacance ;  <br>
            &nbsp;&nbsp;-	solliciter la délivrance de tous certificats, ou autres, le tout relativement aux biens gérés ; <br>
            &nbsp;&nbsp;-	rédiger tous baux, avenants ou leur renouvellement et les signer ;<br>
            &nbsp;&nbsp;-  donner et accepter tous congés ; <br>
            &nbsp;&nbsp;-	réviser les loyers, établir et tenir les fichiers de location, constituer les dossiers ; <br>
            &nbsp;&nbsp;-	recouvrer et comptabiliser les loyers ainsi que les charges, annexes, et dépôts de garantie ; <br>
            &nbsp;&nbsp;-	recevoir et contrôler les réclamations et les doléances des locataires ;<br>
            &nbsp;&nbsp;-	le Mandataire ayant la charge de restituer le dépôt de garantie aux locataires en
                            fin de location, ces dépôts resteront au crédit du compte du Mandant ouvert dans les écritures du
                             Mandataire ;  <br>
            &nbsp;&nbsp;-	le dépôt de garantie conservé par le Mandataire, sera restitué au locataire en cas de
                           sous réserves de déduction des dépenses imputables à ce dernier et constatées dans l’état des
                            lieux de sortie, soit au propriétaire investisseur en cas de vente et en cas d’extinction du
                             mandat ;  <br>
    </p>
      <p> <b> b) <u>Contentieux </u></b> </p>
      <p>
            &nbsp;&nbsp; -	procéder au rappel des loyers échus, poursuites, expulsion saisies etc. ;  <br>
            &nbsp;&nbsp;-	réaliser l’établissement des constats de sinistres, la commande et le contrôle
                              des travaux de réparation   <br>
            &nbsp;&nbsp;-	en cas de litige, consulter le Mandant avant d’engager toute procédure judiciaire ; <br>
            &nbsp;&nbsp;-	représenter le Mandant devant toutes administrations publiques ou privées sous réserve
            d’obtenir au préalable un mandat spécial, déposer et signer toutes pièces, engagements et contrats, moyennant
             un honoraire complémentaire qui sera déterminé d’accord partie ;   <br>

            &nbsp;&nbsp; -	tous les frais de contentieux seront à la charge du Mandant ; <br>
            &nbsp;&nbsp; -	passer et signer tous actes et procès-verbaux, élire domicile, substituer en tout ou partie
             dans les présents pouvoirs et généralement, faire tout ce que le Mandataire jugera convenable aux intérêts
              du Mandant ;  <br>
            &nbsp;&nbsp; -	après accord du Mandant, en cas de difficultés quelconques et à défaut de paiement par
            les débiteurs, en cas de contestation, comme aussi  en cas de faillite, règlement judiciaire ou liquidation
             des biens des débiteurs, exercer toutes poursuites judiciaire, contraintes et diligences nécessaires ; en
             conséquence citer, assigner tant en demande qu’en défense et comparaître devant les tribunaux compétents,
              obtenir tous jugements et arrêts, les faire  mettre à exécution par tous les moyens et voies de droit,
               notamment par la saisie immobilière, et s’en désister, prendre part à toutes les assemblées et
               délibérations de créanciers, produire les titres du Mandant, les affirmer sincères et véritables,
                admettre ou contester ceux des autres créanciers, signer tous concordats, produire à tous ordres ou
                 distributions, obtenir tous bordereaux ou mandats de collocation au profit du Mandant, en toucher ou
                 recevoir le montant de tout dépositaire, en donner quittance, remettre ou se faire remettre tous
                  titres et pièces en donner et retirer décharge.    <br>

      </p>

      <p> <b> c)<u> Entretien des lieux loués </u></b> </p>
      <p>
          &nbsp;&nbsp; -	prendre toutes dispositions pour assurer la bonne marche et l’entretien des divers
                         services de fonctionnement : eau et électricité ;  <br>
          &nbsp;&nbsp; -	s’engager par la présente à consulter préalablement à leur engagement son Mandant pour
                          tous travaux d’entretien ou de mise en valeur des biens d’un montant supérieur ou égal à 10% du loyer
                          mensuel et devra obtenir son accord écrit ;  <br>
          &nbsp;&nbsp; -	surveiller les travaux d’un montant inférieur à 10% du loyer mensuel,   <br>
          &nbsp;&nbsp;-	présenter les devis pour les travaux de remise en état supérieur à 10% du loyer mensuel ;  <br>
          &nbsp;&nbsp; -	en cas d’urgence, prendre toutes mesures conservatoires, procéder aux opérations et en
                         aviser immédiatement le Mandant ; <br>
          &nbsp;&nbsp; - 	si lors de la réalisation des travaux autorisés par le Mandant, le montant des travaux se
                        révèlent être supérieur aux sommes disposées au crédit du compte du Mandant, ce dernier, dans
                        un cadre conventionnel, autorise le Mandataire à prélever sur son compte les sommes qu’il
                        resterait à devoir au Mandataire à l’occasion de l’exécution de travaux approuvés ou
                        représentant les frais engagés lors de l’exécution de mesures conservatoires par le Mandataire.<br>


      </p>
      <p> <b> d)<u> Gestion des charges locatives  </u></b> </p>
        <p>
            &nbsp;&nbsp; -	encaisser, percevoir, sans limitation, toutes sommes représentant les loyers, charges,
             cautionnements, indemnités d'occupation, provisions, avances sur travaux, prestations, sommes pour remise
              ou décharge de contributions, et plus généralement toutes sommes ou valeurs dont la perception est la
              conséquence de l’administration des biens gérés, déposer ces fonds sur les comptes de l’agence et les
              utiliser selon l’usage qui lui semblera le plus nécessaire ou utile, sous réserve du compte rendu de
               gestion qui devra être délivré au Mandant aux échéances précisées au paragraphe « reddition des comptes » ;
               <br>
            &nbsp;&nbsp; -	procéder à tous règlements dans le cadre de la même administration, notamment
             acquitter toutes sommes qui pourront être dues par le Mandant, notamment les charges fiscales,
             faire toutes réclamations en dégrèvement, présenter à cet effet tous mémoires et pétitions ;  <br>


        </p> <br>
        <h5>B – LOCATION NOUVELLE - RECHERCHE DE CLIENTELE </h5>
        <p>Les honoraires de rédaction et état des lieux sont à la charge du locataire.
         Le Mandant autorise le Mandataire à rechercher des locataires, louer le bien, le relouer, au prix
          charges et conditions que le Mandataire jugera à propos moyennant les honoraires et modalités indiqués
           ci-dessus.
        </p>
        <p>Dans le cadre du présent mandat, le Mandant s’engage à confier au Mandataire, un mandat exclusif de
         recherche de locataires pour une durée de trois (3) mois, par tous moyens appropriés avec la possibilité
          de procéder à une délégation de mandat. Passé ce délai de trois (3) mois, cette clause d’exclusivité
          pourra être dénoncée à tout moment par chacune des parties, à charge pour celle  qui entend y mettre fin
          d’en aviser l’autre quinze jours au moins à l’avance par lettre recommandée avec accusé de réception ou
           par courrier contre décharge ou encore par courrier électronique.</p>

           <h5>C – USAGE AUTRE QUE L’HABITATION </h5>
           <p>Sans préjudice des pouvoirs ci-dessus conférés au Mandataire, si le présent Mandant porte sur les biens
            dont la location est soumise au statut des baux d’habitation, le Mandataire ne pourra relouer ou donner
             congé aux fins d’offre de renouvellement sans avoir, au préalable, avisé le Mandant et obtenu son accord
             exprès en ce qui concerne les conditions essentielles du nouveau contrat, notamment le montant du nouveau
             loyer proposé. Il en est de même pour les conditions essentielles nécessaires à l’acte de refus de renouvellement.
            </p>
            <h5>D – EN CAS DE VENTE DU BIEN </h5>
            <p>Sans préjudice des pouvoirs ci-dessus conférés au Mandataire, si le présent mandat porte sur des biens
                dont la location est soumise au statut des baux d’habitation, le Mandant qui souhaite donner congé pour
                vente devra préalablement mandater de façon expresse le Mandataire à cet effet. Le Mandant devra
                préciser le prix et les conditions de la vente projetée, lesquels seront reproduits dans le congé
                valant offre de vente.
            </p>
            <p>A ce titre, le Mandant confère un mandat d’exclusivité de six (6) mois au Mandataire aux conditions
             fixées d’un commun accord entre les parties. Passé ce délai de six (6) mois, à compter de la
            signature du mandat de vente en exclusivité, cette clause d’exclusivité pourra être dénoncée à
            tout moment par chacune des parties, à charge pour celle qui entend y mettre fin d’en aviser
             l’autre quinze jours au moins à l’avance par lettre recommandée avec accusé de réception ou par
             courrier contre décharge ou encore par courrier électronique.Il est ici expressément convenu que si le
             Mandant décide de ne pas relouer les locaux, objet des présentes, il deviendra gardien juridiquement
              desdits locaux dès qu’il sera informé de leur libération et au plus tard à l’expiration du délai de
               préavis du locataire.
          </p>
          <h5>ARTICLE 8 : SUBSTITUTION DE PROPRIETAIRE </h5>
          <p>En cas de changement de propriétaire, le mandat continu dans les mêmes conditions, et le cédant doit
            transmettre à son successeur le présent mandat de gestion. Il appartient au successeur de réclamer
            cette pièce si elle ne lui a pas été transmise, le Mandataire ne pouvant être tenu pour responsable
             de la non-transmission de celle-ci. Le Mandant s’engage par ailleurs et ce, pendant toute la durée du
             présent mandat, à informer le Mandataire de toute modification ou toute novation dans sa situation
             personnelle et patrimoniale. A cet effet, il joindra toute pièce se révélant nécessaire à l’acte de
             gestion.
        </p> <br><br>
        <h5>ARTICLE 9 : SUBSTITUTION DE MANDATAIRE </h5>
        <p>En cas de cession de clientèle du Mandataire, le Mandant reconnaît au Mandataire une faculté de
             substitution au profit de son concessionnaire, le présent mandat se poursuivant aux conditions
              cumulatives suivantes : <br>
              &nbsp;&nbsp; -	Le Mandataire cessionnaire devra remplir toutes les conditions requises pour
                              l’exercice de l’activité d’agence immobilière  <br>
              &nbsp;&nbsp; -	Le Mandataire cessionnaire avisera le Mandant dans les 3 mois de la cession, par
               lettre recommandée avec accusé de réception ou par courrier contre décharge ou encore par courrier
               électronique, le Mandant ayant toute faculté à résilier le présent mandat dans le mois suivant la
               réception du courrier.   <br>

              &nbsp;&nbsp; - recevoir, informer et mettre en place les locataires ;  <br>
            </p>
            <h5>ARTICLE 10 : LOI APPLICABLE – ATTRIBUTION ET COMPETENCE</h5>
            <p>Le présent mandat de gestion est soumis au droit ivoirien. Toutes difficultés relatives à l’interprétation,
                à l’exécution et l’expiration du mandat  seront soumises, à défaut d’accord amiable qui reste la règle de
                 base, au Tribunal de Première Instance d’Abidjan.
           </p>
           <h5>ARTICLE 11 : MONNAIE ET LANGUE</h5>
           <p>La monnaie de référence est le franc CFA. La langue de communication et de procédure est le français. </p>
          <p> Fait et passé à Abidjan le 23 mai 2020 en deux (2) exemplaires originaux à enregistrer à la mairie de l’une
            des Communes d’Abidjan.
           </p>
    </div> <br>

    <div>
        <b>Pour le Mandant   &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Pour le Mandataire</b><br>
        <i>Précédée de la mention : &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;        Précédée de la mention : </i><br>
        <i> "Lu et Approuvé. Bon pour mandat"   &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;    « Lu et Approuvé. Mandat accepté »</i>



    </div>

    </body>
</html>
