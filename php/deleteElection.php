<?php
session_start();
require_once("db.php");

$ConnectingDB = $GLOBALS['connexion'];
$delete = "DELETE FROM elections WHERE election_id='$_POST[election_id]'";
$stmt = $ConnectingDB->prepare($delete);
$stmt->execute();
echo "<script>alert('Election deleted successfully!')</script>";
?>