<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>Rekam Medis</h1>
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
	<h4>
		<small>Tambah Data Rekam Medis</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>


	<form action="proses.php" method="post" enctype="multipart/form-data" id="form">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="tgl">Tanggal Periksa</label>
					<input type="date" name="tgl" id="tgl" class="form-control" value="<?= date('Y-m-d') ?>" required="" autofocus="">
				</div>
				<div class="form-group">
					<label for="satwa">Nama Satwa</label>
					<select name="satwa" id="satwa" class="form-control" required="">
						<option value="">- Pilih -</option>
						<?php
						$sql_satwa = mysqli_query($con, "SELECT * FROM tb_satwa") or die(mysqli_error($con));
						while($data_satwa = mysqli_fetch_array($sql_satwa)){
							echo '<option value="'.$data_satwa['id_satwa'].'">'.$data_satwa['nama_satwa'].'</option>';
						} ?>
					</select>
				</div>
				<div class="form-group">
					<label for="keluhan">Keluhan</label>
					<textarea name="keluhan" id="keluhan" class="form-control" required=""></textarea>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="diagnosa">Diagnosa</label>
					<textarea name="diagnosa" id="diagnosa" class="form-control" required="" rows="4"></textarea>
				</div>
				<div class="form-group">
					<label for="tindakan">Tindakan</label>
					<textarea name="tindakan" id="tindakan" class="form-control" required="" rows="4"></textarea>
				</div>
				<div class="form-group">
					<label for="obat">Obat</label>
					<select multiple="" size="7" name="obat[]" id="obat" class="form-control" required="">
						<?php
						$sql_obat = mysqli_query($con, "SELECT * FROM tb_obat") or die(mysqli_error($con));
						while($data_obat = mysqli_fetch_array($sql_obat)){
							echo '<option value="'.$data_obat['id_obat'].'">'.$data_obat['nama_obat'].'</option>';
						} ?>
					</select>
				</div>
				<div class="form-group">
					<label for="dokter">Nama Dokter</label>
					<select name="dokter" id="dokter" class="form-control" required="">
						<option value="">- Pilih -</option>
						<?php
						$sql_dokter = mysqli_query($con, "SELECT * FROM tb_user WHERE level = 3") or die(mysqli_error($con));
						while($data_dokter = mysqli_fetch_array($sql_dokter)){
							echo '<option value="'.$data_dokter['id_user'].'">'.$data_dokter['nama_user'].'</option>';
						} ?>
					</select>
				</div>

				<div class="form-group">
					<label for="gambar">Foto Kondisi</label>
					<div>
						<img src="<?= base_url() ?>/_assets/gambar/default.png" alt="Gambar kondisi" class="img-thumbnail mb-4 tampil" width="120px">
						<input type="file" class="form-control form-control-sm" name="gambar" id="gambar" onchange="imgView()" style="margin-top: 5px">
						<span class="text-sm">Tipe file gambar JPG | PNG | GIF</span>
					</div>
        </div>

				<div class="form-group">
					<button type="reset" name="reset" class="btn btn-default">Reset</button>
					<input type="submit" name="add" value="Simpan" class="btn btn-success">
				</div>
			</div>
		</div>
	</form>

</div>


<script>
	CKEDITOR.replace('keluhan');
</script>


<script>
  let defaultSrc;

  window.addEventListener('DOMContentLoaded', () => {
    const tampil = document.querySelector('.tampil');
    defaultSrc = tampil.src;

    const form = document.getElementById('form');
    form.addEventListener('reset', () => {
      tampil.src = defaultSrc;
      document.getElementById('gambar').value = '';
    });
  });

  function imgView() {
    const gambar = document.getElementById('gambar');
    const tampil = document.querySelector('.tampil');

    if (gambar.files && gambar.files[0]) {
      const fileReader = new FileReader();
      fileReader.onload = (e) => {
        tampil.src = e.target.result;
      };
      fileReader.readAsDataURL(gambar.files[0]);
    }
  }
</script>


<?php include_once('../_footer.php'); ?>
