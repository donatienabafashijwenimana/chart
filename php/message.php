<?php
include '../connect.php';

  $fromid = $_POST['fromid'];
  $toid = $_POST['toid'];
  $message = $_POST['message'];
 
 $insert = $conn->query("insert into chart values(null,'$fromid','$toid','$message',1,now())");
 $select = $conn->query("select * from conversation where user1='$fromid' and user2='$toid' or user2='$fromid' and user1='$toid'");
 if (mysqli_num_rows($select)==0) {
 $insert2 = $conn->query("insert into conversation values('$fromid','$toid')");
}
 
?>