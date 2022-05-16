<!DOCTYPE html>
<html>
<?php
session_start();
require_once("../database.php");
if (isset($_SESSION['username'])) {
connectDb();
if(isset($_GET['course_code'])) {
    $courseCode = $_GET['course_code'];
} else {
    $courseCode = '';
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
    <script>
        $(document).ready(function(){
            $("#table tr").click(function(){
                $(this).addClass('selected').siblings().removeClass('selected');
                var studentCode = $(this).find('td:nth-child(3)').html();
                var courseCode = $(this).find('input.courseCode').val();
                $.post({
                    url: 'add_student_to_chs.php',
                    data: {
                        student_code: studentCode,
                        course_code: courseCode
                    },
                    // Nếu thành công thì hiển thị kết quả ra trình duyệt
                    success: function (response) {
                        alert(response);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });

            });

        });
    </script>
</head>

<body>
<?php include '../include/header_function.html'?>
<!--endheader-->
<div class="body">
    <div class="container">
        <?php include '../include/menu_function.html'?>
        <div id="main-contain">
            <h2>DANH SÁCH SINH VIÊN </h2><br>
            <div id="listSV">
                <form method="post" id="f_search"> <input id="txtSearch" type="search" name="search" placeholder="Nhập tên hoặc MSSV">
                    <input id="btnSearch" type="submit" name="tim" value="">
                </form>

                <table width="70%" id="table">
                    <tr>
                        <th>STT</th>
                        <th>Họ Tên</th>
                        <th>MSSV</th>
                        <th>Email</th>
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
                        $result = getAllStudents();
                        $i = 0;
                        foreach ($result as $item) {
                            $i++;
                            echo "<tr> ";
                            echo "<td>$i</td>";
                            echo "<td>" . $item['name'] . "</td>";
                            echo "<td>" . $item['student_code'] . "</td>";
                            echo "<input class='courseCode' type='hidden' name='courseId' value=". $courseCode .">";
                            echo "<td>" . $item['email'] . "</td>";
                            echo " <td style='text-align: center;'> <input class='ok' id='btnChitiet' type='button' value='thêm' name='".$item['student_code']."' '> </td>";
                            echo "</tr> ";
                        }
                    }
                    ?>
                </table>
            </div>
            <br>
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

