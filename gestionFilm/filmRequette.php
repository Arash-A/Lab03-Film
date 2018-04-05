<?php

//deleteFilm();

function ajouterFilm() {
	//require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$realisateur=$_POST['realisateur'];
	$categorie=$_POST['categorie'];
	$prix=$_POST['prix'];
	$url=$_POST['url'];;
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
	//require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$film = lireTous();
//	$titre = $film->getTitre();
//	print_r($film);
	echo json_encode($film);
}

function lireCateg() {
	//require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$categorie = lireCategorie();
	echo json_encode($categorie);
}

function rechercheId() {
	//require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
	}
	$film = rechercheParId($id);
	//var_dump($film);

	echo json_encode($film);
}

function miseAJourFilm() {
		//require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$titre=$_POST['titre'];
	$duree=$_POST['duree'];
	$realisateur=$_POST['realisateur'];
	$categorie=$_POST['categorie'];
	$prix=$_POST['prix'];
	$id=$_POST['idd'];
	$url=$_POST['url'];;
	$publier = 0;//$_POST['publier'];
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
	$fm = new Film($id, $titre, $realisateur, $categorie, $duree, $prix, $pochette, $url, $publier);

	$aa = update($fm);
		
	echo "$aa";
}

function lireParCateg() {
		//require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$idCategorie = $_GET['id'];
	$film = lireParCategorie($idCategorie);
//	$titre = $film->getTitre();
//	print_r($film);
	echo json_encode($film);
}

function deleteFilm() {
	//require_once("../dal/requetteFilm.php");
	require_once("../model/film.php");
	$id=$_GET['id'];

	$aa = supprimerParId($id);		
	echo JSON_encode($aa);
}

function ajouterPanier() {
	require_once("../model/film.php");
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
	}
	$film = rechercheParId($id);
	
	if (isset($_COOKIE['id_list'])) {
		$id_string = $_COOKIE['id_list'];
		$id_list = unserialize($id_string);
	} else {
		$id_list = array();
	}
	
	array_push($id_list, $film);
	$id_array = serialize($id_list);
	
	setcookie('id_list', $id_array, time()+36000, '/');
}

function lirePanier() {
	require_once("../model/film.php");
	if (isset($_COOKIE['id_list'])) {
		$id_string = $_COOKIE['id_list'];							
		$film = unserialize($id_string);							
	} else {							
		$film = array();							
	}
	echo json_encode($film);
}

function supprimerPanier() {
	$id=$_GET['id'];					
    
	if (isset($_COOKIE['id_list'])) {							
		$id_string = $_COOKIE['id_list'];							
		$film = unserialize($id_string);							
	} 

	for($i=0; $i<sizeof($film); $i++) {
		if ($film[$i][0]==$id) {
			unset($film[$i]);
		}
	}
	
	$film = array_values($film);
	$id_array = serialize($film);
	setcookie('id_list', $id_array, time()+36000, '/');
	
	echo json_encode($film);
}
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function enregistre($film) {
	require_once("../BD/connexion.inc.php");		
	$requette="INSERT INTO tabfilms VALUES(0,?,?,?,?,?,?,?,?)";
	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($film->getTitre(),$film->getRealisateur(),$film->getCategorie(),$film->getDuree(),$film->getPrix(),$film->getPochette(), $film->getVideo_link(), $film->getPublier()));
	$lastId = $connexion->lastInsertId();
	unset($connexion);
	unset($stmt);
	
	return "Film ".$lastId." bien enregistre";
}

function lireTous() {
	require_once("../BD/connexion.inc.php");
	$array = array();
	$requette="SELECT t.id, t.titre, t.realisateur, c.nom, t.duree, t.prix, t.pochette FROM tabfilms t, categorie c where t.categorie=c.id";

	try{
		 $stmt = $connexion->prepare($requette);
		 $stmt->execute();
		 while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
         $array[] = [$ligne->id, $ligne->titre, $ligne->realisateur, $ligne->nom, $ligne->duree, $ligne->prix, $ligne->pochette];
		 }
	 }catch (Exception $e){
		echo "Probleme pour lire tous les films";
	 }finally {
		unset($connexion);
		unset($stmt);
		return $array;
	 }
}

function lireParCategorie($categorieId) {
	require_once("../BD/connexion.inc.php");
	$array = array();
	$requette="SELECT t.id, t.titre, t.realisateur, c.nom, t.duree, t.prix, t.pochette FROM tabfilms t, categorie c where t.categorie=c.id and t.categorie=?";

	try{
		 $stmt = $connexion->prepare($requette);
		 $stmt->execute(array($categorieId));
		 while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
         $array[] = [$ligne->id, $ligne->titre, $ligne->realisateur, $ligne->nom, $ligne->duree, $ligne->prix, $ligne->pochette];
		 }
	 }catch (Exception $e){
		echo "Probleme pour lire tous les films";
	 }finally {
		unset($connexion);
		unset($stmt);
		return $array;
	 }
}

function rechercheParId($id) {
	require_once("../BD/connexion.inc.php");
	$requette="SELECT t.id, t.titre, t.realisateur, c.nom, t.duree, t.prix, t.pochette FROM tabfilms t, categorie c where t.categorie=c.id and t.id=?";

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($id));
	$ligne=$stmt->fetch(PDO::FETCH_OBJ);
	$film = [$ligne->id,$ligne->titre, $ligne->realisateur, $ligne->nom, $ligne->duree, $ligne->prix, $ligne->pochette];
	unset($connexion);
	unset($stmt);
	return $film;
}

function update($film) {
	require_once("../BD/connexion.inc.php");
	$requette="UPDATE tabfilms set titre=?,realisateur=?,categorie=?,duree=?,prix=?,pochette=?,video_link=?, publier=? WHERE id=?";;

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($film->getTitre(),$film->getRealisateur(),$film->getCategorie(),$film->getDuree(),$film->getPrix(),$film->getPochette(), $film->getVideo_link(), $film->getPublier(),$film->getId()));

	unset($connexion);
	unset($stmt);
	
	return "<br><b>LE FILM : ".$film->getId()." A ETE MODIFIE</b>";
}

function supprimerParId($id) {
	require_once("../BD/connexion.inc.php");
	$requette="DELETE FROM tabfilms WHERE id=?";

	$stmt = $connexion->prepare($requette);
	$stmt->execute(array($id));

	unset($connexion);
	unset($stmt);
	return "<br><b>LE FILM : ".$id." A ETE SUPPRIMEE</b>";
}

function lireCategorie() {
	require_once("../BD/connexion.inc.php");
	$array = array();
	$requette="SELECT * FROM categorie";

	try{
		 $stmt = $connexion->prepare($requette);
		 $stmt->execute();
		 while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
         $array[] = $ligne->nom;
		 }
	 }catch (Exception $e){
		echo "Probleme pour lire tous les catéories";
	 }finally {
		unset($connexion);
		unset($stmt);
		return $array;
	 }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////	
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
	case 'lireParCateg':
		lireParCateg();
		break;
	case 'lireCateg':
		lireCateg();
		break;
	case 'rechercheId':
		rechercheId();
		break;
	case 'miseAJourFilm':
		miseAJourFilm();
		break;
	case 'deleteFilm':
		deleteFilm();
		break;
	case 'ajouterPanier':
		ajouterPanier();
		break;
	case 'supprimerPanier':
		supprimerPanier();
		break;
	case 'lirePanier':
		lirePanier();
		break;
}
?>