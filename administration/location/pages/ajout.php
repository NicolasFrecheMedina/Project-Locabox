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
<h1 class="text-center">Créer nouvelle location</h1>

<?php if (isset($_SESSION["ajout_location"]) && $_SESSION["ajout_location"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            La location n'a pas été créée, les champs <?php echo implode(", ", $_SESSION["erreurs_ajout"]) ?> sont faux.
        </div>
    <?php 
        unset($_SESSION["ajout_location"]);
        unset($_SESSION["erreurs_ajout"]);
    } ?>

<form action="action.php" method="POST">
    <div class="container col-8">
        <div class="form-group">
            <label class="font-weight-bold" for="id_client">ID Client :</label>
            <input type="text" class="form-control" id="id_client" name="id_client">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="id_box">ID Box :</label>
            <input type="text" class="form-control" id="id_box" name="id_box">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="date_debut">Date de début :</label>
            <input type="datetime-local" class="form-control" id="date_debut" name="date_debut">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="date_fin">Date de fin :</label>
            <input type="datetime-local" class="form-control" id="date_fin" name="date_fin">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="contrat">Contrat :</label>
            <input type="text" class="form-control" id="contrat" name="contrat">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" name="btn_ajout">Créer location</button>
            <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
    </div>
</form>

<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>