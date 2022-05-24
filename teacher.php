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
    <div class ="ct">
        <div class="container">
            <?php include 'include/menu.html' ?>
            <div id="main-contain">
                <h2>DANH SÁCH GIẢNG VIÊN </h2><br>
                <div id="listSV">
                    <form method="post" id="f_search">
                        <div class="search-box">
                            <button class="btn-search"><i class="fas fa-search"></i></button>
                            <input type="text" class="input-search" placeholder="Type to Search...">
                        </div>
                    </form>
                    <br>
                    <table width="70%">
                        <tr>
                            <th>STT</th>
                            <th>Họ Tên</th>
                            <th>MSGV</th>
                            <th>Email</th>
                            <th>Bộ môn</th>
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
                                echo " <td style='text-align: center;'> <a href='function/add_teacher.php?id=" . $teacherId . "'><input id='btnSua' type='button' value='Sửa' '></a>   <a onclick='return confirmDelete(this);' href='function/delete_teacher.php?id=" . $teacherId . "'><input id='btnXoa' type='button' value='Xóa'></a> <a href='function/view_teacher.php?id=" . $teacherId . "'><input id='btnChitiet' type='button' value='Chi  tiết' '></a>  </td>";

                            }
                        }
                        ?>
                    </table>
                </div>

                <br>
                <form id="formChucnang">
                    <a href="function/add_teacher.php"><input id="btnThemSV" type="button" value="THÊM GIÁO VIÊN"> </a>
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