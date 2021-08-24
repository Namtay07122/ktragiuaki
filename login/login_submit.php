<?php
	require_once ('../config/dbhelper.php');
	session_start();

	if (isset($_POST['submit']) && $_POST["username"] != '' && $_POST["password"] != '') 
	{
			// $id_user    = $_POST["id"];
			$usrnm      = $_POST["username"];
			$password   = $_POST["password"];
			$sql		= "select * from user where username ='$usrnm' and pass='$password' " ;
			$user = mysqli_query($con, $sql);
			// $data = mysqli_fetch_assoc($user); 

			if(mysqli_num_rows($user)>0){
				if($_POST["username"]=="admin" ){	
					echo "<script>
					      alert('--- Xin chào admin ! Chuyển hướng đăng nhập vào trang quản trị----');
						  window.location='http://localhost/admin/admin.php';
					      </script>";
					$_SESSION["username"] = $usrnm;

					

				}
				else{

				$_SESSION["username"] = $usrnm;
				header("Location: ../index.php");
				}
			}
			else{
				echo "<script>
					      alert('Nhập sai tên Tài Khoản hoặc Mật Khẩu');
						  window.location='http://localhost/login/login.php';
					      </script>";
					    
			}

	}
	else
	{	
		echo "<script>
					      alert('Chưa nhập tài khoản mật khẩu');
						  window.location='http://localhost/login/login.php';
					      </script>";
	}

?>