<?php ob_start(); ?>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php include '../include/header_function.html' ?>
    <!--endheader-->
    <div class="body">
        <div class="container">
            <?php include '../include/menu_function.html'?>
            <div id="main-contain">
                <h2>Chi Tiết Sinh Viên</h2>
                <div class="container">
                    <div class="form">
                        <form action="">
                            <table>
                                <tr>
                                    <td>Họ tên</td>
                                    <td>
                                        <input type="text" name="name" value="<?= $studentById['name'] ?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mã sinh viên</td>
                                    <td><input type="text" name="student_code" value="<?= $studentById['student_code'] ?>" readonly></td>
                                </tr>
                                <?php $srcImage = "uploads/".$studentById['image']; ?>
                                <tr>
                                    <td>Ảnh</td>
                                    <td>
                                        <img src="<?= $srcImage ?>" width="100px" height="auto" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="email" name="email" value="<?= $studentById['email'] ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>Giới tính:</td>
                                    <td>
                                        <select name="gender">
                                            <option value=""><?php echo $studentById['gender'] ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ngày sinh</td>
                                    <td><input type="date" name="dob" value="<?= $studentById['dob'] ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td><input type="text" name="phone_number" value="<?= $studentById['phone_number'] ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td>Quê quán</td>
                                    <td><input type="text" name="address" value="<?= $studentById['address'] ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <input id="btnChapNhan" type="submit" value="Hoàn tất" name="addStudent"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
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
<?php ob_end_flush(); ?>
