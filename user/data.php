<?php include_once('../_header.php');

if($_SESSION['level'] != 1){
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
		<h1>User</h1>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
		<h4>
			<small>Data User</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah User</a>
			</div>
		</h4>
		<form method="post" name="proses">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="user">
					<thead>
						<tr>
							<th>
								<center>
									<input type="checkbox" id="select_all" value="">
								</center>
							</th>
							<th>No.</th>
							<th>Id User</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Level</th>
							<th><i class="glyphicon glyphicon-cog"></i></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no = 1;
						$sql_user = mysqli_query($con, "SELECT * FROM tb_user") or die(mysqli_error($con));
						while($data = mysqli_fetch_array($sql_user)){ 
							$level = $data['level'];
						?>
							<tr>
								<td align="center">
									<input type="checkbox" name="checked[]" class="check" value="<?= $data['id_user']; ?>">
								</td>
								<td><?= $no++; ?>.</td>
								<td><?= $data['id_user']; ?></td>
								<td><?= $data['nama_user']; ?></td>
								<td><?= $data['username']; ?></td>
								<td>
									<?php
										$roles = [
											1 => 'Administrator',
											2 => 'Petugas',
										];
										echo $roles[$level] ?? 'Dokter';
										?>
								</td>
								<td align="center">
									<a href="edit.php?id=<?= $data['id_user']; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</form>

		<div class="box">
			<button class="btn btn-danger btn-sm" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
		</div>

	</div>

	<script>
	$(function(){

		$('#user').DataTable({
			columnDefs: [{
				"searchable": false,
				"orderable": false,
				"targets": [0, 4]
			}],
			"order": [1, "asc"]
		});

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
	});

	function hapus(){
		var conf = confirm('Yakin akan menghapus data?');
		if(conf){
			document.proses.action = 'del.php';
			document.proses.submit();
		}
	};

	</script>


<?php include_once('../_footer.php'); ?>                                                       