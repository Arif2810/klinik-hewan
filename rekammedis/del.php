<?php
require_once"../_config/config.php";

$id = $_GET['id'];
$gbr = $_GET['gambar'];

mysqli_query($con, "DELETE FROM tb_rekammedis WHERE id_rm = '$id'") or die(mysqli_error($con));

// Pengecekan gambar (default atau tidak)
if($gbr != 'default.png'){
  unlink('../_assets/gambar/' . $gbr);
}

echo "<script>alert('Data berhasil dihapus'); window.location='data.php';</script>";