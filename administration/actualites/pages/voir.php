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
               <!-- <div class="col">
                   <div class="form-group">
                       <label for="illustration">Illustration :</label>
                       <img src="<?= 'img/illustration/'. $actualite['illustration'] ?>" alt="">
                   </div>
                </div> -->
                <div class="col-6">
                    <div class="form-group">
                        <label for="miniature">Miniature :</label>
                        <img src="<?= 'img/illustration/miniatures/'. $actualite['illustration_miniature'] ?>" alt="miniature">
                    </div>
                </div>
            
            <div class="col-6">
            <div class="form-group">
                <label for="contenu">Contenu :</label>
                <textarea name="contenu" id="contenu" cols="30" rows="10" readonly><?= $actualite['contenu'] ?></textarea>
            </div>
            </div>
            </div>
            <a href="../index.php" class="btn btn-primary"> retour</a>
        </form>
    </div>

<?php
include 'inc/footer.php';