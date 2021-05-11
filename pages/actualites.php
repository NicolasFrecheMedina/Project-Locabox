<?php
session_start();

include "../connect.php";


$sql = 'SELECT * FROM actualite WHERE statut = 0';
$req = $bdd->prepare($sql);
$req->execute();
$actualites = $req->fetchAll(PDO::FETCH_ASSOC);
// var_dump($actualites);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <title>Locabox</title>
    <!-- <link rel="stylesheet" href="http://localhost/locabox/css/style.css"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

</head>


<body>
<h1>Actualités</h1>

<table>
       <thead>
       <tr>
           <th>Titre</th>
           <th>Contenu</th>
           <th>Slug</th>
           <th>Date publication</th>
           <th>Action</th>
       </tr>
       </thead>
       <tbody>
       <?php foreach ($actualites as $actualite): ?>
           <tr>
               <th scope="row"><?= $actualite['titre'] ?></th>
               <td><?= substr($actualite['contenu'],0,100) ?></td>
               <td><?= $actualite['slug'] ?></td>
               <td><?= $actualite['date_creation']?></td>
               <td><a type="button" href="fiche_actu.php?id=<?= $actualite['id']; ?>">Fiche actualité</a></td>
           </tr>
       <?php endforeach; ?>
       </tbody>
   </table>
   <a href="../index.php#actualites"><button> Retour</button></a>



<script src="js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
<script src="js/demo.js"></script>
</body>
</html>
