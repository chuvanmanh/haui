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
            <h2>Thêm Môn Học</h2>

            <div class="form">
                <span style="font-size: 20px; color: red; font-style: italic"><b>Mời nhập thông tin môn học : </b> </span> </br>
                (Chú ý điền đủ thông tin)
                </br></br>
                <form method="post" action="add_subject.php">
                    <table>
                        <tr>
                            <td>Mã môn học</td>
                            <td><input type="text" name="subject_code" value="<?php if($subjectId) echo $subjectById['subject_code'];?>" required></td>
                        </tr>
                        <tr>
                            <td>Tên môn học</td>
                            <td>
                                <input type="text" name="name" value="<?php if($subjectId) echo $subjectById['name'];?>" autofocus required>
                                <input type="hidden" name="id" value="<?php if($subjectId) echo $subjectId;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Số tín chỉ</td>
                            <td><input type="text" name="num_credit" value="<?php if($subjectId) echo $subjectById['num_credit'];?>"></td>
                        </tr>
                        <tr>
                            <td>Khoa</td>
                            <td><input type="text" name="major" value="<?php if($subjectId) echo $subjectById['major'];?>" required></td>
                        </tr>
                        <tr>
                            <td colspan=2>
                                <input id="btnChapNhan" type="submit" value="Hoàn tất" name="addSubject"/>
                            </td>
                        </tr>
                    </table>

                </form>

                <?php
                if (isset($_POST['addSubject'])) {
                    if (empty($_POST['name']) || empty($_POST['subject_code']) || empty($_POST['num_credit']) || empty($_POST['major'])) {
                        echo '<p style="color:red;font-weight:bold; "> Bạn chưa nhập thông tin đầy đủ !</p> ';
                    } else {
                        $subjectId = trim($_POST['id']);
                        $name = trim($_POST['name']);
                        $subjectCode = trim($_POST['subject_code']);
                        $numberCredit = trim($_POST['num_credit']);
                        $major = trim($_POST['major']);
                        $numSub = count(getAllSubjects());
                        if(!$subjectId) {
                            addSubject($subjectCode, $name, $numberCredit, $major);

                            if ($numSub == count(getAllSubjects())) {
                                echo '<p style="color:red;font-weight:bold; ">ERROR: Mã môn học đã tồn tại!</p> ';
                            } else
                                header('location:../subject.php');
                        }
                        else 
                        {
                            editSubject($subjectId, $subjectCode, $name, $numberCredit, $major);
                            header('location:../subject.php');
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
