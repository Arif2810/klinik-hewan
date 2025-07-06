<?php
require_once"../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

if(isset($_POST['edit'])){
	$curPass   = trim(mysqli_real_escape_string($con, $_POST['oldPass']));
	$newPass   = trim(mysqli_real_escape_string($con, $_POST['newPass']));
	$confPass  = trim(mysqli_real_escape_string($con, $_POST['confPass']));
	$userLogin = $_SESSION['user'];
  $passUser  = $_SESSION['pass'];

	// Pengecekan password baru & confirmasi password
  if($newPass !== $confPass){
    echo "
      <script>
        alert('Password gagal diperbarui, konfirmasi password tidak sama!');
        window.location = 'data.php';
      </script>
    ";
		return false;
  }

	// Pengecekan password lama
  if(sha1($curPass) !== $passUser){
    echo "
      <script>
        alert('Password lama tidak cocok!');
        window.location = 'data.php';
      </script>
    ";
    return false;
  }
	else{
		$pass = sha1($newPass);
    mysqli_query($con, "UPDATE tb_user SET password = '$pass' WHERE username = '$userLogin'");
    echo "
      <script>
        alert('Password berhasil diubah');
        window.location = 'data.php';
      </script>
    ";
    return true;
  }
}