<?php
session_start();
include_once("db.php");

if(!isset($_SESSION['username'])){
	header("Location: login.php");
	return;
}
if(!isset($_GET['pid'])){
	header("Location: index.php");
	return;
} else {
	$pid = $_GET['pid'];
	$sql = "DELETE FROM notice_posts WHERE id=$pid";
	mysqli_query($db, $sql);
	header("Location: index.php");
}
?>