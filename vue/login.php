<?php
session_start ();
require_once ("../BD/param.php");
require("../BD/connexion.inc.php");


if(isset($_POST['submit']))
	{

	$courriel = $_POST['courrielLogin'];
	$mdp = $_POST['motdepasseLogin'];
	
	$requette = "SELECT * FROM users where courriel=?";
	
	$stmt = $connexion->prepare ( $requette );
	$stmt->execute(array($courriel));
	
	if($stmt->rowCount() == 0) {
		echo "<script>alert('Ce courriel n'est pas encore enregistre');</script>";
	}
	
	$ligne = $stmt->fetch ( PDO::FETCH_OBJ );
	
	$hash = $ligne->mdp;
	$role = $ligne->role;
	$id = $ligne->id;
	$nom = $ligne->nom;
	
	$reussite = password_verify ( $mdp, $hash );
	
	unset ( $connexion );
	unset ( $stmt );
	if ($reussite) {
		$_SESSION['login'] = $courriel;
		$_SESSION['id'] = $id;
		$_SESSION['nom'] = $nom;
		$_SESSION['role'] = $role;

		header ( "Location:../index.php" );
	} else {
		$_SESSION ['errmsg'] = "Courriel ou mot de passe invalide";
	}
}
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
</head>
<body>
		<!-- ============================================== HEADER ============================================== -->	
			<?php
			include('headerVue.php');
			?>

	 <!------------------------------MENU-------------------------------->							
			<div id="container" class="container"> 
		<div class="form-group well" id="login">
		<h4><a href="../index.php" id="myBtn2" ><span class="glyphicon glyphicon-circle-arrow-left">Retour</span></a></h4>
			<form id="loginF" method="POST" onSubmit="return validerConnexion();">
				<fieldset>
					<legend>CONNEXION</legend>
					<?php
					if(isset($_SESSION['errmsg'])){
					if($_SESSION['errmsg']!==""){
						echo "<div class='alert alert-danger'>";
						echo $_SESSION['errmsg'];
						echo "</div>";
					}}
					?>
					<?php
						echo $_SESSION['errmsg']="";
					?>
					<div class="form-group">
						</span> <label for="courrielLogin">Courriel</label> 
						<input type="email" class="form-control" id="courrielLogin"
							name="courrielLogin" aria-describedby="emailHelp"
							placeholder="votre courriel">
					</div>
					<div class="form-group">
						<label for="motdepasseLogin">Mot de passe</label> 
						<input type="password" class="form-control" id="motdepasseLogin"
							name="motdepasseLogin" placeholder="Mot de passe">
					</div>
					<button type="submit" id="btnLogin" class="btn btn-primary"
						name="submit">Se connecter</button>
					<br /> <br />
				</fieldset>
			</form>
			<p>
				Pas encore un membre?
				<a href="inscription.php" id="inscriptionBtn" class="navbtn" >
				S'inscrire
				</button>
			</p>

		</div>


		<footer id="footer" class="copyright  col-md-12">
			<p>© 2018 - Maisonneuve</p>
		</footer>
	</div>
</body>
</html>