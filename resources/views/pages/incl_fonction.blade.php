<?php

//Séparateur millier
function separer($nombre, $taille)
{
	echo strrev(wordwrap(strrev($nombre), $taille, ' ', true)); 
	
}

//Formatter date
function madate($vDate)
{
	date('d/m/Y', strtotime($vDate));
	
}


?>