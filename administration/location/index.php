
<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include "inc/connect.php";
include 'inc/head.php';
include 'inc/wrapper.php';

$sql = "SELECT client.nom AS nom_client, prenom, numero, date_debut, date_fin,
location.id AS id_location, client.id AS id_client, box.id AS id_box
FROM location 
INNER JOIN client ON location.id_client=client.id
INNER JOIN box ON location.id_box=box.id
WHERE location.statut=0";
$req = $bdd->prepare($sql);
$req->execute();
$locations = $req->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($locations);


$sql = "SELECT * FROM location WHERE statut=1";
$req = $bdd->prepare($sql);
$req->execute();
$locations_ko = $req->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($locations_ko);
?>
<!-- Begin Page Content -->
    <?php if (isset($_SESSION["ajout_location"]) && $_SESSION["ajout_location"] == true) { ?>
        <div class="alert alert-success col-11 text-center mx-auto" role="alert">
            La location a été créée !
        </div>
    <?php unset($_SESSION["ajout_location"]); } ?>

    <?php if (isset($_SESSION["modif_location"]) && $_SESSION["modif_location"] == true) { ?>
        <div class="alert alert-info col-11 text-center mx-auto" role="alert">
            La location a été modifiée !
        </div>
    <?php unset($_SESSION["modif_location"]); } ?>

    <?php if (isset($_SESSION["suppr_location"]) && $_SESSION["suppr_location"] == true) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            La location a été cloturée !
        </div>
    <?php unset($_SESSION["suppr_location"]); } ?>

    <?php if (isset($_SESSION["location_restaurer"]) && $_SESSION["location_restaurer"] == true) { ?>
        <div class="alert alert-success col-11 text-center mx-auto" role="alert">
            La location a été restaurée !
        </div>
    <?php unset($_SESSION["location_restaurer"]); } ?>


<div class="container-fluid">
    <h1>Locations</h1>
<div class="text-center"><a href="pages/ajout.php" class="btn btn-success mb-3">Créer nouvelle location</a></div>
<table class="table table-sm text-center">
            <thead class="thead-dark"> Location en cours
                <tr>
                    <th>ID client</th>
                    <th>ID box</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($locations as $key => $value) { ?>
                <tr>
                    <td><?php echo $locations[$key]["nom_client"] ?></td>
                    <td><?php echo $locations[$key]["numero"] ?></td>
                    <td><?php echo $locations[$key]["date_debut"] ?></td>
                    <td><?php echo $locations[$key]["date_fin"] ?></td>
                    
                    <td>
                    <a href="pages/voir.php?id=<?php echo $locations[$key]['id_location'] ?>" class="btn btn-warning mb-2">Voir</a>
                    <a href="pages/modif.php?id=<?php echo $locations[$key]['id_location'] ?>" class="btn btn-info mb-2">Modifier</a>
                    <a href="pages/action.php?id=<?php echo $locations[$key]['id_location'] ?> & btn=btn_suppr" class="btn btn-danger mb-2">Clôturer</a>
                    </td>
         
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <table class="table table-sm text-center">
            <thead class="thead-dark"> Location clôturées
                <tr>
                    <th>ID</th>
                    <th>ID client</th>
                    <th>ID box</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Contrat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($locations_ko as $key => $value) { ?>
                <tr>
                    <td><?php echo $locations_ko[$key]["id"] ?></td>
                    <td><?php echo $locations_ko[$key]["id_client"] ?></td>
                    <td><?php echo $locations_ko[$key]["id_box"] ?></td>
                    <td><?php echo $locations_ko[$key]["date_debut"] ?></td>
                    <td><?php echo $locations_ko[$key]["date_fin"] ?></td>
                    <td><?php echo $locations_ko[$key]["contrat"] ?></td>
                    <td>
                        <a href="pages/voir.php?id=<?php echo $locations_ko[$key]['id'] ?>" class="btn btn-warning mb-2">Voir</a>
                        <a href="pages/action.php?id=<?php echo $locations_ko[$key]['id'] ?> & btn2=btn_restaurer" class="btn btn-info mb-2">Restaurer</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>
 