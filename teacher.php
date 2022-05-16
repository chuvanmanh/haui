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
    <title>Giảng viên </title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/fontawesome/css/all.css">
    <link rel="shortcut icon" href="image/logo.ico">
</head>
<body>
<?php include 'include/header.html' ?>
<!--endheader-->
<div class="body">
    <div class ="ct">
        <div class="container">
            <?php include 'include/menu.html' ?>
            <div id="main-contain">
                <h2>DANH SÁCH GIẢNG VIÊN </h2><br>
                <div id="listSV">
                    <form method="post" id="f_search"> <input id="txtSearch" type="search" name="search" placeholder="Nhập tên hoặc MSSV">
                        <input id="btnSearch" type="submit" name="tim" value="">
                    </form>

                    <table width="70%">
                        <tr>
                            <th>STT</th>
                            <th>Họ Tên</th>
                            <th>MSGV</th>
                            <th>Email</th>
                            <th>Chuyên môn</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
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
                            $result = getAllTeachers();
                            $i = 0;
                            foreach ($result as $item) {
                                $teacherId = $item['id'];
                                $i++;
                                echo "<tr> ";
                                echo "<td>$i</td>";
                                echo "<td>" . $item['name'] . "</td>";
                                echo "<td>" . $item['teacher_code'] . "</td>";
                                echo "<td>" . $item['email'] . "</td>";
                                echo "<td>" . $item['specialize'] . "</td>";
                                echo "<td>" . $item['phone_number'] . "</td>";
                                echo "<td>" . $item['address'] . "</td>";
                                echo " <td style='text-align: center;'> <a href='function/add_teacher.php?id=" . $teacherId . "'><input id='btnSua' type='button' value='sửa' '></a>   <a href='function/delete_teacher.php?id=" . $teacherId . "'><input id='btnXoa' type='button' value='xóa'></a> <a href='function/view_teacher.php?id=" . $teacherId . "'><input id='btnChitiet' type='button' value='chi  tiết' '></a>  </td>";

                            }
                        }
                        ?>
                    </table>
                </div>

                <br>
                <form id="formChucnang">
                    <a href="function/add_teacher.php"><input id="btnThemSV" type="button" value="THÊM GV"> </a>
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
}
else{
    header('location:login.php');
}
?>