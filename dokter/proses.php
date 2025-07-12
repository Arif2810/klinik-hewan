<?php
require_once"../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

if(isset($_POST['add'])){
	$uuid 		= Uuid::uuid4()->toString();
	$nama 	  = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$username = trim(mysqli_real_escape_string($con, $_POST['username']));
	$password = sha1(trim($_POST['password']));
	$alamat 	= trim(mysqli_real_escape_string($con, $_POST['alamat']));
	$telp 		= trim(mysqli_real_escape_string($con, $_POST['telp']));
	$level		= 3;

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

	// Simpan ke tabel user
	mysqli_query($con, "INSERT INTO tb_user VALUES('$uuid', '$nama', '$username', '$password', '$level')") or die(mysqli_error($con));

	// Simpan ke tabel dokter
	mysqli_query($con, "INSERT INTO tb_dokter(id_user, alamat, no_telp) VALUES('$uuid', '$alamat', '$telp')") or die(mysqli_error($con));

	echo "<script>alert('Data berhasil ditambahkan');window.location='data.php';</script>";
}
else if(isset($_POST['edit'])){
	$id 		  = $_POST['id'];
	$id_user  = $_POST['id_user'];
	$nama 	  = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$userLama = $_POST['usernameLama'];
	$username = trim(mysqli_real_escape_string($con, $_POST['username']));
	$alamat   = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	$telp     = trim(mysqli_real_escape_string($con, $_POST['telp']));

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

	// Update tabel dokter
	mysqli_query($con, "UPDATE tb_dokter SET alamat = '$alamat', no_telp = '$telp' WHERE id_dokter = '$id'") or die(mysqli_error($con));

	// Update tabel user
	mysqli_query($con, "UPDATE tb_user SET nama_user = '$nama', username = '$username' WHERE id_user = '$id_user'") or die(mysqli_error($con));

	echo "<script>alert('Data berhasil diubah');window.location='data.php';</script>";
}