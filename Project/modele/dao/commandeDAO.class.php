<?php

$dossierBase = $_SERVER['DOCUMENT_ROOT']."ProjetEquipe/";
require_once($dossierBase.'modele/dao/ConnectionDB.class.php');
require_once($dossierBase.'modele/dao/dao.interface.php');
require_once($dossierBase.'modele/classe/commande.class.php');

class CommandeDAO implements DAO
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
        $commande = null;
        $requete = $connection->prepare("select * from commande where com_id = ?");
        $requete->execute(array($cles));
        if($requete->rowCount()>0)
        {
            $tab = $requete->fetch();
            $commande = new Commande($tab['com_id'],$tab['user_id'],
                                    $tab['prod_prixTotal'],$tab['date']);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $commande;
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
        $requete = $connection->prepare("select * from commande ".$filtre);
        $requete->execute();
        foreach($requete as $tab)
        {
            $commande = new Commande($tab['user_id'],
                                    $tab['prod_prixTotal'],$tab['date']);
            $commande->setid($tab['com_id']);
            array_push($liste,$commande);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $liste;
    }
    public static function inserer($unecommande)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "insert into commande (user_id,prod_prixTotal,date)";
        $commandeSQL .="values(?,?,?)";
        $tab =array($unecommande->getuser_id(),
                    $unecommande->getprod_prixTotal(),
                    $unecommande->getdate());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function modifier($unecommande)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "update commande set prod_prixTotal,date where com_id=?";       
        $tab =array($unecommande->getprod_prixTotal(),$unecommande->getdate(),
                    $unecommande->com_id());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function supprimer($unecommande)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "delete from commande where com_id=?";       
        $tab =array($unecommande->getid());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
}