
<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include "inc/connect.php";
include 'inc/head.php';
include 'inc/wrapper.php';

$sql = "SELECT * FROM utilisateur WHERE statut=0";
$req = $bdd->prepare($sql);
$req->execute();
$utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);


?>
<!-- Begin Page Content -->
    <?php if (isset($_SESSION["ajout_utilisateur"]) && $_SESSION["ajout_utilisateur"] == true) { ?>
        <div class="alert alert-success col-11 text-center mx-auto" role="alert">
            Le utilisateur a été créer !
        </div>
    <?php unset($_SESSION["ajout_utilisateur"]); } ?>

    <?php if (isset($_SESSION["modif_utilisateur"]) && $_SESSION["modif_utilisateur"] == true) { ?>
        <div class="alert alert-info col-11 text-center mx-auto" role="alert">
            Le utilisateur a été modifié !
        </div>
    <?php unset($_SESSION["modif_utilisateur"]); } ?>

    <?php if (isset($_SESSION["suppr_utilisateur"]) && $_SESSION["suppr_utilisateur"] == true) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            Le utilisateur a été supprimé !
        </div>
    <?php unset($_SESSION["suppr_utilisateur"]); } ?>


<div class="container-fluid">
    <h1>Utilisateur</h1>
<div class="text-center"><a href="pages/ajout.php" class="btn btn-success mb-3">Créer nouveau utilisateur</a></div>
<table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>Avatar</th>
                    <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>
            
            <?php foreach ($utilisateurs as $key => $value) { ?>
                <tr>
                    <td><?php echo $utilisateurs[$key]["id"] ?></td>
                    <td><?php echo $utilisateurs[$key]["nom"] ?></td>
                    <td><?php echo $utilisateurs[$key]["prenom"] ?></td>
                    <td><?php echo $utilisateurs[$key]["pseudo"] ?></td>
                    <td><?php echo $utilisateurs[$key]["mail"] ?></td>
                    <td><img width="50px" height="50px" src="img/avatar/<?php echo $utilisateurs[$key]["avatar"] ?>" alt=""></td>
                    <td>
                        <a href="pages/voir.php?id=<?php echo $utilisateurs[$key]['id'] ?>" class="btn btn-warning mb-2">Voir</a>
                        <a href="pages/modif.php?id=<?php echo $utilisateurs[$key]['id'] ?>" class="btn btn-info mb-2">Modifier</a>
                        <a href="pages/action.php?id=<?php echo $utilisateurs[$key]['id'] ?> & btn=btn_suppr" class="btn btn-danger mb-2">Supprimer</a>
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
 