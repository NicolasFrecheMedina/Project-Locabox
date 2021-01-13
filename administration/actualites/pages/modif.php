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

<div class="container">
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
                <div class="col-6">
                    <div class="form-group">
                        <label for="illustration">Illustration :</label>
                        <img src="<?= $actualite['illustration'] ?>" alt="">
                        <input type="file" id="illustration" name="illustration">
                    </div>
                </div>
            
                <div class="col-6">
                    <div class="form-group">
                        <label for="contenu">Contenu :</label>
                        <textarea name="contenu" id="contenu" cols="30" rows="10"><?= $actualite['contenu'] ?></textarea>
                    </div>
                </div>
            </div>
            
            <input type="submit" name="update_actu" value="modifier" class="btn btn-warning">
            <a href="../index.php" class="btn btn-primary"> retour</a>
        </form>
</div>

<?php
include 'inc/footer.php';