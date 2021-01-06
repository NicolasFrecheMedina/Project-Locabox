
<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include "inc/connect.php";
include 'inc/head.php';
include 'inc/wrapper.php';

$sql = "SELECT * FROM client WHERE statut=0";
$req = $bdd->prepare($sql);
$req->execute();
$clients = $req->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($clients);
?>
<!-- Begin Page Content -->
    <?php if (isset($_SESSION["ajout_client"]) && $_SESSION["ajout_client"] == true) { ?>
        <div class="alert alert-success col-11 text-center mx-auto" role="alert">
            Le client a été créer !
        </div>
    <?php unset($_SESSION["ajout_client"]); } ?>

    <?php if (isset($_SESSION["modif_client"]) && $_SESSION["modif_client"] == true) { ?>
        <div class="alert alert-info col-11 text-center mx-auto" role="alert">
            Le client a été modifié !
        </div>
    <?php unset($_SESSION["modif_client"]); } ?>

    <?php if (isset($_SESSION["suppr_client"]) && $_SESSION["suppr_client"] == true) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            Le client a été supprimé !
        </div>
    <?php unset($_SESSION["suppr_client"]); } ?>


<div class="container-fluid" style="overflow-x: scroll;">
<div class="text-center"><a href="pages/ajout.php" class="btn btn-success mb-3">Créer nouveau client</a></div>
<table class="table table-sm text-center">
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($clients as $key => $value) { ?>
                <tr>
                    <td><?php echo $clients[$key]["id"] ?></td>
                    <td><?php echo $clients[$key]["nom"] ?></td>
                    <td><?php echo $clients[$key]["prenom"] ?></td>
                    <td><?php echo $clients[$key]["adresse"] ?></td>
                    <td><?php echo $clients[$key]["ville"] ?></td>
                    <td><?php echo $clients[$key]["code_postal"] ?></td>
                    <td><?php echo $clients[$key]["mail"] ?></td>
                    <td><?php echo $clients[$key]["telephone_fixe"] ?></td>
                    <td><?php echo $clients[$key]["telephone_portable"] ?></td>
                    <td><?php echo $clients[$key]["siret"] ?></td>
                    <td><?php echo $clients[$key]["denomination_sociale"] ?></td>
                    <td>
                    <a href="pages/voir.php?id=<?php echo $clients[$key]['id'] ?>" class="btn btn-warning mb-2">Voir</a>
                    <a href="pages/modif.php?id=<?php echo $clients[$key]['id'] ?>" class="btn btn-info mb-2">Modifier</a>
                    <a href="pages/action.php?id=<?php echo $clients[$key]['id'] ?> & btn=btn_suppr" class="btn btn-danger mb-2">Supprimer</a>
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
 