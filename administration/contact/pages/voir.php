<?php
 session_start();
// $_SESSION = array();
// var_dump($_SESSION);
include 'inc/connect.php';
include 'inc/head.php';
include 'inc/wrapper.php';

$id = $_GET["id"];
$sql = "SELECT * from contact WHERE id=$id";
$req = $bdd->prepare($sql);
$req->execute();
$contact = $req->fetch(PDO::FETCH_ASSOC);
// var_dump($boxs);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="text-center">Fiche contact</h1>

<table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Mail</th>
                    <th>Telephone</th>
                    <th>Objet</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
                <tr>
                    <td><?php echo $contact["nom"] ?></td>
                    <td><?php echo $contact["prenom"] ?></td>
                    <td><?php echo $contact["mail"] ?></td>
                    <td><?php echo $contact["telephone"] ?></td>
                    <td><?php echo $contact["objet"] ?> </td>
                    <td><?php echo $contact["message"] ?></td>
                    <td>
                        <?php
                            $date = date_create($contact["date"]);
                            echo $date -> format('d/m/Y') ;
                        ?>
                    </td>
                    <td><a href="repondre.php?id=<?php echo $contact['id'] ?>"><button>Répondre</button></a></td>
                </tr>
        
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
        <a href="../index.php" class="text-center btn btn-primary">Retour</a>
        </div>
<!-- End Content -->
</div>
<?php
include 'inc/footer.php';
?>