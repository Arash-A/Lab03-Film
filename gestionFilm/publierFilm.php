<?php
	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	require_once("../BD/param.php");
	require("../BD/connexion.inc.php");

	$id=$_GET['id'];
	$publier=$_GET['publier'];

	$val = 1-$publier;
	$aa = publier($id, $val);

		
	echo"$aa";
	
	header("Location: ../vue/gestionFilm.php");

?>