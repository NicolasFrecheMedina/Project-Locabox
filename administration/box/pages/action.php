<?php
    session_start();

    include "../inc/connect.php";

    // var_dump($_POST);
    // var_dump($_GET);

    // Fonction ajout
    if (isset($_POST["btn_ajout"])) {
        // echo "Page action ajout";
        unset($_POST["btn_ajout"]);

        $numero = $_POST["numero"];
        $nom = $_POST["nom"];
        $surface = $_POST["surface"];
        $volume = $_POST["volume"];
        $prix = $_POST["prix"];

        foreach ($_POST as $index => $value) {
            if (empty($value)) {
                $_SESSION["erreurs_ajout"][] = $index;
            }
        }
        if (!is_numeric($surface) && !empty($surface)) {
            $_SESSION["erreurs_ajout"][] = "surface";
        }
        if (!is_numeric($volume) && !empty($volume)) {
            $_SESSION["erreurs_ajout"][] = "volume";
        }
        if (!is_numeric($prix) && !empty($prix)) {
            $_SESSION["erreurs_ajout"][] = "prix";
        }
        if(isset($_SESSION["erreurs_ajout"])){
            $_SESSION["ajout_box"] = false;
            header("location:ajout.php");
            die;
        };


        $sql = "INSERT INTO box VALUES (NULL, '$numero', '$nom', '$surface', '$volume', '$prix','0','0')";
        if (!$bdd -> exec($sql)) {
           
            header("location:action.php");
            die;
        } 

        $id = $bdd->lastInsertId();
        $sql='INSERT INTO action_utilisateur(id, id_location, id_actualite, id_utilisateur, id_action, date_modification, id_box, id_client) VALUES (NULL,NULL,NULL,'.$_SESSION["utilisateur"]["id"].', 1 , NOW() ,'.$id.',NULL)';
        var_dump($sql);
        $req = $bdd->prepare($sql);
        if (!$req -> execute()) {
           
            header("location:action.php");
            die;
        }
        $_SESSION["ajout_box"] = true;
        header("location:../index.php");
        die;
    }


    // Fonction modif
    if (isset($_POST["btn_modif"])) {
        // echo "Page action modif";
        unset($_POST["btn_modif"]);

        $id = $_POST["id"];
        $numero = $_POST["numero"];
        $nom = $_POST["nom"];
        $surface = $_POST["surface"];
        $volume = $_POST["volume"];
        $prix = $_POST["prix"];
        
        foreach ($_POST as $index => $value) {
            if (empty($value)) {
                $_SESSION["erreurs_modif"][] = $index;
            }
            }
            if(isset($_SESSION["erreurs_modif"])){
            $_SESSION["modif_box"] = false;
            header("location:modif.php?id=".$id);
            die;
        };
        

        $sql = "UPDATE box SET  numero = '$numero', nom = '$nom', surface = '$surface', volume = '$volume', prix = '$prix', statut = '0' WHERE id= '$id'";
        $req = $bdd->prepare($sql);
        if (!$req -> execute()) {
            header("location:action.php");
            die;
        }
        
        $sql='INSERT INTO action_utilisateur(id, id_location, id_actualite, id_utilisateur, id_action, date_modification, id_box, id_client) VALUES (NULL,NULL,NULL,'.$_SESSION["utilisateur"]["id"].', 2 , NOW() ,'.$id.',NULL)';
        var_dump($sql);
        $req = $bdd->prepare($sql);
        if (!$req -> execute()) {
            header("location:../../index.php");
            die;
        }

        $_SESSION["modif_box"] = true;
        // header("location:action.php");
        header("location:../index.php");
        die;
    }


    // Fonction supprimer
    if (isset($_GET["btn"])) {
         echo "Page action supprimer";
        $id = $_GET["id"];
        $sql = "UPDATE box SET statut=1 WHERE id='$id'";
        $req = $bdd->prepare($sql);

        if (!$req -> execute()) {
             $_SESSION["suppr_box"] = false;
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

        $_SESSION["suppr_box"] = true;
        header("location:../index.php");
        die;
    }
?>