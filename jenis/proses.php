<?php
require_once"../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

if(isset($_POST['add'])){
	$total = $_POST['total'];
	for($i=1; $i<=$total; $i++){
		$uuid = Uuid::uuid4()->toString();
		$jenis = trim(mysqli_real_escape_string($con, $_POST['jenis-'.$i]));
		$sql = mysqli_query($con, "INSERT INTO tb_jenis VALUES('$uuid', '$jenis')") or die(mysqli_error($con));
	}

	if($sql){
		echo "<script>alert('" . $total . " data berhasil ditambahkan'); window.location='data.php';</script>";
	}
	else{
		echo "<script>alert('Gagal tambah data, coba lagi'); window.location='generate.php';</script>";
	}
} 
else if(isset($_POST['edit'])){
	for($i=0; $i<count($_POST['id']); $i++){
		$id = $_POST['id'][$i];
		$jenis = $_POST['jenis'][$i];
		$sql = mysqli_query($con, "UPDATE tb_jenis SET jenis = '$jenis' WHERE id_jenis = '$id'") or die(mysqli_error($con));
	}
	echo "<script>alert('Data berhasil di update'); window.location='data.php';</script>";
}