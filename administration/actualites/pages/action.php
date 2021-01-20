<?php
include 'inc/config.php';
include 'inc/connect.php';

if (isset($_POST["update_actu"])){
    // var_dump($_POST);
    // var_dump($_FILES);
    // die;
    unset($_POST["update_actu"]);
  
    $id = $_POST["id"];
    $titre = $_POST["titre"];
    $contenu =$_POST["contenu"];
    $slug = $_POST["slug"];

    foreach ($_POST as $key => $value) {
        if(empty($value)){
            $error[]= $key;
        }
    }
    // if ($_FILES['illustration']['error']!== 0) {
    //     $errorFile[]= 'l illustration';
    // }
    // if(isset($errorFile)){
    //     $_SESSION["modif_actu"]= false;
    //     $_SESSION["erreurs_modif"]= $errorFile;
    //     header('location: modif.php?id='.$id);
    //     die;
    // }
    
    // var_dump($error);
//     $uploadfile = 'img/illustration/'.$_FILES["illustration"]["name"];

//     if (!move_uploaded_file($_FILES['illustration']['tmp_name'], $uploadfile)){
//         $_SESSION["modif_actu"]= false;
//         header('location:modif.php?id='.$id);
//         die;
//     }else{
//         $illustration = $_FILES["illustration"]["name"];
//     }

// // REDIMENSSION DE L'IMAGE

//     $source = imagecreatefromjpeg('img/illustration/'.$illustration.'');
// //    var_dump($source);
// //    die;
//     // On crée la miniature vide
//     $miniIllustration = imagecreatetruecolor(250, 250);
//     // renvoient la largeur et la hauteur d'une image
//     $largeur_source = imagesx($source);
//     $hauteur_source = imagesy($source);
//     $largeur_destination = imagesx($miniIllustration);
//     $hauteur_destination = imagesy($miniIllustration);

//     // On genere la miniature
//     imagecopyresampled($miniIllustration, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
//     // On l'enregistre dans uploads/mini/
//     imagejpeg($miniIllustration, "img/illustration/miniature/mini-".$illustration);
//     $miniIllustration ="mini-".$illustration;
    
//     // delete ancienne illustration 

//     $sqlSupprIllustration = "DELETE FROM actualite WHERE illustration =".$id;
//     $reqSupprIllustration = $bdd->prepare($sqlSupprIllustration);
//     if (!$reqSupprIllustration->execute()){
//         echo 'error suppr illustration';
//         } 

//  // delete ancienne miniature 

//     $sqlSupprIllustration = "DELETE FROM actualite WHERE illustration_miniature =".$id;
//     var_dump( $sqlSupprIllustration);
//     $reqSupprIllustration = $bdd->prepare($sqlSupprIllustration);
//     if (!$reqSupprIllustration->execute()){
//      echo 'error suppr illustration';
//      } 

     

//     // insert nouvelle illustration

//     $sqlModifMiniature= 'INSERT INTO actualite VALUES ("'.$id.'","'.$illustration .'","'. $miniIllustration.'")';
//      var_dump($sqlModifMiniature);
//     $reqModifMiniature= $bdd->prepare($sqlModifMiniature);
//     if(!$reqModifMiniature ->execute()){
//         echo 'error modif';
//     }

    // update champs
    $sql = 'UPDATE actualite SET titre = "'.$titre.'", slug = "'.$slug.'", contenu="'.$contenu.'" WHERE id='.$id;
    $req = $bdd->prepare($sql);
    if (!$req->execute()){
        $_SESSION["modif_actu"]= false;
        header('location:modif.php?id='.$id);
        die;
      }

      $sql='INSERT INTO action_utilisateur(id, id_location, id_actualite, id_utilisateur, id_action, date_modification, id_box, id_client) VALUES (NULL,NULL,'.$id.','.$_SESSION["utilisateur"]["id"].', 2 , NOW() ,NULL,NULL)';
        var_dump($sql);
        $req = $bdd->prepare($sql);
        if (!$req -> execute()) {
            header("location:../../index.php");
            die;
        }

    $_SESSION["modif_actu"] = true;
    header("location:voir.php?id=".$id);
    die;
}

// AJouter Actu
if (isset($_POST['add_actu'])){
    // var_dump($_POST);
    // var_dump($_FILES);
    // die;
    unset($_POST['add_actu']);

    foreach ($_POST as $key => $value) {
        if(empty($value)){
            $error[]= $key;
        }
        }
        if ($_FILES['illustration']['error']!== 0) {
            $errorFile[]= 'le fichier';
        }
        if(isset($errorFile)){
            $_SESSION["ajout_actu"]= false;
            $_SESSION["erreurs_ajout"]= $errorFile;
            header('location: ajout.php');
            die;
        }

        // var_dump($error);

    $uploadfile = 'img/illustration/'.$_FILES["illustration"]["name"];

        if (!move_uploaded_file($_FILES['illustration']['tmp_name'], $uploadfile)){
            //  'ERROR !';
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
    $miniIllustration = imagecreatetruecolor(250, 250);
    // renvoient la largeur et la hauteur d'une image
    $largeur_source = imagesx($source);
    $hauteur_source = imagesy($source);
    $largeur_destination = imagesx($miniIllustration);
    $hauteur_destination = imagesy($miniIllustration);

    // On genere la miniature
    imagecopyresampled($miniIllustration, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
    // On l'enregistre dans uploads/mini/
    imagejpeg($miniIllustration, "img/illustration/miniature/mini-".$illustration);
    $miniIllustration ="mini-".$illustration;

    $sql = 'INSERT INTO actualite VALUES (NULL,"'.$_POST['titre'] .'","'.$_POST['contenu'] .'",NOW(),"'.$illustration .'","'. $miniIllustration.'","'.$_POST['slug'] .'", 0)';
    // var_dump($sql);
    //    die;
    $req = $bdd->prepare($sql);
    if (!$req->execute()){
        var_dump($sql);
        header('location:../index.php');
        die;
    }

    $id = $bdd->lastInsertId();
    $sql='INSERT INTO action_utilisateur(id, id_location, id_actualite, id_utilisateur, id_action, date_modification, id_box, id_client) VALUES (NULL,NULL,'.$id.','.$_SESSION["utilisateur"]["id"].', 1 , NOW() ,NULL,NULL)';
    var_dump($sql);
    $req = $bdd->prepare($sql);
    if (!$req -> execute()) {
       
        header("location:action.php");
        die;
    }

    $_SESSION["ajout_actu"] = true;
    header('location:voir.php?id='.$id);
    die;
}


 // Fonction supprimer
 if (isset($_GET["btn"])) {
    echo "Page action supprimer";
   $id = $_GET["id"];
   $sql = "UPDATE actualite SET statut=1 WHERE id='$id'";
   $req = $bdd->prepare($sql);

   if (!$req -> execute()) {
        header("location:action.php");
        die;
   }
   $sql='INSERT INTO action_utilisateur(id, id_location, id_actualite, id_utilisateur, id_action, date_modification, id_box, id_client) VALUES (NULL,NULL,NULL,'.$_SESSION["utilisateur"]["id"].', 3 , NOW() ,'.$id.',NULL)';
   var_dump($sql);
   $req = $bdd->prepare($sql);
   if (!$req -> execute()) {
       header("location:action.php");
       die;
   }

   $_SESSION["suppr_actu"] = true;
   header("location:../index.php");
   die;
}