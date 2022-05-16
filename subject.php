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
</head>

<body>
<?php include 'include/header.html' ?>
<!--endheader-->
<div class="body">
    <div class="container">
        <?php include 'include/menu.html' ?>
        <div id="main-contain">
            <h2>DANH SÁCH SINH VIÊN </h2><br>
            <div id="listSV">
                <form method="post" id="f_search"> <input id="txtSearch" type="search" name="search" placeholder="Nhập tên hoặc MSSV">
                    <input id="btnSearch" type="submit" name="tim" value="">
                </form>

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
                    if (isset($_POST['tim'])) {
                        $giatri = $_POST['search'];
                        //echo $giatri;
                        if (empty($giatri)) {
                            echo "Bạn muốn tìm gì?";
                        } else {
                            $query = "SELECT * FROM sinhvien WHERE sinhvien.name LIKE '%" . $giatri . "%' or sinhvien.sinhvienID = '$giatri'";
                        }
                    } else {
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
                            echo " <td style='text-align: center;'> <a href='function/add_subject.php?id=" . $subjectId . "'><input id='btnSua' type='button' value='sửa' '></a>   <a href='function/delete_subject.php?id=" . $subjectId . "'><input id='btnXoa' type='button' value='xóa'></a> <a href='function/add_course.php?id=" . $subjectId . "'><input id='btnChitiet' type='button' value='tạo khoá học' '></a>  </td>";

                        }
                    }
                    ?>
                </table>
            </div>

            <br>
            <form id="formChucnang">
                <a href="function/add_subject.php"><input id="btnThemSV" type="button" value="THÊM MH"> </a>
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