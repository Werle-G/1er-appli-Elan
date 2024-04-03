<?php
    session_start(); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<header class="container-fluid">
    <div class="row">
        <div class="col-10 fs-1 bg-info shadow p-3 text-start text-uppercase text-white">
            <a class="p-3 text-decoration-none text-muted">Menu</a>
            <a class=" fs-1 text-end text-decoration-none text-white" href="index.php">Ajouter produit</a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>