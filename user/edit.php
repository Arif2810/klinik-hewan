<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>User</h1>
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
	<h4>
		<small>Edit Data User</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<?php
			$id = @$_GET['id'];
			$sql_user = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user='$id'") or die(mysqli_error($con));
			$data = mysqli_fetch_array($sql_user);
			?>
			<form action="proses.php" method="post">
				<div class="form-group">
					<input type="hidden" name="id_user" id="id_user" value="<?= $data['id_user'] ?>">
					<label for="nama">Nama</label>
					<input type="text" name="nama" id="nama" value="<?= $data['nama_user'] ?>" class="form-control" required="" autofocus="">
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="hidden" name="usernameLama" value="<?= $data['username'] ?>">
					<input type="text" name="username" id="username" value="<?= $data['username'] ?>" class="form-control" required="">
				</div>

				<div class="form-group">
					<label for="level">Level</label>
					<select name="level" id="level" class="form-control">
						<option value="">-- Pilih Level --</option>
						<option value="1" <?= $data['level'] == 1 ? 'selected' : ''; ?>>Administrator</option>
            <option value="2" <?= $data['level'] == 2 ? 'selected' : ''; ?>>Petugas</option>
					</select>
				</div>

				<div class="form-group">
					<input type="submit" name="edit" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once('../_footer.php'); ?>
