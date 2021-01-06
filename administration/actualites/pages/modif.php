<?php
    session_start();
    // var_dump($_SESSION);
    // var_dump($_SESSION["erreurs_modif"]);

    include "../inc/connection.php";
    
    // var_dump($_GET["id"]);
    $id = $_GET["id"];
    $sql = "SELECT * from client WHERE id=$id";
    $req = $bdd->prepare($sql);
    $req->execute();
    $donnees = $req->fetch(PDO::FETCH_ASSOC);
    // var_dump($donnees);
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

<h1 class="text-center my-2">Modifier le client <?php echo $id ?></h1>

<?php if (isset($_SESSION["modif_client"]) && $_SESSION["modif_client"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            Le client n'a pas été modifié, les champs <?php echo implode(", ", $_SESSION["erreurs_modif"]) ?> sont faux.
        </div>
<?php
    unset($_SESSION["modif_client"]); 
    unset($_SESSION["erreurs_modif"]);
} ?>

<form action="action.php" method="POST">
    <div class="container col-8">
        <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
        <div class="form-group">
            <label class="font-weight-bold" for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $donnees["nom"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="prenom">Prenom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $donnees["prenom"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="adresse">Adresse :</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $donnees["adresse"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="ville">Ville :</label>
            <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $donnees["ville"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="code_postal">Code postal :</label>
            <input type="text" class="form-control" id="code_postal" name="code_postal" value="<?php echo $donnees["code_postal"] ?>">
        </div>
        <div class="text-center"><button type="submit" class="btn btn-info" name="btn_modif">Modifier le client</button></div>
    </div>
</form>

    
</body>
</html>