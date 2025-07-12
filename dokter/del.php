<?php
require_once"../_config/config.php";

if(!isset($_POST['checked'])){
	echo "<script>alert('Tidak ada data yang dipilih'); window.location='data.php';</script>";
}
else{
	$chk = $_POST['checked'];
	foreach($chk as $id_dokter){
		// Ambil id_user dari tb_dokter
		$q = mysqli_query($con, "SELECT id_user FROM tb_dokter WHERE id_dokter = '$id_dokter'") or die(mysqli_error($con));
		$d = mysqli_fetch_assoc($q);
		$id_user = $d['id_user'];

		// Hapus data dokter
		$sql = mysqli_query($con, "DELETE FROM tb_dokter WHERE id_dokter = '$id_dokter'") or die(mysqli_error($con));
		// Hapus data user
		mysqli_query($con, "DELETE FROM tb_user WHERE id_user = '$id_user'") or die(mysqli_error($con));
	}
	if($sql){
		echo "<script>alert('" . count($chk) . " data berhasil dihapus'); window.location='data.php';</script>";
	}
	else{
		echo "<script>alert('Gagal hapus data, coba lagi');</script>";
	}
}

