<?php
session_start();
if (isset($_SESSION['username'])) {
    require_once("../database.php");
    $courseId = $_GET['course_id'];
    if (isset($courseId)) {
        deleteCourse($courseId);
    }
    header('location:../course.php');
}
else {
    header('location:../login.php');
}
?>