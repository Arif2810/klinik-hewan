<?php
require_once"../_config/config.php";

if(isset($_SESSION['user'])){
	echo "<script>window.location='".base_url()."'</script>";
}
else{
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Login - Rumah Sakit</title>
	<!-- Bootstrap Core CSS -->
	<link href="<?= base_url(); ?>/_assets/css/bootstrap.min.css" rel="stylesheet">

	<style>
		#bg-login{
			background-image: url(../_assets/gambar/background.jpg);
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
			height: 100vh; /* agar penuh 1 layar */
			position: relative;
		}

		/* Overlay gelap */
		#bg-login::before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background: rgba(0, 0, 0, 0.6); /* Ubah 0.5 untuk mengatur tingkat gelapnya */
			z-index: 1;
		}

		/* Konten di dalam bg-login tetap di atas overlay */
		#bg-login > * {
			position: relative;
			z-index: 2;
		}
	</style>

</head>
<body id="bg-login">
	<div id="wrapper">
		<div class="container">
			<div align="center" style="margin-top: 210px;">
				<?php
					if(isset($_POST['login'])){
						$user = trim(mysqli_real_escape_string($con, $_POST['user']));
						$pass = sha1(trim(mysqli_real_escape_string($con, $_POST['pass'])));

						$sql_login = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$user' AND password = '$pass'") or die(mysqli_error($con));
						if(mysqli_num_rows($sql_login) > 0){
							$row = mysqli_fetch_assoc($sql_login);
							$_SESSION['user']  = $user;
							$_SESSION['nama']  = $row['nama_user'];
							$_SESSION['level'] = $row['level'];
							$_SESSION['pass']  = $row['password'];
							echo "<script>window.location='".base_url()."'</script>";
						}
						else{ ?>
							<div class="row">
								<div class="col-lg-6 col-lg-offset-3">
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
										<strong>Login gagal!</strong> Username / Password salah
									</div>
								</div>
							</div>
						<?php
						}
					}
				?>
				<form action="" method="post" class="form-vertical" style="max-width: 300px; margin: auto;">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="user" id="username" class="form-control" placeholder="Username" required autofocus>
					</div>
					<div class="input-group" style="margin-top: 5px">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="pass" id="password" class="form-control" placeholder="Password" required>
					</div>
					<div class="form-group text-center" style="margin-top: 5px">
						<input type="submit" name="login" class="btn btn-primary btn-block" value="Login">
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="<?= base_url('_assets/js/jquery.js'); ?>"></script>
	<script src="<?= base_url('_assets/js/bootstrap.min.js'); ?>"></script>

</body>
</html>

<?php } ?>
