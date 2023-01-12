<?php

class Commande {
    private $id;
    private $user_id;
    private $prod_prixTotal;
    private $date;


    public function __construct($user_id,$prod_prixTotal,$date)
    {
        $this->user_id= $user_id;
        $this->prod_prixTotal = $prod_prixTotal;
        $this->date = $date;
    }
    public function getid() { return $this->id; }
    public function getuser_id() { return $this->user_id; }
    public function getprod_prixTotal() { return $this->prod_prixTotal; }
    public function getdate() { return $this->date; }
    public function setid($com_id) { $this->id=$com_id; }
    public function setuser_id($unUser_id) { $this->user_id=$unUser_id; }
    public function setprod_prixTotal($unProd_prixTotal) { $this->prod_prixTotal=$unProd_prixTotal; }
    public function setdate($uneDate) { $this->date=$uneDate; }
}