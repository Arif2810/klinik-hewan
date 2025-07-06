<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>Ganti Password</h1>
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
	<h4>
		<small>Ganti password user</small>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">

			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="oldPass">Password Lama</label>
					<input type="password" name="oldPass" id="oldPass" class="form-control" required autofocus>
				</div>
				<div class="form-group">
					<label for="newPass">Password Baru</label>
					<input type="password" name="newPass" id="newPass" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="confPass">Password Baru</label>
					<input type="password" name="confPass" id="confPass" class="form-control" required>
				</div>
				<div class="form-group">
					<input type="reset" name="reset" value="Reset" class="btn btn-secondary">
					<input type="submit" name="edit" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once('../_footer.php'); ?>
