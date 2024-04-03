<!-- index.php
Présentera un formulaire permettant de renseigner :
- Le nom du produit
- Son prix unitaire
- La quantité désirée -->
<?php
    session_start(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout produit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body>
    <!-- HTML (HyperText Transfer Protocol) Est un protocole de communication de texte -->

    <form action="traitement.php?action=add" method="post">

        <header class="container-fluid">
            <div class="row">
                    <div class="col-10 fs-1 bg-info shadow p-3 bg- text-start text-uppercase texte-white  ">
                        <a class=" p-3 text-decoration-none text-muted "href="menu.php">Menu</a>
                    </div>
                <div class="col-2 fs-1 shadow p-3 text-center text-uppercase">
                    <?php
                    if(isset($_SESSION['quantite'])){

                        echo $_SESSION['quantite'];

                    }else{

                        echo 0;

                    }

                    ?>
                    <a class="pr-3 " href="recap.php"><img src="./img/pngegg.png" alt="panier" class="w-50 h-70"></a>
                </div>
            </div>
        </header>

        <main>
            <div class="container">
                <h2>
                    <div class="p-2 mt-3 text-center fs-3 ">
                    Ajouter un produit</div>
                </h2>
        <!-- action (indique la cible du formulaire, le fichier à atteindre lorsque l'utilisateur soumettra le formulaire)

        methode (précise par quelle méthode HTTP les données du formulaire seront transmises au serveur)

        $_POST
        Méthode HTTP POST, contient toutes les données transmises au serveur par l'intermédiaire d'un formulaire (Form Data ou Request Body Parameters).
        (pour ne pas "polluer" l'URL avec les données du formulaire) 

        $_GET
        Méthode HTTP GET, contient tous les paramètres ayant été transmis au serveur par l'intermédiaire de l'URL de la requête (Query String Parameters).

        $_COOKIE
        Contient les données stockées dans les cookies du navigateur client. 

        $_SESSION (contient les données stockées dans la session utilisateur côté serveur)  -->

                <div class="row">
                    <div class="p-1 text-center">
                        <label>
                            <!-- Nom du produit : -->
                            <input class="px-8 py-2 form-control text-center" type="text" name="name" placeholder="Nom du produit">
                        </label>
                    </div>
                        <div class="p-1 text-center">
                            <label>     <!-- lien implicite en imbriquant l'élément <input> directement au sein d'un élément <label> . Dans ce cas, les attributs for et id ne sont plus nécessaires. -->
                                <!-- Prix du produit : -->
                                <!-- <input class="col-form-label" type="number" step="any" name="price">  -->
                                <input class="px-8 py-2 form-control text-center" type="text" name="price" placeholder="Prix du produit">
                                <!-- step est un nombre qui indique l'incrément que la valeur doit suivre ou le mot-clé any. Il est valable pour les types de saisie numérique, notamment les -->
                            </label>
                        </div>
                    <div class="p-1 text-center">
                        <label>
                            <!-- Quantité désirée :
                            <input type="number" name="qtt" value="1">  -->
                            <input class="px-8 py-2 form-control text-center" type="number" value="1" name="qtt" placeholder="Quantité désirée" min="1">
                            <!-- value (valeur initiale du contrôle) -->
                        </label>
                    </div>
                        <div class="px-8 py-2 pr-2 text-center ">
                            <input class="btn btn-outline-primary"type="submit" name="submit" value="Ajouter le produit">
                        </div>
                    </div>
                </div>
        </main>

    </form>
    <?php 

    function afficher_message(){

        if(isset($_SESSION['msg'])){

            echo "<div class='text-center'>".$_SESSION['msg']."</div>";
            unset($_SESSION['msg']);
        }
        else if(isset($_SESSION['erreur'])){
     
            echo "<div class='text-center'>".$_SESSION['erreur']."</div>";
            unset($_SESSION['erreur']);
        }
        else{
            echo"";
        }
    }
    afficher_message(); 

    

    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>