<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['username'])){
require_once("../database.php");
$classId = $_GET['id'];
$classResult = getClass($classId);

?>

<head>
    <meta charset="utf-8">
    <title>Sinh viên</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/fontawesome/css/all.css">
    <link rel="shortcut icon" href="../image/logo.ico">
</head>
<body>
<?php include '../include/header_function.html'?>
<!--endheader-->
<div class="body">
    <div class="container">
        <?php include '../include/menu_function.html'?>
        <div id="main-contain">
            <h2>DANH SÁCH SINH VIÊN LỚP
                <?php echo $classResult['name'] ;?>
            </h2>
            <br>
            <div id="listSV">
                <table width = "70%">
                    <tr>
                        <th>STT</th>
                        <th>Họ Tên</th>
                        <th>MSSV</th>
                        <th>Email</th>
                        <th>Ngày sinh</th>
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
                        $result = getListStudentByClassId($classId);
                        $i = 0;
                        if(!empty($result)) {
                            foreach ($result as $item) {
                                $studentId = $item['id'];
                                $i++;
                                echo "<tr> ";
                                echo "<td>". $i ."</td>";
                                echo "<td>". $item['name'] ."</td>";
                                echo "<td>". $item['student_code'] ."</td>";
                                echo "<td>". $item['email'] ."</td>";
                                echo "<td>". date("d-m-Y", strtotime($item['dob'])) ."</td>";
                                echo "<td>". $item['phone_number'] ."</td>";
                                echo "<td>". $item['address'] ."</td>";
                                echo " <td style='text-align: center;'> <a href='function/add_student.php?id=" . $studentId . "'><input id='btnSua' type='button' value='sửa' '></a>   <a href='function/delete_student.php?id=" . $studentId . "'><input id='btnXoa' type='button' value='xóa'></a> <a href='function/detail_student.php?id=" . $studentId . "'><input id='btnChitiet' type='button' value='chi  tiết' '></a>  </td>";
                                echo "</tr> ";
                            }
                        } else {
                            echo '<tr > <td colspan="6" align = "center">Chưa có sinh viên ở lớp này! </td></tr>';
                        }
                    }
                    ?>
                </table>
                <br>
                <p style="color: white; text-align:center;"><b> SĨ SỐ: <?php echo $i;?> </b></p>
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
else
{
    header('location: login.php');
}
?>

