<?php

class Utilisateur implements JsonSerializable {
	private $id;
	private $nom;
	private $premon;
	private $courriel;
	private $mdp;
	private $adresse;
	private $role;
	
	function __construct($id, $nom, $prenom, $courriel, $mdp, $adresse, $role) {
		$this->setId($id);		
		$this->setNom($nom);
		$this->setPrenom($prenom);
		$this->setCourriel($courriel);
		$this->setMdp($mdp);
		$this->setAdresse($adresse);
		$this->setRole($role);
	}
	
	function __destruct(){}
	
	public function jsonSerialize(){
        return [
            'Utilisateur' => [
                'id' => $this->id,
                'nom' => $this->nom,
				'prenom' => $this->prenom,
                'courriel' => $this->courriel,
                'adresse' => $this->adresse,
				'role' => $this->role		
            ]
        ];
    }
		
	function setId($id){
		$this->id = $id;
	}
	
	function getId(){
		return $this->id;
	}
	
	function setNom($nom){
		$this->nom = $nom;
	}
	
	function getNom(){
		return $this->nom;
	}
	
	function setPrenom($prenom){
		$this->prenom = $prenom;
	}
	
	function getPreom(){
		return $this->prenom;
	}
	
	function setCourriel($courriel){
		$this->courriel = $courriel;
	}
	
	function getCourriel(){
		return $this->courriel;
	}
	
	function setMdp($mdp){
		$this->mdp= $mdp;
	}
	
	function getMdp(){
		return $this->mdp;
	}
	
	function setAdresse($adresse){
		$this->adresse= $adresse;
	}
	
	function getAdresse(){
		return $this->adresse;
	}
	
	function setRole($role){
		$this->role= $role;
	}
	
	function getRole(){
		return $this->role;
	}
}	

?>