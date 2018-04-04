<?php
session_start ();
 require_once ("../BD/param.php");
 require("../BD/connexion.inc.php");
if(isset($_POST['submit']))
	{
	$nom=$_POST['nomInscri'];
	$prenom=$_POST['prenomInscri'];
	$adresse=$_POST['adresseInscri'];
	$courriel=$_POST['courrielInscri'];
	$mdp=$_POST['motdepasseInscri'];
	$role=1;
	$hash = password_hash($mdp, PASSWORD_DEFAULT);

	$checkCourriel="SELECT * FROM users WHERE courriel = ?";
	$check = $connexion->prepare($checkCourriel);
	$check->execute(array($courriel));
	
	if($check->rowCount() > 0 ){
		$_SESSION['errmsg']="<div class='alert alert-danger'>Ce courriel est deja enregistre";
	}else{
		$requette="INSERT INTO users VALUES(0,?,?,?,?,?,?)";
		$stmt = $connexion->prepare($requette);
		$stmt->execute(array($nom,$prenom,$courriel,$hash,$adresse,$role));
		$lastId = $connexion->lastInsertId();
		$_SESSION['errmsg']="<div class='alert alert-success'>Vous êtes maintenant inscrit , vous pouvez vous connecter";
		unset($connexion);
		unset($stmt);
	}}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>Filmania</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrapValidator.css">
<link rel="stylesheet" type="text/css" href="../css/films.css">
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.validate.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script src="../js/film.js"></script>
<script>
function valider(){
	var pass=document.inscriptionF.motdepasseInscri.value;
	var cpass=document.inscriptionF.motdepasseConfirm.value;
	var courriel=document.inscriptionF.courrielInscri.value;
	var expReg_pass = /^[a-zA-Z0-9]{6,10}$/;
	var expReg_courriel = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,3}$/;
	
	var etat=true;
	
	if (pass != cpass){
		alert('veuillez confirmer le mot de passe');
	etat=false;
	return etat;
	}
		if (!expReg_pass.test(pass)){
		alert('veuillez entrez un mot de passe plus forte');
	etat=false;
	return etat;
	}
	
	if(!expReg_courriel.test(courriel)){
		alert('votre adresse de courriel nest correcte');
	etat=false;
	return etat;
	}
	return etat;
}

</script>
</head>
<body>
	
		<!-- ============================================== HEADER ============================================== -->	
			<?php
			include('headerVue.php');
			?>
		<!--===================================================================================================== -->
		<div class="container"> 
		<div class="form-group well" id="inscription">
		<h4><a href="../index.php" id="myBtn2" ><span class="glyphicon glyphicon-circle-arrow-left">Retour </span></a></h4>
			<form id="inscriptionF" method="post" name="inscriptionF" onsubmit="return valider()" >
				<fieldset>
					<legend>INSCRIPTION</legend>
					<?php
						if(isset($_SESSION['errmsg'])){
						if($_SESSION['errmsg']!==""){
							echo $_SESSION['errmsg'];
							echo "</div>";
						}}
					?>
					<?php
						echo $_SESSION['errmsg']="";
					?>
					<div class="form-group" >
						<label for="nomInscri">Nom</label> <input type="text"
							class="form-control" id="nomInscri" name="nomInscri"
							aria-describedby="emailHelp" placeholder="votre nom" required>
					</div>
					<div class="form-group">
						<label for="prenomInscri">Prénom</label> <input type="text"
							class="form-control" id="prenomInscri" name="prenomInscri"
							placeholder="votre prénom">
					</div>
					<div class="form-group">
						<label for="courrielInscri">Courriel</label> <input type="email"
							class="form-control" id="courrielInscri" name="courrielInscri"
							aria-describedby="emailHelp" placeholder="votre courriel" required>
					</div>
					<div class="form-group">
						<label for="adresseInscri">Adresse</label> <input type="text"
							class="form-control" id="adresseInscri" name="adresseInscri"
							aria-describedby="emailHelp" placeholder="votre adresse" required>
					</div>
					<div class="form-group">
						<label for="motdepasseInscri">Mot de passe</label> <input
							type="password" class="form-control" id="motdepasseInscri"
							name="motdepasseInscri" placeholder="Mot de passe" required>
					</div>
					<div class="form-group">
						<label for="motdepasseConfirm">Confirmation de mot de
							passe</label> <input type="password" class="form-control"
							id="motdepasseConfirm" name="motdepasseConfirm"
							placeholder="Mot de passe" required onkeyup ="validatePassword()">
					</div>
					<button type="submit" id="btnNouveauUser" class="btn btn-primary" name="submit">S'inscrire</button>
				</fieldset>
			</form>
		</div>
		</div>
		<footer id="footer" class="copyright  col-md-12">
			      <p>© 2018 - Maisonneuve</p>
	     </footer> 
				
	</body>

</html>