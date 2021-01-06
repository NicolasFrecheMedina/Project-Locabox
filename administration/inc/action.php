<?php
session_start();
include 'connect.php';


//On veut récuperer les informations données dans le formulaire
if(isset($_POST["pseudo"]) && isset($_POST["mdp"])){
    if (!empty($_POST["pseudo"]) && !empty($_POST["mdp"])) {
        $pseudo=$_POST["pseudo"];
        $sql= 'SELECT * FROM utilisateur WHERE pseudo = "'.$_POST['pseudo'].'"';
        $req=$bdd->prepare($sql);
        $req->execute();
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
// var_dump ($resultat);

        if (!$resultat)
        {
            header('Location: ../login.php');
            die();
        }
        if(!password_verify($_POST['mdp'], $resultat['mdp'])){
            header('Location: ../login.php');
            die();
        }
        unset($resultat['mdp']);
        $_SESSION['connect']=true;
        $_SESSION['user']=$user;
        header('Location:../index.php');
        die;
    }
}

?>