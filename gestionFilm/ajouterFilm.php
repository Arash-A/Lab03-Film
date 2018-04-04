<?php
	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	require_once("../BD/param.php");
	require("../BD/connexion.inc.php");
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$realisateur=$_POST['realisateur'];
	$categorie=$_POST['categorie'];
	$prix=$_POST['prix'];
	$video=$_POST['video'];
	
	$id=$_POST['idd'];
	if (isset($_POST['publier'])) {
		$publier = $_POST['publier'];
	} else {
		$publier = 0;
	}
	
	if ($publier == null) {
		$publier = 0;
	}
	
	$link = $video;

	
	$dossier="../images/";
	$nomPochette=sha1($titre.time());
	
	$pochette="avatar.jpg";
	if($_FILES['pochette']['tmp_name']!==""){	
		//Upload de la photo	
		$tmp = $_FILES['pochette']['tmp_name'];	
		$fichier= $_FILES['pochette']['name'];	
		$extension=strrchr($fichier,'.');	
		@move_uploaded_file($tmp,$dossier.$nomPochette.$extension);	
		// Enlever le fichier temporaire chargé	
		@unlink($tmp); //effacer le fichier temporaire	
		$pochette=$nomPochette.$extension;	
		}

	
	//echo "$dossier.$nomPochette.$extension";
		echo "$publier";

	if($id==0) {
		$fm = new Film(0, $titre, $realisateur, $categorie, $duree, $prix, $pochette, $link, $publier);

		$aa = enregistre($fm);
	} else {
		$fm = new Film($id, $titre, $realisateur, $categorie, $duree, $prix, $pochette, $link, $publier);
		$aa = update($fm);
	}
		
//	var_dump($aa);
	
	header("Location: ../vue/gestionFilm.php");

?>