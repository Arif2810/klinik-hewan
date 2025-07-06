<?php
require_once"../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

if(isset($_POST['add'])){
	$uuid      = Uuid::uuid4()->toString();
	$identitas = trim(mysqli_real_escape_string($con, $_POST['identitas']));
	$nama      = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$jenis     = trim(mysqli_real_escape_string($con, $_POST['jenis']));
	$jk 			 = trim(mysqli_real_escape_string($con, $_POST['jk']));
	$tgl_lahir = trim(mysqli_real_escape_string($con, $_POST['tgl_lahir']));
	$kelas     = trim(mysqli_real_escape_string($con, $_POST['kelas']));
	$generasi  = trim(mysqli_real_escape_string($con, $_POST['generasi']));

	// cek duplikasi identitas
	$sql_cek_identitas = mysqli_query($con, "SELECT * FROM tb_satwa WHERE nomor_identitas='$identitas'") or die(mysqli_error($con));
	// jika identitas sudah ada
	if(mysqli_num_rows($sql_cek_identitas) > 0){
		echo "<script>alert('Nomor identitas sudah pernah diinput!');window.location='add.php';</script>";
	}
	else{
		mysqli_query($con, "INSERT INTO tb_satwa VALUES('$uuid', '$identitas', '$nama', '$jenis', '$jk', '$tgl_lahir', '$kelas', '$generasi')") or die(mysqli_error($con));
		echo "<script>alert('Data berhasil ditambahkan');window.location='data.php';</script>";
	}
}
else if(isset($_POST['edit'])){
	$id        = $_POST['id'];
	$identitas = trim(mysqli_real_escape_string($con, $_POST['identitas']));
	$nama      = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$jenis     = trim(mysqli_real_escape_string($con, $_POST['jenis']));
	$jk 			 = trim(mysqli_real_escape_string($con, $_POST['jk']));
	$tgl_lahir = trim(mysqli_real_escape_string($con, $_POST['tgl_lahir']));
	$kelas     = trim(mysqli_real_escape_string($con, $_POST['kelas']));
	$generasi  = trim(mysqli_real_escape_string($con, $_POST['generasi']));

	// cek duplikasi identitas
	$sql_cek_identitas = mysqli_query($con, "SELECT * FROM tb_satwa WHERE nomor_identitas = '$identitas' AND id_satwa != '$id'") or die(mysqli_error($con));
	// jika identitas sudah ada
	if(mysqli_num_rows($sql_cek_identitas) > 0){
		echo "<script>alert('Nomor identitas sudah pernah diinput!');window.location='edit.php?id=$id';</script>";
	}
	else{
		mysqli_query($con, "UPDATE tb_satwa SET 
			nomor_identitas = '$identitas', 
			nama_satwa = '$nama', 
			id_jenis = '$jenis', 
			jenis_kelamin='$jk', 
			tgl_lahir = '$tgl_lahir', 
			kelas = '$kelas', 
			generasi = '$generasi' WHERE id_satwa = '$id'
		") or die(mysqli_error($con));
		echo "<script>alert('Data berhasil ditambahkan');window.location='data.php';</script>";
	}
}
