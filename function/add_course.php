<?php ob_start() ?>
<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['username'])){
require_once("../database.php");
if(isset($_GET['id'])) {
    $subjectId = $_GET['id'];
    $subjectById = getSubject($subjectId);
} else {
    $subjectId = '';
}
if(isset($_GET['course_id'])) {
    $courseId = $_GET['course_id'];
    $courseById = getCourse($courseId);
} else {
    $courseId = '';
}

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
            <h2>Thêm Lớp Học</h2>

            <div class="form">
                <span style="font-size: 20px; color: red; font-style: italic"><b>Mời nhập thông tin lớp học : </b> </span> </br>
                (Chú ý điền đủ thông tin)
                </br></br>
                <form method="post" action="add_course.php">
                    <table>
                        <?php if(!$courseId): ?>
                        <tr>
                            <td>Mã môn</td>
                            <td>
                                <?= $subjectById['subject_code']; ?>
                                <input type="hidden" name="subject_code" value=" <?= $subjectById['subject_code']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Tên môn học</td>
                            <td> <?= $subjectById['name']; ?></td>
                            <input type="hidden" name="name" value=" <?= $subjectById['name']; ?>"/>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Mã lớp học</td>
                            <td>
                                <input type="text" name="course_code" value="<?php if($courseId) echo $courseById['course_code'];?>">
                                <input type="hidden" name="course_id" value="<?php if($courseId) echo $courseId;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Tên lớp</td>
                            <td>
                                <input type="text" name="room" value="<?php if($courseId) echo $courseById['room'];?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Chọn giáo viên</td>
                            <td><select name="teacher_code" required>
                                    <?php
                                    $teachers = getAllTeachers();
                                    foreach ($teachers as $item) {
                                        echo "<option value= '" . $item['teacher_code'] . "'>" . $item['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Số tiết học</td>
                            <td><input type="text" name="number_lesson" value="<?php if($courseId) echo $courseById['number_lesson'];?>" required></td>
                        </tr>
                        <tr>
                            <td>Ngày học</td>
                            <td>
                                <select name="day_of_week">
                                    <option value="">Please select</option>
                                    <option value="mon">Thứ hai</option>
                                    <option value="tue">Thứ ba</option>
                                    <option value="wed">Thứ tư</option>
                                    <option value="thu">Thứ năm</option>
                                    <option value="fri">Thứ sáu</option>
                                    <option value="sar">Thứ bảy</option>
                                    <option value="sun">Chủ nhật</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2>
                                <input id="btnChapNhan" type="submit" value="Hoàn tất" name="addCourse"/>
                            </td>
                        </tr>
                    </table>

                </form>

                <?php
                if (isset($_POST['addCourse'])) {
                    if (empty($_POST['course_code']) || empty($_POST['room']) || empty($_POST['teacher_code']) || empty($_POST['number_lesson']) || empty($_POST['day_of_week'])) {
                        echo '<p style="color:red;font-weight:bold; "> Bạn chưa nhập thông tin đầy đủ !</p> ';
                    } else {
                        $courseId = trim($_POST['course_id']);
                        $courseCode = trim($_POST['course_code']);
                        $room = trim($_POST['room']);
                        $teacherCode = trim($_POST['teacher_code']);
                        $numberOfLesson = trim($_POST['number_lesson']);
                        $dayOfWeek = trim($_POST['day_of_week']);
                        if(!$courseId) {
                            $subjectCode = trim($_POST['subject_code']);
                            $subjectName = trim($_POST['name']);
                            addCourse($courseCode, $room, $teacherCode, $subjectCode, $numberOfLesson, $dayOfWeek);
                            header('location:../subject.php');
                        } else {
                            editCourse($courseId, $courseCode, $room, $teacherCode, $numberOfLesson, $dayOfWeek);
                            header('location:../course.php');
                        }
                    }
                }
                ?>
                <br>
                Chọn menu bên trái hoặc click vào <a href="../student.php"
                                                     style="color: blue; text-decoration:underline; font-weight:bold;">đây</a>
                để quay lại danh sách sinh viên.
                <br>
                <br>
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
else {
    header('location:../login.php');
}
?>
<?php ob_end_flush() ?>
