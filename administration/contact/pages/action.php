<?php
    session_start();

    include "../inc/connect.php";

    // var_dump($_POST);
    // var_dump($_GET);

    // Fonction supprimer
    if (isset($_GET["btn"])) {
         echo "Page action supprimer";
        $id = $_GET["id"];
        $sql = "UPDATE box SET statut=1 WHERE id='$id'";
        $req = $bdd->prepare($sql);

        if ($req -> execute()) {
             $_SESSION["suppr_box"] = true;
            header("location:../index.php");
            die;
        }
    }


//     if (isset($_POST["btn-repondre"])) {

//         var_dump($_POST);

//         unset($_POST["btn_repondre"]);
//         $id = $_POST["id"];
    
// // Le message
// $repondre = $_POST["repondre"];
// $objet = $_POST["objet"];

// // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
// $message = wordwrap($message, 70, "\r\n");

// // Envoi du mail
// mail('locabox.dwwm@gmail.com', $objet, $message);
      
//    }

if (isset($_POST['btn-repondre'])){

    var_dump($_POST);
        $mail = mail($_POST['mail'], $_POST['objet'], $_POST['repondre']);
         var_dump($mail);
        die;
        if (!$mail){
            // error
            header('location:repondre.php?id='.$_POST['id']);
            die;
        }
        $sql = 'UPDATE contact SET statut = 1 WHERE id = ' . $_POST['id'];
        $req = $bdd->prepare($sql);
        if (!$req->execute()){
            // error
            header('location:repondre.php?id='.$_POST['id']);
            die;
        }
        header('location:index.php');
        die;
    }
   
?>