<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>Satwa</h1>
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
	<h4>
		<small>Tambah Data satwa</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="identitas">Nomor Identitas</label>
					<input type="number" name="identitas" id="identitas" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="nama">Nama Satwa</label>
					<input type="text" name="nama" id="nama" class="form-control" required="">
				</div>
				<div class="form-group">
					<label for="jenis">Jenis Satwa</label>
					<input type="text" name="jenis" id="jenis" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="jk">Jenis Kelamin</label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="jk" id="jk" value="L" required=""> Jantan
						</label>
						<label class="radio-inline">
							<input type="radio" name="jk" value="P"> Betina
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="tgl_lahir">Tanggal Lahir</label>
					<input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required="">
				</div>
				<div class="form-group">
					<label for="kelas">Kelas</label>
					<input type="text" name="kelas" id="kelas" class="form-control">
				</div>
				<div class="form-group">
					<label for="generasi">Generasi</label>
					<input type="text" name="generasi" id="generasi" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" name="add" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once('../_footer.php'); ?>
