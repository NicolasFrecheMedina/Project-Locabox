
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
$sql = 'SELECT COUNT(*) AS nb_box FROM box ;';
$req = $bdd->prepare($sql);
$req->execute();
$nb_boxs = $req->fetch(PDO::FETCH_ASSOC);
//  var_dump($nb_boxs);
$nbboxs= intval($nb_boxs['nb_box']);
// var_dump($nbboxs);

$parPage = 10;

// On calcule le nombre de pages total
$pages = ceil($nbboxs / $parPage);

// // Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

$sql = 'SELECT * FROM box ORDER BY numero LIMIT :premier, :parpage; WHERE statut=0';
$req = $bdd->prepare($sql);
$req->bindValue(':premier', $premier, PDO::PARAM_INT);
$req->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$req->execute();
$boxs = $req->fetchAll(PDO::FETCH_ASSOC);
// var_dump($boxs);
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
                    <th>Disponibilité</th>
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
                    <?php
                    if ($boxs[$key]["disponibilite"] == 0)
                        echo '<td style="background : #3DDA19;"> DISPONIBLE </td>';
                    else
                        echo '<td style="background : #BA001A;"> INDISPONIBLE</td>';
                     ?>       
                    <td>
                    <a href="pages/voir.php?id=<?php echo $boxs[$key]['id'] ?>" class="btn btn-warning mb-2">Voir</a>
                    <a href="pages/modif.php?id=<?php echo $boxs[$key]['id'] ?>" class="btn btn-info mb-2">Modifier</a>
                    <a href="pages/action.php?id=<?php echo $boxs[$key]['id'] ?> & btn=btn_suppr" class="btn btn-danger mb-2">Supprimer</a>
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
 