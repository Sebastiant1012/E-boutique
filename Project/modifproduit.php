<?php
include_once("modele/dao/produitDAO.class.php");
include_once("modele/dao/categorieDAO.class.php");
include_once("modele/dao/userDAO.class.php");
if(!isset($_SESSION))
{
  session_start();
}
if(!isset($_SESSION['ProduitaModifier']))
{
    header("Location: admin.php");
}
if(!isset($_SESSION['auth_user'])|| $_SESSION['auth_user']->getusertype()!=2)
{
    header("Location: index.php");
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
                ?>
                <li><a href="admin.php"><span class="glyphicon glyphicon-user"></span> administration</a></li>
                <li><a href="#" id=logoutButton><span class="glyphicon glyphicon-user"></span> logout</a></li>
                <?php
            }else
            {

            
        ?>
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> login</a></li>
        <?php
            }
        ?>
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
<center>
    <?php
    $produit = $_SESSION['ProduitaModifier'];
    ?>
    <div class= "loginbox">
        <div class="panel panel-primary">
            <div class="panel-heading">Login</div>
            <div class="panel-heading">
                <input type="hidden" id="id" value="<?= $produit->getid()?>"/>
                <label for="nom">Nom du produit</label>
                <input type="text" class="form-control" id="nom" value="<?= $produit->getnom()?>"/>
                <label for="prix">Prix du produit</label>
                <input type="text" class="form-control" id="prix" value="<?= $produit->getprix()?>"/>
                <label for="image">Image du produit</label>
                <input type="text" class="form-control" id="image" value="<?= $produit->getimage()?>"/>
                <label for="desc">Description du produit</label>
                <textarea class="form-control" id="desc"><?= $produit->getdesc()?></textarea>
                <label for="cat">Categorie du produit</label>
                <select id="cat">
                    <?php
                        $categories=CategorieDAO::chercherTous();
                        foreach($categories as $cat)
                        {
                            $id =$cat->getid();
                            $titre=$cat->gettitre();
                            $select="";
                            if($id==$produit->getcat()){
                                $select="selected";
                            }
                            echo "<option value='$id' $select>$titre</option>";
                        }
                    ?>
                </select>
                <input type="submit" class="btn btn-success"  id="valider" value="Valider">
            </div>
            <div class="panel-footer" id="e_msg"></div>
        </div>
     </div>
</center>

<footer class="container-fluid text-center">
</footer>

</body>
</html>