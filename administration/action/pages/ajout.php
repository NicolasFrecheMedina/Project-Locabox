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
<h1 class="text-center">Créer nouveau box</h1>

<?php if (isset($_SESSION["ajout_box"]) && $_SESSION["ajout_box"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            Le box n'a pas été créer, les champs <?php echo implode(", ", $_SESSION["erreurs_ajout"]) ?> sont faux.
        </div>
    <?php 
        unset($_SESSION["ajout_box"]);
        unset($_SESSION["erreurs_ajout"]);
    } ?>

<form action="action.php" method="POST">
    <div class="container col-8">
        <div class="form-group">
            <label class="font-weight-bold" for="numero">Numero :</label>
            <input type="text" class="form-control" id="numero" name="numero">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="surface">Surface en m<sup>2</sup>:</label>
            <input type="text" class="form-control" id="surface" name="surface">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="volume">Volume en m<sup>3</sup>:</label>
            <input type="text" class="form-control" id="volume" name="volume">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="prix">Prix en € :</label>
            <input type="text" class="form-control" id="prix" name="prix">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" name="btn_ajout">Créer le box</button>
            <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
    </div>
</form>

<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>