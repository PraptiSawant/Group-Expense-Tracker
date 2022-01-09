<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="Member">
        <div class="AddGrp">
                <form action="addmembers.php" method="post">
                    <?php
                        for($i=0;$i<$_SESSION['nm'];$i++)
                            {
                    ?>
                    <p style="color:#000000;"><font size="4">MEMBER <?php echo $i+1 ?></font></p>
                    <p>First Name</p>
                    <input type="text" name="<?php echo $i.'fname';?>" >
                    <p>Last Name</p>
                    <input type="text" name="<?php echo $i.'lname';?>" >
                    <p>Email-ID</p>
                    <input type="text" name="<?php echo $i.'eid';?>" >
                    <br>
                    <br>
                    <?php
                            }
                    ?>
                    <input type="Submit" name="addmember" value="Add Member">
                </form>
        </div>
</div>
    
</body>
</html>
<?php
    include('dbconn.php');
    if(isset($_POST['addmember']))
    { 
        echo "<img src ='{$_SESSION['image']}' >";
    for($i=0;$i<$_SESSION['nm'];$i++)
    {
        $eid=$_POST[$i."eid"];
        $fn=$_POST[$i."fname"];
        $ln=$_POST[$i."lname"];
        $query="SELECT * FROM `user` WHERE `Email_ID` ='$eid' AND `Fname`='$fn' AND `Lname`='$ln'";
        $result=mysqli_query($conn,$query);
        $row=mysqli_num_rows($result);
    if($row>=1)
    {   
           $data=mysqli_fetch_assoc($result);
           $mid=$data['User_ID'];
           $_SESSION['mid']=$mid;
           $qry="INSERT INTO `belongs_to`(`UID`, `GID`) VALUES ('{$_SESSION['mid']}','{$_SESSION['gid']}')";
           $result=mysqli_query($conn,$qry);
    }

  }
header('location:home.php');
}

?>