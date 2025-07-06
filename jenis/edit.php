<?php
$chk = $_POST['checked'];
if(!isset($chk)){
	echo "<script>alert('Tidak ada data yang dipilih'); window.location='data.php';</script>";
}
else{
	include_once('../_header.php'); ?>
	<div class="box">
		<h1>Jenis Satwa</h1>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
		<h4>
			<small>Edit Data Jenis Satwa</small>
			<div class="pull-right">
				<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
			</div>
		</h4>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form action="proses.php" method="post">
					<input type="hidden" name="total" value="<?= @$_POST['count_add']; ?>">
					<table class="table">
						<tr>
							<th>#</th>
							<th>Jenis Satwa</th>
						</tr>
						<?php
						$no = 1;
						foreach($chk as $id){
							$sql_jenis = mysqli_query($con, "SELECT * FROM tb_jenis WHERE id_jenis = '$id'") or die(mysqli_error($con));
							while($data = mysqli_fetch_array($sql_jenis)){ ?>
								<tr>
									<td><?= $no++; ?></td>
									<td>
										<input type="hidden" name="id[]" value="<?= $data['id_jenis']; ?>">
										<input type="text" name="jenis[]" value="<?= $data['jenis'] ?>" class="form-control" required>
									</td>
								</tr>
							<?php
							}
						}
						?>
					</table>
					<div class="form-group">
						<input type="submit" name="edit" value="Simpan Semua" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
	include_once('../_footer.php');
} ?>