<?php include_once('../_header.php');

if($_SESSION['level'] == 3){
  echo "
  <script>
    alert('Halaman tidak ditemukan!');
    window.location = '../index.php';
  </script>
  ";
  exit();
}
?>

	<div class="box">
		<h1>Jenis Satwa</h1>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
		<h4>
			<small>Data Jenis satwa</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="generate.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Jenis satwa</a>
			</div>
		</h4>
		<form method="post" name="proses">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>Jenis Satwa</th>
							<th>
								<center>
									<input type="checkbox" id="select_all" value="">
								</center>
							</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no = 1;
						$sql_jenis = mysqli_query($con, "SELECT * FROM tb_jenis ORDER BY jenis ASC") or die(mysqli_error($con));
						if(mysqli_num_rows($sql_jenis) > 0){
							while($data = mysqli_fetch_array($sql_jenis)){ ?>
								<tr>
									<td><?= $no++; ?>.</td>
									<td><?= $data['jenis']; ?></td>
									<td align="center">
										<input type="checkbox" name="checked[]" class="check" value="<?= $data['id_jenis']; ?>">
									</td>
								</tr>
							<?php
							}
						}
						else{
							echo "<tr><td colspan=\"3\" align=\"center\">Data tidak ditemukan</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
		</form>

		<div class="box">
			<button class="btn btn-warning btn-sm" onclick="edit()"><i class="glyphicon glyphicon-edit"></i> Edit</button>
			<button class="btn btn-danger btn-sm" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
		</div>

	</div>

	<script>
	$(document).ready(function(){
		$('#select_all').on('click', function(){
			if(this.checked){
				$('.check').each(function(){
					this.checked = true;
				})
			}
			else{
				$('.check').each(function(){
					this.checked = false;
				})
			}
		});
		$('.check').on('click', function(){
			if($('.check:checked').length == $('.check').length){
				$('#select_all').prop('checked', true)
			}
			else{
				$('#select_all').prop('checked', false)
			}
		})
	})

	function edit(){
		document.proses.action = 'edit.php';
		document.proses.submit();
	}

	function hapus(){
		var conf = confirm('Yakin akan menghapus data?');
		if(conf){
			document.proses.action = 'del.php';
			document.proses.submit();
		}
	}

	</script>


<?php include_once('../_footer.php'); ?>                                                       