<?php
include 'inc/config.php';
include 'inc/connect.php';

if (isset($_POST['update_actu'])){
    var_dump($_POST);
    $uploadfile = 'img/illustration/'.$_FILES["illustration"]["name"];
    
    if (!move_uploaded_file($_FILES['illustration']['tmp_name'], $uploadfile)){
        // 'ERROR !';
        // header('location:modif.php');
        die;
    }else{
        $illustration = $_FILES["illustration"]["name"];
    }
    $sql = 'UPDATE actualite SET titre = "'. $_POST['titre'] .'", contenu = "'. $_POST['contenu'] .'",illustration = "'.$illustration.'", slug = "'. $_POST['slug'] .'", 0';
    $req = $bdd->prepare($sql);
    if ($req->execute()){
        header('location:../index.php');
        die;
    }
}

if (isset($_POST['add_actu'])){
    // var_dump($_POST);
    // var_dump($_FILES);
    $uploadfile = 'img/illustration/'.$_FILES["illustration"]["name"];
    if (!move_uploaded_file($_FILES['illustration']['tmp_name'], $uploadfile)){
        // 'ERROR !';
        header('location:ajout.php');
        die;
    }else{
        $illustration = $_FILES["illustration"]["name"];
    }
    // REDIMENSSION DE L'IMAGE

    $source = imagecreatefromjpeg('img/illustration/'.$illustration.'');
//    var_dump($source);
//    die;
    // On crée la miniature vide
    $illustration_miniature = imagecreatetruecolor(250, 250);
    // renvoient la largeur et la hauteur d'une image
    $largeur_source = imagesx($source);
    $hauteur_source = imagesy($source);
    // on ajoute l'image à source à l'image vierge
    $largeur_destination = imagesx($illustration_miniature);
    $hauteur_destination = imagesy($illustration_miniature);
    // On crée la miniature
    imagecopyresampled($illustration_miniature, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
    // On l'enregistre dans uploads/mini/
    imagejpeg($illustration_miniature, "img/illustration/miniatures/mini-".$illustration);
    $miniIllustration ="mini-".$illustration;


    
    $sql = 'INSERT INTO actualite VALUES (NULL,"'.$_POST['titre'] .'","'.$_POST['contenu'] .'",NOW(),"'.$illustration .'","'. $miniIllustration.'","'.$_POST['slug'] .'", 0)';
    $req = $bdd->prepare($sql);
    if (!$req->execute()){
        var_dump($sql);
        header('location:ajout.php');
        die;
    }
    $id = $bdd->lastInsertId();
    header('location:voir.php?id='.$id);
    die;
}

 // Fonction supprimer
 if (isset($_GET["btn"])) {
    echo "Page action supprimer";
   $id = $_GET["id"];
   $sql = "UPDATE actualite SET statut=1 WHERE id='$id'";
   $req = $bdd->prepare($sql);

   if ($req -> execute()) {
        $_SESSION["suppr_actu"] = true;
       header("location:../index.php");
       die;
   }
}