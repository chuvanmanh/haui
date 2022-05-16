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
                <form method="post">
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
                        <tr>
                            <td>Ảnh</td>
                            <td><input type="text" name="image" value="<?php if($teacherId) echo $teacherById['image'];?>"></td>
                        </tr>

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
                                <td>Tên đăng nhập</td>
                                <td><input type="text" name="username" required></td>
                            </tr>
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
//                        if(!$teacherId && (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password_confirm']))) {
//                            echo '<p style="color:red;font-weight:bold; "> Bạn chưa nhập thông tin username hoặc password đầy đủ !</p> ';
//                        }
                    } else {
                        $teacherId = trim($_POST['id']);
                        $name = trim($_POST['name']);
                        $teacherCode = trim($_POST['teacher_code']);
                        $email = trim($_POST['email']);
                        $specialize= trim($_POST['specialize']);
                        $gender = trim($_POST['gender']);
                        $phone = trim($_POST['phone_number']);
                        $address = trim($_POST['address']);
                        $image = trim($_POST['image']);
                        if(!$teacherId) {
                            $username = trim($_POST['username']);
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
