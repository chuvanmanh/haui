<!DOCTYPE html>
<html>
<?php
session_start();
require './database.php';
if (isset($_SESSION['username'])) {
connectDb();
?>

<head>
    <meta charset="utf-8">
    <title>Sinh viên</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/fontawesome/css/all.css">
    <link rel="shortcut icon" href="image/logo.ico">
    <script>
        function confirmDelete(link) {
            if (confirm("Bạn có chắc chắn xóa sinh viên này?")) {
                doAjax(link.href, "POST"); // doAjax needs to send the "confirm" field
            }
            return false;
        }
    </script>
</head>

<body>
<?php include 'include/header.html' ?>
<!--endheader-->
<div class="body">
    <div class="container">
        <?php include 'include/menu.html' ?>
        <div id="main-contain">
            <h2>DANH SÁCH MÔN HỌC </h2><br>
            <div id="listSV">
                <form method="post" id="f_search">
                    <!-- <input id="txtSearch" type="search" name="search" placeholder="Nhập tên hoặc MSSV"> -->
                    <div class="search-box">
                        <button class="btn-search"><i class="fas fa-search"></i></button>
                        <input type="text" class="input-search" placeholder="Type to Search...">
                    </div>
                </form>
                <br>
                <table width="70%">
                    <tr>
                        <th>STT</th>
                        <th>Mã môn học</th>
                        <th>Tên môn học</th>
                        <th>Số tín chỉ</th>
                        <th>Khoa</th>
                        <th>Chức năng</th>
                    </tr>
                    <?php
                        $result = getAllSubjects();
                        $i = 0;
                        foreach ($result as $item) {
                            $subjectId = $item['id'];
                            $i++;
                            echo "<tr> ";
                            echo "<td>$i</td>";
                            echo "<td>" . $item['subject_code'] . "</td>";
                            echo "<td>" . $item['name'] . "</td>";
                            echo "<td>" . $item['num_credit'] . "</td>";
                            echo "<td>" . $item['major'] . "</td>";
                            echo " <td style='text-align: center;'> <a href='function/add_subject.php?id=" . $subjectId . "'><input id='btnSua' type='button' value='Sửa' '></a>   <a onclick='return confirmDelete(this);' href='function/delete_subject.php?id=" . $subjectId . "'><input id='btnXoa' type='button' value='Xóa'></a> <a href='function/add_course.php?id=" . $subjectId . "'><input id='btnChitiet' type='button' value='Tạo khoá học' '></a>  </td>";
                        }
                    ?>
                </table>
            </div>

            <br>
            <form id="formChucnang">
                <a href="function/add_subject.php"><input id="btnThemSV" type="button" value="THÊM MÔN HỌC"> </a>
            </form>
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