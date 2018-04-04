
function traiter() {				
	alert("aaa");					
	$.post("gestionFilm/ajouter.php", $("#nouveauF").serialize(), function(data) {	
		alert(data);		
	});

}


function filmCard($film) {
}

