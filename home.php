<?php
include('dbconn.php');
session_start();
$query="SELECT `UID`,`GID`,`Group_Name`,`Grp_image` From `group_table`,`belongs_to` where `UID`='{$_SESSION['uid']}' AND `GID`= `Group_ID` GROUP BY `UID`,`GID`,`Group_Name`";
$result=mysqli_query($conn,$query);

if(isset($_POST['View']))
{
    $id=$_GET['id'];
    $_SESSION['grpid']=$id;
    header('location:details.php');
}

 $pic=array('friends.jpg','holiday.jpg','house.jpg','fun.jpg','trek.jpg');
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="stylei.css">
</head>
<body >
<header>
        <p>SHARE <img class="logo" src="photos/coin.png" alt="logo">XPENSES</p>
        <div class="bu">
        <a class="cta" href="deletegroup.php"><button>DELETE A GROUP</button></a>
        <a class="cta" href="addGroups.php"><button>CREATE A NEW GROUP</button></a>
        <a class="cta" href="index.php"><button>HOME</button></a>
</div>
</header>
<div class="contain">
    <?php
          while($row=mysqli_fetch_assoc($result))
          {
              $tmp=$row['GID'];
              $q="SELECT COUNT(*) FROM `belongs_to` WHERE `GID`='$tmp'";
              $res=mysqli_query($conn,$q);
              $data=mysqli_fetch_assoc($res);

    ?>
    <form action="home.php?action=add&id=<?php echo $row["GID"] ?>" method="post" >
    <div class="group">
        <div class="GroupImage">
        <?php
             echo "<img src ='{$row['Grp_image']}' >";
        ?>
        </div>
        <div class="title">
            <h3><?php echo $row['Group_Name']; ?></h3>
            <p>No Of Members: <?php echo $data['COUNT(*)'];?></p>
            <input type="submit" name="View" value="VIEW EXPENSES">
        </div>
        </div>
    </form> 
    <?php }?>  
    </div>
</body>
</html>