<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>Satwa</h1>
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
	<h4>
		<small>Edit Data Satwa</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<?php
			$id = @$_GET['id'];
			$sql_satwa = mysqli_query($con, "SELECT * FROM tb_satwa WHERE id_satwa = '$id'") or die(mysqli_error($con));
			$data = mysqli_fetch_array($sql_satwa);
			?>

			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="identitas">Nomor Identitas</label>
					<input type="hidden" name="id" value="<?= $data['id_satwa'] ?>">
					<input type="number" name="identitas" id="identitas" class="form-control" value="<?= $data['nomor_identitas'] ?>" required="" autofocus="">
				</div>
				<div class="form-group">
					<label for="nama">Nama Satwa</label>
					<input type="text" name="nama" id="nama" class="form-control" value="<?= $data['nama_satwa'] ?>" required>
				</div>
				<div class="form-group">
					<label for="jenis">Jenis Satwa</label>
					<select name="jenis" id="jenis" class="form-control" required>
						<option value="">-- Pilih --</option>
						<?php
						$sql_jenis = mysqli_query($con, "SELECT * FROM tb_jenis ORDER BY jenis ASC") or die(mysqli_error($con));
						while($data_jenis = mysqli_fetch_array($sql_jenis)){
							if($data['id_jenis'] == $data_jenis['id_jenis']){
								$select = "selected";
							}
							else{
								$select = "";
							}
							echo '<option '.$select.' value="'.$data_jenis['id_jenis'].'">'.$data_jenis['jenis'].'</option>';
						} ?>
					</select>
				</div>
				<div class="form-group">
					<label for="jk">Jenis Kelamin</label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="jk" id="jk" value="L" required="" <?= $data['jenis_kelamin'] == "L" ? "checked" : null ?>> Laki - laki
						</label>
						<label class="radio-inline">
							<input type="radio" name="jk" value="P" <?= $data['jenis_kelamin'] == "P" ? "checked" : null ?>> Perempuan
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="tgl_lahir">Tanggal Lahir</label>
					<input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?= $data['tgl_lahir'] ?>" required="">
				</div>
				<div class="form-group">
					<label for="kelas">Kelas</label>
					<input type="text" name="kelas" id="kelas" class="form-control" value="<?= $data['kelas'] ?>" required="">
				</div>
				<div class="form-group">
					<label for="generasi">Generasi</label>
					<input type="text" name="generasi" id="generasi" class="form-control" value="<?= $data['generasi'] ?>" required="">
				</div>
				<div class="form-group">
					<input type="submit" name="edit" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once('../_footer.php'); ?>
