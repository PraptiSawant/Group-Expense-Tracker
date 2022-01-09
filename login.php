<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="left">
        <div class="slogan1">  
        <p style="color:#ffffff;">SHARE EXPENSES</p>
</div>
        <div class="slogan2">
        <p align="center" ><font size="6">Welcome Back!</font></p>
        <p align="center" ><font size="4">To keep connected with us please <br>sign in with your personal info</font></p>
        </div>
        </div>
        <div class="right">
            <div class="formbx">
                <form action="login.php" method="post">
                    <h4>LOGIN</h4>
                    <p>Email_ID</p>
                    <input type="text" name="eid" >
                    <p>Password</p>
                    <input type="password" name="pass" >
                    <input type="Submit" name="login" value="Sign in">
                    <p>Don't have an account ? </p>
                    <input type="Submit" name="signup" value="Sign up">
                </form>
            </div>
        </div>
</body>
</html>
<?php
   include('dbconn.php');
   if(isset($_POST['login']))
   {
       $username=$_POST['eid'];
       $password=$_POST['pass'];
       $qry="SELECT * FROM `user` WHERE `Email_ID` ='$username' AND `Password`='$password'";
       $result=mysqli_query($conn,$qry);
       $row=mysqli_num_rows($result);
       if($row>=1)
       {
           $data=mysqli_fetch_assoc($result);
           $id=$data['User_ID'];
           echo "id= ".$id;
           session_start();
           $_SESSION['uid']=$id;
           header('location:home.php');
       }
   }
   if(isset($_POST['signup']))
   {
    header('location:signup.php');
   }
?>