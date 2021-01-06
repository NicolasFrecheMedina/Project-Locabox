<?php

$user = 'locabox';
$password = 'LnRgbtw8lYDMkFq1';
try {
    $bdd = new PDO('mysql:dbname=locabox;host=localhost', $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>