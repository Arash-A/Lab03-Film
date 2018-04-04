<?php

class Film implements JsonSerializable {
	private $id;
	private $titre;
	private $realisateur;
	private $categorie;
	private $duree;
	private $prix;
	private $pochette;
	private $video_link;
	private $publier;
	
	function __construct($id, $titre, $realisateur, $categorie, $duree, $prix, $pochette, $video_link, $publier) {
		$this->setId($id);
		$this->setTitre($titre);
		$this->setRealisateur($realisateur);
		$this->setCategorie($categorie);
		$this->setDuree($duree);
		$this->setPrix($prix);
		$this->setPochette($pochette);
		$this->setVideo_link($video_link);
		$this->setPublier($publier);
	}
	
	function __destruct(){}
	
	public function jsonSerialize()
    {
        return [
            'Film' => [
                'id' => $this->id,
                'titre' => $this->titre,
				'realisateur' => $this->realisateur,
                'categorie' => $this->categorie,
                'duree' => $this->duree,
				'prix' => $this->prix,
                'pochette' => $this->pochette,
				'video_link' => $this->video_link,
            ]
        ];
    }
	
	function setVideo_link($video_link){
		$this->video_link = $video_link;
	}
	
	function getVideo_link(){
		return $this->video_link;
	}
	
	function setPublier($publier){
		$this->publier = $publier;
	}
	
	function getPublier(){
		return $this->publier;
	}
	
	function setId($id){
		$this->id = $id;
	}
	
	function getId(){
		return $this->id;
	}
	
	function setTitre($titre){
		$this->titre = $titre;
	}
	
	function getTitre(){
		return $this->titre;
	}
	
	function setRealisateur($realisateur){
		$this->realisateur = $realisateur;
	}
	
	function getRealisateur(){
		return $this->realisateur;
	}
	
	function setCategorie($categorie){
		$this->categorie = $categorie;
	}
	
	function getCategorie(){
		return $this->categorie;
	}
	
	function setDuree($duree){
		$this->duree= $duree;
	}
	
	function getDuree(){
		return $this->duree;
	}
	
	function setPrix($prix){
		$this->prix= $prix;
	}
	
	function getPrix(){
		return $this->prix;
	}
	
	function setPochette($pochette){
		$this->pochette= $pochette;
	}
	
	function getPochette(){
		return $this->pochette;
	}
}	

?>