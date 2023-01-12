<?php
class Categorie {
    private $id;
    private $titre;



    public function __construct($id,$titre)
    {
        $this->id = $id;
        $this->titre = $titre;
    }
    public function gettitre() { return $this->titre; }
    public function getid() { return $this->id; }
    public function settitre($unTitre) { $this->titre=$unTitre; }
}
