<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

$sqlRoles = 'SELECT * FROM role';
$reqRoles = $bdd->prepare($sqlRoles);
$reqRoles->execute();
$roles = $reqRoles->fetchAll(PDO::FETCH_ASSOC);
// var_dump($roles);

?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center">Créer nouveau utilisateur</h1>

    <?php if (isset($_SESSION["ajout_utilisateur"]) && $_SESSION["ajout_utilisateur"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
        <!-- La fonction implode() transforme un tableau en chaine de caractère, il prend 2 paramètres, ici ', ' pour espacer
         et le deuxième prend pour paramètres les erreurs du tableau -->
            L'utilisateur n'a pas été créer, les champs <?php echo implode(", ", $_SESSION["erreurs_ajout"]) ?> sont faux.
        </div>
    <?php 
        unset($_SESSION["ajout_utilisateur"]);
        unset($_SESSION["erreurs_ajout"]);
    } ?>

<form action="action.php" method="POST" enctype="multipart/form-data">
    <div class="container col-8">
        <div class="form-group">
            <label class="font-weight-bold" for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="prenom">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="pseudo">Pseudo :</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="mdp">Mot de passe :</label>
            <input type="password" class="form-control" id="mdp" name="mdp">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="mail">Mail</label>
            <input type="text" class="form-control" id="mail" name="mail">
        </div>
        <div class="form-group">
            <label class="font-weight-bold" for="avatar">Avatar :</label>
            <input type="file" id="avatar"  name="avatar">
        </div>
        <div class="form-group">
            <label for="role">Rôle(s) :</label>
                <!-- permet de faire de stocker plusieurs réponse car utilisateur peut avoir plusieurs rôle cardinalités 0.n sur mcd -->
                <select class="form-control user-role" id="role" name="role[]" multiple="multiple">
                    <?php  foreach ($roles as $role){ ?>
                        <option value="<?= $role['id'] ?>"><?= $role['libelle'] ?></option>
                    <?php } ?>
                </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" name="btn_ajout">Créer l'utilisateur</button>
            <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
    </div>
</form>

<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>