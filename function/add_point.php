<!DOCTYPE html>
<html>
<?php
session_start();
require_once("../database.php");
if (isset($_SESSION['username'])) {
connectDb();
if(isset($_GET['course_code'])) {
    $courseCode = $_GET['course_code'];
    $studentByCourseCode = getStudentByCourseCode($courseCode);
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
            $("#table tr td input.update").click(function(){
                $(this).addClass('selected').siblings().removeClass('selected');
                var chsCode = $("#table tr").find('input.chsCode').val();
                var l1 = $("#table tr").find('input.l1').val();
                var l2 = $("#table tr").find('input.l2').val();
                var l3 = $("#table tr").find('input.l3').val();
                alert(l1);
                $.post({
                    url: 'add_point_for_student.php',
                    data: {
                        chs_code: chsCode,
                        l1: l1,
                        l2: l2,
                        l3: l3
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
                <table width="70%" id="table">
                    <tr>
                        <th>STT</th>
                        <th>MSSV</th>
                        <th>Họ Tên</th>
                        <th>L1</th>
                        <th>L2</th>
                        <th>L3</th>
                        <th>Chức năng</th>
                    </tr>

                    <?php
                        $i = 0;
                        foreach ($studentByCourseCode as $item) {
                            $chsCode = $item['chs_code'];
                            $i++;
                            echo "<tr> ";
                            echo "<td>$i</td>";
                            echo "<td>" . $item['student_code'] . "</td>";
                            echo "<td>" . $item['name'] . "</td>";
                            echo "<input class='chsCode' type='hidden' name='chsCode' value=". $chsCode .">";
                            echo "<td> <input class='l1' type='text' name='l1'></td>";
                            echo "<td> <input class='l2' type='text' name='l2'></td>";
                            echo "<td> <input class='l3' type='text' name='l3'></td>";
                            echo " <td style='text-align: center;'> <input id='btnChitiet' class='update' type='button' value='update' name='point'> </td>";
                            echo "</tr> ";
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

