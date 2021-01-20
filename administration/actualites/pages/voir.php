<?php
include 'inc/config.php';
include 'inc/connect.php';

if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    if ($id > 0){
        $sql = 'SELECT * FROM actualite WHERE id='.$id;
        $req = $bdd->prepare($sql);
        $req->execute();
        $actualite = $req->fetch(PDO::FETCH_ASSOC);
    }
}

include 'inc/head.php';
include 'inc/wrapper.php';
?>

    <div class="container">
        <h1 class="text-center mt-4">Fiche actualite</h1>

    <?php if (isset($_SESSION["modif_actu"]) && $_SESSION["modif_actu"] == true) { ?>
        <div class="alert alert-info col-11 text-center mx-auto" role="alert">
            L'actualité a été modifié !
        </div>
    <?php unset($_SESSION["modif_actu"]); } ?>
    
    <?php if (isset($_SESSION["ajout_actu"]) && $_SESSION["ajout_actu"] == true) { ?>
        <div class="alert alert-success col-11 text-center mx-auto" role="alert">
            L'actualité a été créer !
        </div>
    <?php unset($_SESSION["ajout_actu"]); } ?>

   

 


        <form action="action.php" method="POST" class="text-center">
            <input type="hidden" name="id" value="<?= $actualite['id'] ?>">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="titre">Titre :</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?= $actualite['titre'] ?>" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="slug">Slug :</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="<?= $actualite['slug'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="miniature">Miniature :</label>
                        <img src="<?= 'img/illustration/miniature/'. $actualite['illustration_miniature'] ?>" alt="miniature">
                    </div>
                </div>         
                <div class="col-6">
                    <div class="form-group">
                        <label for="contenu">Contenu :</label>
                        <textarea name="contenu" id="contenu" cols="30" rows="10" readonly><?= $actualite['contenu'] ?></textarea>
                        <script>
                            CKEDITOR.replace( 'contenu' );
                        </script>
                    </div>
                </div>
            </div>
                <a href="../index.php" class="btn btn-primary"> retour</a>
        </form>
    </div>

<?php
include 'inc/footer.php';