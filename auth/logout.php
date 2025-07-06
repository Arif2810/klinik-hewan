<?php

require_once"../_config/config.php";

// unset($_SESSION['user']);
$_SESSION = [];
session_unset();
session_destroy();
echo "<script>window.location='".base_url('auth/login.php')."'</script>";