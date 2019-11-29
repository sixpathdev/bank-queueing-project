<?php
require_once "../controls.php";
require_once "../sys.php";

clearQueue($dbc);
header('Location: ../admin_controls.php');
?>