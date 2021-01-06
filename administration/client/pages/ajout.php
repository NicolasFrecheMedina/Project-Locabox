<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center">Créer nouveau client</h1>

<?php if (isset($_SESSION["ajout_client"]) && $_SESSION["ajout_client"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            Le client n'a pas été créer, les champs <?php echo implode(", ", $_SESSION["erreurs_ajout"]) ?> sont faux.
        </div>
    <?php 
        unset($_SESSION["ajout_client"]);
        unset($_SESSION["erreurs_ajout"]);
    } ?>

<form action="action.php" method="POST">
    <div class="container col-8">
        <div class="form-group">
            <label class="font-weight-bold" for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="adresse">Adresse :</label>
            <input type="text" class="form-control" id="adresse" name="adresse">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="ville">Ville :</label>
            <input type="text" class="form-control" id="ville" name="ville">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="code_postal">Code postal :</label>
            <input type="text" class="form-control" id="code_postal" name="code_postal">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="mail">Mail :</label>
            <input type="text" class="form-control" id="mail" name="mail">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="telephone_fixe">Téléphone fixe :</label>
            <input type="text" class="form-control" id="telephone_fixe" name="telephone_fixe">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="telephone_portable">Téléphone portable :</label>
            <input type="text" class="form-control" id="telephone_portable" name="telephone_portable">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="siret">Siret :</label>
            <input type="text" class="form-control" id="siret" name="siret">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="denomination_sociale">Dénomination sociale :</label>
            <input type="text" class="form-control" id="denomination_sociale" name="denomination_sociale">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" name="btn_ajout">Créer client</button>
            <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
    </div>
</form>

<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>