<!-- recap.php
Affichera tous les produits en session (et en détail) et présentera le total général de tous les produits ajoutés. -->


<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->
</head>
<body>

<header class="container-fluid">
        <div class="row">
            <div class="col fs-1 bg-info shadow p-3 text-start text-uppercase text-white">
                <a class="ps-3 text-decoration-none text-muted" href="menu.php">Menu</a>
                <a class="p-3 fs-1 pr-3text-end text-decoration-none text-white" href="index.php">Ajouter produit</a>
            </div>

            <div class="col-2 fs-1 shadow p-3 text-center text-uppercase">
                <?php 
                if(isset($_SESSION['quantite'])){

                    echo $_SESSION['quantite'];

                }else{

                    echo 0;

                }
                ?>
                <a class="pr-3" href="recap.php"><img src="./img/pngegg.png" alt="panier" class="w-50 h-70"></a>
            </div>
        </div>
    </header>

    <div class="p-2 text-center fs-1">Panier</div>

    <?php 

        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p class='p-3 text-center'>Aucun produit en session...</p>";
            
            // !isset() clé products du tableau $_session n'existe pas
            // empty() clé existe mais ne contient aucune donnée
        }

        else{
            $_SESSION['quantite'] = ( count($_SESSION['products']));
            echo 
                "<table class='table'>",
                    "<thead>",
                        "<tr>",
                            "<th class='ps-4'>#</th>",
                            "<th >Nom</th>",
                            "<th >Prix</th>",
                            "<th >Quantité</th>",
                            "<th  colspan=2>Total</th>",
                        "</tr>",
                    "</thead>",
                    "<tbody>";
        
        $totalGeneral = 0;    // initialise une nouvelle variable $totalGeneral à zéro.
        $quantite = 0;
        
        foreach($_SESSION['products'] as $index => $product) {

        echo "<tr>",
                "<td class='ps-4'>".$index."</td>",
                "<td >".$product['name']."</td>",
                "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                "<td><button class='btn btn-outline-secondary '><a class='text-decoration-none text-muted' href='traitement.php?action=moins&id=$index'>-</a>
                ".$product['qtt']."
                <a class='text-decoration-none text-muted' href='traitement.php?action=plus&id=$index'>+</a></button>
                </td>",
                "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                "<td><a class='btn btn-outline-danger' href='traitement.php?action=deleteOne&id=$index'>Supprimer</a>
                </td>",
            "</tr>",
            "</tbody>";
        $totalGeneral += $product['total'];
        
        $quantite += $product['qtt'];

        // $_SESSION['quantite'] = $quantite;

                // number_format(
                //     variable à modifier,
                //     nombre de décimales souhaité,
                //     caractère séparateur décimal,
                //     caractère séparateur de milliers,
                //     &nbsp  est un espace insécable.
                //     );

            }
            echo "<tfoot>",
                "<tr>",
                "<td class='ps-4'><strong>Total général :</strong></td>",
                "<td colspan=4><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                "<td colspan=4><a class='btn btn-danger' href='traitement.php?action=deleteAll'>Supprimer panier</a></td>",
                "</tr>",
                "</tfoot>",
                "</table>";
                
        }

        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>