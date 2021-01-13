<?php
    session_start();

    include "../inc/connect.php";

    // var_dump($_POST);
    // var_dump($_GET);

    // Fonction ajout

    if (isset($_POST['btn_ajout'])){
        //    var_dump($_POST);
        //    var_dump($_FILES);
        //    die;
            $uploadfile = '../img/avatar/'.$_FILES["avatar"]["name"];
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)){
                //  'ERROR !';
                header('location:ajout.php');
                die;
            }else{
                $avatar = $_FILES["avatar"]["name"];
            }
        
            $sql = 'INSERT INTO utilisateur VALUES(NULL,"'. $_POST['nom'] .'", "'. $_POST['prenom'] .'", "'. $_POST['pseudo'] .'", "'. $_POST['mail'] .'","'. $_POST['mdp'] .'","'. $avatar .'", 0)';
            var_dump($sql);
        //    die;
            $req = $bdd->prepare($sql);
            if (!$req->execute()){
                 'error !';
                header('location:../index.php');
                die;
            }
            $id = $bdd->lastInsertId();
            foreach ($_POST['role'] as $role){
                $sqlRole = 'INSERT INTO utilisateur_role VALUES("'. $id .'", "'. $role .'")';
                $req = $bdd->prepare($sqlRole);
                $req->execute();
            }
            header('location:voir.php?id='.$id);
        }



    // Fontion modif
    if (isset($_POST['btn_modif'])){
        //    var_dump($_POST);
        //    var_dump($_FILES);
        //    die;
            $uploadfile = '../img/avatar/'.$_FILES["avatar"]["name"];
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)){
                 'ERROR !';
                header('location:modif.php');
                die;
            }else{
                $avatar = $_FILES["avatar"]["name"];
            }
        
            $sql = 'UPDATE utilisateur SET  nom ="'. $_POST['nom'] .'", prenom = "'. $_POST['prenom'] .'", pseudo = "'. $_POST['pseudo'] .'", mail = "'. $_POST['mail'] .'", mdp = "'. $_POST['mdp'] .'", avatar="'. $avatar .'", statut = 0';
            var_dump($sql);
            die;
            $req = $bdd->prepare($sql);
            if (!$req->execute()){
                 'error !';
                header('location:action.php');
                die;
            }
            $id = $bdd->lastInsertId();
            foreach ($_POST['role'] as $role){
                $sqlRole = 'UPDATE utilisateur_role SET id="'. $id .'", role= "'. $role .'"';
                $req = $bdd->prepare($sqlRole);
                $req->execute();
            }
            header('location:voir.php?id='.$id);
        }



    // if (isset($_POST["btn_modif"])) {
    //     // echo "Page action modif";
    //     unset($_POST["btn_modif"]);

    //     $uploadfile = 'img/avatar/'.$_FILES["avatar"]["name"];
    //     if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)){
    //         //  'ERROR !';
    //         header('location:modif.php');
    //         die;
    //     }else{
    //         $avatar = $_FILES["avatar"]["name"];
    //     }
    //     $id = $_POST["id"];
    //     $nom = $_POST["nom"];
    //     $prenom = $_POST["prenom"];
    //     $pseudo = $_POST["pseudo"];
    //     $mail = $_POST["mail"];
        
    //     foreach ($_POST as $index => $value) {
    //         if (empty($value)) {
    //             $_SESSION["erreurs_modif"][] = $index;
    //         }
    //         }
    //         if(isset($_SESSION["erreurs_modif"])){
    //         $_SESSION["modif_utilisateur"] = false;
    //         header("location:modif.php?id=".$id);
    //         die;
    //     };
        

    //     $sql = "UPDATE utilisateur SET  nom = '$nom', prenom = '$prenom', pseudo = '$pseudo', mail = '$mail', avatar = '$avatar', statut = '0' WHERE id= '$id'";
    //     $req = $bdd->prepare($sql);
    //     if ($req -> execute()) {
    //         $_SESSION["modif_utilisateur"] = true;
    //         header("location:../index.php");
    //         die;
    //     }
    //     $id = $bdd->lastInsertId();
    //     foreach ($_POST['role'] as $role){
    //         $sqlRole = "UPDATE utilisateur_role SET id_utilisateur='$id',id_role='$role' WHERE id= '$id'";
    //         $req = $bdd->prepare($sqlRole);
    //         $req->execute();
    //     }
    //     header('location:voir.php?id='.$id);
    // }


    // Fonction supprimer
    if (isset($_GET["btn"])) {
         echo "Page action supprimer";
        $id = $_GET["id"];
        $sql = "UPDATE utilisateur SET statut=1 WHERE id='$id'";
        $req = $bdd->prepare($sql);

        if ($req -> execute()) {
             $_SESSION["suppr_utilisateur"] = true;
            header("location:../index.php");
            die;
        }
    }
?>