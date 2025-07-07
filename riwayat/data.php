<?php include_once('../_header.php'); ?>

	<div class="box">
		<h1>Rekam Medis</h1>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
		<h4>
			<small>Data Rekam Medis</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Rekam Medis</a>
			</div>
		</h4>
		<form method="post" name="proses">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="rekammedis">
					<thead>
						<tr>
							<th>No.</th>
							<th>ID Satwa</th>
							<th>Nama Satwa</th>
							<th>Umur</th>
							<th>Jenis Kelamin</th>
							<th>Jenis Satwa</th>
							<th><i class="glyphicon glyphicon-cog"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$query = "SELECT * FROM tb_satwa INNER JOIN tb_jenis ON tb_satwa.id_jenis = tb_jenis.id_jenis";
						$sql_satwa = mysqli_query($con, $query) or die(mysqli_error($con));
						while($data = mysqli_fetch_array($sql_satwa)){ ?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data['nomor_identitas']; ?></td>
								<td><?= $data['nama_satwa'] ?></td>
								<td><?= htgUmur($data['tgl_lahir']) ?></td>
								<td><?= ($data['jenis_kelamin'] == 'L') ? 'Jantan' : 'Betina'; ?></td>
								<td><?= $data['jenis'] ?></td>
								<td align="center">
									<a href="laporan.php?id=<?= $data['id_satwa'] ?>" class="btn btn-warning btn-xs" target="_blank"><i class="glyphicon glyphicon-print"></i></a>
								</td>
							</tr>
						<?php
						} ?>
					</tbody>
				</table>
			</div>
		</form>
	</div>

	<script>
		$(document).ready(function(){
			$('#rekammedis').DataTable({
				columnDefs: [{
					"searchable": false,
					"orderable": false,
					"targets": 6
				}],
				"order": [0, "asc"]
			})
		});
	</script>

<?php include_once('../_footer.php'); ?>  


