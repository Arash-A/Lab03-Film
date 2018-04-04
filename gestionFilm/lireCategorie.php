<?php

	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$categorie = lireCategorie();
	echo json_encode($categorie);
//	var_dump($categorie);

?>