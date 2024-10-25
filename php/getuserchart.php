<?php
function getuserchart($id,$conn){
    $selectuser = $conn->query("select*from users where user_id='$id'");
    $todata = mysqli_fetch_array($selectuser);
    return $todata;
}