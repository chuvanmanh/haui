<?php
session_start();
if (isset($_SESSION['username'])) {
    require_once("../database.php");
    if (isset($_POST['chs_code'])) {
        $chsCode = $_POST['chs_code'];
        $l1 = $_POST['l1'];
        $l2 = $_POST['l2'];
        $l3 = $_POST['l3'];
        addPointForStudent($chsCode, $l1, $l2, $l3);
        echo "Nhập thành công";
    } else echo "Nhập thất bại!";
} else {
    header('location:../login.php');
}