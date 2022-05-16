<?php
session_start();
if (isset($_SESSION['username'])) {
    require_once("../database.php");
    $studentId = $_GET['id'];
    if (isset($studentId)) {
        deleteStudent($studentId);
    }
    header('location:../student.php');
}
else {
        header('location:../login.php');
    }
?>