<?php
session_start();
if (isset($_SESSION['username'])) {
    require_once("../database.php");
    if (isset($_POST['student_code']) || isset($_POST['course_code'])) {
        $studentCode = $_POST['student_code'];
        $courseCode = $_POST['course_code'];
        $chsCode = $courseCode."_".$studentCode;
        addCourseHasStudent($chsCode, $courseCode, $studentCode);
        echo "Thêm thành công";
    } else echo "Thêm thất bại!";
} else {
    header('location:../login.php');
}