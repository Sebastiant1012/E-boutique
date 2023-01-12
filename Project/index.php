<?php
include_once("modele/dao/produitDAO.class.php");
include_once("modele/dao/categorieDAO.class.php");
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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" id=get_cat>
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
                <?php
            }else
            {

            
        ?>
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> login</a></li>
        <?php
            }
        ?>
        <li><a href="panier.php"><span class="glyphicon glyphicon-shopping-cart"></span> Panier
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
<div id='get_product'></div>
<footer class="container-fluid text-center">
</footer>

</body>
</html>