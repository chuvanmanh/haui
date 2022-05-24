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
  <title>Contact Us</title>
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
                  <div class="well well-sm " style="background-color:#025eb1;color:#fff;"><b> Recent Post </b> </div>
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
            <div class="panel-body">

              <!-- Map Column -->
              <div class="col-md-8">
                Add in backend
                <!-- Embedded Google Map -->
                <div class="mapouter">
                  <div class=""><iframe width="500" height="400" id=""></iframe>

                  </div>
                  <style>
                    .mapouter {
                      text-align: right;
                      height: 600px;
                      width: 400px;
                    }

                    .gmap_canvas {
                      overflow: hidden;
                      background: none !important;
                      height: 400px;
                      width: 600px;
                    }
                  </style>
                </div>
              </div>
              <!-- Contact Details Column -->
              <div class="col-md-4">
                <h3>Thông tin liên hệ</h3>
                <p>
                  Đại học Công Nghiệp Hà Nội
                  <br>389 Cầu Diễn - Quận Bắc Từ Liêm - Hà Nội<br>
                </p>
                <p><i class="fa fa-phone"></i>
                  <abbr title="Phone">Phone</abbr>: (84) 22222222
                </p>
                <p><i class="fa fa-envelope-o"></i>
                  <abbr title="Email">Email</abbr>: <a href="mailto:nhom5php@haui.edu.vn">nhom5php@haui.edu.vn</a>
                </p>
                <p><i class="fa fa-clock-o"></i>
                  <abbr title="Hours"></abbr>Thứ hai - Thứ 7: 7:00 AM - 5:00 PM
                </p>
                <ul class="list-unstyled list-inline list-social-icons">
                  <li>
                    <a href=""><i class="fa fa-facebook-square fa-2x"></i></a>
                  </li>
                  <li>
                    <a href=""><i class="fa fa-linkedin-square fa-2x"></i></a>
                  </li>
                  <li>
                    <a href=""><i class="fa fa-twitter-square fa-2x"></i></a>
                  </li>
                  <li>
                    <a href=""><i class="fa fa-google-plus-square fa-2x"></i></a>
                  </li>
                </ul>
              </div>



            </div>
          </div>
        </div>
        <footer class="panel-footer" style="background-color:#025eb1;color:#fff;">
          <p align="center">© Online HAUI Student Management System</p>
        </footer>
      </div>