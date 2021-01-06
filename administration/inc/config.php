<?php

session_start();

    function is_connect() {
    if(isset($_SESSION['connect']) &&$_SESSION['connect']===true){
        return true;
    }
        return false;
}

?>
