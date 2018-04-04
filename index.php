<?php
session_start ();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Filmania</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/films.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-1.10.2.min.js"></script>
		<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" rel="stylesheet" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
		<script src="js/jquery.youtubepopup.min.js"></script>
		<script src="js/jquery.validate.js"></script>
		<script src="js/film.js"></script>
		<script src="js/popper.js"></script>
		<script src="js/bootstrap.js"></script>
	</head>
		<script>
		function ajoutee(){
			alert("votre film va être ajouté à votre panier");
		}
		</script>
	
	<body>
	
		<!-- ============================================== HEADER ============================================== -->	
			<?php
			include('vue/headerIndex.php');
			?>

	 <!------------------------------MENU-------------------------------->	 
			<div id="container" class="container"> 

				<div id="menu" class="col-md-2 col-md-3">
					<h4>Catégorie</h4>
					  <ul id="categorieMenu" class="nav nav-pills nav-stacked">
							<?php
								if (isset($_GET['categorie'])) {
									$id_categorie = $_GET['categorie'];
								}else {
									$id_categorie = 0;
								}
								require_once("./dal/requetteFilm.php");	
								require_once("./model/film.php");
								require_once("./BD/param.php");
								require("./BD/connexion.inc.php");
								$categorie = lireCategorie();
								require("./BD/connexion.inc.php");
								
								if ($id_categorie == 0) {
									$film = lireTous();
									echo "<li class='active'><a href='index.php?categorie=0'>Tous les films</a></li>"; 
								} else {
									$film = lireParCategorie($id_categorie);
									echo "<li><a href='index.php?categorie=0'>Tous les films</a></li>"; 
								}
								for($i=0; $i<sizeof($categorie); $i++) {	
									$p=$i+1;
									if ($id_categorie == $p) {
										echo "<li class='active'><a href='index.php?categorie=$p'>$categorie[$i]</a></li>";  
									} else {
										echo "<li><a href='index.php?categorie=$p'>$categorie[$i]</a></li>"; 
									}
								}							
							?>
					  </ul>
				</div>
				<div id="main" class="col-md-10 col-md-9">
					<div class="well" id="films">
					
					
						<?php
							for($i=0; $i<sizeof($film); $i++) {
								if ($film[$i][8]==1) {
						    	echo '<div class="col-xs-3 col-sm-3 col-md-3" >';
								echo '<div class="card card-cascade" style="max-width:180px;">';
								echo '<h5 class="card-title text-center">';
                            	//echo '<a href="images/1.jpe" target="_blank">';
								echo '<p class="card-text"><b>'.$film[$i][1].'</b></p>';
								//echo '</a>';
								echo '</h5>';
								echo '<div class="page text-center">';
								echo '<p><a class="youtube" href="'.$film[$i][7].'" title="voir la bande-annonce" >';
								echo '<img class="card-img-top view overlay" src="images/'.$film[$i][6].'" alt="Card image cap" width=100 height=140></a></p>';
								//echo '<div class="popup" id="media-popup">';
								// echo '<iframe width="560" height="315" src="'.$film[$i][7].'" frameborder="0" allowfullscreen></iframe>';
								//echo '</div>';
								echo '</div>';
							
								echo '<div class="card-footer text-center">';
								echo '<p class="card-text"><b>'.$film[$i][2].'</b></p>';
								echo '<p class="card-text">Prix:'.$film[$i][5].'$&nbsp&nbsp&nbsp&nbsp';
								if(isset($_SESSION['login'])){
									if($_SESSION['role']==1){
								echo '<a href="gestionFilm/ajouterAuPanier.php?id='.$film[$i][0].'&titre='.$film[$i][1].'&realisateur='.$film[$i][2].'&categorie='.$film[$i][3].'&pochette='.$film[$i][6].'&prix='.$film[$i][5].'" onclick="ajoutee()"">';
								echo '<span class="glyphicon glyphicon-shopping-cart" title="ajouter au panier"></span></a></p>';
									}
								}
								echo '</div>';
								echo '</div>';
								echo '</div>'; 	
								}
							}					
						?>
				</div>
			</div>

	        			
		
	        <footer id="footer" class="copyright  col-md-12">
			      <p>© 2018 - Maisonneuve</p>
	        </footer> 
	</body>
			<script type="text/javascript">
			 $(function () {
				 $("a.youtube").YouTubePopup({ autoplay: 1 });
			 });
		</script>
</html>