<?php
    session_start();

    include "../inc/connect.php";

    // var_dump($_POST);
    // var_dump($_GET);

    // Fonction ajout
    if (isset($_POST["btn_ajout"])) {
        // echo "Page action ajout";
        unset($_POST["btn_ajout"]);

        $id_client = $_POST["id_client"];
        $id_box = $_POST["id_box"];
        $date_debut = $_POST["date_debut"];
        $date_fin = $_POST["date_fin"];
        $contrat = $_POST["contrat"];
       
        foreach ($_POST as $index => $value) {
            if (empty($value)) {
                $_SESSION["erreurs_ajout"][] = $index;
            }
        }

        if(isset($_SESSION["erreurs_ajout"])){
            $_SESSION["ajout_client"] = false;
            header("location:ajout.php");
            die;
        };

        $sql = "INSERT INTO location VALUES (NULL, '$id_client', '$id_box', '$date_debut', '$date_fin', '$contrat','0')";
        if ($bdd -> exec($sql)) {
            $_SESSION["ajout_location"] = true;
            header("location:../index.php");
            die;
        } 
    }


    // Fontion modif
    if (isset($_POST["btn_modif"])) {
        // echo "Page action modif";
        unset($_POST["btn_modif"]);

        $id_client = $_POST["id_client"];
        $id_box = $_POST["id_box"];
        $date_debut = $_POST["date_debut"];
        $date_fin = $_POST["date_fin"];
        $contrat = $_POST["contrat"];
        
        foreach ($_POST as $index => $value) {
            if (empty($value)) {
                $_SESSION["erreurs_ajout"][] = $index;
            }
        }

            if(isset($_SESSION["erreurs_modif"])){
            $_SESSION["modif_location"] = false;
            header("location:modif.php?id=".$id);
            die;
        };
        
        $sql = "UPDATE location SET  id_client = '$id_client', id_box = '$id_box', date_debut = '$date_debut', date_fin = '$date_fin', contrat = '$contrat', statut = '0' WHERE id= '$id'";
        $req = $bdd->prepare($sql);
        if ($req -> execute()) {
            $_SESSION["modif_location"] = true;
            header("location:../index.php");
            die;
        }
    }


    // Fonction supprimer
    if (isset($_GET["btn"])) {
        //  echo "Page action supprimer";
        $id = $_GET["id"];
        $sql = "UPDATE location SET statut=1 WHERE id='$id'";
        $req = $bdd->prepare($sql);
        if ($req -> execute()) {
             $_SESSION["suppr_location"] = true;
            header("location:../index.php");
            die;
        }
    }

    if (isset($_GET["btn2"])) {
        // echo "Page action supprimer";
       $id = $_GET["id"];
       $sql = "UPDATE location SET statut=0 WHERE id='$id'";
       $req = $bdd->prepare($sql);
       if ($req -> execute()) {
            $_SESSION["location_restaurer"] = true;
           header("location:../index.php");
           die;
       }
   }
?>