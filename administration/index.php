
<?php
include 'inc/config.php';
include 'vendor/autoload.php';
include 'inc/connect.php';
if (!is_connect()) {
    header('location: login.php');
    }
include 'inc/head.php';
include 'inc/wrapper.php';

// $_SESSION['utilisateur']=$utilisateur;
// var_dump($utilisateur);



?>

<!-- Begin Page Content -->
<div class="container-fluid">
<h1>Bienvenue sur votre système de gestion de base de données</h1>
<?php
$contrat = new PhpOffice\PhpWord\TemplateProcessor ('c:\wamp64\www\locabox/administration/location/contrat/template_contrat/template_contrat.docx');

// var_dump($contrat);

$contrat->setValue ('prenom', 'Nicolas');
$contrat->setValue ('nom', 'Freche');
$contrat->saveAs('c:\wamp64\www\locabox/administration/location/contrat/template_contrat/demo.docx')
?>

<?php
// exemple boucle foreach
$tab = ["lundi"," mardi","mercredi", "dimanche"];
// var_dump($tab);
// foreach ($tab as $i => $value) {
//     echo "boucle ".$i;
//     var_dump($i." -> ".$value);
// };

?>

</div>
<!-- End Content -->
<?php
include 'inc/footer.php';
?>