<?php
session_start();

include "../connect.php";

$sql = "SELECT * FROM box WHERE statut=0";
$req = $bdd->prepare($sql);
$req->execute();
$boxs = $req->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($boxs);
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
<h1>Boxs</h1>

<table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Surface en m<sup>2</sup></th>
                    <th>Volume en m<sup>3</sup></th>
                    <th>Prix</th> 
                    <th>Disponibilité</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($boxs as $key => $value) { ?>
                <tr>
                    <td><?php echo $boxs[$key]["numero"] ?></td>
                    <td><?php echo $boxs[$key]["nom"] ?></td>
                    <td><?php echo $boxs[$key]["surface"] ?> m<sup>2</sup></td>
                    <td><?php echo $boxs[$key]["volume"] ?> m<sup>3</sup></td>
                    <td><?php echo $boxs[$key]["prix"] ?> €</td>
                    <?php
                    if ($boxs[$key]["disponibilite"] == 0)
                        echo '<td style="background : #3DDA19;"> DISPONIBLE </td>';
                    else
                        echo '<td style="background : #BA001A;"> INDISPONIBLE</td>';
                     ?>       
                   
         
                </tr>
            <?php } ?>
            </tbody>
</table>
        <button>Prendre réservation</button>




<script src="js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
<script src="js/demo.js"></script>
</body>
</html>