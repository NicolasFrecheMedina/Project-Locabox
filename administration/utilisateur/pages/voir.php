<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

$id = $_GET["id"];
$sql = "SELECT * from utilisateur WHERE id=$id";
$req = $bdd->prepare($sql);
$req->execute();
$utilisateurs = $req->fetch(PDO::FETCH_ASSOC);
// var_dump($utilisateurs);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center">utilisateur n° <?php echo $utilisateurs["id"] ?></h1>

<table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>Avatar</th>
                   
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $utilisateurs["id"] ?></td>
                    <td><?php echo $utilisateurs["nom"] ?></td>
                    <td><?php echo $utilisateurs["prenom"] ?></td>
                    <td><?php echo $utilisateurs["pseudo"] ?></td>
                    <td><?php echo $utilisateurs["mail"] ?></td>
                    <td><img width="50px" height="50px" src="../img/<?php echo $utilisateurs["avatar"] ?>" alt=""></td>
                   
         
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