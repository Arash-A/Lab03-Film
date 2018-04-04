<?php

	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$film = lireTous();
//	$titre = $film->getTitre();
//	print_r($film);
	echo json_encode($film);


?>