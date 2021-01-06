
<?php
include 'inc/config.php';
include 'inc/connect.php';
if (!is_connect()) {
    header('location: login.php');
    }
include 'inc/head.php';
include 'inc/wrapper.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

Accueil

</div>
<!-- End Content -->
<?php
include 'inc/footer.php';
?>