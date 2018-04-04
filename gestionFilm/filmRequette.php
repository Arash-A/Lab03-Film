<?php
function ajouterFilm() {
	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$realisateur=$_POST['realisateur'];
	$categorie=$_POST['categorie'];
	$prix=$_POST['prix'];
	$url="";
	$publier = 0;
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
	$fm = new Film(0, $titre, $realisateur, $categorie, $duree, $prix, $pochette, $url, $publier);

	$aa = enregistre($fm);
		
	echo "$aa";	
}

function lire() {
	require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$film = lireTous();
//	$titre = $film->getTitre();
//	print_r($film);
	echo json_encode($film);
}

	if (isset($_GET["op"])) {
		$op = $_GET["op"];
	} else if (isset($_POST["op"])){
		$op = $_POST["op"];
	}
//echo json_encode($op);
switch ($op) {
	case 'ajouterFilm':
		ajouterFilm();
		break;
	case 'lire':
		lire();
		break;
	case 'lire':
		lire();
		break;
}
?>