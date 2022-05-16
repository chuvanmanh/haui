<?php
session_start();
if (isset($_SESSION['username'])) {
    require_once("../database.php");
    $classId = $_GET['id'];
    if (isset($classId)) {
        deleteClass($classId);
    }
    header('location:../class.php');
}
else {
    header('location:../login.php');
}
?>