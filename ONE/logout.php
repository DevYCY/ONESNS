
<?php
    session_start(); 
    if(isset($_SESSION['UID'])){
        session_unset(); 
        session_destroy(); 
    }
?> 