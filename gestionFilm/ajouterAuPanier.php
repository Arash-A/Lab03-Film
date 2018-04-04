<?php
	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	require_once("../BD/param.php");
	require("../BD/connexion.inc.php");

//	$cookie_name = 'id_list';
//	unset($_COOKIE[$cookie_name]);
	// empty value and expiration one hour before
//	$res = setcookie($cookie_name, '', time() - 3600);
	
	
	
	$id=$_GET['id'];
	$titre=$_GET['titre'];
	$realisateur=$_GET['realisateur'];
	$categorie=$_GET['categorie'];
	$pochette=$_GET['pochette'];
	$prix=$_GET['prix'];
	
	$film_temp = array($id, $titre, $realisateur, $categorie, $pochette, $prix);

	if (isset($_COOKIE['id_list'])) {
		$id_string = $_COOKIE['id_list'];
		$id_list = unserialize($id_string);
	} else {
		$id_list = array();
	}
	
	array_push($id_list, $film_temp);
	$id_array = serialize($id_list);
	
	setcookie('id_list', $id_array, time()+36000, '/');
	
	header("Location: ../index.php");

?>
