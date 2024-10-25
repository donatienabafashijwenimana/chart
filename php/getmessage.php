<?php
include '../connect.php';
session_start();

$from_id = $_SESSION['user_id'];
$to_id = $_POST['toid'];
$update = $conn->query("update chart set opened=1 where from_id='to_id' and to_id='from_id'");
    $selectmessege =$conn->query("select*from chart where
    from_id='$from_id' and to_id='$to_id'
     or  from_id='$to_id' and to_id='$from_id'");

     foreach($selectmessege as $message){
?>
    <div class="messagearea2">
        <?php
        if ($message['from_id']==$from_id) {
            ?><p class="sendedmessage">
               <label> <?=$message['messege']?></label>
                <small class="at"><?=date('h:i',strtotime($message['created_at']))?></small>
            </p>
            <?php
        }else{
        ?>
        <p class="receivedmessage">
            <label> <?=$message['messege']?></label>
            <small class="at"><?=date('h:i',strtotime($message['created_at']))?></small>
        </p>
        <?php } ?>
    </div>
    <?php } ?>
