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
<h1 class="text-center">Box n° <?php echo $boxs["numero"] ?></h1>

<table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Surface en m<sup>2</sup></th>
                    <th>Volume en m<sup>3</sup></th>
                    <th>Prix</th>
                   
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $boxs["id"] ?></td>
                    <td><?php echo $boxs["numero"] ?></td>
                    <td><?php echo $boxs["nom"] ?></td>
                    <td><?php echo $boxs["surface"] ?> m<sup>2</sup></td>
                    <td><?php echo $boxs["volume"] ?> m<sup>3</sup></td>
                    <td><?php echo $boxs["prix"] ?> €</td>
                   
         
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