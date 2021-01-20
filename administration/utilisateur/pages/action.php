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
        unset($_POST['btn_ajout']);

            foreach ($_POST as $key => $value) {
                if(empty($value)){
                    $error[]= $key;
                }
            }
            if (!isset($_POST['role'])) {
                $error[]= 'role';
            }
            if(isset($error)){
                $_SESSION["ajout_utilisateur"]= false;
                $_SESSION["erreurs_ajout"]= $error;
                header('location: ajout.php');
                die;
            }

            if ($_FILES['avatar']['error']!== 0) {
                $errorFile[]= 'le fichier';
            }
            if(isset($errorFile)){
                $_SESSION["ajout_utilisateur"]= false;
                $_SESSION["erreurs_ajout"]= $errorFile;
                header('location: ajout.php');
                die;
            }
            
            // var_dump($error);

            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            
            $uploadfile = '../img/avatar/'.$_FILES["avatar"]["name"];

            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)){
                //  'ERROR !';
                header('location:ajout.php');
                die;
            }else{
                $avatar = $_FILES["avatar"]["name"];
            }
        
            $sql = 'INSERT INTO utilisateur VALUES(NULL,"'. $_POST['nom'] .'", "'. $_POST['prenom'] .'", "'. $_POST['pseudo'] .'", "'. $_POST['mail'] .'","'. $mdp .'","'. $avatar .'", 0)';
        // var_dump($sql);
        //    die;
            $req = $bdd->prepare($sql);
            if (!$req->execute()){
                 'error !';
                header('location:../index.php');
                die;
            }
            // valable pour toute les requete
            $id = $bdd->lastInsertId();
            foreach ($_POST['role'] as $role){
                $sqlRole = 'INSERT INTO utilisateur_role VALUES("'. $id .'", "'. $role .'")';
                $req = $bdd->prepare($sqlRole);
                $req->execute();
            }

            
            $sql='INSERT INTO action_utilisateur(id, id_location, id_actualite, id_utilisateur, id_action, date_modification, id_box, id_client) VALUES (NULL,NULL,NULL,'.$_SESSION["utilisateur"]["id"].', 1 , NOW() ,NULL,NULL)';
            var_dump($sql);
            $req = $bdd->prepare($sql);
            if (!$req -> execute()) {
               
                header("location:action.php");
                die;
            }
         
            $_SESSION["ajout_utilisateur"] = true;
            header('location:voir.php?id='.$id);
        }



    // Fontion modif
if (isset($_POST['btn_modif'])){
        //    var_dump($_POST);
        //    var_dump($_FILES);
        //    die;

        unset($_POST["btn_modif"]);

            $id= $_POST["id"];
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $pseudo = $_POST["pseudo"];
            $mail = $_POST["mail"];

            $sql = 'UPDATE utilisateur SET nom ="'.$nom.'", prenom = "'.$prenom.'", mail = "'.$mail.'" WHERE id ='.$id;
            //  var_dump($sql);
            //  die;

            $req = $bdd->prepare($sql);
            if (!$req->execute()){
                $_SESSION["modif_utilisateur"] = false;
            header("location:modif.php?id=".$id);
            die;
            }
// delete role utilisateur
           
            $sqlSupprRole = "DELETE FROM utilisateur_role WHERE id_utilisateur =".$id;
            $reqSupprRole = $bdd->prepare($sqlSupprRole);
            if (!$reqSupprRole->execute()){
                echo 'error';
                } 
            
// insert role utilisateur       
            foreach ($_POST['role'] as $role){
                $sqlAjoutRole= 'INSERT INTO utilisateur_role VALUES("'.$id.'", "'.$role.'")';
                // var_dump($sqlAjoutRole);
                $reqAjoutRole= $bdd->prepare($sqlAjoutRole);
                if(!$reqAjoutRole ->execute()){
                    echo 'error ajout role';
                }
            }
            $sql='INSERT INTO action_utilisateur(id, id_location, id_actualite, id_utilisateur, id_action, date_modification, id_box, id_client) VALUES (NULL,NULL,NULL,'.$_SESSION["utilisateur"]["id"].', 2 , NOW() ,NULL,NULL)';
            var_dump($sql);
            $req = $bdd->prepare($sql);
            if (!$req -> execute()) {
               
                header("location:action.php");
                die;
            }
            $_SESSION["modif_utilisateur"] = true;
            header("location:voir.php?id=".$id);
            die;
      
        }


    // Fonction supprimer
if (isset($_GET["btn"])) {
         echo "Page action supprimer";
        $id = $_GET["id"];
        $sql = "UPDATE utilisateur SET statut=1 WHERE id='$id'";
        $req = $bdd->prepare($sql);

        if (!$req -> execute()) {
           
            header("location:action.php");
            die;
        }

        $sql='INSERT INTO action_utilisateur(id, id_location, id_actualite, id_utilisateur, id_action, date_modification, id_box, id_client) VALUES (NULL,NULL,NULL,'.$_SESSION["utilisateur"]["id"].', 3 , NOW() ,NULL,NULL)';
        var_dump($sql);
        $req = $bdd->prepare($sql);
        if (!$req -> execute()) {
           
            header("location:action.php");
            die;
        }
        $_SESSION["suppr_utilisateur"] = true;
        header("location:../index.php");
        die;
        }
?>