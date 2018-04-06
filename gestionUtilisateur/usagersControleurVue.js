
function InscritUsager(reponse) {
    var msg = document.getElementById('errenr');
    //debugger;
    if (reponse.msg == "ok") {
        msg.innerHTML = "Merci pour vous inscrire chez nous ! vous pouvez maintenant vous connecter";
        msg.className = "text-success";
        document.getElementById('inscriptionF').reset();
    } else if (reponse.msg == "existe") {
        msg.innerHTML = "L'utilisateur avec ce courriel déja existe";
        msg.className = "text-danger";
        document.getElementById('inscriptionF').reset();
    } else if (reponse.msg == "erreur") {
        msg.innerHTML = "Il y a un probléme d'inscription , veuillez commncer à nouveau";
        msg.className = "text-danger";
        document.getElementById('inscriptionF').reset();
    }

}

function seConnecter(reponse) {
    var msg = document.getElementById('errConn');
    //debugger;
    if (reponse.msg == "ok") {
        toutHide();
        $('#connexionBtn').addClass("hide").removeClass("show");
        $('#inscriptionBtn').addClass("hide").removeClass("show");
        $('#deConnexionBtn').addClass("show").removeClass("hide");
        
        if (reponse.role == "admin") {
            $('#gestion').addClass("show").removeClass("hide");
            $('#gestionFilm').addClass("show").removeClass("hide");
        } else {
            $('#main').addClass("show").removeClass("hide");
            $('#menu').addClass("show").removeClass("hide");
            $('#myBtn1').addClass("show").removeClass("hide");
        }

    } else if (reponse.msg == "mdpIncorrecte") {
        msg.innerHTML = "Votre mot de passe est incorrecte";
        msg.className = "text-danger";
    } else if (reponse.msg == "nonInscrit") {
        msg.innerHTML = "Ce courriel n'est pas encore inscrit dans le système , veuillez vous inscrire";
        msg.className = "text-danger";
    }

}

function deconnexion(reponse) {
    if (reponse.msg == "ok") {
        //alert("deconnexion complète");
        location.reload(true);
    } else {
        alert("problème au moment de déconnexion");
    }
}
function monProfileUs(reponse) {
    if (reponse.msg == "OK") {
        var Usager=reponse.utilisateurs;
        
        $("#inputPrenomModif").attr("placeholder",Usager.prenom);
        $("#inputNomModif").attr("placeholder",Usager.nom);
        $("#inputDateNaissanceModif").attr("value",Usager.dateNaissance);
        $("#inputCourModif").attr("placeholder",reponse.courriel);
    } else {
        alert("problème de trouve votre profil");
    }
}

function connecterValide(reponse) {
    if (reponse.msg == "ok") {
        $('#navDeconnexion').removeClass("hide");
        $('#navEnregistrement').addClass("hide");
        $('#navConnexion').addClass("hide");
        if (reponse.role == "admin") {
            $('#navConnecteAdmin').removeClass("hide");
        } else {
            $('#navPanier').removeClass("hide");
            $('#monProfile').removeClass("hide");
                    if (reponse.itemCount) {
                        $('#nbItemPanier').text("(" + reponse.itemCount + ")");
                    } else {
                        $('#nbItemPanier').text("(1)");
                    }
        }
    } else {

    }
}

// ********************** selon l'action, on appelle la méthode concerné *******************
var usagersVue = function(reponse) {
    var action = reponse.action;
    switch (action) {
        case "enregistrer":
            InscritUsager(reponse);
            break;
        case "connecter":
            seConnecter(reponse);
            break;
        case "monProfile":
            monProfileUs(reponse);
            break;
        case "deconnecter":
            deconnexion(reponse);
            break;
        case "fiche":
            afficherFiche(reponse);
            break;
        case "estConnecter":
            connecterValide(reponse);
            break;

    }
}