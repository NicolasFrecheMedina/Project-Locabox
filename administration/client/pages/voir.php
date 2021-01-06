<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

$id = $_GET["id"];
$sql = "SELECT * from client WHERE id=$id";
$req = $bdd->prepare($sql);
$req->execute();
$clients = $req->fetch(PDO::FETCH_ASSOC);
// var_dump($clients);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center"><?php echo $clients["nom"] ," ", $clients["prenom"] ?></h1>

<table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Code Postal</th>
                    <th>Mail</th>
                    <th>Téléphone fixe</th>
                    <th>Téléphone portable</th>
                    <th>Siret</th>
                    <th>Dénomination sociale</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $clients["id"] ?></td>
                    <td><?php echo $clients["nom"] ?></td>
                    <td><?php echo $clients["prenom"] ?></td>
                    <td><?php echo $clients["adresse"] ?></td>
                    <td><?php echo $clients["ville"] ?></td>
                    <td><?php echo $clients["code_postal"] ?></td>
                    <td><?php echo $clients["mail"] ?></td>
                    <td><?php echo $clients["telephone_fixe"] ?></td>
                    <td><?php echo $clients["telephone_portable"] ?></td>
                    <td><?php echo $clients["siret"] ?></td>
                    <td><?php echo $clients["denomination_sociale"] ?></td>
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