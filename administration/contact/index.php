
<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include "inc/connect.php";
include 'inc/head.php';
include 'inc/wrapper.php';

$sql = "SELECT * FROM contact WHERE statut=0";
$req = $bdd->prepare($sql);
$req->execute();
$contacts = $req->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($contacts);


  
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

<table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Mail</th>
                    <th>Telephone</th>
                    <th>Objet</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact) { ?>
                <tr>
                    <td><?php echo $contact["nom"] ?></td>
                    <td><?php echo $contact["prenom"] ?></td>
                    <td><?php echo $contact["mail"] ?></td>
                    <td><?php echo $contact["telephone"] ?></td>
                    <td><?php echo $contact["objet"] ?> </td>
                    <td><?php echo $contact["message"] ?></td>
                    <td>
                        <?php
                            $date = date_create($contact["date"]);
                            echo $date -> format('d/m/Y') ;
                        ?>
                    </td>
                
                    <td>
                    <a href="pages/voir.php?id=<?php echo $contact['id'] ?>" class="btn btn-warning mb-2">Voir</a>
                    <!-- <a href="pages/modif.php?id=<?php echo $contact['id'] ?>" class="btn btn-info mb-2">Modifier</a> -->
                    <a href="pages/action.php?id=<?php echo $contact['id'] ?> & btn=btn_suppr" class="btn btn-danger mb-2">Supprimer</a>
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
 