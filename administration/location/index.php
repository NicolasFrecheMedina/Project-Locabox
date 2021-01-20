
<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include "inc/connect.php";
include 'inc/head.php';
include 'inc/wrapper.php';

// $sql = 'SELECT location.id AS id_location, box.id AS id_box, client.id AS id_client, date_debut, date_fin, contrat, nom, prenom, adresse, code_postal, ville, numero, prix FROM location INNER JOIN client ON client.id = location.id_client INNER JOIN box ON box.id = location.id_box WHERE location.statut=0';

$sql = "SELECT client.nom AS nom_client, prenom, numero, date_debut, date_fin,
location.id AS id_location, client.id AS id_client, box.id AS id_box, box.nom AS nom_box
FROM location 
INNER JOIN client ON location.id_client=client.id
INNER JOIN box ON location.id_box=box.id
WHERE location.statut=0";
$req = $bdd->prepare($sql);
$req->execute();
$locations = $req->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($locations);

$sql = "SELECT client.nom AS nom_client, prenom, numero, date_debut, date_fin,
location.id AS id_location, client.id AS id_client, box.id AS id_box,  box.nom AS nom_box
FROM location 
INNER JOIN client ON location.id_client=client.id
INNER JOIN box ON location.id_box=box.id
WHERE location.statut=1";
$req = $bdd->prepare($sql);
$req->execute();
$locations_ko = $req->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($locations);

// $sql = "SELECT * FROM location WHERE statut=1";
// $req = $bdd->prepare($sql);
// $req->execute();
// $locations_ko = $req->fetchAll(PDO::FETCH_ASSOC);
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
<table class="table table-sm">
            <thead class="thead-dark"> Location en cours
                <tr>
                    <th>Client</th>
                    <th>Box</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($locations as $location) { ?>
                <tr>
                    <td><a href="../client/pages/voir.php?id=<?= $location['id_client'] ?>"><?= $location['nom_client'].' '.$location['prenom'] ?></a></td>  
                    <td><a href="../box/pages/voir.php?id=<?= $location['id_box'] ?>"><?= $location['numero'].'/'.$location['nom_box'] ?></a></td>
                    <td>
                        <?php
                            $date_debut = date_create($location["date_debut"]);
                            echo $date_debut -> format('d/m/Y') ;
                        ?>
                    </td>
                    <td>
                        <?php
                            $date_fin = date_create($location["date_fin"]);
                            echo $date_fin -> format('d/m/Y') ;
                        ?>
                    </td>
                    
                    <td>
                    <a href="pages/voir.php?id=<?php echo $location['id_location'] ?>" class="btn btn-warning mb-2">Voir</a>
                    <a href="pages/modif.php?id=<?php echo $location['id_location'] ?>" class="btn btn-info mb-2">Modifier</a>
                    <a href="pages/action.php?id=<?php echo $location['id_location'] ?> & btn=btn_suppr" class="btn btn-danger mb-2">Clôturer</a>
                    </td>
         
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <table class="table table-sm">
            <thead class="thead-dark"> Location clôturées
                <tr>
                    <th>Client</th>
                    <th>Box</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($locations_ko as $location_ko) { ?>
                <tr>
                    <td><a href="../client/pages/voir.php?id=<?= $location_ko['id_client'] ?>"><?= $location_ko['nom_client'].' '.$location_ko['prenom'] ?></a></td>  
                    <td><a href="../box/pages/voir.php?id=<?= $location_ko['id_box'] ?>"><?= $location_ko['numero'].'/'.$location_ko['nom_box'] ?></a></td>
                    <td>
                        <?php
                            $date_debut = date_create($location_ko["date_debut"]);
                            echo $date_debut -> format('d/m/Y') ;
                        ?>
                    </td>
                    <td>
                        <?php
                            $date_fin = date_create($location_ko["date_fin"]);
                            echo $date_fin -> format('d/m/Y') ;
                        ?>
                    </td>
                    <td>
                        <a href="pages/voir.php?id=<?php echo $location_ko['id_location'] ?>" class="btn btn-warning mb-2">Voir</a>
                        <a href="pages/action.php?id=<?php echo $location_ko['id_location'] ?> & btn2=btn_restaurer" class="btn btn-info mb-2">Restaurer</a>
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
 