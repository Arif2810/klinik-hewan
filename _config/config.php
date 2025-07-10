<?php
// setting default timezone
date_default_timezone_set('Asia/Jakarta');

session_start();

include_once "conn.php";

// koneksi
$con = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);
if(mysqli_connect_errno()){
	echo mysqli_connect_error();
}

// fungsi base_url
function base_url($url = null){
	$base_url = "http://localhost/klinik-hewan";
	if($url != null){
		return $base_url . "/" . $url;
	}
	else{
		return $base_url;
	}
}

// Function untuk upload gambar
function uploadGbr($url){
  $namafile = $_FILES['gambar']['name'];
  $ukuran = $_FILES['gambar']['size'];
  $tmp = $_FILES['gambar']['tmp_name'];

  $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
  $ekstensiFile = explode('.', $namafile);
  $ekstensiFile = strtolower(end($ekstensiFile));

  if(!in_array($ekstensiFile, $ekstensiValid)){
    echo "
      <script>
        alert('Input user gagal, file yang anda upload bukan gambar!');
        window.location = '$url';
      </script>
    ";
    die();
  }

  if($ukuran > 10000000){
    echo "
      <script>
        alert('Input user gagal, maksimal ukuran gambar 10 MB!');
        window.location = '$url';
      </script>
    ";
    die();
  }

  $namafileBaru = time() . '-' . $namafile;
  move_uploaded_file($tmp, '../_assets/gambar/' . $namafileBaru);
  return $namafileBaru;
}

// function untuk tgl format indonesia
function tgl_indo($tgl){
	$tanggal = substr($tgl, 8, 2);
	$bulan = substr($tgl, 5, 2);
	$tahun = substr($tgl, 0, 4);

	return $tanggal."/".$bulan."/".$tahun;
}

// Function untuk umur
function htgUmur($tgl_lahir){
  $tglLahir = new DateTime($tgl_lahir);
  $hariini = new DateTime('today');

  $umur = $hariini->diff($tglLahir)->y;
  return $umur . ' tahun';
}

