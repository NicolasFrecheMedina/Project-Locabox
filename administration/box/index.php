
<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include "inc/connect.php";
include 'inc/head.php';
include 'inc/wrapper.php';

$sql = "SELECT * FROM box WHERE statut=0";
$req = $bdd->prepare($sql);
$req->execute();
$boxs = $req->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($boxs);
?>
<!-- Begin Page Content -->
    <?php if (isset($_SESSION["ajout_box"]) && $_SESSION["ajout_box"] == true) { ?>
        <div class="alert alert-success col-11 text-center mx-auto" role="alert">
            Le box a été créer !
        </div>
    <?php unset($_SESSION["ajout_box"]); } ?>

    <?php if (isset($_SESSION["modif_box"]) && $_SESSION["modif_box"] == true) { ?>
        <div class="alert alert-info col-11 text-center mx-auto" role="alert">
            Le box a été modifié !
        </div>
    <?php unset($_SESSION["modif_box"]); } ?>

    <?php if (isset($_SESSION["suppr_box"]) && $_SESSION["suppr_box"] == true) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            Le box a été supprimé !
        </div>
    <?php unset($_SESSION["suppr_box"]); } ?>


<div class="container-fluid">
<div class="text-center"><a href="pages/ajout.php" class="btn btn-success mb-3">Créer nouveau box</a></div>
<table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Surface en m<sup>2</sup></th>
                    <th>Volume en m<sup>3</sup></th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($boxs as $key => $value) { ?>
                <tr>
                    <td><?php echo $boxs[$key]["id"] ?></td>
                    <td><?php echo $boxs[$key]["numero"] ?></td>
                    <td><?php echo $boxs[$key]["nom"] ?></td>
                    <td><?php echo $boxs[$key]["surface"] ?> m<sup>2</sup></td>
                    <td><?php echo $boxs[$key]["volume"] ?> m<sup>3</sup></td>
                    <td><?php echo $boxs[$key]["prix"] ?> €</td>
                    <td>
                    <a href="pages/voir.php?id=<?php echo $boxs[$key]['id'] ?>" class="btn btn-warning mb-2">Voir</a>
                    <a href="pages/modif.php?id=<?php echo $boxs[$key]['id'] ?>" class="btn btn-info mb-2">Modifier</a>
                    <a href="pages/action.php?id=<?php echo $boxs[$key]['id'] ?> & btn=btn_suppr" class="btn btn-danger mb-2">Supprimer</a>
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
 