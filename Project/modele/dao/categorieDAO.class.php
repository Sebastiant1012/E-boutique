<?php

$dossierBase = $_SERVER['DOCUMENT_ROOT']."ProjetEquipe/";
require_once($dossierBase.'modele/dao/ConnectionDB.class.php');
require_once($dossierBase.'modele/dao/dao.interface.php');
require_once($dossierBase.'modele/classe/categorie.class.php');

class CategorieDAO implements DAO
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
        $categorie = null;
        $requete = $connection->prepare("select * from categories where cat_id = ?");
        $requete->execute(array($cles));
        if($requete->rowCount()>0)
        {
            $tab = $requete->fetch();
            $categorie = new Categorie($tab['cat_id'],$tab['cat_titre']);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $categorie;
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
        $requete = $connection->prepare("select * from categories ".$filtre);
        $requete->execute();
        foreach($requete as $tab)
        {
            $categorie = new Categorie($tab['cat_id'],$tab['cat_titre']);

            array_push($liste,$categorie);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $liste;
    }
    public static function inserer($unecategorie)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "insert into categories (cat_titre)";
        $commandeSQL .="values(?)";
        $tab =array($unecategorie->gettitre());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function modifier($unecategorie)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "update categories set cat_titre=? where cat_id=?";       
        $tab =array($unecategorie->gettitre(),$unecategorie->getid());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function supprimer($unecategorie)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "delete from categorie where cat_id=?";    
        $tab =array($unecategorie->getid());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
}