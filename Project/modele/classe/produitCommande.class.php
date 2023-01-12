<?php
class ProduitCommande {
    private $com_id;
    private $prod_id;
    private $prod_qty;
    private $prod_prix;


    public function __construct($com_id,$prod_id,$prod_qty,$prod_prix)
    {
        $this->com_id = $com_id;
        $this->prod_id = $prod_id;
        $this->prod_qty = $prod_qty;
        $this->prod_prix = $prod_prix;


    }
    public function getcom_id() { return $this->com_id; }
    public function getprod_id() { return $this->prod_id; }
    public function getprod_qty() { return $this->prod_qty; }
    public function getprod_prix() { return $this->prod_prix; }
    public function setcom_id($unCom_id) { $this->com_id=$unCom_id; }
    public function setprod_id($unProd_id) { $this->prod_id=$unProd_id; }
    public function setprod_qty($unProd_qty) { $this->prod_qty=$unProd_qty; }
    public function setprod_prix($unProd_prix) { $this->prod_prix=$unProd_prix; }
}
