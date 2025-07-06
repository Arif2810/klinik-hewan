<?php
require_once"../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

if(isset($_POST['add'])){
	$uuid      = Uuid::uuid4()->toString();
	$nama      = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$username  = trim(mysqli_real_escape_string($con, $_POST['username']));
	$level   	 = $_POST['level'];
	$password  = trim(htmlspecialchars($_POST['password']));
  $password2 = trim(htmlspecialchars($_POST['password2']));

	// Cek duplikasi username
	$cekUsername = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$username'");
  if(mysqli_num_rows($cekUsername)){
    echo "
      <script>
        alert('Username sudah terpakai, user baru gagal di-registrasi!');
        window.location = 'add.php';
      </script>
    ";
    return;
  }
	// Cek password dan konfirmasi password
  if($password !== $password2){
    echo "
      <script>
        alert('Konfirmasi password tidak sesuai, user baru gagal di-registrasi!');
        window.location = 'add.php';
      </script>
    ";
    return;
  }
	$pass = sha1($password);
	mysqli_query($con, "INSERT INTO tb_user VALUES('$uuid', '$nama', '$username', '$pass', '$level')") or die(mysqli_error($con));
	echo "<script>alert('Data berhasil ditambahkan');window.location='data.php';</script>";
}
else if(isset($_POST['edit'])){
	$id 			= $_POST['id_user'];
	$nama 		= trim(mysqli_real_escape_string($con, $_POST['nama']));
	$userLama = $_POST['usernameLama'];
	$username = trim(mysqli_real_escape_string($con, $_POST['username']));
	$level    = $_POST['level'];
	// Cek duplikasi username
  $cekUsername = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$username'");
  if($username !== $userLama){
    if(mysqli_num_rows($cekUsername)){
      echo "
        <script>
          alert('Username sudah terpakai, data user gagal diperbarui!');
          window.location = 'data.php';
        </script>
      ";
      return;
    }
  }
	mysqli_query($con, "UPDATE tb_user SET 
		nama_user = '$nama',
		username  = '$username',
		level     = '$level' 
		WHERE id_user = '$id'
	") or die(mysqli_error($con));
	echo "<script>alert('Data berhasil diubah');window.location='data.php';</script>";
}