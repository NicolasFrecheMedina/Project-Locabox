<?php
    session_start();

    include "../inc/connect.php";

    // var_dump($_POST);
    // var_dump($_GET);

    // Fonction ajout
    if (isset($_POST["btn_ajout"])) {
        // echo "Page action ajout";
        unset($_POST["btn_ajout"]);

        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $pseudo = $_POST["pseudo"];
        $mdp = $_POST["mdp"];
        $mail = $_POST["mail"];
        $avatar = $_POST["avatar"];

        foreach ($_POST as $index => $value) {
            if (empty($value)) {
                $_SESSION["erreurs_ajout"][] = $index;
            }
        }
        if(isset($_SESSION["erreurs_ajout"])){
            $_SESSION["ajout_utilisateur"] = false;
            header("location:ajout.php");
            die;
        };


        $sql = "INSERT INTO utilisateur VALUES (NULL, '$nom', '$prenom', '$pseudo','$mdp', '$mail', '$avatar','0','0')";
        if ($bdd -> exec($sql)) {
            $_SESSION["ajout_utilisateur"] = true;
            header("location:../index.php");
            die;
        } 
    }


    // Fontion modif
    if (isset($_POST["btn_modif"])) {
        // echo "Page action modif";
        unset($_POST["btn_modif"]);

        $id = $_POST["id"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $pseudo = $_POST["pseudo"];
        $mail = $_POST["mail"];
        $avatar = $_POST["avatar"];
        
        foreach ($_POST as $index => $value) {
            if (empty($value)) {
                $_SESSION["erreurs_modif"][] = $index;
            }
            }
            if(isset($_SESSION["erreurs_modif"])){
            $_SESSION["modif_utilisateur"] = false;
            header("location:modif.php?id=".$id);
            die;
        };
        

        $sql = "UPDATE utilisateur SET  nom = '$nom', prenom = '$prenom', pseudo = '$pseudo', mail = '$mail', avatar = '$avatar', statut = '0' WHERE id= '$id'";
        $req = $bdd->prepare($sql);
        if ($req -> execute()) {
            $_SESSION["modif_utilisateur"] = true;
            header("location:../index.php");
            die;
        }
    }


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