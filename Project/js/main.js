$(document).ready(function(){
    //toute les fonctions ajax son simplement des points de depart des fonction de action.php

    //Appeler immediatement les fonctions suivantes lorsque le site est ouvert 
    cat();
    product();
    productAdmin();
    catAdmin();

    //obtien toute les produits
    function product(){
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {getProduct:1},
            success: function(data){
                $('#get_product').html(data);
            }
        })
    }
    //obtien toute les categorie
    function cat()
    {
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{category:1},
            success: function(data){
                $('#get_cat').html(data);
            }
        })
    }
    //oh moment qu'une category est clicker sa applique le filtre
    $("body").delegate(".category","click",function(event){
        event.preventDefault();
        var cid=$(this).attr('cid');
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {get_selected_Category:1, cat_id:cid},
            success: function(data){
                $('#get_product').html(data);
            }
        })
    })
    //verification de login
    $("#login").click(function(event){
        event.preventDefault();
        var email=$('#email').val();
        var pwd=$('#password').val();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {userLogin:1,email:email, pwd:pwd},
            success: function(data){
                //selon le type de user une redirection a lieu
                switch(data){
                    case "1":
                        window.location.href="index.php";
                        break;
                    case "2":
                        window.location.href="admin.php";
                        break;
                    default:
                        $("#e_msg").html("<p>nom utilisateur ou mot de passe invalide</p>")
                }
            }
        })
    })
    //roule la fonction logout et redirige a l'index
    $("#logoutButton").click(function(event){
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {userlogout:1},
            success: function(data){
                window.location.href="index.php";
            }
        })
    })
    //redirige au formulaire de modification
    $("body").delegate(".modif","click",function(event){
        var parent_id= $(this).parent().parent().attr('id').split('_')[1];
         $.ajax({
             url: "action.php",
             method: "POST",
             data: {prodmodif:1,prodid:parent_id},
             success: function(data){
                window.location.href="modifproduit.php";
             }
         })
    })
    //enregistre les modification apporter dans le formulaire
    $("#valider").click(function(event){
        console.log("#valider");
        var nom = $("#nom").val();
        var prix = $("#prix").val();
        var desc = $("#desc").val();
        var img = $("#image").val();
        var cat = $("#cat").val();
        var id = $("#id").val();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {validermodif:1,nom:nom,prix:prix,desc:desc,img:img,cat:cat,id:id},
            success: function(data){
                window.location.href="admin.php";
            }
        })
    })
    //roule la fonction supprimer
    $("body").delegate(".supp","click",function(event){
        var parent_id= $(this).parent().parent().attr('id').split('_')[1];
         $.ajax({
             url: "action.php",
             method: "POST",
             data: {prodsupp:1,prodid:parent_id},
             success: function(data){
                window.location.href="admin.php";
             }
         })
    })
    //Roule la fonction pour ajouter un produit 
    $("#Newvalider").click(function(event){
        var nom = $("#nom").val();
        var prix = $("#prix").val();
        var desc = $("#desc").val();
        var img = $("#image").val();
        var cat = $("#cat").val();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {validerajout:1,nom:nom,prix:prix,desc:desc,img:img,cat:cat},
            success: function(data){
                window.location.href="admin.php";
            }
        })
    })
    //obtien les produits pour la page admin
    function productAdmin(){
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {getProductAdmin:1},
            success: function(data){
                $('#get_product_admin').html(data);
            }
        })
    }
    //obtien les category pour la page admin
    function catAdmin()
    {
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{categoryAdmin:1},
            success: function(data){
                $('#get_cat_admin').html(data);
            }
        })
    }
    //filtre des category admin
    $("body").delegate(".categoryAdmin","click",function(event){
        event.preventDefault();
        var cid=$(this).attr('cid');
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {get_selected_CategoryAdmin:1, cat_id:cid},
            success: function(data){
                $('#get_product_admin').html(data);
            }
        })
    })
    //roule la fonction d'ajouter produit au panier
    $("body").delegate(".btnajoutpanier","click",function(event){
        var prodid=$(this).siblings(".btnajouterinfo").val();
        var prodprix=$(this).siblings(".infoprix").val();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {ajoutpanier:1,prodid:prodid,prodprix:prodprix},
            success: function(data){
                window.location.href="index.php"
            }
        })
    })
    //roule la fonction de modification de quantite
    $("body").delegate(".panierupdate","click",function(event){
        var prodid=$(this).siblings(".prodComid").val();
        var prodqty=$(this).siblings(".prodComqty").val();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {updatepanier:1,prodid:prodid,prodqty:prodqty},
            success: function(data){
                window.location.href="panier.php";
            }
        })
    })
    //roule la fonction de suppression d'un article au panier
    $("body").delegate(".paniersupprimer","click",function(event){
        var prodid=$(this).siblings(".prodComid").val();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {deletedupanier:1,prodid:prodid},
            success: function(data){
                window.location.href="panier.php";
            }
        })
    })
    //roule la fonction de complete la commande
    $("#passerCommande").click(function(event){
        var prixTotal=$("#prixTotal").attr("prixTotal");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {passerCommande:1,prixTotal:prixTotal},
            success: function(data){
               window.location.href="confirmation.php";
            }
        })
    })
})
//converti le password en text/password
function rendreVisible()
    {
        var x= document.getElementById("password");
        if(x.type=="password")
        {
            x.type="text";
        }else
        {
            x.type="password";
        }
    }