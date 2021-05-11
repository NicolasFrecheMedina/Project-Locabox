<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

$id = $_GET["id"];
$sql = "SELECT * from location WHERE id=$id";
$req = $bdd->prepare($sql);
$req->execute();
$locations = $req->fetch(PDO::FETCH_ASSOC);
//  var_dump($locations);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center">Modifier location n° <?php echo $locations["id"] ?></h1>

<?php if (isset($_SESSION["modif_location"]) && $_SESSION["modif_location"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            La location n'a pas été modifiée, les champs <?php echo implode(", ", $_SESSION["erreurs_modif"]) ?> sont faux.
        </div>
<?php
    unset($_SESSION["modif_location"]); 
    unset($_SESSION["erreurs_modif"]);
} ?>

<form action="action.php" method="POST">
    <div class="container col-8">
    <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
    <div class="form-group">
            <label class="font-weight-bold" for="id_client">ID Client :</label>
            <input type="text" class="form-control" id="client" name="id_client" disabled value="<?php echo $locations["id_client"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="id_box">ID Box :</label>
            <input type="text" class="form-control" id="box" name="id_box" disabled value="<?php echo $locations["id_box"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="date_debut">Date de début :</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" disabled value="<?php echo $locations["date_debut"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="date_fin">Date de fin :</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" value="<?php echo $locations["date_fin"] ?>">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="contrat">Contrat :</label>
            <input type="text" class="form-control" id="contrat" name="contrat" disabled value="<?php echo $locations["contrat"] ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-info" name="btn_modif">Modifier la location</button>
            <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
    </div>
</form>

<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>