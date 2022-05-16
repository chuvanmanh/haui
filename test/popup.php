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
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
 <style>
       .modal-box{ font-family: 'Poppins', sans-serif; }
.show-modal{
    color: #fff;
    background: linear-gradient(to right, #33a3ff, #0675cf, #49a6fd);
    font-size: 18px;
    font-weight: 600;
    text-transform: capitalize;
    padding: 10px 15px;
    margin: 200px auto 0;
    border: none;
    outline: none;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    display: block;
    transition: all 0.3s ease 0s;
}
.show-modal:hover,
.show-modal:focus{
    color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    outline: none;
}
.modal-dialog{
    width: 400px;
    margin: 70px auto 0;
}
.modal-dialog{ transform: scale(0.5); }
.modal-dialog{ transform: scale(1); }
.modal-dialog .modal-content{
    text-align: center;
    border: none;
}
.modal-content .close{
    color: #fff;
    background: linear-gradient(to right, #33a3ff, #0675cf, #4cd5ff);
    font-size: 25px;
    font-weight: 400;
    text-shadow: none;
    line-height: 27px;
    height: 25px;
    width: 25px;
    border-radius: 50%;
    overflow: hidden;
    opacity: 1;
    position: absolute;
    left: auto;
    right: 8px;
    top: 8px;
    z-index: 1;
    transition: all 0.3s;
}
.modal-content .close:hover{
    color: #fff;
    box-shadow: 0 0 5px rgba(0,0,0,0.5);
}
.close:focus{ outline: none; }
.modal-body{ padding: 60px 40px 40px !important; }
.modal-body .title{
    color: #026fd4;
    font-size: 33px;
    font-weight: 700;
    letter-spacing: 1px;
    margin: 0 0 10px;
}
.modal-body .description{
    color: #9A9EA9;
    font-size: 16px;
    margin: 0 0 20px;
}
.modal-body .form-group{
    text-align: left;
    margin-bottom: 20px;
    position: relative;
}
.modal-body .input-icon{
    color: #777;
    font-size: 18px;
    transform: translateY(-50%);
    position: absolute;
    top: 50%;
    left: 20px;
}
.modal-body .form-control{
    font-size: 17px;
    height: 45px;
    width: 100%;
    padding: 6px 0 6px 50px;
    margin: 0 auto;
    border: 2px solid #eee;
    border-radius: 5px;
    box-shadow: none;
    outline: none;
}
.form-control::placeholder{
    color: #AEAFB1;
}
.form-group.checkbox{
    width: 130px;
    margin-top: 0;
    display: inline-block;
}
.form-group.checkbox label{
    color: #9A9EA9;
    font-weight: normal;
}
.form-group.checkbox input[type=checkbox]{
    margin-left: 0;
}
.modal-body .forgot-pass{
    color: #7F7FD5;
    font-size: 13px;
    text-align: right;
    width: calc(100% - 135px);
    margin: 2px 0;
    display: inline-block;
    vertical-align: top;
    transition: all 0.3s ease 0s;
}
.forgot-pass:hover{
    color: #9A9EA9;
    text-decoration: underline;
}
.modal-content .modal-body .btn{
    color: #fff;
    background: linear-gradient(to right, #33a3ff, #0675cf, #4cd5ff);
    font-size: 16px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    line-height: 38px;
    width: 100%;
    height: 40px;
    padding: 0;
    border: none;
    border-radius: 5px;
    border: none;
    display: inline-block;
    transition: all 0.6s ease 0s;
}
.modal-content .modal-body .btn:hover{
    color: #fff;
    letter-spacing: 2px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}
.modal-content .modal-body .btn:focus{ outline: none; }
@media only screen and (max-width: 480px){
    .modal-dialog{ width: 95% !important; }
    .modal-content .modal-body{
        padding: 60px 20px 40px !important;
    }
}

  </style>
    <meta charset="utf-8">
    <title>Sinh viên</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/fontawesome/css/all.css">
    <link rel="shortcut icon" href="../image/logo.ico">
</head>
<body>
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="modal-box">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg show-modal" data-toggle="modal" data-target="#myModal">
                  Login Form
                </button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content clearfix">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <div class="modal-body">

                                <div class="container">

                                    <div id="main-contain">
                                        <h2>Thêm Sinh Viên</h2>

                                        <div class="form">
                                            <span style="font-size: 20px; color: red; font-style: italic"><b>Mời nhập thông tin sinh viên : </b> </span> </br>
                                            (Chú ý điền đủ thông tin)
                                            </br></br>
                                            <form method="post" action="add_student.php">
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
                                                    <tr>
                                                        <td>Ảnh</td>
                                                        <td><input type="text" name="image" value="<?php if($studentId) echo $studentById['image'];?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Chọn Lớp</td>
                                                        <td><select name="class_id" required>
                                                            <?php
                                    $classes = getAllClasses();
                                    foreach ($classes as $item) {
                                        echo "<option value= '" . $item['id'] . "'>" . $item['name'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td><input type="email" name="email" value="<?php if($studentId) echo $studentById['email'];?>" required></td>
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
                                                            <input id="btnChapNhan" type="submit" value="Hoàn tất" name="addStudent"/>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </form>

                                            <?php
                if (isset($_POST['addStudent'])) {
                    if (empty($_POST['name']) || empty($_POST['student_code']) || empty($_POST['phone_number']) || empty($_POST['email']) || empty($_POST['class_id'])) {
                        echo '<p style="color:red;font-weight:bold; "> Bạn chưa nhập thông tin đầy đủ !</p> ';
                                            //                        if(!$studentId && (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password_confirm']))) {
                                            //                            echo '<p style="color:red;font-weight:bold; "> Bạn chưa nhập thông tin username hoặc password đầy đủ !</p> ';
                                            //                        }
                                            } else {
                                            $studentId = trim($_POST['id']);
                                            $name = trim($_POST['name']);
                                            $studentCode = trim($_POST['student_code']);
                                            $classId = trim($_POST['class_id']);
                                            $email = trim($_POST['email']);
                                            $gender = trim($_POST['gender']);
                                            $dob = trim($_POST['dob']);
                                            $phone = trim($_POST['phone_number']);
                                            $address = trim($_POST['address']);
                                            $image = trim($_POST['image']);
                                            if(!$studentId) {
                                            $username = trim($_POST['username']);
                                            $password = trim($_POST['password']);
                                            $passwordConfirm = trim($_POST['password_confirm']);
                                            if($password == $passwordConfirm) {

                                            addStudent($classId, $studentCode, $name, $email, $gender, $dob, $phone, $address, $image);


                                            $newStudentId = getStudentIdByStudentCode($studentCode);
                                            addUser($username,$password,2,0, $newStudentId);

                                            } else {
                                            echo '<p style="color:red;font-weight:bold; "> Mật khẩu xác nhận chưa đúng!</p> ';
                                            }
                                            }
                                            editStudent($studentId, $classId, $studentCode, $name, $email, $gender, $dob, $phone, $address, $image);
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
<?php
}
else {
    header('location:../login.php');
}
?>
<?php ob_end_flush() ?>
