<?php ob_start() ?>
<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['username'])){
require_once("../database.php");
if(isset($_GET['id'])) {
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
                        $('#previewTeacher').html('<img src="'+event.target.result+'" width="100px" height="auto"/>');
                        $('#editImageTeacher').remove();
                    };
                    fileReader.readAsDataURL(fileInput.files[0]);
                }
            }
            $("#imageTeacher").change(function () {
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
                <form method="post"  enctype="multipart/form-data" action="add_teacher.php">
                    <table>
                        <tr>
                            <td>Họ tên</td>
                            <td>
                                <input type="text" name="name" value="<?php if($teacherId) echo $teacherById['name'];?>" autofocus required>
                                <input type="hidden" name="id" value="<?php if($teacherId) echo $teacherId;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Mã giáo viên</td>
                            <td><input type="text" name="teacher_code" value="<?php if($teacherId) echo $teacherById['teacher_code'];?>" required></td>
                        </tr>
                        <?php if(!$teacherId): ?>
                            <tr>
                                <td>Ảnh</td>
                                <td>
                                    <input type="file" name="image" id="imageTeacher" value="<?php if($teacherId) echo $teacherById['image'];?>">
                                    <div id="previewTeacher"></div>
                                </td>

                            </tr>

                        <?php else: ?>
                            <?php $srcImage = "uploads/".$teacherById['image']; ?>
                            <tr>
                                <td>Ảnh</td>
                                <td>
                                    <input type="file" name="image" id="imageTeacher" value="<?php if($teacherId) echo $teacherById['image'];?>">
                                    <div id="previewTeacher"></div>
                                    <img src="<?= $srcImage ?>" width="100px" height="auto" id="editImageTeacher"/>

                                </td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" value="<?php if($teacherId) echo $teacherById['email'];?>" required></td>
                        </tr>
                        <tr>
                            <td>Specialize</td>
                            <td><input type="text" name="specialize" value="<?php if($teacherId) echo $teacherById['specialize'];?>" required></td>
                        </tr>
                        <tr>
                            <td>Giới tính:</td>
                            <td>
                                <select name="gender">
                                    <option value="">Please select</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nu">Nữ</option>
                                    <option value="Khac">Khác</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td><input type="text" name="phone_number" value="<?php if($teacherId) echo $teacherById['phone_number'];?>" required></td>
                        </tr>
                        <tr>
                            <td>Quê quán</td>
                            <td><input type="text" name="address" value="<?php if($teacherId) echo $teacherById['address'];?>"></td>
                        </tr>
                        <?php if(!$teacherId): ?>
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
                                <input id="btnChapNhan" type="submit" value="Hoàn tất" name="addTeacher"/>
                            </td>
                        </tr>
                    </table>

                </form>

                <?php
                if (isset($_POST['addTeacher'])) {
                    if (empty($_POST['name']) || empty($_POST['teacher_code']) || empty($_POST['phone_number']) || empty($_POST['email'])) {
                        echo '<p style="color:red;font-weight:bold; "> Bạn chưa nhập thông tin đầy đủ !</p> ';
                    } else {
                        $teacherId = trim($_POST['id']);
                        $name = trim($_POST['name']);
                        $teacherCode = trim($_POST['teacher_code']);
                        $email = trim($_POST['email']);
                        $specialize= trim($_POST['specialize']);
                        $gender = trim($_POST['gender']);
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
                        if(!$teacherId) {
                            $username = $teacherCode;
                            $password = trim($_POST['password']);
                            $passwordConfirm = trim($_POST['password_confirm']);
                            if($password == $passwordConfirm) {

                                addTeacher( $teacherCode, $name, $email, $specialize, $gender, $phone, $address, $image);


                                $newStudentId = getStudentIdByStudentCode($teacherCode);
                                addUser($username,$password,1);

                            } else {
                                echo '<p style="color:red;font-weight:bold; "> Mật khẩu xác nhận chưa đúng!</p> ';
                            }
                        }
                        else editTeacher($teacherId, $teacherCode, $name, $email, $specialize, $gender, $phone, $address, $image);
                        header('location:../teacher.php');
                    }
                }
                ?>
                <br>
                Chọn menu bên trái hoặc click vào <a href="../teacher.php"
                                                     style="color: blue; text-decoration:underline; font-weight:bold;">đây</a>
                để quay lại danh sách giảng viên.
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
