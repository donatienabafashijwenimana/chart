<?php
include '../connect.php';
$id = $_POST['id'];
$update = $conn->query("update users set last_seen=now() where user_id='$id'");
echo $id;
?>