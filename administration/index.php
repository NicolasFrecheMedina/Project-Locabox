
<?php
include 'inc/config.php';
include 'inc/connect.php';
if (!is_connect()) {
    header('location: login.php');
    }
include 'inc/head.php';
include 'inc/wrapper.php';



$sql = 'SELECT id_utilisateur 
FROM utilisateur_role
INNER JOIN utilisateur ON utilisateur_role.id_utilisateur =utilisateur.id ';
$req = $bdd->prepare($sql); 
$req->execute(); 
$sql = $req->fetchAll(PDO::FETCH_ASSOC);
var_dump($sql);

$sql = 'SELECT * FROM role';
$req = $bdd->prepare($sql); 
$req->execute(); 
$sql = $req->fetchAll(PDO::FETCH_ASSOC);
var_dump($sql);




?>

<!-- Begin Page Content -->
<div class="container-fluid">



</div>
<!-- End Content -->
<?php
include 'inc/footer.php';
?>