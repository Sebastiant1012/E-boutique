<?php
class Produit {
    private $id;
    private $cat;
    private $nom;
    private $desc;
    private $image;
    private $prix;


    public function __construct($id,$cat,$nom,$desc,$image,$prix)
    {
        $this->id = $id;
        $this->cat = $cat;
        $this->nom = $nom;
        $this->desc = $desc;
        $this->image = $image;
        $this->prix = $prix;

    }
    public function getid() { return $this->id; }
    public function getcat() { return $this->cat; }
    public function getnom() { return $this->nom; }
    public function getdesc() { return $this->desc; }
    public function getimage() { return $this->image; }
    public function getprix() { return $this->prix; }
    public function setcat($uneCat) { $this->cat=$uneCat; }
    public function setnom($unNom) { $this->nom=$unNom; }
    public function setdesc($uneDesc) { $this->desc=$uneDesc; }
    public function setimage($unImage) { $this->image=$unImage; }
    public function setprix($unPrix) { $this->prix=$unPrix; }
}


