<!DOCTYPE html>
<html>
<?php
session_start();
require './database.php';
if (isset($_SESSION['username'])) {
?>
<head>
    <meta charset="utf-8">
    <title>Thông tin lớp học</title>
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
            <h2>DANH SÁCH ĐIỂM CỦA SINH VIÊN </h2><br>
            <div id="listSV">
                <div class="search-box">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search" placeholder="Type to Search...">
                </div>
                <br>
                <table width="70%">
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên </th>
                        <th>Tên sinh viên</th>
                        <th>Điểm L1</th>
                        <th>Điểm L2</th>
                        <th>Điểm L3</th>
                    </tr>

                    <?php
                    $result = getPoint();
                    $i = 0;
                    foreach ($result as $item) {
                        $i++;
                        echo "<tr> ";
                        echo "<td>$i</td>";
                        echo "<td>" . $item['student_code'] . "</td>";
                        echo "<td>" . $item['name'] . "</td>";
                        echo "<td>" . $item['point_l1'] . "</td>";
                        echo "<td>" . $item['point_l2'] . "</td>";
                        echo "<td>" . $item['point_l3'] . "</td>";
                    }
                    ?>
                </table>
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
} else {
    header('location:login.php');
}
?>