<?php

include '../../Models/config.php';

session_start();
session_unset();
session_destroy();

header('location:../login.php');

?>