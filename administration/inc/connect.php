<?php

$user = 'locabox';
$password = 'LnRgbtw8lYDMkFq1';
// essaye de se connecter à la bdd
try {
    // Création objet PDO
    $bdd = new PDO('mysql:dbname=locabox;host=localhost', $user, $password);
} catch (PDOException $e) {
    // Renvoi d'erreur si bloc try echec
    echo 'Connection failed: ' . $e->getMessage();
}

?>