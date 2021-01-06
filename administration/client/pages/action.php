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
        $adresse = $_POST["adresse"];
        $ville = $_POST["ville"];
        $code_postal = $_POST["code_postal"];
        $mail = $_POST["mail"];
        $telephone_fixe = $_POST["telephone_fixe"];
        $telephone_portable = $_POST["telephone_portable"];
        $siret = $_POST["siret"];
        $denomination_sociale = $_POST["denomination_sociale"];

        if (empty($nom)) {
            $_SESSION["erreurs_ajout"][] = "nom";
        }
        if (empty($prenom)) {
            $_SESSION["erreurs_ajout"][] = "prenom";
        }
        if (empty($adresse)) {
            $_SESSION["erreurs_ajout"][] = "adresse";
        }
        if (empty($ville)) {
            $_SESSION["erreurs_ajout"][] = "ville";
        }
        if (empty($code_postal)) {
            $_SESSION["erreurs_ajout"][] = "code_postal";
        }
        if (empty($mail)) {
            $_SESSION["erreurs_ajout"][] = "mail";
        }
        if (empty($telephone_fixe)) {
            $_SESSION["erreurs_ajout"][] = "telephone_fixe";
        }
        if (empty($telephone_portable)) {
            $_SESSION["erreurs_ajout"][] = "telephone_portable";
        }

        if(isset($_SESSION["erreurs_ajout"])){
            $_SESSION["ajout_client"] = false;
            header("location:ajout.php");
            die;
        };


        $sql = "INSERT INTO client VALUES (NULL, '$nom', '$prenom', '$adresse', '$ville', '$code_postal','$mail','$telephone_fixe','$telephone_portable','$siret','$denomination_sociale','0')";
        if ($bdd -> exec($sql)) {
            $_SESSION["ajout_client"] = true;
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
        $adresse = $_POST["adresse"];
        $ville = $_POST["ville"];
        $code_postal = $_POST["code_postal"];
        $mail = $_POST["mail"];
        $telephone_fixe = $_POST["telephone_fixe"];
        $telephone_portable = $_POST["telephone_portable"];
        $siret = $_POST["siret"];
        $denomination_sociale = $_POST["denomination_sociale"];
        
        if (empty($nom)) {
            $_SESSION["erreurs_ajout"][] = "nom";
        }
        if (empty($prenom)) {
            $_SESSION["erreurs_ajout"][] = "prenom";
        }
        if (empty($adresse)) {
            $_SESSION["erreurs_ajout"][] = "adresse";
        }
        if (empty($ville)) {
            $_SESSION["erreurs_ajout"][] = "ville";
        }
        if (empty($code_postal)) {
            $_SESSION["erreurs_ajout"][] = "code_postal";
        }
        if (empty($mail)) {
            $_SESSION["erreurs_ajout"][] = "mail";
        }
        if (empty($telephone_fixe)) {
            $_SESSION["erreurs_ajout"][] = "telephone_fixe";
        }
        if (empty($telephone_portable)) {
            $_SESSION["erreurs_ajout"][] = "telephone_portable";
        }
            if(isset($_SESSION["erreurs_modif"])){
            $_SESSION["modif_client"] = false;
            header("location:modif.php?id=".$id);
            die;
        };
        

        $sql = "UPDATE client SET  nom = '$nom', prenom = '$prenom', adresse = '$adresse', ville = '$ville', code_postal = '$code_postal', mail = '$mail', telephone_fixe = '$telephone_fixe', telephone_portable = '$telephone_portable', siret = '$siret', denomination_sociale = '$denomination_sociale', statut = '0' WHERE id= '$id'";
        $req = $bdd->prepare($sql);
        if ($req -> execute()) {
            $_SESSION["modif_client"] = true;
            header("location:../index.php");
            die;
        }
    }


    // Fonction supprimer
    if (isset($_GET["btn"])) {
         echo "Page action supprimer";
        $id = $_GET["id"];
        $sql = "UPDATE client SET statut=1 WHERE id='$id'";
        $req = $bdd->prepare($sql);
        if ($req -> execute()) {
             $_SESSION["suppr_client"] = true;
            header("location:../index.php");
            die;
        }
    }
?>