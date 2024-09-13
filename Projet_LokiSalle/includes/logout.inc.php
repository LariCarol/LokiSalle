<?php
    session_start();
    session_destroy();
    header('Location: ../membre_login.php');