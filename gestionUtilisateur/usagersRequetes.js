/* requette qui concerne des utilissateurs */
/* 
function checkLoginState() {
	FB.getLoginStatus(function(response) {
	  statusChangeCallback(response);
	});
  } */

function enregUsager(){
	alert(1111);
	var formUsager = new FormData(document.getElementById('inscriptionF'));
	formUsager.append('action','enregistrer');
	$.ajax({
		type : 'POST',
		url : 'gestionUtilisateur/usagersControleur.php',
		data : formUsager,
		dataType : 'text', //text pour le voir en format de string
		contentType : false,
		processData : false,
		success : function (reponse){ alert(reponse);
			//usagersVue(reponse); //appel de fonction javascript dans usagersControleurVue.js
		},
		fail : function (err){
			alert(1111);
		}
	});  
}

function connUsager(){
	var formconnexion = new FormData(document.getElementById('formConn'));
	formconnexion.append('action','connecter');
	$.ajax({
		type : 'POST',
		url : 'gestionUtilisateur/usagersControleur.php',
		data : formconnexion,
		/* async : false, */
 		contentType : false,
		processData : false, 
		dataType : 'json', //text pour le voir en format de string
		success : function (reponse){//alert(reponse);
				usagersVue(reponse);
		},
		fail : function (err){
			alert("1111");
		}
	});
}

function monProfile(){
	var formProfile = new FormData();
	formProfile.append('action','monProfile');
	$.ajax({
		type : 'POST',
		url : 'gestionUtilisateur/usagersControleur.php',
		data : formProfile,
		contentType : false, 
		processData : false,
		dataType : 'json', 
		success : function (reponse){//alert(reponse);
					//$('#divFormFiche').hide();
					$('#monProf').removeClass("hide");
					$('#carouselExampleIndicators').addClass("hide").removeClass("show");
					$('#landing').addClass("hide").removeClass("show");
					$('#map').addClass("hide").removeClass("show");
					$('#consulterCircuitsContainer').addClass("hide").removeClass("show");
					$('#lesCards').addClass("hide").removeClass("show");
					usagersVue(reponse);
		},
		fail : function (err){
		}
	});
} 

function deconnecter(){
	var formdeconnexion = new FormData();
	formdeconnexion.append('action','deconnecter');
	$.ajax({
		type : 'POST',
		url : 'gestionUtilisateur/usagersControleur.php',
		data : formdeconnexion,
		/* async : false, */
		contentType : false, 
		processData : false,
		dataType : 'json', 
		success : function (reponse){//alert(reponse);
					usagersVue(reponse); 
		},
		fail : function (err){
		}
	});
} 

function estConnecte(){
	var formdeconnexion = new FormData();
	formdeconnexion.append('action','estConnecter');
	$.ajax({
		type : 'POST',
		url : 'gestionUtilisateur/usagersControleur.php',
		data : formdeconnexion,
		/* async : false, */
		contentType : false, 
		processData : false,
		dataType : 'json', 
		success : function (reponse){//alert(reponse);
					usagersVue(reponse); 
		},
		fail : function (err){
		}
	});
} 

function modifierProf(){
 $("#monProf").addClass("hide");
 $('#carouselExampleIndicators').addClass("show").removeClass("hide");
    $('#landing').addClass("show").removeClass("hide");
    $('#map').addClass("show").removeClass("hide");
    $('#consulterCircuitsContainer').addClass("show").removeClass("hide");
    $('#lesCards').addClass("show").removeClass("hide");
}