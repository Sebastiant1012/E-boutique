<?php
class Usertype {
    private $id;
    private $nom;



    public function __construct($id,$nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }
    public function getnom() { return $this->nom; }
    public function getid() { return $this->id; }
    public function setnom($unNom) { $this->nom=$unNom; }
}
