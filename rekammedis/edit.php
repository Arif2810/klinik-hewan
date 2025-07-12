<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>Rekam Medis</h1>
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
	<h4>
		<small>Edit Data Rekam Medis</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>

	<?php
	$id = @$_GET['id'];
	$sql_rekammedis = mysqli_query($con, "SELECT * FROM tb_rekammedis INNER JOIN tb_satwa ON tb_rekammedis.id_satwa = tb_satwa.id_satwa INNER JOIN tb_user ON tb_rekammedis.id_user = tb_user.id_user WHERE id_rm = '$id'") or die(mysqli_error($con));
	$data = mysqli_fetch_array($sql_rekammedis);
	?>

	<form action="proses.php" method="post" enctype="multipart/form-data" id="form">
		<div class="row">
			<div class="col-md-6">
				<input type="hidden" name="id" value="<?= $data['id_rm'] ?>">
				<div class="form-group">
					<label for="tgl">Tanggal Periksa</label>
					<input type="date" name="tgl" id="tgl" class="form-control" value="<?= $data['tgl_periksa'] ?>" required="" autofocus="">
				</div>
				<div class="form-group">
					<label for="satwa">Nama Satwa</label>
					<select name="satwa" id="satwa" class="form-control" required>
						<option value="">- Pilih -</option>
						<?php
						$sql_satwa = mysqli_query($con, "SELECT * FROM tb_satwa") or die(mysqli_error($con));
						while($data_satwa = mysqli_fetch_array($sql_satwa)){
							if($data['id_satwa'] == $data_satwa['id_satwa']){
								$select = "selected";
							}
							else{
								$select = "";
							}
							echo '<option '.$select.' value="'.$data_satwa['id_satwa'].'">'.$data_satwa['nama_satwa'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="keluhan">Keluhan</label>
					<textarea name="keluhan" id="keluhan" class="form-control" required=""><?= $data['keluhan']; ?></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="diagnosa">Diagnosa</label>
					<textarea name="diagnosa" id="diagnosa" class="form-control" required="" rows="4"><?= $data['diagnosa']; ?></textarea>
				</div>
				<div class="form-group">
					<label for="tindakan">Tindakan</label>
					<textarea name="tindakan" id="tindakan" class="form-control" required="" rows="4"><?= $data['tindakan']; ?></textarea>
				</div>
				<div class="form-group">
					<label for="obat">Obat</label>
					<?php
						$sql_rm_obat = mysqli_query($con, "SELECT * FROM tb_rm_obat WHERE id_rm='$id'") or die(mysqli_error($con));
						while($data_rm_obat = mysqli_fetch_array($sql_rm_obat)){
							$selected_obat[] = $data_rm_obat['id_obat'];
						}
					?>
					<select multiple="" size="7" name="obat[]" id="obat" class="form-control" required="">
						<?php
							$sql_obat = mysqli_query($con, "SELECT * FROM tb_obat") or die(mysqli_error($con));
							while($data_obat = mysqli_fetch_array($sql_obat)){ ?>

								<option value="<?= $data_obat['id_obat']; ?>" <?php for($i = 0; $i < count($selected_obat); $i++){
									if($data_obat['id_obat'] == $selected_obat[$i]){
										echo "selected";
									}
								} ?>>
								<?= $data_obat['nama_obat']; ?>
								</option>
							<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="dokter">Nama Dokter</label>
					<select name="dokter" id="dokter" class="form-control" required="">
						<option value="">- Pilih -</option>
						<?php
						$sql_dokter = mysqli_query($con, "SELECT * FROM tb_user WHERE level = 3") or die(mysqli_error($con));
						while($data_dokter = mysqli_fetch_array($sql_dokter)){
							if($data['id_user'] == $data_dokter['id_user']){
								$select = "selected";
							}
							else{
								$select = "";
							}
							echo '<option '.$select.' value="'.$data_dokter['id_user'].'">'.$data_dokter['nama_user'].'</option>';
						} ?>
					</select>
				</div>
				<div class="form-group">
					<label for="gambar">Foto Kondisi</label>
					<div>
						<input type="hidden" name="gbrLama" value="<?= $data['gambar'] ?>">
						<img src="<?= base_url() ?>/_assets/gambar/<?= $data['gambar'] ?>" alt="Gambar kondisi" class="img-thumbnail mb-4 tampil" width="120px">
						<input type="file" class="form-control form-control-sm" name="gambar" id="gambar" onchange="imgView()" style="margin-top: 5px">
						<span class="text-sm">Tipe file gambar JPG | PNG | GIF</span>
					</div>
        </div>
				<div class="form-group">
					<input type="submit" name="edit" value="Simpan" class="btn btn-success">
				</div>
			</div>
		</div>
	</form>

</div>

<script>
	CKEDITOR.replace( 'keluhan' );
</script>


<script>
  let defaultSrc;

  window.addEventListener('DOMContentLoaded', () => {
    const tampil = document.querySelector('.tampil');
    defaultSrc = tampil.src;
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
