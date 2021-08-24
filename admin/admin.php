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
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="../index.php">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Brand</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="admin.php"><i class="fas fa-glass-martini" style="width: 20px;height: 20px;"></i><span>ALL</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="add.php"><i class="fas fa-user"></i><span>Add</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="unit.php"><i class="fas fa-table"></i><span>Recruitment</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php"><i class="far fa-user-circle"></i><span>Logout</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="register.html"><i class="fas fa-user-circle"></i><span>Register</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Danh sách</h3>

                        <div class="container-fluid">
                            <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                            <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                <?php 
                                        $id = "";
                                        $wh = "";
                                    if (isset($_GET['search'])) {
                                    $search= $_GET['search'];
                                    $wh = " where name like '%".$search."%' ";
                                    }
                                    else{
                                        $search="";
                                        $wh = " where name like '%".$search."%'  ";

                                    }
                                        ?>
                                    <input name='search' class="bg-light form-control border-0 small"  type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="container-fluid">
                        
                         <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <select style="width:200px ;border-radius :10px ;border:none ;text-align :center; " name="id_unit" value="<?=$dv?>" id="">
                                    <option value="">---------</option>
                                    <?php 
                                        $sql = "select * from unit " ;
                                        $variable = select_list($sql);
                                        foreach ($variable as  $value) { ?>
                                                
                                        <option value="<?=$value['id']?>"  <?php if( isset($_GET['id_unit']) && $_GET['id_unit'] ==$value['id']) echo "selected"?>   ><?=$value['name']?></option>

					  	            <?php } ?>
                            </select>
                            <button class="btn"> Tìm </button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px;">Họ tên</th>
                                            <th style="width: 100px;">Ảnh</th>
                                            <th style="width: 200px;">Chức vụ</th>
                                            <th style="width: 200px;">Email/th>
                                            <th style="width: 70px;">Số ĐT</th>
                                            <th style="width: 70px;">Đơn vị</th>
                                            <th style="width: 70px;"></th>
                                            <th style="width: 70px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php


                                            if (isset($_GET['id_unit'])) {
                                                $id = $_GET['id_unit'];
                                                if ($id =='') {
                                                    $wh = 'where id_unit' .$id;
                                                }else{
                                                    $id = "=".$_GET['id_unit'];
                                                    $wh = 'where id_unit' .$id;
                                                }
                                            }



                                            $sql          = 'select * from cadres '.$wh;

                                            $listcanbo = select_list($sql);

                                            $index = 1;
                                            foreach ($listcanbo as $item) {
                                                
                                                    $donvi = "select name from unit where id = " .$item['id_unit'];
                                                    $val_donvi = select_one($donvi);
                                                    if ($val_donvi != null) {
                                                            $item_donvi = $val_donvi['name'];
                                                    }


                                                
                                                echo '<tr>
                                            <td>'.$item['name'].'</td>
                                            <td><img height="100px" src='.$item["thumbnail"].' alt=""></td>
                                            <td>'.$item['position'].'</td>
                                            <td>'.$item['email'].'</td>
                                            <td>'.$item['phonenumber'].'</td>
                                            <td>'.$item_donvi.'</td>
                                            <td><button class="btn btn-primary" onclick="deleteCategory('.$item['id'].')" type="button">Xoá</button></td>
                                            <td><a href="add.php?id='.$item['id'].'"><button class="btn btn-primary" type="button">Sửa</button></a></td>
                                        </tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
 
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script type="text/javascript">
		function deleteCategory(id) {
			var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
			if(!option) {
				return;
			}

			console.log(id)
			//ajax - lenh post
			$.post('delete.php', {
				'id': id,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}


	</script>
</body>

</html>