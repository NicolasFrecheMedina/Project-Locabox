<?php
    //On appel la fonction pour vérfier l'utilisateur, fonction de base PHP voir doc
    session_start();
    // On fait appel au fichier connect pour ce cennecter à la bdd
    include "../inc/connect.php";

    var_dump($_POST);
    // var_dump($_GET);

// Fonction ajout
    // Vérificaton des données rentrer dans le formulaire lors du déclenchement du bouton ajouter
    if (isset($_POST['btn_ajout'])){
        // var_dump($_POST);
        // var_dump($_FILES);
           die;
        // Permet de bouclé sur $post sans que le champs btn ajout soit dans le tableau de la boucle 
        unset($_POST['btn_ajout']);
            // On boucle sur les champs du formulaire pour vérifier qu'il ne soit pas vide sinon erreur
            foreach ($_POST as $key => $value) {
                if(empty($value)){
                    $error[]= $key;
                }
            }
            //si pas rempli n'existe pas. Si le champs n'existe pas erreur, aucune valeur. on peut pas vérifier comme les autres champs si il est vide car si il est vide il n'existe pas
            if (!isset($_POST['role'])) {
                $error[]= 'role';
            }
            // erreur
            if(isset($error)){
                // voir fichier ajout.php
                $_SESSION["ajout_utilisateur"]= false;
                $_SESSION["erreurs_ajout"]= $error;
                header('location: ajout.php');
                die;
            }
            // Vérif que tableau error dans tableau avatar ne soit pas égale à 0 
            if ($_FILES['avatar']['error']!== 0) {
                // on créer un tableau errorfile
                $errorFile[]= 'le fichier';
            }
            // on imbrique les tableau errorfile dans $session[erreur_ajout] d'ou errorfile[] un tableau et pas uniquement une valeur
            if(isset($errorFile)){
                $_SESSION["ajout_utilisateur"]= false;
                $_SESSION["erreurs_ajout"]= $errorFile;
                header('location: ajout.php');
                die;
            }
            
            // var_dump($error);
            // fonction php doc, PASSWORD_DEFAULT: algo de hachage( chiffrer)
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            // let = uploadfile dans le tb avatar on recupere le nom
            $uploadfile = '../img/avatar/'.$_FILES["avatar"]["name"];
            //move_uploaded_file fonction php bouge la photo de son endroit temporaire deuxième paramètre endroit ou on stock la photo, la fonction déplace le fichier souhaité
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)){
                //  'ERROR !';
                header('location:ajout.php');
                // die stopper le programme pratique pour debuggaouw
                die;
            }else{
                // si ca fonctionne on stock le nom de l'image
                $avatar = $_FILES["avatar"]["name"];
            }
            // on declare un requete sql avec insert into qui insert une occurence dans la table au choix, ici utilisateur, 
            // on lui passe comme valeur null pour index autoincrémentation on récupere ce qui à été écris dans les champs 
            // et on ils prennent pour valeur les champs dans la table utilisateur. Attention à l'ordre

            $sql = 'INSERT INTO utilisateur VALUES(NULL,"'. $_POST['nom'] .'", "'. $_POST['prenom'] .'", "'. $_POST['pseudo'] .'", "'. $_POST['mail'] .'","'. $mdp .'","'. $avatar .'", 0)';
        // var_dump($sql);
        //    die;
            // on prépare le requête voir doc au cas où
            $req = $bdd->prepare($sql);
            if (!$req->execute()){
                 var_dump('error !');
                header('location:../index.php');
                die;
            }
            // valable pour toute les requetes

            // on récupère le dernier id ajouter et donc le dernier utilisateur
            $id = $bdd->lastInsertId();
            // on a un tableau $variable qui a $value pour cet index
            // foreach ($variable as $key => $value) {
            //     # code...
            // }
            // on boucle parce qu'un utilisateur peut avoir plusieurs role
            // $role c'est la VALEUR dans une boucle
            foreach ($_POST['role'] as $role){
                // l'occurence utilisateur role à deux paramètres l'id et le role 
                // requete a chaque passage de boucle
                $sqlRole = 'INSERT INTO utilisateur_role VALUES("'. $id .'", "'. $role .'")';
                $req = $bdd->prepare($sqlRole);
                $req->execute();
                // if req execute à faire
            }

            // requete pour action voir index de action pour requete inner join
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



    // Fonction modif
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