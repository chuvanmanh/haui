<?php
session_start();
if (isset($_SESSION['username'])) {
    require_once("../database.php");
    $teacherId = $_GET['id'];
    if (isset($teacherId)) {
        deleteTeacher($teacherId);
    }
    header('location:../teacher.php');
}
else {
    header('location:../login.php');
}
?><?php
