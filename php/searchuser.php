<div class="peoplelist">
<?php
session_start();
include '../connect.php';
 $usernamesearch = $_POST['user'];

$selectuser = $conn->query("select* from users where username like '%$usernamesearch%'");

foreach($selectuser as $user){
if($user['user_id']==$_SESSION['user_id']) continue;
?>
 <a href="#" class="peoleitem">
    <img src="profile/<?=$user['profile_picture']?>" alt="">
    <label  class="peopleitemname"><?=$user['username']?></label>
</a>
<?php
}
?>
</div>