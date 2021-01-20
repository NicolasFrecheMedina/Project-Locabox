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
        $utilisateur = $req->fetch(PDO::FETCH_ASSOC);
 var_dump ($utilisateur);

        if ($utilisateur === false)
        {
            header('Location: ../login.php');
            die;
        }
        if(!password_verify($_POST['mdp'], $utilisateur['mdp'])){
            header('Location: ../login.php');
            die;
        }
        
        $_SESSION['connect']=true;
        unset($utilisateur['mdp']);
        $_SESSION['utilisateur']=$utilisateur;
        header('Location:../index.php');
        die;
    }
}

?>