<!---------------------------haut de page----------------------------------------->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
			<nav id="nav" class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="../index.php"><span class="glyphicon glyphicon-film" >FILMANIA</span></a>
					</div>
						<ul class="nav navbar-nav navbar-right">
								<?php
									if(isset($_SESSION['login'])){
										if($_SESSION['role']==1){
											echo '<li><a href="panier.php" id="myBtn1" ><span class="glyphicon glyphicon-shopping-cart"> Panier </span></a></li>';
										}else if($_SESSION['role']==0){
											echo '<li><a href="gestionFilm.php" id="myBtn2" ><span class="glyphicon glyphicon-wrench">Admin </span></a></li>';
											echo '<li></li>';
										}
										echo '<li><a href="deconnexion.php" id="myBtn3" ><span class="glyphicon glyphicon-log-out" ></span> Déconnecter</a></li>';
									}else{
										echo '<li><a href="inscription.php" id="myBtn4" ><span class="glyphicon glyphicon-user" ></span>inscription</a></li>';
										echo '<li></li>';
										echo '<li><a href="login.php" id="myBtn4" ><span class="glyphicon glyphicon-log-in" ></span>Connexion</a></li>';
									}
								?>
						</ul>						
				</div>
			</nav>
	 <!-------------------------------------------------------------------->

