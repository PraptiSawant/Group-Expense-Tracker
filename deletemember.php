<?php 
include('dbconn.php');
session_start();
       $query="SELECT * FROM `belongs_to`,`user` WHERE `User_ID`=`UID` AND `GID`='{$_SESSION['grpid']}'";
       $res=mysqli_query($conn,$query);
       $r=mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="AddExp">
    
                <form action="deletemember.php" method="post">
                    <p>Payee First Name</p>
                    <div class="name">
                    <select name="PFname">
                    <?php for($i=0;$i<$r;$i++)
                        {
                            $data=mysqli_fetch_assoc($res);
                    ?>
                        <option value="<?php echo $data["Fname"] ?> "><?php echo $data["Fname"]." ".$data["Lname"]; ?></option>
                        <?php } ?>
                        </select> 
                        </div> 
                        <input type="Submit" name="exit" value="EXIT"></input>
                    <input type="Submit" name="deletemember" value="DELETE MEMBER"></input>
                </form>
        </div>
     </div>
</body>
</html>
<?php
include('dbconn.php');
     if(isset($_POST['deletemember']))
     {
        $pf=$_POST['PFname'];
        $qy="SELECT `User_ID` FROM `user` WHERE `Fname`='$pf'";
        $exe=mysqli_query($conn,$qy);
        $dat=mysqli_fetch_assoc($exe);
        $uid=$dat['User_ID'];
        $q="DELETE FROM `belongs_to` WHERE `UID`='$uid'";
        $execute=mysqli_query($conn,$q);
     }
     if(isset($_POST['exit']))
     {
         header('location:details.php');
     }
?>