<?php
	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$id=$_GET['id'];

	$aa = supprimerParId($id);
		
	echo JSON_encode($aa);
	
	//echo "$prix";
	

	


?>