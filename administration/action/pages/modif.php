<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

$id = $_GET["id"];
$sql = "SELECT * from box WHERE id=$id";
$req = $bdd->prepare($sql);
$req->execute();
$boxs = $req->fetch(PDO::FETCH_ASSOC);
// var_dump($boxs);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center">Modifier le box n° <?php echo $boxs["numero"] ?></h1>

<?php if (isset($_SESSION["modif_box"]) && $_SESSION["modif_box"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            Le box n'a pas été modifié, les champs <?php echo implode(", ", $_SESSION["erreurs_modif"]) ?> sont faux.
        </div>
<?php
    unset($_SESSION["modif_box"]); 
    unset($_SESSION["erreurs_modif"]);
} ?>

<form action="action.php" method="POST">
    <div class="container col-8">
        <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
        <div class="form-group">
            <label class="font-weight-bold" for="numero">Numero :</label>
            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $boxs["numero"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $boxs["nom"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="surface">Surface en m<sup>2</sup>:</label>
            <input type="text" class="form-control" id="surface" name="surface" value="<?php echo $boxs["surface"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="volume">Volume en m<sup>3</sup>:</label>
            <input type="text" class="form-control" id="volume" name="volume" value="<?php echo $boxs["volume"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="prix">Prix en € :</label>
            <input type="text" class="form-control" id="prix" name="prix" value="<?php echo $boxs["prix"] ?>">
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