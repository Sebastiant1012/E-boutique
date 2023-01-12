<?php 
$dossierBase = $_SERVER['DOCUMENT_ROOT']."ProjetEquipe/";
require_once($dossierBase.'modele/dao/config/configDB.interface.php');
 //class cree pour implementer un singleton(un seul objet utiliser en tout temps)
class ConnectionDB {
	private static $instance = null;
    private function __construct()
    {
        
    }
    public static function getInstance()
    {
        if(self::$instance==null)
        {
            $configuration = "mysql:host=".Config::HOST.";dbname=".Config::DBNOM;
            self::$instance = new PDO($configuration, Config::USERNAME,Config::PASS);
            self::$instance->exec("SET character_set_results = 'utf8' ");
            self::$instance->exec("SET character_set_client = 'utf8' ");
            self::$instance->exec("SET character_set_connection = 'utf8' ");
        }
        return self::$instance;
    }

    public static function close()
    {
        self::$instance = null;
    }
}