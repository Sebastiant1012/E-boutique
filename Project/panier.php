<?php
include_once("modele/dao/produitDAO.class.php");
include_once("modele/dao/categorieDAO.class.php");
include_once("modele/dao/produitCommandeDAO.class.php");
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

<div class="jumbotron">
  <div class="container text-center">
    <h1>Pasmazon</h1>      
    <p>Acheter, Depenser & Pleurer</p>
  </div>
</div>

<nav class="navbar navbar-inverse navlogin">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Accueil</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php
            if(isset($_SESSION['auth_user']))
            {
              if($_SESSION['auth_user']->getusertype()==2){
                ?>
                <li><a href="admin.php"><span class="glyphicon glyphicon-user"></span> administration</a></li>
              <?php } ?>
                <li><a href="#" id=logoutButton><span class="glyphicon glyphicon-user"></span> logout</a></li>
                <?php }else{?>
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> login</a></li>
        <?php }?>
        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Panier
          <?php 
          if(isset($_SESSION["panier"]))
          {
            echo count($_SESSION['panier']);
          }
         ?></a></li>
      </ul>
    </div>
      
  </div>
</nav>
<?php
  if(isset($_SESSION['auth_user'])){

  
?>
<div  class="container">
    <h1>Votre Panier</h1>
</div>
<div class="container">
    <?php
    //va chercher les produits du panier de la session en cours pour les afficher
       $liste=$_SESSION['panier'];
       $prixTotal=0;
        foreach($liste as $produitCommande){
            $produit=ProduitDAO::chercher($produitCommande->getprod_id());
            $prixTotal+=$produitCommande->getprod_prix();
    ?>
     <div class="row">
        <div class="col-md-3">
            <img src="images/<?=$produit->getimage()?>.jpg"style="width: 100px;" alt="">
        </div>

        <div class="col-md-8">
            <ul>
                <li><?=$produit->getnom()?></li>
                <li>
                    <input type="hidden" class="prodComid" value="<?=$produitCommande->getprod_id() ?>"/>
                    <input type="text" class="prodComqty" value="<?=$produitCommande->getprod_qty() ?>"/><label>Quantite</label>
                    <input type="submit" class="panierupdate" value="Mettre a jour">
                    <input type="submit" class="paniersupprimer" value="Supprimer">
                </li>
            </ul>
        </div>

        <div class="col-md-1 text-right">
            <p>Prix</p>
            <?=$produitCommande->getprod_prix()?>$
        </div>
     </div>   
     <?php } ?>

</div>
<div class="container">
   <div class="row">
        <div class="col-md-offset-10 col-md-2 text-right">
            <h3>Sous-total</h3>
            <h4 id="prixTotal" prixTotal="<?=$prixTotal?>"><?=$prixTotal?>$</h4>
        </div>
    </div> 
</div>
<footer class="container-fluid text-center">
    <input type="submit" value="Passer la commande" id="passerCommande">
</footer>
<?php 
  }else{
?>
<h3>Veuillez vous connectez a votre compte pour utiliser le panier</h3>
<?php

}
?>
</body>
</html>