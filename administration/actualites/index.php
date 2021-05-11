
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
$sql = 'SELECT COUNT(*) AS nb_actu FROM actualite ;';
$req = $bdd->prepare($sql);
$req->execute();
$nb_actualites = $req->fetch(PDO::FETCH_ASSOC);
//  var_dump($nb_boxs);
$nbactus= intval($nb_actualites['nb_actu']);
//  var_dump($nbactus);

$parPage = 5;

// On calcule le nombre de pages total
$pages = ceil($nbactus / $parPage);

// // Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

$sql = 'SELECT * FROM actualite ORDER BY id LIMIT :premier, :parpage; WHERE statut=0';
$req = $bdd->prepare($sql);
$req->bindValue(':premier', $premier, PDO::PARAM_INT);
$req->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$req->execute();
$actualites = $req->fetchAll(PDO::FETCH_ASSOC);

?>



    <?php if (isset($_SESSION["suppr_actu"]) && $_SESSION["suppr_actu"] == true) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            L'actualité a été supprimé !
        </div>
    <?php unset($_SESSION["suppr_actu"]); } ?>

<div class="container">
   <h1 class="text-center mt-4">Index Actualite</h1>
   <div class="text-center"><a href="pages/ajout.php" class="btn btn-success mb-3">Créer nouvelle actualité</a></div>
   <table class="table table-hover">
       <thead>
       <tr>
           <th scope="col">Titre</th>
           <th scope="col">Contenu</th>
           <th scope="col">Slug</th>
           <th scope="col">Action</th>
       </tr>
       </thead>
       <tbody>
       <?php foreach ($actualites as $actualite): ?>
           <tr>
               <th scope="row"><?= $actualite['titre'] ?></th>
               <td><?= substr($actualite['contenu'],0,100) ?></td>
               <td><?= $actualite['slug'] ?></td>
               <td><div class="dropdown">
                       <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           actions
                       </button>
                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item" href="pages/voir.php?id=<?= $actualite['id']; ?>">Fiche actualité</a>
                           <a class="dropdown-item" href="pages/modif.php?id=<?= $actualite['id']; ?>">Modifier l'actualité</a>
                           <a class="dropdown-item" href="pages/action.php?id=<?= $actualite['id']; ?> & btn=btn_suppr">Supprimer l'actualité'</a>
                       </div>
                   </div></td>
           </tr>
       <?php endforeach; ?>
       </tbody>
   </table>
</div>
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


<?php
include 'inc/footer.php';
?>