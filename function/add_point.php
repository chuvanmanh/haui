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
//echo "<pre/>";
//var_dump($studentByCourseCode);
//die();
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
            $(".use-address").click(function(){
                var chsCode = $(this).closest("tr").find(".nr").text();
                alert(chsCode);
                var l1 = $(this).closest("tr").find(".l1").text();
                var l2 = $(this).closest("tr").find(".l2").text();
                var l3 = $(this).closest("tr").find(".l3").text();
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
                            echo "<td >$i</td>";
                            echo "<td>" . $item['student_code'] . "</td>";
                            echo "<td>" . $item['name'] . "</td>";
                            echo "<td class='nr' style='display: none'>" . $item['chs_code'] . "</td>";
                            echo "<td class='l1' contenteditable='true'></td>";
                            echo "<td class='l2' contenteditable='true'></td>";
                            echo "<td class='l3' contenteditable='true'></td>";
                            echo " <td style='text-align: center;'> <button  id='btnChitiet'  type='button' class='use-address'>update</button> </td>";
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

