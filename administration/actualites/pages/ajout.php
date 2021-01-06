<?php
    session_start();
    // var_dump($_SESSION);
    // var_dump($_SESSION["erreurs_ajout"]);

    include "../inc/connection.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Ajout Client</title>
</head>
<body>
    <a href="../index.php" class="btn btn-dark m-2">Retour index</a>

    <h1 class="text-center my-2">Ajouter un nouveau Client</h1>

    <?php if (isset($_SESSION["ajout_client"]) && $_SESSION["ajout_client"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            Le client n'a pas été ajouté, les champs <?php echo implode(", ", $_SESSION["erreurs_ajout"]) ?> sont faux.
        </div>
    <?php 
        unset($_SESSION["ajout_client"]);
        unset($_SESSION["erreurs_ajout"]);
    } ?>

    <form  action="action.php" method="POST">
        <div class="container col-8">
            <div class="form-group">
                <label class="font-weight-bold" for="nom">Nom :</label>
                <input type="text" class="form-control" name="nom" id="nom">
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="prenom">Prenom :</label>
                <input type="text" class="form-control" name="prenom" id="prenom">
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="adresse">Adresse :</label>
                <input type="text" class="form-control" name="adresse" id="adresse">
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="ville">Ville :</label>
                <input type="text" class="form-control" name="ville" id="ville">
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="code_postal">Code postal :</label>
                <input type="text" class="form-control" name="code_postal" id="code_postal">
            </div>
            <div class="text-center"><button type="submit" class="btn btn-success" name="btn_ajout">Ajouter le client</button></div>
        </div>
    </form>

        
</body>
</html>