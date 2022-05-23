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
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script>
        function confirmDelete()
            {
                var x = confirm("Bạn có muốn xoá sinh viên này không ?");
                if (x)
                    return true;
                else
                    return false;
            }
        $(document).ready(function () {

            $('#search').on("keyup", function () {
                var keySearch = $(this).val();

                if (keySearch != "") {
                    $.ajax({
                        method: 'POST',
                        url: 'function/search_student.php',
                        data: {key_search: keySearch},
                        success: function (response) {
                            $('#showValue').html(response);
                            $('#showValue').css('display', 'block');
                            $("#search").focusout(function () {
                                $('#showValue').css('display', 'none');
                            });
                            $("#search").focusin(function () {
                                $('#showValue').css('display', 'block');
                            });
                        }
                    });
                } else {
                    $('#showValue').css('display', 'none');
                }
            });
        });
    </script>
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
                <div class="search-box">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" name="search" class="search input-search" placeholder="Type to Search..." id="search">
                    <div id="showValue"></div>
                </div>
                <br>

                <table width="70%">
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
                    $result = getAllStudents();
                    $i = 0;
                    $a = 'abc';
                    foreach ($result as $item) {
                        $studentId = $item['id'];
                        $i++;
                        echo "<tr> ";
                        echo "<td> $i</td>";
                        echo "<td>" . $item['name'] . "</td>";
                        echo "<td>" . $item['student_code'] . "</td>";
                        echo "<td>" . $item['email'] . "</td>";
                        echo "<td>" . date("d-m-Y", strtotime($item['dob'])) . "</td>";
                        echo "<td>" . $item['phone_number'] . "</td>";
                        echo "<td>" . $item['address'] . "</td>";
                        echo " <td style='text-align: center;'> <a href='function/add_student.php?id=" . $studentId . "'><input id='btnSua' type='button' value='Sửa' '></a>   <a Onclick='confirmDelete()' href='function/delete_student.php?id=" . $studentId . "'><input id='btnXoa' type='button' value='Xóa' ></a> <a href='function/view_student.php?id=" . $studentId . "'><input id='btnChitiet' type='button' value='Chi  tiết' '></a>  </td>";
                    }
                    ?>
                </table>
            </div>

            <br>
            <form id="formChucnang">
                <a href="function/add_student.php"><input id="btnThemSV" type="button" value="THÊM SINH VIÊN"> </a>
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