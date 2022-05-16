<?php
session_start();
if (isset($_SESSION['username'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>SM - Trang chủ</title>
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
                <div id="cthome">
                    <!--                <div>-->
                    <!--                    <marquee width="50%"  scrollamount=”2″ behavior=”slide” >-->
                    <!--                        --><?php
                                                    //                        if(mysqli_num_rows($result)>0){
                                                    //                            $i = 0;
                                                    //                            while($r= mysqli_fetch_assoc($result)){
                                                    //                                $i++;
                                                    //                                $tin = $r['noidung'];
                                                    //                                echo $tin ;
                                                    //                            }
                                                    //                        }
                                                    //                        
                                                    ?>
                    <!--                    </marquee>-->
                    <!--                    <span>NEWS</span>-->
                    <!--                </div>-->
                    <img src="image/anhcover.jpg" width="80%" style="border-radius: 20px;"> </br></br>
                    <h3> Student Management Website System FIT-HaUI </h3> </br>
                    <a href="class.php"><i class="fas fa-users"></i></a>
                    <a href="student.php"><i class="fas fa-graduation-cap"></i></a>
                    <a href="teacher.php"><i class="fas fa-chalkboard-teacher"></i></a>
                    <a href="point.php"><i class="fas fa-check"></i></a>
                    <a href="contact.php"><i class="fas fa-address-book"></i></a>
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
    header('location: login.php');
}
?>