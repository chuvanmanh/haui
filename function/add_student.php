<?php ob_start() ?>
<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['username'])){
require_once("../database.php");
if(isset($_GET['id'])) {
    $studentId = $_GET['id'];
    $studentById = getStudent($studentId);
} else {
    $studentId = '';
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
            function imagePreview(fileInput) {
                if (fileInput.files && fileInput.files[0]) {
                    var fileReader = new FileReader();
                    fileReader.onload = function (event) {
                        $('#preview').html('<img src="'+event.target.result+'" width="100px" height="auto"/>');
                        $('#editImage').remove();
                    };
                    fileReader.readAsDataURL(fileInput.files[0]);
                }
            }
            $("#image").change(function () {
                imagePreview(this);
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
            <h2>Thêm Sinh Viên</h2>

            <div class="form">
                <span style="font-size: 20px; color: red; font-style: italic"><b>Mời nhập thông tin sinh viên : </b> </span> </br>
                (Chú ý điền đủ thông tin)
                </br></br>
                <form method="post" action="add_student.php" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Họ tên</td>
                            <td>
                                <input type="text" name="name" value="<?php if($studentId) echo $studentById['name'];?>" autofocus required>
                                <input type="hidden" name="id" value="<?php if($studentId) echo $studentId;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Mã sinh viên</td>
                            <td><input type="text" name="student_code" value="<?php if($studentId) echo $studentById['student_code'];?>" required></td>
                        </tr>
                        <?php if(!$studentId): ?>
                            <tr>
                                <td>Ảnh</td>
                                <td>
                                    <input type="file" name="image" id="image" value="<?php if($studentId) echo $studentById['image'];?>">
                                    <div id="preview"></div>
                                </td>

                            </tr>

                        <?php else: ?>
                        <?php $srcImage = "uploads/".$studentById['image']; ?>
                        <tr>
                            <td>Ảnh</td>
                            <td>
                                <input type="file" name="image" id="image" value="<?php if($studentId) echo $studentById['image'];?>">
                                <div id="preview"></div>
                                <img src="<?= $srcImage ?>" width="100px" height="auto" id="editImage"/>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" value="<?php if($studentId) echo $studentById['email'];?>" required></td>
                        </tr>
                        <?php if($studentId): ?>
                        <tr>
                            <td>Giới tính:</td>
                            <td>
                                <select name="gender" required>
                                    <option value="" <?php if($studentById['gender']=="") echo 'selected' ?>>Please select</option>
                                    <option value="Nam" <?php if($studentById['gender']=="Nam") echo 'selected' ?>>Nam</option>
                                    <option value="Nu" <?php if($studentById['gender']=="Nu") echo 'selected' ?>>Nữ</option>
                                    <option value="Khac" <?php if($studentById['gender']=="Khac") echo 'selected' ?>>Khác</option>
                                </select>
                            </td>
                        </tr>
                        <?php else: ?>
                        <tr>
                            <td>Giới tính:</td>
                            <td>
                                <select name="gender" required>
                                    <option value="">Please select</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nu">Nữ</option>
                                    <option value="Khac">Khác</option>
                                </select>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Ngày sinh</td>
                            <td><input type="date" name="dob" value="<?php if($studentId) echo $studentById['dob'];?>"></td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td><input type="text" name="phone_number" value="<?php if($studentId) echo $studentById['phone_number'];?>" required></td>
                        </tr>
                        <tr>
                            <td>Quê quán</td>
                            <td><input type="text" name="address" value="<?php if($studentId) echo $studentById['address'];?>"></td>
                        </tr>
                        <?php if(!$studentId): ?>
                        <tr>
                            <td>Mật khẩu</td>
                            <td><input type="text" name="password" required></td>
                        </tr>
                        <tr>
                            <td>Xác nhận mật khẩu</td>
                            <td><input type="text" name="password_confirm" required></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan=2>
                                <input id="btnChapNhan" type="submit" value="Hoàn tất" name="addStudent"/>
                            </td>
                        </tr>
                    </table>

                </form>

                <?php
                if (isset($_POST['addStudent'])) {
                    if (empty($_POST['name']) || empty($_POST['student_code']) || empty($_POST['phone_number']) || empty($_POST['email'])) {
                        echo '<p style="color:red;font-weight:bold; "> Bạn chưa nhập thông tin đầy đủ !</p> ';
                        if(!$studentId && (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password_confirm']))) {
                            echo '<p style="color:red;font-weight:bold; "> Bạn chưa nhập thông tin username hoặc password đầy đủ !</p> ';
                        }
                    } else {
                        $studentId = trim($_POST['id']);
                        $name = trim($_POST['name']);
                        $studentCode = trim($_POST['student_code']);
                        $email = trim($_POST['email']);
                        $gender = trim($_POST['gender']);
                        $dob = trim($_POST['dob']);
                        $phone = trim($_POST['phone_number']);
                        $address = trim($_POST['address']);

                        // Process image
                        $image = $_FILES['image']['name'];
                        $uploadTo = "uploads/";
                        $allowedImageType = array('jpg','png','jpeg','gif','pdf','doc');
                        $imageName = $_FILES['image']['name'];
                        $tempPath=$_FILES["image"]["tmp_name"];

                        $basename = basename($imageName);
                        $originalPath = $uploadTo.$basename;
                        $imageType = pathinfo($originalPath, PATHINFO_EXTENSION);
                        if(!empty($imageName)){

                            if(in_array($imageType, $allowedImageType)){
                                // Upload file to server
                                if(move_uploaded_file($tempPath,$originalPath)){
                                    echo $imageName." was uploaded successfully";
                                    // write here sql query to store image name in database

                                }else{
                                    echo 'image Not uploaded ! try again';
                                }
                            }else{
                                echo $imageType." image type not allowed";
                            }
                        }else{
                            echo "Please Select a image";
                        }

                        //
                        if(!$studentId) {
                            $username = $studentCode;
                            $password = trim($_POST['password']);
                            $passwordConfirm = trim($_POST['password_confirm']);
                            if($password == $passwordConfirm) {
                                addUser($username,$password,2);
                                addStudent($studentCode, $name, $email, $gender, $dob, $phone, $address, $image);

                            } else {
                                echo '<p style="color:red;font-weight:bold; "> Mật khẩu xác nhận chưa đúng!</p> ';
                            }
                        }
                        else editStudent($studentId, $studentCode, $name, $email, $gender, $dob, $phone, $address, $image);
                        header('location:../student.php');
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
