<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

$sqlClient = 'SELECT * FROM client';
$reqClient = $bdd->prepare($sqlClient);
$reqClient->execute();
$clients = $reqClient->fetchAll(PDO::FETCH_ASSOC);

$sqlBox = 'SELECT * FROM box';
$reqBox = $bdd->prepare($sqlBox);
$reqBox->execute();
$boxs = $reqBox->fetchAll(PDO::FETCH_ASSOC);
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
            <label for="id_client">Client :</label>
                <select class="form-control id_client" id="id_client" name="id_client">
                    <?php  foreach ($clients as $client){ ?>
                        <option value=" <?= $client['id'] ?>"> ID: <?= $client['id'] ?> / Nom : <?= $client['nom'] ?> / Prénom : <?= $client['prenom'] ?></option>
                    <?php } ?>
                </select>
        </div>
        
        <div class="form-group">
            <label for="id_box">Box :</label>
                <select class="form-control id_box" id="id_box" name="id_box" multiple="multiple">
                    <?php  foreach ($boxs as $box){ ?>
                        <option value=" <?= $box['id'] ?>">ID: <?= $box['id']?> / Surface: <?= $box['surface']?>m<sup>2</sup> / Volume: <?= $box['volume']?>m<sup>3</sup></option>
                    <?php } ?>
                </select>
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="date_debut">Date de début :</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="date_fin">Date de fin :</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin">
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