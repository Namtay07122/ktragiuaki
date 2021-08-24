<?php
require_once ('../config/dbhelper.php');
  session_start();
    $check = "select active from user where username = '".$_SESSION['username']."'" ;

 	$check = select_one($check);
 	if ($check != null) {
 		$status = $check['active'];
 	}
    if (!isset($_SESSION["username"]) || $status == 0 )
        {     header("Location:../../index.php");
            // header("Location:index.php");
        }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
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
                    <li class="nav-item"><a class="nav-link" href="add.php"><i class="fas fa-user"></i><span>Add</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="unit.php"><i class="fas fa-table"></i><span>Recruitment</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php"><i class="far fa-user-circle"></i><span>Logout</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="register.html"><i class="fas fa-user-circle"></i><span>Register</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Danh Sách Đơn Vị</h2>
			
			</div>
			<div class="panel-body">
				
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Tên Cơ Quan, Đơn Vị</th>

						</tr>
					</thead>
					<tbody>
<?php


 $sql= "select * from unit ";

$unit = select_list($sql);
$index = 1 ;
foreach ($unit as $item) {


 ?>

	<tr>
				<td><?=($index++)?></td>
				<td ><?=$item['name']?></td>
				
				<td>
				<a href="Detail.php?id=<?=$item['id']?>">
				<button class="btn btn-success">Xem chi tiết</button></a>
				</td>
				
			</tr>

<?php }?>

</tbody>
				</table>

			</div>
		</div>
	</div>

</body>

</html>