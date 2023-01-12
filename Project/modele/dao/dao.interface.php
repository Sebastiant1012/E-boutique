<?php
//interface que toute les classes dao vont implementer pour standardiser les nom des fonctions
interface DAO
{
    /**
     *  @param String $cles id de l'entree a chercher
     * fonction pour chercher une seule entre utilisant une cle primaire
    */
    public static function chercher($cles);
    /*
     fonction pour chercher toute les entres
    */
    public static function chercherTous();
    /**
     * @param String $filtre un snippet de code sql pour la partie where d'une query sql
     * fonction pour chercher des entres seulon un filtre specifier
     */
    public static function chercherFiltre($filtre);
    /** 
     * @param Object $object l'objet a inserer
     * fonction qui ajoute un entre a la base de donnee
     */
    public static function inserer($object);
    /**
     * @param Object $object l'objet a modifier
     * fonction qui modifie les informations d'un entree dans la base de donnee
    */
    public static function modifier($object);
    /**
     * @param Object $object l'objet a supprimer
     * fonction qui enleve un entree de la base de donnee
    */
    public static function supprimer($object);
}