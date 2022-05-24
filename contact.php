<!DOCTYPE html>
<html>
<?php
session_start();
if(isset($_SESSION['username']))
{
?>

<head>
    <meta charset="utf-8">
    <title>Contact</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/fontawesome/css/all.css">
    <link rel="shortcut icon" href="image/logo.ico">
</head>
<body>
<?php include 'include/header.html' ?>
<!--endheader-->
<div class="body">
    <div class="container">
        <?php include 'include/menu.html' ?>
        <div id="main-contain">
            <h2>CONTACT </h2>
            <div id="contact-contain">
                <img src="image/fit-logo.png" alt="khoacndttt" height="100%">
                <br><big>
                    <span style="color:red">Website quản lý sinh viên </span></big><br>
                Development by Team @5
                <br>
                <br>
                <br>
                <b> Contact me: </b>
                <br> <u> Phonenumber </u>: 0999999999
                <br> <u> Email </u>: dhcnhn@gmail.com

                <br>
                Excersise : Application Programming.
                <br>
                &copy; No Copyright
            </div>
        </div>

    </div>

</div>
<!--endbody-->
<footer>
    <div class="container">
        © Nhom 5
    </div>
</footer>

</body>
</html>
<?php
}
else{
    header('location:login.php');
}
?>