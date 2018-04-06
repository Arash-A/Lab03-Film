<?php
	require_once("../includes/modele.inc.php");
	$tabRes=array();

	function enregistrer(){
		global $tabRes;	
 		$prenom=$_POST['prenomInscri'];
		$nom=$_POST['nomInscri'];
		$adress=$_POST['adresseInscri'];
		$courriel=$_POST['courrielInscri'];
		$mdp=$_POST['motdepasseInscri'];
		$hash = password_hash($mdp, PASSWORD_DEFAULT); 
		try{
  			$requete="SELECT * FROM users WHERE courriel = ? ";
			$unModele=new filmsModele($requete,array($courriel));
			$stmt=$unModele->executer();
			//$tabRes['msg']=$stmt->fetch(PDO::FETCH_OBJ);
			
			if($stmt->rowCount() > 0 ){ // si courriel existe
				$tabRes['action']="enregistrer";
				$tabRes['msg']="existe";
			}else{
					$requete=" INSERT INTO users VALUES(0,?,?,?,?,?,1) ";
					$unModele=new filmsModele($requete,array($nom,$prenom,$courriel,$hash,$adress));
					$unModele->executer();
 					$lasId=$unModele->LAST_ID;
					$tabRes['action']="enregistrer";
					$tabRes['msg']="ok";
			} 
		}catch(Exception $e){
			$tabRes['action']="enregistrer";
			$tabRes['msg']="erreur";
		}finally{
			unset($unModele);
		}
	}


	function connecter(){
		global $tabRes;	
 		$courriel=$_POST['courrielLogin'];
		$mdp=$_POST['motdepasseLogin'];
		try{
			$requete="SELECT * FROM users WHERE courriel = ? ";
			$unModele=new filmsModele($requete,array($courriel));
			$stmt=$unModele->executer();
			$tabRes['action']="connecter";
			//$tabRes['msg']=$stmt->fetch(PDO::FETCH_OBJ);
			
			 if($stmt->rowCount() > 0){ // si courriel existe
				$ligne=$stmt->fetch(PDO::FETCH_OBJ);
				$mdpDB=$ligne->mdp;
				$hash=password_verify($mdp,$mdpDB);
				$roleDB=$ligne->role;

				if ($hash) {
					$tabRes['msg']="ok";
					$_SESSION['courriel']=$courriel;
					
					if ($roleDB == 1) {
						$tabRes['role']="utilisateur";
						$_SESSION['role']="utilisateur";
					} else {
						$tabRes['role']="admin";
						$_SESSION['role']="admin";
					} 
				} else {
					$tabRes['msg']="mdpIncorrecte";
				}
			}else{
					$tabRes['msg']="nonInscrit";
			} 
		}catch(Exception $e){
			$tabRes['msg']="erreur";
		}finally{
			unset($unModele);
		}
	}

	function monProfile(){
		global $tabRes;
		$tabRes['action']="monProfile";
		if (isset($_SESSION['role'])) {
			$id=$_SESSION['idConnexion'];
			$tabRes['msg']="ok";

			if ($_SESSION['role']=="admin") {
				$requete="SELECT courriel FROM connexion WHERE idConnexion = ? ";
				$unModele=new filmsModele($requete,array($id));
				$stmt=$unModele->executer();
				$ligne=$stmt->fetch(PDO::FETCH_OBJ);
				$tabRes['courriel']=$ligne->courriel; 
				$tabRes['msg']="vous etes admin";
			} else {
				$tabRes['msg']="OK";
				try{
					$requete="SELECT courriel FROM connexion WHERE idConnexion = ? ";
					$unModele=new filmsModele($requete,array($id));
					$stmt=$unModele->executer();
					$ligne=$stmt->fetch(PDO::FETCH_OBJ);
					$tabRes['courriel']=$ligne->courriel; 

					$requete="SELECT * FROM utilisateur WHERE idConnexion = ? ";
					$unModele=new filmsModele($requete,array($id));
					$stmt=$unModele->executer();
					$ligne=$stmt->fetch(PDO::FETCH_OBJ);
					$tabRes['utilisateurs']=array();
					$tabRes['utilisateurs']=$ligne;
				}catch(Exception $e){
					$tabRes['msg']="NON";
				}finally{
					unset($unModele);
				}
			}
		}else{
			$tabRes['msg']="nonTrouve";
		}
	}
	function lister(){
		global $tabRes;
		$tabRes['action']="liste";
		if (isset($_SESSION['idConnexion'])) {
			$id=$_SESSION['idConnexion'];
			$tabRes['msg']="ok";
			
			try{
				$requete="SELECT courriel FROM connexion WHERE idConnexion = ? ";
				$unModele=new filmsModele($requete,array($id));
				$stmt=$unModele->executer();
				$ligne=$stmt->fetch(PDO::FETCH_OBJ);
				$tabRes['courriel']=$ligne->courriel;
				
				$requete="SELECT * FROM utilisateur WHERE idConnexion = ? ";
				$unModele=new filmsModele($requete,array($id));
				$stmt=$unModele->executer();
				$ligne=$stmt->fetch(PDO::FETCH_OBJ);
				$tabRes['utilisateurs']=array();
				$tabRes['utilisateurs']=$ligne;
			}catch(Exception $e){
			}finally{
				unset($unModele);
			}
		}else{
			$tabRes['msg']="nonTrouve";
		}
	}


	function deconnecter(){
		global $tabRes;
		$tabRes['action']="deconnecter";
		if (isset($_SESSION['courriel'])) {
			
			$_SESSION['courriel']==null;
			$_SESSION['role']=null;
			
			session_unset();
			$tabRes['msg']="ok";
		}else{
			$tabRes['msg']="non";
		}
	}
	function estConnecter(){
		global $tabRes;
		$tabRes['action']="estConnecter";
		if (isset($_SESSION['idConnexion'])) {
			$tabRes['msg']="ok";
			if ($_SESSION['role']=="admin") {
				$tabRes['role']="admin";
			}else{
				if(isset($_SESSION["shopping_cart"]))  
				{  
					$count = count($_SESSION["shopping_cart"]);  
					$tabRes['itemCount']= $count;	
				}   
				 
				$tabRes['role']="utilisateur";
			}
		}else{
			$tabRes['msg']="non";
		}
	}

	//******************************************************
	//Contr�leur
	$action=$_POST['action'];
	session_start ();
	switch($action){
		case "enregistrer" :
			enregistrer();
		break;
		case "connecter" :
			connecter();
		break;
		case "monProfile" :
			monProfile();
		break;
		case "deconnecter" :
			deconnecter();
		break;
		case "liste" :
			lister();
		break;
		case "estConnecter" :
			estConnecter();
		break;
	}
    echo json_encode($tabRes); // json_encode --> Retourne la représentation JSON d'une valeur 
?>