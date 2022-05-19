<?php
session_start();
if (isset($_SESSION['username'])) {
    require_once("../database.php");
    if (isset($_POST['key_search'])) {
        $keySearch = $_POST['key_search'];
         $result = searchStudent($keySearch);
        echo $result;
    } else echo "Không tìm thấy!";
} else {
    header('location:../login.php');
}
