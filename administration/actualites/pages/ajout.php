<?php
 session_start();
 // $_SESSION = array();
 // var_dump($_SESSION);
 include 'inc/connect.php';
 include 'inc/head.php';
 include 'inc/wrapper.php';
 
?>
<div class="container-fluid">

    <h1 class="text-center my-2">Créer nouvelle actualité</h1>

    <?php if (isset($_SESSION["ajout_actu"]) && $_SESSION["ajout_actu"] == false) { ?>
        <div class="alert alert-danger col-11 text-center mx-auto" role="alert">
            L'actualité n'a pas été ajouté, les champs <?php echo implode(", ", $_SESSION["erreurs_ajout"]) ?> sont faux.
        </div>
    <?php 
        unset($_SESSION["ajout_actu"]);
        unset($_SESSION["erreurs_ajout"]);
    } ?>



<form action="action.php" method="POST" class="text-center" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="titre">Titre :</label>
                        <input type="text" class="form-control" id="titre" name="titre">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="illustration">Illustration :</label>
                        <input type="file" id="illustration" name="illustration">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="slug">Slug :</label>
                        <input type="text" class="form-control" id="slug" name="slug">
                    </div>
                </div>
            </div>

            <div class="form-group">
                    <label for="contenu">Contenu :</label>
                    <textarea name="contenu" id="contenu" cols="30" rows="10"></textarea>
                    <script>
                            CKEDITOR.replace( 'contenu' );
                    </script>
                </div>
           
           
            <button type="submit" name="add_actu" class="btn btn-success">Créer</button> <a href="../index.php" class="btn btn-dark m-2">Retour index</a>

    </form>

</div>
<?php
include 'inc/footer.php';
?>