<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['username'])) {
    require_once("../database.php");
    if (isset($_GET['id'])) {
        $teacherId = $_GET['id'];
        $teacherById = getTeacher($teacherId);
    } else {
        $teacherId = '';
    }
?>

    <head>
        <meta charset="utf-8">
        <title>Sinh viên</title>
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/fontawesome/css/all.css">
        <link rel="shortcut icon" href="../image/logo.ico">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                function imagePreview(fileInput) {
                    if (fileInput.files && fileInput.files[0]) {
                        var fileReader = new FileReader();
                        fileReader.onload = function(event) {
                            $('#previewTeacher').html('<img src="' + event.target.result + '" width="100px" height="auto"/>');
                            $('#editImageTeacher').remove();
                        };
                        fileReader.readAsDataURL(fileInput.files[0]);
                    }
                }
                $("#imageTeacher").change(function() {
                    imagePreview(this);
                });

            });
        </script>

    </head>

    <body>
        <?php include '../include/header_function.html' ?>
        <!--endheader-->
        <div class="body">
            <div class="container">
                <?php include '../include/menu_function.html' ?>
                <div id="main-contain">
                    <h2>Chi Tiết Giáo Viên</h2>
                    <div class="container">
                        <div class="form">
                            <form action="">
                                <table>
                                    <tr>
                                        <td>Họ tên</td>
                                        <td>
                                            <input type="text" name="name" value="<?php echo $teacherById['name']; ?>" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mã giáo viên</td>
                                        <td><input type="text" name="teacher_code" value="<?php echo $teacherById['teacher_code']; ?>" readonly></td>

                                    </tr>
                                    <?php $srcImage = "uploads/" . $teacherById['image']; ?>
                                    <tr>
                                        <td>Ảnh</td>
                                        <td>
                                            <img src="<?= $srcImage ?>" width="100px" height="auto" />
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Email</td>
                                        <td><input type="email" name="email" value="<?php echo $teacherById['email']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Bộ Môn</td>
                                        <td><input type="text" name="specialize" value="<?php echo $teacherById['specialize']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Giới Tính</td>
                                        <td><input type="text" name="gender" value="<?php echo $teacherById['gender']; ?>" readonly></td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Giới tính:</td>
                                        <td>
                                            <select name="gender" required>
                                                <option value="" <?php if ($teacherById['gender'] == "") echo 'selected' ?>>Please select</option>
                                                <option value="Nam" <?php if ($teacherById['gender'] == "Nam") echo 'selected' ?>>Nam</option>
                                                <option value="Nu" <?php if ($teacherById['gender'] == "Nu") echo 'selected' ?>>Nữ</option>
                                                <option value="Khac" <?php if ($teacherById['gender'] == "Khac") echo 'selected' ?>>Khác</option>
                                            </select>
                                        </td>
                                    </tr> -->

                                    <tr>
                                        <td>Số điện thoại</td>
                                        <td><input type="text" name="phone_number" value="<?php echo $teacherById['phone_number']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Quê quán</td>
                                        <td><input type="text" name="address" value="<?php echo $teacherById['address']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 align="center">
                                            <input style="background-color:forestgreen; width: auto; margin-top: 10px;" type="button" onclick="location.href='<?php echo '../teacher.php' ?>';" value="Quay lại" />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </body>

</html>
<?php
} else {
    header('location:../login.php');
}
?>
<?php ob_end_flush(); ?>