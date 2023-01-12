<?php

$dossierBase = $_SERVER['DOCUMENT_ROOT']."ProjetEquipe/";
require_once($dossierBase.'modele/dao/ConnectionDB.class.php');
require_once($dossierBase.'modele/dao/dao.interface.php');
require_once($dossierBase.'modele/classe/produitCommande.class.php');

class ProduitCommandeDAO implements DAO
{
    public static function chercher($cles)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $produit = null;
        $requete = $connection->prepare("select * from produit_commande where com_id = ? and prod_id = ?");
        $requete->execute(array($cles));
        if($requete->rowCount()>0)
        {
            $tab = $requete->fetch();
            $produit = new ProduitCommande($tab['com_id'],$tab['prod_id'],
                                    $tab['prod_qty'],$tab['prod_prix']);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $produit;
    }
    public static function chercherTous()
    {
        return self::chercherFiltre("");
    }
    public static function chercherFiltre($filtre)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $liste = array();
        $requete = $connection->prepare("select * from produit_commande ".$filtre);
        $requete->execute();
        foreach($requete as $tab)
        {
            $produit = new ProduitCommande($tab['com_id'],$tab['prod_id'],
                                            $tab['prod_qty'],$tab['prod_prix']);

            array_push($liste,$produit);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $liste;
    }
    public static function inserer($unProduitCommande)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "insert into produit_commande (com_id,prod_id,prod_qty,prod_prix)";
        $commandeSQL .="values(?,?,?,?)";
        $tab =array($unProduitCommande->getcom_id(),$unProduitCommande->getprod_id(),
                    $unProduitCommande->getprod_qty(),$unProduitCommande->getprod_prix());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function modifier($unProduitCommande)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "update produit_commande set prod_qty=?,prod_prix=? where com_id=? and prod_id=?";       
        $tab =array($unProduitCommande->getprod_qty(),$unProduitCommande->getprod_prix(),
                    $unProduitCommande->getcom_id(),$unProduitCommande->getprod_id());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function supprimer($unProduitCommande)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "delete from produit_commande where com_id=? and prod_id=?";       
        $tab =array($unProduitCommande->getgetcom_id(),$unProduitCommande->getprod_id());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
}