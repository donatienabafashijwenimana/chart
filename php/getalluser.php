<div class="peoplelist">
<?php
session_start();
$conn =mysqli_connect('localhost','root','','chart_platform');
 $id = $_POST['id'];

$selectuser = $conn->query("select* from conversation where user1='$id' or user2='$id'");

foreach($selectuser as $userconv){
    $user1= $userconv['user1'];
    $user2= $userconv['user2'];
    $select2 = $conn->query("select* from users where user_id='$user1' or user_id='$user2'");
    
    foreach($select2 as $user){
        if ($user['user_id']==$id) continue;
        $from_id= $id;
        $to_id = $user['user_id'];
        $selectmessege =$conn->query("select*from chart where
        from_id='$from_id' and to_id='$to_id'
        or  from_id='$to_id' and to_id='$from_id' order by chart_id desc limit 1");
        $message = mysqli_fetch_array($selectmessege);
?>
 <a href="?toid=<?=$user['user_id']?> " class="peoleitem">
    <img src="profile/<?=$user['profile_picture']?>" alt="">
    <label  class="peopleitemname">
        <?=$user['username']?> 
        <?php if ($message!=null){
         if ($message['from_id']==$id) {
          ?><small><?=substr($message['messege'],0,10)?></small>
          <?php
        }else {
            ?><small style="color:green">
                 <?=substr($message['messege'],0,3)?> 
                 <?php if($message['opened']==1){?><small class="unread">
                    <?=$message['opened'];?></small><?php } ?>
               </small>
            <?php
        } }?>
        
    </label>
    
</a>
<?php
    }
}
?>
</div>