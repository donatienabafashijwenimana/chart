<?php
session_start();
$time = date("y-m-d h:i:s");
//including data base connection 
include '../connect.php';

$passerror = $erroruser = "";
if (isset($_POST['login'])) {
    
$username = $_POST['user_name'];
$pass =$_POST['password'];
$select_username = $conn->query("select*from users where username='$username'");
if (mysqli_num_rows($select_username) > 0) {
    $select_password = $conn->query("select* from users where username='$username' and password='$pass'");
    $row = mysqli_fetch_array($select_password);
    if (mysqli_num_rows($select_password) > 0) {
        
        echo"<script>
        alert('signin successfull');
        </script>";

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        $user_id = $_SESSION['user_id'];
        $update = $conn->query("update users set last_seen='$time' where user_id='{$_SESSION['user_id']}'");
        header('location:homepage.php');
    }else {
        $passerror="!!incorect password";
    }
}else {
    $erroruser="!!invalid user name";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat</title>
    <link rel="stylesheet" href="../css/form.css">

    <link rel="icon" href="icon/man-head.png">
</head>
<style>
    </style>
<body>
    <div class="div-form">
        
        <form action="#" method="post" class='form-login'>
          <div class="nav">
            <div class="log"><h1>sign in</h1></div>
          </div>
            <label for="username">user name</label>
            <input type="text" name="user_name" class='input-login'>
            <label for="error" class='error'><?php echo $erroruser; ?></label>
            <label for="password">password</label>
            <input type="password" name="password" class='input-login'>
            <label for="error" class='error'><?php echo $passerror; ?></label>
            <p><a href="sign up.php">create account</a></p>
            <input type="submit" name='login' value="login" class='submit'><br>
            
        </form>
    </div>
</body>
</html>