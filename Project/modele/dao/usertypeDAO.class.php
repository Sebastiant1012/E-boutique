<?php

$dossierBase = $_SERVER['DOCUMENT_ROOT']."ProjetEquipe/";
require_once($dossierBase.'modele/dao/ConnectionDB.class.php');
require_once($dossierBase.'modele/dao/dao.interface.php');
require_once($dossierBase.'modele/classe/usertype.class.php');
class UsertypeDAO implements DAO
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
        $userType = null;
        $requete = $connection->prepare("select * from user_type where type_id = ?");
        $requete->execute(array($cles));
        if($requete->rowCount()>0)
        {
            $tab = $requete->fetch();
            $userType = new Usertype($tab['type_id'],$tab['type_nom']);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $userType;
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
        $requete = $connection->prepare("select * from user_type ".$filtre);
        $requete->execute();
        foreach($requete as $tab)
        {
            $userType = new Usertype($tab['type_id'],$tab['type_nom']);

            array_push($liste,$userType);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $liste;
    }
    public static function inserer($unUsertype)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "insert into user_type (type_nom)";
        $commandeSQL .="values(?)";
        $tab =array($unUsertype->getnom());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function modifier($unUsertype)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "update user_type set type_nom=? where type_id=?";       
        $tab =array($unUsertype->getnom(),$unUsertype->getid());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function supprimer($unUsertype)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "delete from user_type where type_id=?";    
        $tab =array($unUsertype->getid());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
}