<?php
    include('../connect.php');
    $time = date("y-m-d h:i:s");
    session_start();

    $error = $errorim = "";

    if (isset($_POST['signup'])) {
        $phone = $_POST['phonenumber'];
        $username = $_POST['user_name'];
        $sex = $_POST['sex'];
        $password = $_POST['password'];


        $image = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];
        $location ="profile/".$image;
        $file_extension = strtolower(pathinfo($location,PATHINFO_EXTENSION));
        $file_extension_allowed = Array('jpg','png','jpeg','bitmap','tiff','gif');

        $select = $conn->query("select* from users where username='$username'");
        if (mysqli_num_rows($select) > 0) {
            $error = "!!this user name was token";
            
        }else {
           if (in_array($file_extension,$file_extension_allowed)) {
           if(move_uploaded_file($tmp_image,$location));
           $insert= $conn->query("insert into users values(null,'$phone','$username','$sex','$password','$time','$image')");
            if($insert){
                      echo"<script>
                      alert('signup successfull');
                      window.location.href='sign in.php'
                      </script>";
                      die();
        }else{
            echo"<script>
            alert('sign up unsuccessfull')
          window.location.href='sign in.php'
            </script>";
        }
           }else {
           $errorim = "!!this file does not image";
          }

         }
        
        
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/form.css">
    <link rel="icon" href="icon/2share.png">
</head>
<body>
    <div class="div-form">
        
        <form action="#" method="post" class='form-login' enctype="multipart/form-data">
        <div class="nav">
            <div class="log"><h3>create account</h3></div>
            <div class="image"><img src="icon/2share.png"></div>
          </div>
            <label for="phonenumber">phone number</label>
            <input type="number" name="phonenumber" class='input-login'>
            
            <label for="username">user name</label>
            <input type="text" name="user_name" class='input-login'>
            <label for="error" class='error'><?php echo $error; ?></label> 
            <label for="gender">select your gender </label>
            <input type="radio" name="sex" id="" value='male' checked>male
            <input type="radio" name="sex" id="" value='female'>female <br> <br>
            <label for="password">password</label> 
            <input type="password" name="password" class='input-login'>
            <label for="p_p"> profile picture</label>
            <input type="file" name="image" id="im-profile">
                <?php echo $errorim ?>
            <input type="submit" name='signup' value="sign up" class='submit'>
            <a href="sign in.php">sign in</a>
        </form>
   
</body>
</html>