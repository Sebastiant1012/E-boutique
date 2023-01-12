<?php

$dossierBase = $_SERVER['DOCUMENT_ROOT']."ProjetEquipe/";
require_once($dossierBase.'modele/dao/ConnectionDB.class.php');
require_once($dossierBase.'modele/dao/dao.interface.php');
require_once($dossierBase.'modele/classe/user.class.php');

class UserDAO implements DAO
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
        $user = null;
        $requete = $connection->prepare("select * from user where user_id = ?");
        $requete->execute(array($cles));
        if($requete->rowCount()>0)
        {
            $tab = $requete->fetch();
            $user = new User($tab['user_id'],$tab['nom'],
                                $tab['prenom'],$tab['email'],
                                $tab['password'],$tab['usertype']);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $user;
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
        $requete = $connection->prepare("select * from user ".$filtre);
        $requete->execute();
        foreach($requete as $tab)
        {
            $user = new User($tab['user_id'],$tab['nom'],
                            $tab['prenom'],$tab['email'],
                            $tab['password'],$tab['usertype']);

            array_push($liste,$user);
        }
        $requete->closeCursor();
        ConnectionDB::close();
        return $liste;
    }
    public static function inserer($unuser)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "insert into user (nom,prenom,email,password,usertype)";
        $commandeSQL .="values(?,?,?,?,?)";
        $tab =array($unuser->getnom(),
                    $unuser->getprenom(),$unuser->getemail(),
                    $unuser->getpassword(),$unuser->getusertype());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function modifier($unuser)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "update user set nom=?,prenom=?,email=?,password=?,usertype=? where user_id=?";       
        $tab =array($unuser->getnom(),$unuser->getprenom(),
                    $unuser->getemail(),$unuser->getpassword(),
                    $unuser->getusertype(),$unuser->getid());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
    public static function supprimer($unuser)
    {
        try 
        {
            $connection= ConnectionDB::getInstance();
        } catch (Exception $e) 
        {
            throw new Exception("Impossible d'obtenir une connection a la base de donnee");
        }
        $commandeSQL = "delete from user where user_id=?";       
        $tab =array($unuser->getid());

        $requete = $connection->prepare($commandeSQL);
        return $requete->execute($tab);
    }
}