<!-- traitement.php 

(Traitera la requête provenant de la page index.php (après soumission du formulaire), ajoutera le produit avec son nom, son prix, sa quantité et le total calculé (prix × quantité) en session.) -->

<?php

    session_start();   //fonction pour disposer d'une session
    // démarrer une session sur le serveur pour l'utilisateur courant, ou récupérer la session de ce même utilisateur s'il en avait déjà une.


    if(isset($_GET['action'])) {


        switch($_GET['action']) {
 
            case 'add' :  

                if(isset($_POST['submit'])){  // verifier existen clé submit
        
                    // vérifier(filtre) l'intégrité des valeurs transmises dans le tableau $_POST (données transmises au serveur par le formulaire)
            
                    //Evite de provoquer des erreurs, de pirater le serveur en injectant du code.Failles XSS (Cross-site Scripting)(faille par injection)
            
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
            
                    // filter_input() renvoie en cas de succès la valeur assainie correspondant au champ traité, false si le filtre échoue ou null
                    // si le champ sollicité par le nettoyage n'existait pas dans la requête POST. //
            
                    if($name && $price && $qtt){
            
                        // ($name && $price && $qtt) vérifie implicitement si chaque variable contient une valeur jugée positive par PHP (du texte, des nombres, etc., autrement dit tout sauf false ou null ou 0).
            
                        $product = [
                            "name" => $name,
                            "price" => $price,
                            "qtt" => $qtt,
                            "total" => $price*$qtt
                        ];
            
                        $_SESSION['products'][] = $product;
                        $_SESSION['msg'] = "Produit ajouté";

                        $_SESSION['quantite'] += 1;
                        header("Location:index.php"); 
                    }
                    else{
                        $_SESSION['erreur'] = "Erreur";
                        header("Location:index.php"); 
                    }
                }

            break;


            case 'deleteAll':

                if(isset($_SESSION['products'])) {

                    unset($_SESSION['products']);
                    unset($_SESSION['quantite']);
                    header("Location:recap.php");
                }
                
            break;

            case 'deleteOne':
                //recuperer l'index dans l'url
                //si index present dans url et si product index 
                //alors supprimer product index

                if(isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {

                 unset($_SESSION['products'][$_GET['id']]);
                 $_SESSION['quantite'] -= 1;
                 header("Location:recap.php");

                }

            break;

            case 'moins':

                if(isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {

               
                   
                    $_SESSION['products'][$_GET['id']]['qtt']--;

                   

                    $_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['qtt'] * $_SESSION['products'][$_GET['id']]['price'];

                   if($_SESSION['products'][$_GET['id']]['qtt'] == 0){

                    $_SESSION['quantite'] -= 1;

                     unset($_SESSION['products'][$_GET['id']]);
                     header("Location:recap.php");
                   }

                   //a 0 on supprime le produit
                   // et on calcul le prix *qtt
                   header("Location:recap.php");
                }
            break;
            
            case 'plus':

                if(isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {

                    $_SESSION['products'][$_GET['id']]['qtt']++;

                    $_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['qtt'] * $_SESSION['products'][$_GET['id']]['price'];

                    header("Location:recap.php");
                    
                }
            
            break;

            default;
        }

    }


    // limiter acces a traitement à traitement.php
    
    // fonction envoie un nouvel entête HTTP (les entêtes d'une réponse) au client. Avec le type d'appel "Location:", cette réponse est envoyée au client avec le status code 302, qui indique une redirection. Le client recevra alors la ressource précisée dans cette fonction

    // header (n'arrete pas l'execution du script courant , veiller à ce que header soit la derniere instruction ou appeler fonction exit() ou die() tout de suite après)
?>