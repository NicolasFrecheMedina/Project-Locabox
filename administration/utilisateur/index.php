<?php
// On appel la fonction session_start() pour vérfier l'état de la session de l'utilisateur
session_start();
// var_dump($_SESSION);
//On inclut la connexion à la base de donnée
include "inc/connect.php";
// On inclut différent éléments du la page web
include 'inc/head.php';
include 'inc/wrapper.php';

// On déclare un requête 
$sql = "SELECT * FROM utilisateur WHERE statut=0";
//On prépare la requête
$req = $bdd->prepare($sql);
//On éxécute la requête
$req->execute();
//On stocke le résultat dans un tableau associatif
$utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);
// On vérifie par le résultats sur notre page web
// var_dump($utilisateurs);
?>
    <!-- Vérification action ajout -->
    <?php if (isset($_SESSION["ajout_utilisateur"]) && $_SESSION["ajout_utilisateur"] == true) { ?>
        <div class="alert alert-success col-11 text-center mx-auto" role="alert">
            L'utilisateur a été créer !
        </div>
    <?php unset($_SESSION["ajout_utilisateur"]); } ?>
    <!-- Vérification action modifier -->
    <?php if (isset($_SESSION["modif_utilisateur"]) && $_SESSION["modif_utilisateur"] == true) { ?>
        <div class="alert alert-info col-11 text-center mx-auto" role="alert">
            Le utilisateur a été modifié !
        </div>
    <?php unset($_SESSION["modif_utilisateur"]); } ?>
    <!-- Vérification action suppresion -->
    <?php if (isset($_SESSION["suppr_utilisateur"]) && $_SESSION["suppr_utilisateur"] == true) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            Le utilisateur a été supprimé !
        </div>
    <?php unset($_SESSION["suppr_utilisateur"]); } ?>

<!-- Begin Content -->
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
            <!-- On boucle sur la table utilisateur -->
            <?php foreach ($utilisateurs as $utilisateur) { ?>
                <tr>
                    <!-- On affiche les champs que l'on souahite dans un tableau html -->
                    <td><?php echo $utilisateur["id"] ?></td>
                    <td><?php echo $utilisateur["nom"] ?></td>
                    <td><?php echo $utilisateur["prenom"] ?></td>
                    <td><?php echo $utilisateur["pseudo"] ?></td>
                    <td><?php echo $utilisateur["mail"] ?></td>
                    <td><img width="50px" height="50px" src="img/avatar/<?php echo $utilisateur["avatar"] ?>" alt=""></td>
                    <td>
                        <!-- On récupère l'identifiants de l'utilisateur pour gérer une action sur cet utilisateur -->
                        <a href="pages/voir.php?id=<?php echo $utilisateur['id'] ?>" class="btn btn-warning mb-2">Voir</a>
                        <a href="pages/modif.php?id=<?php echo $utilisateur['id'] ?>" class="btn btn-info mb-2">Modifier</a>
                        <a href="pages/action.php?id=<?php echo $utilisateur['id'] ?> & btn=btn_suppr" class="btn btn-danger mb-2">Supprimer</a>
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
 