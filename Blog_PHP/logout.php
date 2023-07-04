<?php

    include './include/session.php';

   
    session_destroy();
    

    header('location:index.php');