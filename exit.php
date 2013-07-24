<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
unset($_SESSION['id']);
unset($_SESSION['nik']);
session_destroy();
?>
<script type="text/javascript">
window.location = "index.php"
</script>