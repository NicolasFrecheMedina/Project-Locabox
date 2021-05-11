
<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include "inc/connect.php";
include 'inc/head.php';
include 'inc/wrapper.php';

// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

// On détermine le nombre total d'articles
$sql = 'SELECT COUNT(*) AS nb_client FROM client ;';
$req = $bdd->prepare($sql);
$req->execute();
$nb_clients = $req->fetch(PDO::FETCH_ASSOC);
//  var_dump($nb_boxs);
$nbclients= intval($nb_clients['nb_client']);
// var_dump($nbboxs);

$parPage = 10;

// On calcule le nombre de pages total
$pages = ceil($nbclients / $parPage);

// // Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

$sql = 'SELECT * FROM client ORDER BY id LIMIT :premier, :parpage; WHERE statut=0';
$req = $bdd->prepare($sql);
$req->bindValue(':premier', $premier, PDO::PARAM_INT);
$req->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$req->execute();
$clients = $req->fetchAll(PDO::FETCH_ASSOC);

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
        <nav class="d-flex justify-content-center">
                    <ul class="pagination">
                        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                          <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>

<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>
 