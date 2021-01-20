<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    if ($id > 0){
        $sql = 'SELECT  client.nom AS nom_client, prenom, numero, date_debut, date_fin, contrat,
        location.id AS id_location, client.id AS id_client, box.id AS id_box, box.nom AS nom_box
               FROM location 
               INNER JOIN client ON location.id_client=client.id 
               INNER JOIN box ON location.id_box=box.id WHERE location.id = '.$id;
        $req = $bdd->prepare($sql);
        $req->execute();
        $locations = $req->fetch(PDO::FETCH_ASSOC);
    }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center"> Location n° <?php echo $locations["id_location"]?></h1>

<?php if (isset($_SESSION["modif_location"]) && $_SESSION["modif_location"] == true) { ?>
        <div class="alert alert-info col-11 text-center mx-auto" role="alert">
            La location été modifié !
        </div>
    <?php unset($_SESSION["modif_location"]); } ?>
    
    <?php if (isset($_SESSION["ajout_location"]) && $_SESSION["ajout_location"] == true) { ?>
        <div class="alert alert-success col-11 text-center mx-auto" role="alert">
            La location a été créer !
        </div>
    <?php unset($_SESSION["ajout_location"]); } ?>

<table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Client</th>
                    <th>Box</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Contrat</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="../../client/pages/voir.php?id=<?= $locations['id_client'] ?>"><?= $locations['nom_client'].' '.$locations['prenom'] ?></a></td>  
                    <td><a href="../../box/pages/voir.php?id=<?= $locations['id_box'] ?>"><?= $locations['numero'].' / '.$locations['nom_box'] ?></a></td>
                    <td>
                        <?php
                            $date_debut = date_create($locations["date_debut"]);
                            echo $date_debut -> format('d/m/Y') ;
                        ?>
                    </td>
                    <td>
                        <?php
                            $date_fin = date_create($locations["date_fin"]);
                            echo $date_fin -> format('d/m/Y') ;
                        ?>
                    </td>
                    <td><?php echo $locations["contrat"] ?></td>
                </tr>
            
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
        <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>