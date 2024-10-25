<?php

   session_start();
   if(!isset($_SESSION['user_id']))header("location:sign in.php");
   include '../connect.php';
   include 'getuserchart.php';
  $userid = $_SESSION['user_id'];
  $selectudata =$conn->query(" select* from users where user_id='$userid'");
  $userdata = mysqli_fetch_array($selectudata);
  
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<input type="hidden" name="fromid" id="fromid" value="<?=$_SESSION['user_id']?>">

    <div class="top">
        <div class="left">
            <img src="profile/<?=$userdata['profile_picture'];?>" alt="">
            <div class="userdata">
                <div class="username"><?=$userdata['username']?></div>
                <small>online</small>
            </div>
        </div>
        <div class="right">
            <img src="../icon/2share.png" alt="">
        </div>
    </div>
    <div class="container">
        <div class="nav">
            <img src="../icon/home.png" alt="" onclick="return window.location.href='homepage.php'">
            <img src="../icon/setting.png" alt="">
        </div>
        <div class="people">
            <input type="search" name="searchuser"  placeholder="search user" id="searchuser">
            <div class="peoplelist">
               
            </div>

        </div>
        <?php if(isset($_GET['toid'])){ 
            $todata = getuserchart($_GET['toid'],$conn);
        ?>
        <div class="message">
            <?php
            
            ?>
             <div class="top" style="width:97%">
                <div class="left">
                    <img src="profile/<?=$userdata['profile_picture'];?>" alt="">
                    <div class="userdata">
                        <div class="username"><?=$todata['username']?></div>
                        <small><?=date('y-d-m h:i',strtotime($todata['last_seen']))==date('y-d-m h:i')?'online':'offline'?></small>
                    </div>
                </div>
             </div>
             <div class="messagearea">

            </div>
            <div class="messagefield">
                <input type="hidden" name="fromid" id="fromid" value="<?=$_SESSION['user_id']?>">
                <input type="hidden" name=""  id="toid" value="<?=$_GET['toid']?>">
                <input type="text" name="message" id="messagetext"><button id="send">send</button>
            </div>
        </div>
        <?php }else{?>
            <h1>select user to start chart</h1>
            <?php } ?>
    </div>
</body>
</html>
<script  src="../js/jquery-3.6.3.js"></script>
<script  src="../js/javascript.js"></script>
<script>
    
</script>