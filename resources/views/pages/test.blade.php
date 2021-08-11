<html>
<head>
<style type="text/css">
ul.topnav {
	list-style: none;
	padding: 0 20px;
	margin: 0;
	float: left;
	width: 920px;
	background: #222;
	font-size: 1.2em;
	background: url(topnav_bg.gif) repeat-x;
}
ul.topnav li {
	float: left;
	margin: 0;
	padding: 0 15px 0 0;
	position: relative;
}
ul.topnav li a{
	padding: 10px 5px;
	color: #fff;
	display: block;
	text-decoration: none;
	float: left;
}
ul.topnav li a:hover{
	background: url(topnav_hover.gif) no-repeat center top;
}
ul.topnav li span { /*-- Style du bouton qui exécutera l'action qui déroulera le menu déroulant jquery (représenté par une flèche) --*/
	width: 17px;
	height: 35px;
	float: left;
	background: url(subnav_btn.gif) no-repeat center top;
}
ul.topnav li span.subhover {background-position: center bottom; cursor: pointer;} /*-- Changement au survol de la flèche (bouton Drop Down)--*/
ul.topnav li ul.subnav {
	list-style: none;
	position: absolute;
	left: 0; top: 35px;
	background: #333;
	margin: 0; padding: 0;
	display: none;
	float: left;
	width: 170px;
	border: 1px solid #111;
}
ul.topnav li ul.subnav li{
	margin: 0; padding: 0;
	border-top: 1px solid #252525; /*--Cré un effet de bevel--*/
	border-bottom: 1px solid #444; /*--Cré un effet de bevel--*/
	clear: both;
	width: 170px;
}
html ul.topnav li ul.subnav li a {
	float: left;
	width: 145px;
	background: #333 url(dropdown_linkbg.gif) no-repeat 10px center;
	padding-left: 20px;
}
html ul.topnav li ul.subnav li a:hover { /*--Changement au survol d'un lien de la sous-navigation--*/
	background: #222 url(dropdown_linkbg.gif) no-repeat 10px center;
}



</style>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("ul.subnav").parent().append("<span></span>"); //Affiche simplement le bouton (ici représenté par une flèche) qui sert à afficher le menu déroulant lorsque le JavaScript est activé.
	$("ul.topnav li span").click(function() { //Lorsque l'on clique sur le bouton (flèche)...

		//Les événements suivants sont appliqués à la sous-navigation (menu déroulant).
		$(this).parent().find("ul.subnav").slideDown('fast').show(); //Ouverture du menu déroulant lorsque l'on clique sur le bouton

		$(this).parent().hover(function() {
		}, function(){
			$(this).parent().find("ul.subnav").slideUp('slow'); //Lorsque l'on survol à l'extérieur du menu déroulé, le menu déroulant remontra
		});

		//Les événements suivant s'appliquent lors du survol du bouton de la flèche.
		}).hover(function() {
			$(this).addClass("subhover"); //Lorsque l'on survol, ajout de la classe "subhover"
		}, function(){	//On Hover Out
			$(this).removeClass("subhover"); //Lorsque l'on survol à l'extérieur, enlève la classe "subhover"
	});
    });
</script>
</head>
<body>
hqhqh

<ul class="topnav">
    <li><a href="#">Home</a></li>
    <li>
        <a href="#">Tutorials</a>
        <ul class="subnav">
            <li><a href="#">Sub Nav Link</a></li>
            <li><a href="#">Sub Nav Link</a></li>
        </ul>
    </li>
    <li>
        <a href="#">Resources</a>
        <ul class="subnav">
            <li><a href="#">Sub Nav Link</a></li>
            <li><a href="#">Sub Nav Link</a></li>
        </ul>
    </li>
    <li><a href="#">About Us</a></li>
    <li><a href="#">Advertise</a></li>
    <li><a href="#">Submit</a></li>
    <li><a href="#">Contact Us</a></li>
</ul>

</body>
</html>