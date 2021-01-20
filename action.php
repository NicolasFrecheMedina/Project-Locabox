<?php
session_start();
include 'connect.php';


if (isset($_POST["btn-contact"])) {

    var_dump($_POST);

    unset($_POST["btn-contact"]);

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $mail = $_POST["mail"];
    $telephone = $_POST["telephone"];
    $objet = $_POST["objet"];
    $message = $_POST["message"];

    foreach ($_POST as $index => $value) {
        if (empty($value)) {
            $_SESSION["erreur_message"][] = $index;
            header("location:index.php#contact");
            die;
        }
    }
   

    $sql = "INSERT INTO contact VALUES (NULL, '$nom', '$prenom', '$mail', '$telephone','$objet','$message' , NOW(),'0')";
    var_dump($sql);
    if ($bdd -> exec($sql)) {
        $_SESSION["message_envoye"] = true;
        header("location:index.php#contact");
        die;
    } 
}
   


