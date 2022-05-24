<?php
session_start();
include './database.php';
connectDb();
if (isset($_POST['sidebarLogin'])) {
    if (empty($_POST['username']) or empty($_POST['password'])) {
        echo ' </br> <p style="color:red"> vui lòng nhập đầy đủ username và password !</p>';
        exit;
    } else {
        $username = trim(addslashes($_POST['username']));
        $password = trim(addslashes($_POST['password']));

        //$password = md5($password);
        $result = getUsername($username);
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }
        $row = mysqli_fetch_array($result);
        if ($password != $row['password']) {
            echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }

        $_SESSION['username'] = $username;
        header('location:index.php');
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>About Us</title>
    <link rel="shortcut icon" href="image/logo.ico">

    <!-- Bootstrap Core CSS -->
    <link href="./style/bootstrap.min.css" rel="stylesheet">

    <link href="./style/modern.css" rel="stylesheet">
    <link href="./style/costum.css" rel="stylesheet">

    <style type="text/css">
        .p {
            color: white;
            margin-bottom: 0;
            margin-top: 0;
            list-style: none;
        }

        .p>a {
            color: white;
            margin-bottom: 0;
            margin: 0;
            padding: 0;
            text-decoration: none;
            background-color: #0000FF;
        }

        .p>a:hover,
        .p>a:focus {
            color: black;
            text-decoration: none;
            background-color: #2d52f2;
        }



        .title-logo {
            color: black;
            text-decoration: none;
            font-size: 42px;
            font-family: "broadway";
            padding: 0;
            margin: 0;
            top: 0;
        }

        .title-logo:hover {
            color: blue;
            text-decoration: none;
        }

        .carttxtactive {
            color: red;
            font-style: bold;
            box-shadow: red;

        }

        .carttxtactive:hover {
            color: white;
        }

        .menu li {
            left: 0px;
            width: 150px;
            padding: 0 3px 0 3px;
            text-align: center;
            cursor: pointer;
        }

        .stretch {
            margin-bottom: -20px;
        }

        .stretch img {
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .da-thumbs li a div {
            top: 0px;
            left: -100%;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .da-thumbs li a:hover div {
            left: 0px;
        }

        .home>.pix_diapo,
        .da-thumbs {
            width: 100%;
        }

        .pix_diapo div img {
            width: 100%;
            height: 100%;
        }
    </style>

<body style="background-color:#e0e4e5">

    <div class="container stretch">
        <div class="row">
            <img src="./style/header.jpg">
        </div>
    </div>
    <div class="navbar   navbar-magbanua  container" role="navigation">
        <div class="container ">
            <div class="navbar-header">
                <div class="navbar-menu p">Menu</div>
                <button type="button" class="navbar-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse bigMenu">
                <ul class="nav navbar-nav menu" style="margin-left:-4%;">
                    <li class="dropdown dropdown-toggle">
                        <a href="./login.php">Home</a>
                    </li>

                    <li class="dropdown-toggle">
                        <a href="./contact_us.php">Contact Us</a>
                    </li>

                    <li class="dropdown-toggle">
                        <a href="./about_us.php">About Us</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div id="page-wrapper">
                <div class="row" style="min-height: 400px;">
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="list-group">
                                    <div class="well well-sm " style="background-color:#025eb1;color:#fff;"><b> Recent
                                            Post </b> </div>
                                    <ul>
                                        <li>
                                            <a>Chu Văn Mạnh</a>
                                        </li>
                                        <li>
                                            <a>Đặng Đức Thọ</a>
                                        </li>
                                        <li>
                                            <a>Nguyễn Lân Duy</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="well well-sm" style="background-color:#025eb1;color:#fff;">
                                    <b>Login</b>
                                </div>
                                <form class="form-horizontal span6" method="POST">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label" for="username">Username:</label>
                                            <input id="username" name="username" placeholder="Username" type="text" class="form-control input">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="control-label" for="password">Password:</label>
                                            <input name="password" id="password" placeholder="Password" type="password" class="form-control input ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" id="sidebarLogin" name="sidebarLogin" style="background-color:#025eb1;color:#fff;" class="btn btn-primary btn-sm">
                                                <span class="glyphicon glyphicon-logged-in "></span> Login
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3><b> Sứ mệnh và Tầm nhìn</b>
                                </h3>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <p>
                                </p>
                                <h1> TẦM NHÌN </h1>

                                HaUI 2025: Văn hóa Lãnh đạo Toàn cầu, Chất lượng và Xuất sắc.


                                <h1> SỨ MỆNH </h1>

                                Trường Đại học Công nghiệp Hà Nội cam kết phát triển học thuật và
                                năng lực doanh nghiệp, tạo điều kiện học tập kinh nghiệm và đảm bảo
                                các tiêu chuẩn cao nhất về chất lượng và sự xuất sắc cũng như tính toàn vẹn của thể chế.


                                <h1> MỤC TIÊU </h1>
                                <ul>
                                    <li> Nhận thức rõ sự cần thiết của việc đạt được trật tự, kỷ luật và
                                        sự tôn trọng giữa các bên liên quan bên trong và bên ngoài của nó trong
                                        đạt được mối quan hệ hài hòa giữa các cá nhân và tinh thần
                                        của một.
                                    </li>
                                    <li> Tuân thủ cao các chính sách và tiêu chuẩn, quy tắc hiện có và
                                        các quy định nhằm thúc đẩy văn hóa kỷ luật, tức là kỷ luật
                                        con người, tư tưởng kỷ luật và hành động kỷ luật.
                                    </li>
                                    <li> Chất lượng nâng cao rõ rệt và sự xuất sắc trong học tập và
                                        các chương trình công nghệ thông qua quốc gia và quốc tế
                                        công nhận.
                                    </li>
                                    <li> Theo đuổi nổi bật mạng lưới địa phương và toàn cầu với các tổ chức của
                                        cao hơn, Kỹ thuật - Dạy nghề và giáo dục cơ bản.
                                    </li>
                                    <li> Thúc đẩy mạnh mẽ các liên kết quốc gia và quốc tế,
                                        hợp tác và liên doanh với các tổ chức khác để tăng cường
                                        năng lực và năng lực thể chế.
                                    </li>
                                    <li> Áp dụng công nhận và tôn vinh sự xuất sắc trong nội bộ và
                                        các bên liên quan bên ngoài, các đối tác thể chế trên toàn quốc và
                                        trên toàn thế giới.
                                    </li>
                                    <li> trau dồi sâu sắc và phát triển tính cần thiết và liên tục
                                        các hoạt động nghiên cứu và khuyến nông có liên quan giữa các nhân viên của nó và
                                        sinh viên để thúc đẩy các sáng kiến, phát minh và tính mới.
                                    </li>
                                    <li> Tập thể nỗ lực và duy trì sự thành lập của Green Valley
                                        College Foundation Inc. với tư cách là một tổ chức đẳng cấp thế giới từ tốt đến
                                        tuyệt vời và được xây dựng để tồn tại lâu dài.
                                    </li>
                                </ul>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer" style="background-color:#025eb1;color:#fff;">
                    <p align="center">© Online HAUI Student Management System</p>
                </footer>
            </div>