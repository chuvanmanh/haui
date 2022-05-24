<?php
session_start();
if (isset($_SESSION['username'])) {
    require_once("../database.php");
    $subjectId = $_GET['id'];
    if (isset($subjectId)) {
        deleteSubject($subjectId);
    }
    header('location:../subject.php');
} else {
    header('location:../login.php');
}
?><?php
