<?php
include_once("modele/dao/categorieDAO.class.php");
include_once("modele/dao/produitDAO.class.php");
include_once("modele/dao/userDAO.class.php");
include_once("modele/dao/produitCommandeDAO.class.php");
include_once("modele/dao/commandeDAO.class.php");
include_once("modele/classe/commande.class.php");

if(!isset($_SESSION))
{
  session_start();
}
//action qui va chercher toutes les category
//genere le html a utiliser sur la page
if(isset($_POST["category"]))
{
    $filtre ="";
    $categories = CategorieDAO::chercherFiltre($filtre);
    echo '<li class="active"    ><a href="#" class="category" cid="0">Toutes</a></li>';
    if(count($categories)>0)
    {
      foreach($categories as $uneCategorie)
      {
        echo "<li><a href='#' class='category' cid='".$uneCategorie->getid()."'>".$uneCategorie->gettitre()."</a></li>";
      }
      
    }
}
//action qui va chercher toutes les category pour admin
//genere le html a utiliser sur la page
if(isset($_POST["categoryAdmin"]))
{
    $filtre ="";
    $categories = CategorieDAO::chercherFiltre($filtre);
    echo '<li class="active"    ><a href="#" class="categoryAdmin" cid="0">Toutes</a></li>';
    if(count($categories)>0)
    {
      foreach($categories as $uneCategorie)
      {
        echo "<li><a href='#' class='categoryAdmin' cid='".$uneCategorie->getid()."'>".$uneCategorie->gettitre()."</a></li>";
      }
      
    }
}
//action qui va chercher toutes les produits
//genere le html a utiliser sur la page
if(isset($_POST['getProduct'])){
    $liste = ProduitDAO::chercherTous();
    if(count($liste)==0)
    {
        echo "<p>Aucun article trouver</p>";
    }else
    {
        $count = 1;
        foreach($liste as $unProduit)
        {
            $produitID = $unProduit->getid();
            if(array_key_exists('postdata',$_SESSION)&& array_key_exists($produitID,$_SESSION['postdata']))
            {
            $_SESSION['panier'][]=$unProduit;
            unset($_SESSION['postdata']);
            }
        if($count%3==1)
        {
            $isOpen = true;
            echo "<div class='container'>"; 
            echo "<div class='row'>";
        }
                echo "<div class='col-sm-4'>";
                echo  "<div class='panel panel-primary'>";
                    echo "<div class='panel-heading'>".$unProduit->getnom()."</div>";
                    echo "<div class='panel-body'><img src='images/".$unProduit->getimage().".jpg' class='img-responsive' style='width:100%' alt='Image'></div>";
                    echo "<div class='panel-footer'>".$unProduit->getdesc()."</div>";
                    echo "<div class='panel-footer text-center'>".$unProduit->getprix()."$</div>";
        ?>          
                     <div class="panel-footer text-center"> 
                            <input type="hidden" class="infoprix" name="<?=$unProduit->getprix()?>" value="<?=$unProduit->getprix()?>"/>
                            <input type="hidden" class="btnajouterinfo" name="<?=$unProduit->getid()?>" value="<?=$unProduit->getid()?>"/>
                            <input type="submit" value="Ajouter au panier" class="btnajoutpanier"/>  
                    </div>
        <?php
                echo "</div></div>";
            if($count%3==0)
            {
            $isOpen=false;
            echo "</div></div>";
            }
        $count++;
        }
        if($isOpen)
        {
            echo "</div></div>";
        }
    }
}
//action qui va appliquer le filtres selon la category selectionner
if(isset($_POST["get_selected_Category"]))
{
    $cid=$_POST["cat_id"];
    if($cid>0)
    {
        $where="where prod_cat=$cid";
    }else 
    {
        $where="";
    }
   
    $liste = ProduitDAO::chercherFiltre($where);
    if(count($liste)==0)
    {
        echo "<p>Aucun article trouver</p>";
    }else
    {
        $count = 1;
        foreach($liste as $unProduit)
        {
            $produitID = $unProduit->getid();
            if(array_key_exists('postdata',$_SESSION)&& array_key_exists($produitID,$_SESSION['postdata']))
            {
            $_SESSION['panier'][]=$unProduit;
            unset($_SESSION['postdata']);
            }
        if($count%3==1)
        {
            $isOpen = true;
            echo "<div class='container'>"; 
            echo "<div class='row'>";
        }
                echo "<div class='col-sm-4'>";
                echo  "<div class='panel panel-primary'>";
                    echo  "<div class='panel-heading'>".$unProduit->getnom()."</div>";
                    echo    "<div class='panel-body'><img src='images/".$unProduit->getimage().".jpg' class='img-responsive' style='width:100%' alt='Image'></div>";
                    echo    "<div class='panel-footer'>".$unProduit->getdesc()."</div>";
                    echo "<div class='panel-footer text-center'>".$unProduit->getprix()."$</div>";
        ?>
                     <div class="panel-footer text-center"> 
                            <input type="hidden" class="infoprix" name="<?=$unProduit->getprix()?>" value="<?=$unProduit->getprix()?>"/>
                            <input type="hidden" class="btnajouterinfo" name="<?=$unProduit->getid()?>" value="<?=$unProduit->getid()?>"/>
                            <input type="submit" value="Ajouter au panier" class="btnajoutpanier"/>  
                    </div>
        <?php
                echo "</div></div>";
            if($count%3==0)
            {
            $isOpen=false;
            echo "</div></div>";
            }
        $count++;
        }
        if($isOpen)
        {
            echo "</div></div>";
        }
    }
}
//action qui valide l'identiter du user et retourne le type user
if(isset($_POST["userLogin"]))
{
    $email=$_POST["email"];
    $password=$_POST["pwd"];
    $where="where email='$email' and password ='$password'";
    $liste=UserDAO::chercherFiltre($where);
    if(count($liste)==0)
    {
        echo "0";
        unset($_SESSION['auth_user']);
    }else
    {
        foreach($liste as $unUser)
        {
            echo $unUser->getusertype();
            //ajoute les info du user a la session
            $_SESSION['auth_user']=$unUser;
        }
    }

}
//action qui detruit la session
if(isset($_POST["userlogout"]))
{
session_destroy();
}

//action qui va chercher toutes les produits pour admin
if(isset($_POST['getProductAdmin'])){
    $liste = ProduitDAO::chercherTous();
    if(count($liste)==0)
    {
        echo "<p>Aucun article trouver</p>";
    }else
    {
        $count = 1;
        foreach($liste as $unProduit)
        {
        if($count%3==1)
        {
            $isOpen = true;
            echo "<div class='container'>"; 
            echo "<div class='row'>"; 
        }
        ?>
        <div class='col-sm-4'>
            <div class='panel panel-primary'id="prod_<?=$unProduit->getid()?>">
                <div class='panel-heading'><?=$unProduit->getnom()?></div>
                <div class='panel-body'><img src='images/<?=$unProduit->getimage()?>.jpg' class='img-responsive' style='width:100%' alt='Image'></div>
                <div class='panel-footer'><?=$unProduit->getdesc()?></div>
                <div class='panel-footer text-center'><?=$unProduit->getprix()?>$</div>
                <div class='panel-footer text-center'>
                    <input type="submit" class="btn btn-success modif" value="Modifier" name="">
                    <input type="submit" class="btn btn-success supp" value="Supprimer" name="">
                </div>
            </div>
        </div>
        <?php
                
            if($count%3==0)
            {
            $isOpen=false;
            echo "</div></div>";
            }
        $count++;
        }
        if($isOpen)
        {
            echo "</div></div>";
        }
    }
}
//pour predefinir le formulaire de modification d'un produit
if(isset($_POST["prodmodif"]))
{
    $idProduit=$_POST["prodid"];
    $produit=ProduitDAO::chercher($idProduit);
    $_SESSION["ProduitaModifier"]=$produit;
}
//modification du produit dans la base de donnee
if(isset($_POST["validermodif"]))
{
    $id=$_POST["id"];
    $nom=$_POST["nom"];
    $prix=$_POST["prix"];
    $image=$_POST["img"];
    $desc=$_POST["desc"];
    $cat=$_POST["cat"];

    $produit = new Produit($id,$cat,$nom,$desc,$image,$prix);
    ProduitDAO::modifier($produit);

}
//action qui supprime le produit de la base de donnee
if(isset($_POST["prodsupp"]))
{
    $idProduit=$_POST["prodid"];
    $produit=ProduitDAO::chercher($idProduit);
    ProduitDAO::supprimer($produit);
}
//action qui ajoute un produit a la base de donnee
if(isset($_POST["validerajout"]))
{
    $nom=$_POST["nom"];
    $prix=$_POST["prix"];
    $image=$_POST["img"];
    $desc=$_POST["desc"];
    $cat=$_POST["cat"];

    $produit = new Produit(0,$cat,$nom,$desc,$image,$prix);
    ProduitDAO::inserer($produit);

}
//action qui va appliquer le filtres selon la category selectionner pour admin
if(isset($_POST["get_selected_CategoryAdmin"]))
{
    $cid=$_POST["cat_id"];
    if($cid>0)
    {
        $where="where prod_cat=$cid";
    }else 
    {
        $where="";
    }
   
    $liste = ProduitDAO::chercherFiltre($where);
    if(count($liste)==0)
    {
        echo "<p>Aucun article trouver</p>";
    }else
    {
        $count = 1;
        foreach($liste as $unProduit)
        {
            $produitID = $unProduit->getid();
            if(array_key_exists('postdata',$_SESSION)&& array_key_exists($produitID,$_SESSION['postdata']))
            {
            $_SESSION['panier'][]=$unProduit;
            unset($_SESSION['postdata']);
            }
        if($count%3==1)
        {
            $isOpen = true;
            echo "<div class='container'>"; 
            echo "<div class='row'>";
        }
        ?>
        <div class='col-sm-4'>
            <div class='panel panel-primary'id="prod_<?=$unProduit->getid()?>">
            <div class='panel-heading'><?=$unProduit->getnom()?></div>
            <div class='panel-body'><img src='images/<?=$unProduit->getimage()?>.jpg' class='img-responsive' style='width:100%' alt='Image'></div>
            <div class='panel-footer'><?=$unProduit->getdesc()?></div>
            <div class='panel-footer text-center'><?=$unProduit->getprix()?>$</div>
            <div class='panel-footer text-center'>
                <input type="submit" class="btn btn-success modif" value="Modifier" name="">
                <input type="submit" class="btn btn-success supp" value="Supprimer" name="">
            </div>
        </div></div>
        <?php
            if($count%3==0)
            {
            $isOpen=false;
            echo "</div></div>";
            }
        $count++;
        }
        if($isOpen)
        {
            echo "</div></div>";
        }
    }
}
//action qui ajoute au panier un article voulue 
if(isset($_POST["ajoutpanier"]))
{
   $produitcommande=new ProduitCommande(0,$_POST["prodid"],1,$_POST["prodprix"]);
   //incremente la quantite d'un produit deja existant au panier 
    $found = false;
    foreach($_SESSION["panier"] as $commande){
        if($commande->getprod_id()==$_POST["prodid"]){
            $qty=$commande->getprod_qty();
            $qty++;
            $commande->setprod_qty($qty);
            $commande->setprod_prix($qty*$_POST["prodprix"]);
            $found=true;
        }
    }
    //ajout au panier si produit existe pas
   if(!$found){
    $_SESSION["panier"][]=$produitcommande;
   } 
   
}
//update la quantite d'un produit dans le panier
if(isset($_POST["updatepanier"]))
{
    $comid=$_POST["prodid"];
    $comqty=$_POST["prodqty"];

    foreach($_SESSION["panier"] as $commande){
        if($commande->getprod_id()==$comid){
            $produit = ProduitDAO::chercher($comid);
            $commande->setprod_qty($comqty);
            $commande->setprod_prix($comqty*$produit->getprix());
        }
    }
}
//enlever un produit du panier
if(isset($_POST["deletedupanier"]))
{
    $comid=$_POST["prodid"];
    foreach($_SESSION["panier"] as $commande){
        if($commande->getprod_id()==$comid){
           unset($_SESSION["panier"][array_search($commande,$_SESSION["panier"])]);
        }
    }
}
//sauvegarde la commande dans la base de donnee
if(isset($_POST["passerCommande"]))
{
    $prixTotal=$_POST["prixTotal"];
    $userid=$_SESSION["auth_user"]->getid();
    date_default_timezone_set("America/New_York");
    $date=date("d-m-Y");
    $commande=new Commande($userid,$prixTotal,$date);
    //cree une commande pour l'assigner a nos ligne de produitCommande
    CommandeDAO::inserer($commande);
    //maintenant que la commande est cree on a besoin de savoir son id donc on fais la recherche de son id
    $where="where user_id='$userid' and prod_prixTotal='$prixTotal' and date='$date'";
    $commandeDAO=CommandeDAO::chercherFiltre($where);
    $commandeid=$commandeDAO[0]->getid();
    //ajoute les lignes a la base de donnee avec le bon id de commande
    foreach($_SESSION["panier"] as $commande){
       $commande->setcom_id($commandeid);
       ProduitCommandeDAO::inserer($commande);
    }
    //reinitialise le panier 
    unset($_SESSION["panier"]);
}