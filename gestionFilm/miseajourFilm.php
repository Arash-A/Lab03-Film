<?php
	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$realisateur=$_POST['realisateur'];
	$categorie=$_POST['categorie'];
	$prix=$_POST['prix'];
	$id=$_POST['idd'];
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
	$fm = new Film($id, $titre, $realisateur, $categorie, $duree, $prix, $pochette);

	$aa = update($fm);
		
	echo "$aa";
	
	//echo "$prix";
	

	


?>