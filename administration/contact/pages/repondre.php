<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

$id = $_GET["id"];
$sql = "SELECT * from contact WHERE id=$id";
$req = $bdd->prepare($sql);
$req->execute();
$contact = $req->fetch(PDO::FETCH_ASSOC);
// var_dump($boxs);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center">Fiche contact</h1>
    <div class="formulaire">
                        <form  action="action.php" method="POST">
                            <label class="form_action" for="nom">Nom : </label>
                            <input class="form_action" type="text" name="nom" id="nom" readonly value="<?php echo $contact["nom"] ?>"> 
                            <label class="form_action" for="prenom">Prénom : </label>
                            <input class="form_action" type="text" name="prenom" id="prenom" readonly value="<?php echo $contact["nom"] ?>"> 
                            <label class="form_action" for="mail">Mail : </label>
                            <input class="form_action" type="text" name="mail" id="mail" readonly value="<?php echo $contact["mail"] ?>">
                            <label class="form_action" for="telephone">Téléphone : </label>
                            <input class="form_action" type="text" name="telephone" id="telephone" readonly value="<?php echo $contact["telephone"] ?>">
                            <label class="form_action" for="objet">Objet : </label>
                            <input class="form_action" type="text" name="objet" id="objet" readonly value="<?php echo $contact["mail"] ?>">
                            <label class="form_action" for="repondre">Réponse : </label>
                            <textarea  class="form_action"name="repondre" id="repondre" cols="30" rows="10"></textarea>
                            <button href="index.php" id="btn-repondre" type="submit" name="btn-repondre">Envoyer</button>
                        </form>
    </div>

        <div class="d-flex justify-content-center">
        <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>