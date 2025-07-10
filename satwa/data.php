<?php include_once('../_header.php'); ?>
	<div class="box">
		<h1>Satwa</h1>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
		<h4>
			<small>Data Satwa</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Satwa</a>
			</div>
		</h4>

		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover" id="satwa">
				<thead>
					<tr>
						<th>Nomor Identitas</th>
						<th>Nama Satwa</th>
						<th>Jenis Satwa</th>
						<th>Jenis Kelamin</th>
						<th>Tanggal Lahir</th>
						<th>Kelas</th>
						<th>Generasi</th>
						<th><i class="glyphicon glyphicon-cog"></i></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$query = "SELECT * FROM tb_satwa ORDER BY nama_satwa ASC
						";
						$sql_satwa = mysqli_query($con, $query) or die(mysqli_error($con));
						while($data = mysqli_fetch_array($sql_satwa)){ ?>
					<tr>
						<td><?= $data['nomor_identitas']; ?></td>
						<td><?= $data['nama_satwa']; ?></td>
						<td><?= $data['jenis']; ?></td>
						<td><?= ($data['jenis_kelamin'] == 'L') ? 'Jantan' : 'Betina'; ?></td>
						<td><?= $data['tgl_lahir']; ?></td>
						<td><?= $data['kelas']; ?></td>
						<td><?= $data['generasi']; ?></td>
						<td align="center">
							<a href="edit.php?id=<?= $data['id_satwa'] ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
							<a href="del.php?id=<?= $data['id_satwa']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin menghapus data?')"><i class="glyphicon glyphicon-trash"></i></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$('#satwa').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy',
					{
							extend: 'excel',
							messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
					},
					{
						extend: 'csv'
					},
					{
						extend: 'pdfHtml5',
						download: 'open',
						messageBottom: null
					}
				],
				columnDefs: [{
					"searchable": false,
					"orderable": false,
					"targets": 7
				}],
				"order": [0, "asc"]
			})
		});
	</script>

<?php include_once('../_footer.php'); ?>                                                       