<?php

$dossierBase = $_SERVER['DOCUMENT_ROOT']."ProjetEquipe/";
require_once($dossierBase.'modele/dao/ConnectionDB.class.php');
require_once($dossierBase.'modele/dao/dao.interface.php');
require_once($dossierBase.'modele/classe/produit.class.php');

class ProduitDAO implements DAO
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
        $requete = $connection->prepare("select * from produits where prod_id = ?");
        $requete->execute(array($cles));
        if($requete->rowCount()>0)
        {
            $tab = $requete->fetch();
            $produit = new Produit($tab['prod_id'],$tab['prod_cat'],
                                    $tab['prod_nom'],$tab['prod_desc'],
                                    $tab['prod_image'],$tab['prod_prix']);
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
        $requete = $connection->prepare("select * from produits ".$filtre);
        $requete->execute();
        foreach($requete as $tab)
        {
            $produit = new Produit($tab['prod_id'],$tab['prod_cat'],
                                    $tab['prod_nom'],$tab['prod_desc'],
                                    $tab['prod_image'],$tab['prod_prix']);

            array_push($liste,$produit);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $liste;
    }
    public static function inserer($unProduit)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "insert into produits (prod_cat,prod_nom,prod_desc,prod_image,prod_prix)";
        $commandeSQL .="values(?,?,?,?,?)";
        $tab =array($unProduit->getcat(),
                    $unProduit->getnom(),$unProduit->getdesc(),
                    $unProduit->getimage(),$unProduit->getprix());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function modifier($unProduit)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "update produits set prod_cat=?,prod_nom=?,prod_desc=?,prod_image=?,prod_prix=? where prod_id=?";       
        $tab =array($unProduit->getcat(),$unProduit->getnom(),
                    $unProduit->getdesc(),$unProduit->getimage(),
                    $unProduit->getprix(),$unProduit->getid());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function supprimer($unProduit)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "delete from produits where prod_id=?";       
        $tab =array($unProduit->getid());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
}