<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
        // Redirecting To Homepage
        header("Location: project.php");
    }
?>