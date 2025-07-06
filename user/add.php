<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>User</h1>
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
	<h4>
		<small>Tambah Data User</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" name="nama" id="nama" class="form-control" required="" autofocus="">
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control" required="">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" required="">
				</div>
				<div class="form-group">
					<label for="password2">Konfirmasi Password</label>
					<input type="password" name="password2" id="password2" class="form-control" required="">
				</div>
				<div class="form-group">
					<label for="level">Level</label>
					<select name="level" id="level" class="form-control">
						<option value="">-- Pilih Level --</option>
						<option value="1">Administrator</option>
						<option value="2">Petugas</option>
						<option value="3">Dokter</option>
					</select>
				</div>

				<div class="form-group">
					<input type="submit" name="add" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once('../_footer.php'); ?>
