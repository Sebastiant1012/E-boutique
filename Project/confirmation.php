<?php
include_once("modele/dao/userDAO.class.php");
if(!isset($_SESSION))
{
  session_start();
}
if(!isset($_SESSION["panier"]))
{
  $_SESSION["panier"]=[];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Magasin en ligne</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/StyleIndex.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="./bootstrap/js//bootstrap.min.js"></script>
  <script src="./js/main.js"></script>
  
</head>
<body>

<h2>Achat complete!!!!!!!!!</h2>
<p>Facture envoyer a: <?=$_SESSION["auth_user"]->getemail() ?></p>
<a href="index.php" class="btn btn-success">Retour a la page d'accueil</a>
</body>
</html>