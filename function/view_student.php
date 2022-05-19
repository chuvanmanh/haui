<?php ob_start() ?>
<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['username'])){
require_once("../database.php");
if (isset($_GET['id'])) {
    $studentId = $_GET['id'];
    $studentById = getStudent($studentId);
} else {
    $studentId = '';
}
?>

<head>
    <meta charset="utf-8">
    <title>Sinh viên</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/fontawesome/css/all.css">
    <link rel="shortcut icon" href="../image/logo.ico">
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
</head>
<body>
<?php include '../include/header_function.html' ?>
<!--endheader-->
<div class="body">
    <div class="container">
        <?php include '../include/menu_function.html' ?>
        <div>
            <img sre="<?= $studentById['name'] ?>" />
        </div>
        <div>
            <?= $studentById['student_code'] ?>
        </div>
        <div>
            <?= $studentById['name'] ?>
        </div>
        <div>
            <?= $studentById['email'] ?>
        </div>
        <div>
            <?= $studentById['gender'] ?>
        </div>
        <div>
            <?= $studentById['dob'] ?>
        </div>
        <div>
            <?= $studentById['phone_number'] ?>
        </div>
        <div>
            <?= $studentById['address'] ?>
        </div>
    </div>

</div>
</body>
</html>
<?php
}
else {
    header('location:../login.php');
}
?>
