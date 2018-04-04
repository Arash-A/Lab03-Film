<?php

	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
	}
	$film = rechercheParId($id);
	//var_dump($film);

	echo json_encode($film);


?>