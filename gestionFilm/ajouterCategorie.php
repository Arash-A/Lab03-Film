<?php
	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	require_once("../BD/param.php");
	require("../BD/connexion.inc.php");

	$categorie=$_POST['categorie'];
	$id=$_POST['id'];
		
	$aa = insererCategorie($categorie);
	echo "$aa";
	
	header("Location: ../vue/generationFilm.php?id=".$id);

?>