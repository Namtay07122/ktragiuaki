<?php
    require_once ('config/dbhelper.php');	

  
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section>
        <header>
            <div id="inner-header" class="container">
                <a class="logo" href="#">ĐH Thuỷ Lợi</a>
                <nav>
                    <ul id="main-menu">
                        <li><a href="index.php">Trang chủ</a></li>
                        <li><a href="">Đăng nhập admin</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="clearfix"></div>
    </section>
    <br> <br><br><br>
    <section class="details">
    <?php 

        $sql =  " select * from cadres where id =".$_GET['id']." ";

        $directory =  select_one($sql) ;
        if($directory != null) {
        
                $name = $directory['name'];
                $thumbnail = $directory['thumbnail'];
                $cv = $directory['position'];

                $em = $directory['email'];
                $sdt = $directory['phonenumber'];
                $dtcq = $directory['organ'];
                $iddv = $directory['id_unit'];

                $sqldv = "select name from unit where id = " .$iddv;
                $iddv = select_one($sqldv) ;
        if ($iddv!= null) {
                $dv = $iddv['name'];
        }


        }  ?>
    <div class="grid-container1">
        <div class="grid-item1"><img src="<?=$thumbnail?>" alt=""></div>
        <div class="grid-item1 a">
            <p><strong>Chức vụ : </strong> <?=$cv?></p>
            <p><strong>Đơn vị : </strong><?=$dv?> </p>
            <p><strong>Email : </strong><?=$em?> </p>
            <p><strong>SDT : </strong> <?=$sdt?> </p>
            <p><strong>SDT cơ quan : </strong> <?=$dtcq?> </p>
        </div>
</div>

    </section>
    <script>
        $(document).ready(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop()) {
                    $('header').addClass('sticky');
                }
                else {
                    $('header').removeClass('sticky');
                }
            })
        }
        )
    </script>
</body>
</html>