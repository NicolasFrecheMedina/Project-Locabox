
<?php
 session_start();
 // $_SESSION = array();
 // var_dump($_SESSION);
 include "inc/connect.php";

include 'inc/head.php';
include 'inc/wrapper.php';



$sql = 'SELECT * FROM actualite WHERE statut = 0';
$req = $bdd->prepare($sql);
$req->execute();
$actualites = $req->fetchAll(PDO::FETCH_ASSOC);
// var_dump($actualites);
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


<?php
include 'inc/footer.php';
?>