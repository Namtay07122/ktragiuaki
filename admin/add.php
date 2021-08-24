<?php
	require_once ('../config/dbhelper.php');
    session_start();
     $check = "select active from user where username = '".$_SESSION['username']."'" ;

 	$check = select_one($check);
 	if ($check != null) {
 		$status = $check['active'];
 	}
    if (!isset($_SESSION["username"]) || $status == 0 )
        {     header("Location:../../admin.php");
            // header("Location:index.php");
        }

$id = $name  = $cv =  $cq =  $em =  $sdt = $bm =  $dv = $thumbnail = $id_dv = '';
if (!empty($_POST)) {
	if (isset($_POST['username'])) {
		$name = $_POST['username'];

	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];

	}
		if (isset($_POST['thumbnail'])) {
		$thumbnail = $_POST['thumbnail'];
		$thumbnail = str_replace('"', '\\"', $thumbnail);
	}

	if (isset($_POST['organ'])) {
		$cq = $_POST['organ'];
	}
	if (isset($_POST['position'])) {
		$cv = $_POST['position'];
	}
	if (isset($_POST['email'])) {
		$em = $_POST['email'];
	}
	if (isset($_POST['phonenumber'])) {
		$sdt = $_POST['phonenumber'];
	}
	
	if (isset($_POST['unit'])) {
		$dv = $_POST['unit'];
	}
		

	if (!empty($name)) {
		if ($id == '') {
			
		$sql = 'insert into cadres(name, thumbnail, organ, position, email, phonenumber ,id_unit) values("'.$name.'","'.$thumbnail.'", "'.$cq.'", "'.$cv.'", "'.$em.'", "'.$sdt.'", "'.$dv.'" )';
				
			
		}
		 else {
		$sql = 'update cadres set name = "'.$name.'", thumbnail = "'.$thumbnail.'", organ = "'.$cq.'", position = "'.$cv.'", email = "'.$em.'", phonenumber = "'.$sdt.'", id_unit = "'.$dv.'" where id = '.$id;}
			 select($sql);
			// print($sql);
			// exit();
			header('Location: admin.php');
			die();
		

		
	}
}

if (isset($_GET['id'])) {
	$id       = $_GET['id']; 
	$sql      = 'select * from cadres where id = '.$id;
	$login = select_one($sql);
	if ($login != null) {
		$name 	  = $login['name'];
		$cq 	  = $login['organ'];
		$cv 	  = $login['position'];
		$em 	  = $login['email'];
		$sdt 	  = $login['phonenumber'];
		$id_dv 	  = $login['id_unit'];
		$thumbnail   = $login['thumbnail'];	

		$donvi = "select name from unit where id = " .$id_dv;
		$val_donvi = select_one($donvi);
		if ($val_donvi != null) {
				$dv = $val_donvi['name'];
		}
		

	}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link " href="admin.php"><i class="fas fa-glass-martini" style="width: 20px;height: 20px;"></i><span>ALL</span></a></li>
                    <li class="nav-item"><a class="nav-link active " href="add.php"><i class="fas fa-user"></i><span>Add</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="unit.php"><i class="fas fa-table"></i><span>Recruitment</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php"><i class="far fa-user-circle"></i><span>Logout</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="register.html"><i class="fas fa-user-circle"></i><span>Register</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
		
		<form method="post" style = "width: 50% ; margin-left : 20%;margin-top:3%;">
					<div class="form-group">
					  <label  for="username">Tên :</label>
					  <input type="text" name="id" value="<?=$id?>" hidden="true">

					  <input style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="username" name="username" 
					  value="<?=$name?>" >

					</div>

					<div class="form-group">
					  <label  for="matkhau">Chức Vụ:</label>
					  
					  <input style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="matkhau" name="position" value="<?=$cv?>" >
					</div>
					<div class="form-group">
					  <label  for="matkhau">Điện THoại Cơ Quan:</label>
					  
					  <input style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="matkhau" name="organ" value="<?=$cq?>" >
					</div>
					<div class="form-group">
					  <label  for="matkhau">Email:</label>
					  
					  <input style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="matkhau" name="email" value="<?=$em?>" >
					</div>
					<div class="form-group">
					  <label  for="matkhau">Số điện thoại</label>
					  
					  <input style="text-align:center;font-size : 20px;" required="true" type="text" class="form-control" id="matkhau" name="phonenumber" value="<?=$sdt?>" >
					</div>
					
					<div class="form-group">
					  <label  for="matkhau">Đơn Vị</label>
					  
					  <select style="text-align:center;font-size : 20px;" required="true" type="text"  class="form-control" id="matkhau" name="unit" value="<?=$dv?>" >

					  	<option value="<?=$id_dv?>"><?=$dv?></option>
					  	<?php 

					  		$sql = "select * from unit " ;
					  		$variable = select_list($sql);
					  		foreach ($variable as  $value) { ?>
					  				
					  		<option value="<?=$value['id']?>"><?=$value['name']?></option>

					  	<?php } ?>

					  </select>
					</div>

					<div class="form-group">
					  <label for="thumbnail">Ảnh:</label>
					  
					  <input  placeholder="" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?=$thumbnail?>" onchange="updateThumbnail()">
					  <img src="<?=$thumbnail?>" style="max-width: 200px;margin-left: 30%" id="img_thumbnail">
					</div>
			
					<button style="width: 50%; margin-left : 20%" class="btn btn-success">Lưu</button>
				</form>
</div>