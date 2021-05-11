<?php

include 'connect.php';

$sqlActu = 'SELECT * FROM actualite WHERE statut = 0 ORDER BY date_creation LIMIT 5';
$reqActu = $bdd->prepare($sqlActu);
$reqActu->execute();
$actualites = $reqActu->fetchAll(PDO::FETCH_ASSOC);
// var_dump($actualites);

$sql = 'SELECT * FROM piece';
$req = $bdd->prepare($sql);
$req->execute();
$pieces = $req->fetchAll(PDO::FETCH_ASSOC);


if (empty($_GET)){
    $sql = "SELECT * FROM objet_piece INNER JOIN objet ON objet.id = objet_piece.id_objet WHERE objet_piece.id_piece=1";
$req = $bdd->prepare($sql);
$req->execute();
$objets_pieces = $req->fetchAll(PDO::FETCH_ASSOC);
}else{
$id = $_GET["id"];
$sql = "SELECT * FROM objet_piece INNER JOIN objet ON objet.id = objet_piece.id_objet WHERE objet_piece.id_piece='$id'";
$req = $bdd->prepare($sql);
$req->execute();
$objets_pieces = $req->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <title>Locabox</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">

</head>
<body>

<!-- Topbar -->

    <div class="topbar">
        <div>
            <img style="margin-top:10px;" src="img/logo-locabox2.png" alt="logo-locabox">
        </div>
        <div id="menu">
            <a href="#actualites"><div class="bouton_topbar">Actualités</div></a>
            <a href="#les_boxs"><div class="bouton_topbar">Les Boxs</div></a>
            <a href="#simulateur"><div class="bouton_topbar">Simulateur</div></a>
            <a href="#le_parc"><div class="bouton_topbar">Le Parc</div></a>
            <a href="#contact"><div class="bouton_topbar"> Contact </div></a>
        </div>
    </div>

<!--End Topbar -->
<!-- Accueil -->
<h6>BIENVENUE SUR</h6>
    <div id="container">
        <div class="slide_one"></div>
        <div class="slide_two"><img id="logo_accueil" src="img/logo-locabox.png" alt=""></div>
        <div class="slide_three"></div>
    </div>

<!--End Accueil -->
<!-- Actualités -->

    <div id="actualites">
        <div class="top_section">
            <div>
                <a href="#actualites"><h2>Actualités</h2></a>
            </div>
        </div>
        <div class="slider">
                <div class="items"> 
                <?php foreach ($actualites as $actualite): ?>
                        <div class="item active"> 
                            <div class="container_titre">  
                              <div class="titre_actu">  <a href="pages/fiche_actu.php?id=<?= $actualite['id']; ?>"><?= $actualite['titre'] ?></a></div>
                            </div>
                            <img src="<?= 'administration/actualites/img/illustration/miniature/'. $actualite['illustration_miniature'] ?>">      
                        </div>
                <?php endforeach; ?>
                        <div class="button-container-actu">
                            <div class="button-actu">&#10094;</div>
                            <div class="button-actu">&#10095;</div>
                        </div>
	            </div>
        </div>   
        <div class="footer_general">
                <div class="lien_general">
                    <a href="pages/actualites.php" > TOUTES LES ACTUALITÉS ></a>
                </div>           
        </div> 
    </div>
    
<!-- End Actualités -->
<!-- Les Boxs -->

<div id="les_boxs">
    <div class="top_section">
        <div>
        <a href="#les_boxs"><h2>Les Boxs</h2></a>
        </div>
        <div>
            <a href="#"><img id="logo_footer" src="img/logo-locabox2.png" alt=""></a>
        </div>
    </div>
    <div id="exemple_box">
        <div class="carre_box"><img id="img_carre_box" src="img/img5.png" alt=""></div>
        <div class="carre_text_box">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel orci felis. Proin id sem commodo, volutpat ligula quis, aliquam nibh. Aenean elit ligula, condimentum a pharetra nec, maximus quis turpis. Phasellus ut sem euismod, volutpat ipsum non, condimentum urna. Morbi a augue ultrices, porttitor elit non, fermentum ex. Phasellus dapibus tristique felis ut ultricies. Sed dignissim nisi eget fermentum molestie. Nam laoreet a magna eget tempor. In id nisi mattis, venenatis massa id, gravida arcu.</div>
        <div class="carre_box detail">
            <ul>
                <li>Prix : </li>
                <li>Volume : </li>
                <li>Surface : </li>
            </ul>
        </div>
    </div>
    <div class="footer_general">
            <div class="lien_general">
                <a href="pages/boxs.php"> TOUTES LES BOXS ></a>
            </div>           
    </div> 
        
</div>

<!-- End Les Boxs -->
<!-- Simulateur -->

<div id="simulateur">
    <div class="top_section">
        <div>
        <a href="#simulateur"><h2>Simulateur</h2></a>
        </div>
        <div>
            <a href="#"><img id="logo_footer" src="img/logo-locabox2.png" alt=""></a>
        </div>
    </div>

    <div class="container_simulateur">

        <div class='contenu_simulateur'>
            <table>
                <thead>
                    <tr class="head_table">
                        <th>Selectionner une pièces</th>
                        <th>Selectionner la quantité d'objet</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="body_table">
                        <td class="container_piece">
                        <?php foreach ($pieces as $piece) {?>
                            <a href="?id=<?php echo $piece['id']?>#simulateur">
                                <?php echo $piece['libelle']?></a>
                        <?php } ?> 
                        </td>
                        <td class="container_objet">       
                                <?php foreach ($objets_pieces as $objet_piece) {?>
                            <div class="objet"> 
                                <div class="quantite_objet" data-surface="<?php echo $objet_piece["surface"];?>" data-volume="<?php echo $objet_piece["volume"];?>">
                                    <button name="btn_moins" id="moins" class="bouton_moins_plus moins" > - </button>
                                    <input type="text" class="nb" id="input_objet" value=0>
                                    <button name="btn_plus" id="plus" class="bouton_moins_plus plus"> + </button>     
                                </div>
                                <div>
                                    <img width=80px height=80px id="img_simulateur" src="https://unsplash.it/1000/1000?random=" />
                                </div>
                                <div>
                                    <a href="#"><?php echo $objet_piece['nom']?></a>
                                </div>
                            </div>
                                    <?php } ?>                     
                        </td>
                    </tr>

                </tbody>
                
                <tfoot>
                    <tr>
                        <td>
                            <div class="space_result">Surface totale : </div>
                        </td>
                        <td>
                            <input class="space_result result_surface" id="input_surface" value='' type="text">m<sup>2 </sup>
                        </td>
                        <td>
                            <div class="space_result"> Volume totale : </div>
                        </td>
                        <td>
                            <input class="space_result result_volume" id="input_volume" type="text" >m<sup>3 </sup>
                        </td>
                    </tr>
                </tfoot>
    
            </table>
           
        </div>
    </div>


        <div class="footer_general">
            <div class="lien_general">
                <a href="#"> CONTACT </a>
            </div>           
        </div> 
</div>

<!-- End Simulateur -->
<!-- Le Parc -->

<div id="le_parc">

<div class="top_section">
        <div>
        <a href="#le_parc"><h2>Le Parc</h2></a>
        </div>
        <div>
            <a href="#"><img id="logo_footer" src="img/logo-locabox2.png" alt=""></a>
        </div>
    </div>
    <div class="container_le_parc">
        <h5>SÉCURITÉ</h5>
        <div class="securite">
            <div>
                <img class="img_espacement" src="img/photo8.JPG" width=275px height="200px" alt="">
            </div>
            <div>
                <img class="img_espacement" src="img/photo3.JPG" width=275px height="200px" alt="">
            </div>
            <div>
                <img class="img_espacement" src="img/photo5.JPG" width=275px height="200px" alt="">
            </div>
        </div>
        <div class="securite">
            <div>
                <img class="img_espacement" src="img/photo1.jpg" width=275px height="200px" alt="">
            </div>
            <div id="text_securite">Ut aliquet sapien non ex convallis, vulputate viverra mi mollis. Proin ut enim at purus sagittis vehicula. Mauris consectetur id nisi non condimentum. Vestibulum aliquet ligula at orci convallis volutpat. Sed congue hendrerit quam, in hendrerit sem mollis blandit. Aenean sagittis libero consectetur, pharetra augue eleifend, porta erat. Pellentesque lobortis semper mollis. Ut libero turpis, convallis consequat imperdiet eget, faucibus id felis.</div>
            <div>
                <img class="img_espacement" src="img/photo14.PNG" width=275px height="200px" alt="">
            </div>
        </div>
        <div class="securite">
            <div>
                <img class="img_espacement" src="img/photo16.PNG" width=275px height="200px" alt="">
            </div>
            <div>
                <img class="img_espacement" src="img/photo4.jpg" width=275px height="200px" alt="">
            </div>
            <div>
                <img class="img_espacement" src="img/photo15.PNG" width=275px height="200px" alt="">
            </div>
        </div>
    </div>
    <div class="container_le_parc">
        <h5>NOUS LOCALISER</h5>
        <div id="localiser">
            <div class="localiser">
                <div>
                    <iframe class="img_localiser" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2894.5712368202326!2d-1.459985284507526!3d43.490417579127154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5140b949cc09ff%3A0x9a58126858dd2192!2sLOCABOX%20Bayonne!5e0!3m2!1sfr!2sfr!4v1608379657002!5m2!1sfr!2sfr" width="275" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>   
                <div id="container_effet">
                    <div id="container2">
                        <div id="img2"></div>
                        <img class="slide_four" src="img/logo-locabox.png" alt="">
                    </div>
                </div>                 
                <div>
                    <img class="img_localiser" src="img/photo2.jpg" width=275px height="200px" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Le Parc -->
<!-- Contact -->
<div id="contact">
<?php if (isset($_SESSION["message_envoye"]) && $_SESSION["message_envoye"] == false) { ?>
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Le message n'a pas été envoyé, les champs <?php echo implode(", ", $_SESSION["erreur_message"]) ?> sont faux.
    </div>    
    <?php unset($_SESSION["erreur_massage"]); } ?>

    <?php if (isset($_SESSION["message_envoye"]) && $_SESSION["message_envoye"] == true) { ?>
        <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Message envoyé!
    </div>    
    <?php unset($_SESSION["message_envoye"]); } ?>
    <!-- gérer alerte ne s'affiche pas -->

    <div class="titre_contact">
        <h3>Contact</h3>
    </div> 
  
    <div class="arrow-down"></div>
                <div class="formulaire">
                    <form  action="action.php" method="POST">
                        <label class="form_action" for="nom">Nom : </label>
                        <input class="form_action" type="text" name="nom" id="nom"> 
                        <label class="form_action" for="prenom">Prénom : </label>
                        <input class="form_action" type="text" name="prenom" id="prenom"> 
                        <label class="form_action" for="mail">Mail : </label>
                        <input class="form_action" type="text" name="mail" id="mail">
                        <label class="form_action" for="telephone">Téléphone : </label>
                        <input class="form_action" type="text" name="telephone" id="telephone">
                        <label class="form_action" for="objet">Objet : </label>
                        <input class="form_action" type="text" name="objet" id="objet">
                        <label class="form_action" for="message">Message : </label>
                        <textarea  class="form_action"name="message" id="message" cols="30" rows="10"></textarea>
                        <button href="#contact" id="btn-contact" type="submit" name="btn-contact">Envoyer</button>
                    </form>
                </div>
            
</div>

<!-- End Contact -->
<!-- Footer -->
<div id="footer">
    <a href="#"><img height="40px" src="img/logo-locabox2.png" alt=""></a>
</div>
<!-- End Footer -->
<script src="js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
<script src="js/demo.js"></script>
</body>
</html>
