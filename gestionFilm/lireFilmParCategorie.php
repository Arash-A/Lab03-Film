<?php

	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$idCategorie = $_GET['id'];
	$film = lireParCategorie($idCategorie);
//	$titre = $film->getTitre();
//	print_r($film);
	echo json_encode($film);


?>