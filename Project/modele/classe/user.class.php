<?php
class User {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $usertype;


    public function __construct($id,$nom,$prenom,$email,$password,$usertype)
    {
        $this->id = $id;
        $this->nom= $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->usertype = $usertype;

    }
    // Accesseurs et mutateurs
    public function getid() { return $this->id; }
    public function getnom() { return $this->nom; }
    public function getprenom() { return $this->prenom; }
    public function getemail() { return $this->email; }
    public function getpassword() { return $this->password; }
    public function getusertype() {return $this->usertype;}
    public function setnom($unNom) { $this->nom=$unNom; }
    public function setprenom($unPrenom) { $this->prenom=$unPrenom; }
    public function setemail($unEmail) { $this->email=$unEmail; }
    public function setpassword($unPassword) { $this->password=$unPassword; }
    public function setusertype($unUsertype) {$this->usertype=$unUsertype;}
}
