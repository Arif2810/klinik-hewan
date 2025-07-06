<?php
require_once"../_config/config.php";

if(!isset($_POST['checked'])){
	echo "<script>alert('Tidak ada data yang dipilih'); window.location='data.php';</script>";
}
else{
	$chk = $_POST['checked'];
	foreach($chk as $id){
		$sql = mysqli_query($con, "DELETE FROM tb_jenis WHERE id_jenis = '$id'") or die(mysqli_error($con));
	}
	if($sql){
		echo "<script>alert('" . count($chk) . " data berhasil dihapus'); window.location='data.php';</script>";
	}
	else{
		echo "<script>alert('Gagal hapus data, coba lagi');</script>";
	}
}