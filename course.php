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
            <h2>DANH SÁCH LỚP </h2><br>
            <div id="listSV">
                <div class="search-box">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                    <input type="text" class="input-search" placeholder="Type to Search...">
                </div>
                <br>
                <table width="70%">
                    <tr>
                        <th>STT</th>
                        <th>Mã lớp học</th>
                        <th>Tên môn học</th>
                        <th>Phòng học</th>
                        <th>Số tiết</th>
                        <th>Ngày học</th>
                        <th>Chức năng</th>
                    </tr>

                    <?php
                    $result = getAllCourses();
                    $i = 0;
                    foreach ($result as $item) {
                        $courseId = $item['id'];
                        $subjectCode = $item['subject_code'];
                        $courseCode = $item['course_code'];
                        $i++;
                        echo "<tr> ";
                        echo "<td>$i</td>";
                        echo "<td>" . $item['course_code'] . "</td>";
                        echo "<td>" . $item['name'] . "</td>";
                        echo "<td>" . $item['room'] . "</td>";
                        echo "<td>" . $item['number_lesson'] . "</td>";
                        echo "<td>" . $item['day_of_week'] . "</td>";

                        echo " <td style='text-align: center;'> <a href='function/add_course.php?course_id=$courseId'><input id='btnSua' type='button' value='Sửa' '></a>   <a href='function/delete_course.php?course_id=$courseId'><input id='btnXoa' type='button' value='Xóa'></a>  <a href='function/add_student_to_course.php?course_code=$courseCode'><input id='btnChitiet' type='button' value='Thêm sinh viên' '></a> <a href='function/add_point.php?course_code=$courseCode'><input id='btnChitiet' type='button' value='Nhập điểm' '></a> </td>";
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