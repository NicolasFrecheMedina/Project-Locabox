<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

$id = $_GET["id"];
$sql = "SELECT * from client WHERE id=$id";
$req = $bdd->prepare($sql);
$req->execute();
$clients = $req->fetch(PDO::FETCH_ASSOC);
// var_dump($clients);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center">Modifier client <?php echo $clients["nom"] ," ", $clients["prenom"] ?></h1>

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
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $clients["nom"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $clients["prenom"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="adresse">Adresse :</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $clients["adresse"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="ville">Ville :</label>
            <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $clients["ville"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="code_postal">Code postal :</label>
            <input type="text" class="form-control" id="code_postal" name="code_postal" value="<?php echo $clients["code_postal"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="mail">Mail :</label>
            <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $clients["mail"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="telephone_fixe">Téléphone fixe :</label>
            <input type="text" class="form-control" id="telephone_fixe" name="telephone_fixe" value="<?php echo $clients["telephone_fixe"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="telephone_portable">Téléphone portable :</label>
            <input type="text" class="form-control" id="telephone_portable" name="telephone_portable" value="<?php echo $clients["telephone_portable"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="siret">Siret :</label>
            <input type="text" class="form-control" id="siret" name="siret" value="<?php echo $clients["siret"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="denomination_sociale">Dénomination sociale :</label>
            <input type="text" class="form-control" id="denomination_sociale" name="denomination_sociale" value="<?php echo $clients["denomination_sociale"] ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-info" name="btn_modif">Modifier le box</button>
            <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
    </div>
</form>

<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>