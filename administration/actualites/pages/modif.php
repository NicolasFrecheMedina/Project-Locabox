<?php
    
    include 'inc/config.php';
    include 'inc/connect.php';
    include 'inc/head.php';
    include 'inc/wrapper.php';
    // var_dump($_GET["id"]);

    if (isset($_GET['id'])){
        $id = intval($_GET['id']);
        if ($id > 0){
            $sql = 'SELECT * FROM actualite WHERE id='.$id;
            $req = $bdd->prepare($sql);
            $req->execute();
            $actualite = $req->fetch(PDO::FETCH_ASSOC);
        }
    }
    
?>

<?php if (isset($_SESSION["modif_actu"]) && $_SESSION["modif_actu"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            L'actualité n'a pas été créer, les champs <?php echo implode(", ", $_SESSION["erreurs_modif"]) ?> sont faux.
        </div>
    <?php 
        unset($_SESSION["modif_actu"]);
        unset($_SESSION["erreurs_modif"]);
    } ?>

<div class="container-fluid">
        <h1 class="text-center mt-4">Update actualite</h1>
        <form action="action.php" method="POST" class="text-center" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $actualite['id'] ?>">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="titre">Titre :</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?= $actualite['titre'] ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="slug">Slug :</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="<?= $actualite['slug'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-11">
                    <div class="form-group">
                        <label for="contenu">Contenu :</label>
                        <textarea name="contenu" id="contenu" cols="30" rows="10"><?= $actualite['contenu'] ?></textarea>
                        <script>
                            CKEDITOR.replace( 'contenu' );
                        </script>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-11">
                    <div class="form-group">
                        <label for="illustration">Illustration :</label>
                        <input type="file" id="illustration"  name="illustration" value="<?= $actualite['illustration'] ?>" >
                        <img src="<?= 'img/illustration/'. $actualite['illustration'] ?>" alt="illustration">
                    </div>
                </div>  -->
            </div>
            <div class="text-center">
                <button type="submit" name="update_actu" class="btn btn-warning">Modifier</button>
                <a href="../index.php" class="btn btn-primary"> Retour</a>
            </div>
        </div>
    </form>
</div>
<?php
include 'inc/footer.php';