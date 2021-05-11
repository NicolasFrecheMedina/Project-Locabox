
<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include "inc/connect.php";
include 'inc/head.php';
include 'inc/wrapper.php';

// faire un requete pour récupérer des informations sur des tables différente l'utilisateur et son act Expliquer ALIAS car il peuvent avoir une meme dénomination et appartenir à des tables différentes
$sql='SELECT client.id AS id_client , action.libelle , utilisateur.nom AS nom_utilisateur , 
utilisateur.prenom AS prenom_utilisateur , utilisateur.id AS id_utilisateur, 
box.id AS box_id , location.id AS id_location ,actualite.id AS id_actualite,
action_utilisateur.date_modification AS date_modification 
FROM action_utilisateur 
LEFT JOIN utilisateur ON action_utilisateur.id_utilisateur=utilisateur.id  
LEFT JOIN actualite ON action_utilisateur.id_actualite=actualite.id 
LEFT JOIN action ON action_utilisateur.id_action=action.id 
LEFT JOIN location ON action_utilisateur.id_location=location.id  
LEFT JOIN box ON action_utilisateur.id_box=box.id  
LEFT JOIN client ON action_utilisateur.id_client=client.id'; 
$req = $bdd->prepare($sql); $req->execute(); 
$action_utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);

//   var_dump($action_utilisateurs);
?>
<!-- Begin Page Content -->
   
<div class="container-fluid">
<h1>Historique actions</h1>

<?php foreach ($action_utilisateurs as $actionUtilisateur) { ?>

<div>L'utilisateur <?php echo $actionUtilisateur["nom_utilisateur"] ?> <?php echo $actionUtilisateur["prenom_utilisateur"] ?>
 a 
    <?php
                        if ($actionUtilisateur["libelle"] == 'ajouter'){
                            echo '<span style="color: green;"> ajouter </span>';
                        }  
                        if ($actionUtilisateur["libelle"] == 'modifier'){
                            echo '<span style="color: orange;"> modifier </span> ';
                        }
                        if ($actionUtilisateur["libelle"] == 'supprimer'){
                            echo '<span style="color: red;""> supprimer </span>';
                        }
                        if ($actionUtilisateur["libelle"] == 'cloturer'){
                            echo '<span style="color: blue;""> cloturer </span>';
                        }
                        ?>    

 <?php 
        if (isset ($actionUtilisateur["id_client"])) {
            $table = 'client';
            $pronom = 'un';
        }
        if (isset ($actionUtilisateur["id_location"])) {
            $table = 'location';
            $pronom = 'une';
        }
        if (isset ($actionUtilisateur["id_actualité"])) {
            $table = 'actualitée';
            $pronom = 'une';
        }
        if (isset ($actionUtilisateur["id_box"])) {
            $table = 'box';
            $pronom = 'un';
        }
?>
<?php echo $pronom.' '.$table.' '?>
le 
<?php
                            $date_modif = date_create($actionUtilisateur["date_modification"]);
                            echo $date_modif -> format('d/m/Y H:i:s') ;
                        ?>
</div>
<?php } ?>


<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>
 