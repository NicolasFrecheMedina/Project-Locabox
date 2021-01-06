<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

$id = $_GET["id"];
$sql = "SELECT * from utilisateur WHERE id=$id";
$req = $bdd->prepare($sql);
$req->execute();
$utilisateurs = $req->fetch(PDO::FETCH_ASSOC);
// var_dump($utilisateurs);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center">Modifier l'utilisateur <?php echo $utilisateurs["pseudo"] ?></h1>

<?php if (isset($_SESSION["modif_utilisateur"]) && $_SESSION["modif_utilisateur"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            L'utilisateur n'a pas été modifié, les champs <?php echo implode(", ", $_SESSION["erreurs_modif"]) ?> sont faux.
        </div>
<?php
    unset($_SESSION["modif_utilisateur"]); 
    unset($_SESSION["erreurs_modif"]);
} ?>

<form action="action.php" method="POST">
    <div class="container col-8">
        <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
        <div class="form-group">
            <label class="font-weight-bold" for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $utilisateurs["nom"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $utilisateurs["prenom"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="pseudo">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?php echo $utilisateurs["pseudo"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="mail">Mail</label>
            <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $utilisateurs["mail"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="avatar">Avatar</label>
            <input type="text" class="form-control" id="avatar" name="avatar">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-info" name="btn_modif">Modifier l'utilisateur</button>
            <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
    </div>
</form>

<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>