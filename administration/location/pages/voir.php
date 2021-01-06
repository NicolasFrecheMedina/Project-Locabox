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
// var_dump($locations);

?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center"> Location n° <?php echo $locations["id"]?></h1>

<table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>ID client</th>
                    <th>ID box</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Contrat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $locations["id"] ?></td>
                    <td><a href="#"><?php echo $locations["id_client"] ?></a></td>
                    <td><a href="#"><?php echo $locations["id_box"] ?></a></td>
                    <td><?php echo $locations["date_debut"] ?></td>
                    <td><?php echo $locations["date_fin"] ?></td>
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