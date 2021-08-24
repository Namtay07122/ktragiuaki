 <?php 

  session_start();
  require_once('config/dbhelper.php');
  $src = ""; 
  if (isset($_SESSION['username'])) {
    $check = "select active from user where username = '".$_SESSION['username']."'" ;

    $check = select_one($check);
    if ($check != null) {
        $status = $check['active'];
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    
    
    <title>Document</title>
</head>

<body>
    <section>
        <header>
            <div id="inner-header" class="container">
                <a class="logo" href="#">ĐH Thuỷ Lợi</a>
                <nav>
                    <ul id="main-menu">
                        <li><a href="">Trang chủ</a></li>
                        <li><?php 
					if (!isset($_SESSION['username'])) { ?>			
					<a href="Login/login.php">Đăng Nhập</a>
				
				<?php } else{ ?>

			<a href="">Xin chào <?=$_SESSION['username']?></a>
						
							
								<li>
									<a href="logout.php">Đăng Xuất</a>
								</li>
								
								<?php if ($status == 1) {?>
								<li>
									<a href="./admin/admin.php">Trang quản trị</a>
								</li>
								<?php } ?>
								

					
						</div>

						<?php  } ?></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="clearfix"></div>
    </section>


    <section class="search">
        <form action="" method="GET">
        <div>
        <?php 
        if (isset($_GET['search'])) {
           $search= $_GET['search'];
           $src = " where name like '%".$search."%' ";
         }
           else{
             $search="";
             $src = " where name like '%".$search."%'  ";

           }
            ?>
            <input class="srch" type="text" value='<?=$search?>' name="search" placeholder="Điền vào đây thg ml ...">
        </div>
            <input class="btn" type="submit" value="Tìm đi">
        </form>
    </section>
    <?php 

 
         $sql= "select * from cadres ".$src."";
  

         $datas = select_list($sql);


    ?>
    <section class="aa">
    <h2>
            Danh sách Cán bộ Đại học Thuỷ Lợi
    </h2>
    
    <div class="grid-container">
        
    <?php 

foreach( $datas as $data){

?>
        <div class="grid-item">
        
            <a href="detail.php?id=<?=$data['id']?>">
                 <div class="img">
                    <img src="<?php echo"".$data['thumbnail']."" ?>" alt="">
                 </div>
                 <div class="view">
                     <p >Xem thêm</p>
                 </div>
                 <div class="name">
                     <span><?php echo"".$data['name']."" ?></span>
                 </div>
        </a>
        
        </div>
        
        <?php } ?>
        
        
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