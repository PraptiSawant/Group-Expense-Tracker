<?php
include('dbconn.php');
session_start();
    $query="SELECT * FROM `group_table` WHERE `Group_ID`='{$_SESSION['grpid']}'";
    $result=mysqli_query($conn,$query);
    $data=mysqli_fetch_assoc($result);

    $qy="SELECT SUM(Amount) FROM `expense_tb` WHERE `Grp_ID`='{$_SESSION['grpid']}'";
    $exe=mysqli_query($conn,$qy);
    $row=mysqli_num_rows($exe);
    $dat=mysqli_fetch_assoc($exe);

    $q="SELECT COUNT(*) FROM `belongs_to` WHERE `GID`='{$_SESSION['grpid']}'";
    $res=mysqli_query($conn,$q);
    $d=mysqli_fetch_assoc($res);
    ?>
    
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylei.css">
</head>
<body>
<header>
        <p>SHARE <img class="logo" src="photos/coin.png" alt="logo">XPENSES</p>
        <div class="bu">
        <a class="cta" href="addexpense.php"><button>ADD EXPENSE</button></a>
        <a class="cta" href="deletemember.php"><button>DELETE MEMBER</button></a>
        <a class="cta" href="updateexpense.php"><button>UPDATE EXPENSE</button></a>
        <a class="cta" href="joinnewmembers.php"><button>ADD MEMBER</button></a>
        <a class="cta" href="viewreport.php"><button>VIEW EXPENSE REPORT</button></a>
        <a class="cta" href="home.php"><button>Back</button></a>
</div>
</header>
<div class="grp">
    <h2  style="color:#bf1922;">Group Name : <?php echo $data['Group_Name']; ?></h2> 
    <h4  style="color:grey;">Number Of Members : <?php echo $d['COUNT(*)'];?> </h4> 
    <h4  style="color:grey;">Date :  <?php echo $data['created_at']; ?></h4> 
    <h4  style="color:grey;">Total Expense : <?php echo $dat['SUM(Amount)']; ?> Rs</h4> 
</div>
    <table class="table" border="1" width="95%" height="100%" align="center">
        
        <tr>
            <th>PAYEE NAME</th><th>AMOUNT</th><th>CATEGORY</th><th>DATE OF TRANSACTION</th>
        </tr>
        <?php
             $que=" SELECT `Fname`, `Lname`,`Amount`, `Category_Name`, `Date_of_transaction` FROM `expense_tb`,`user`,`category` WHERE `User_ID`=`UID` AND Cat_ID = Category_ID AND `Grp_ID`='{$_SESSION['grpid']}' ORDER BY `Date_of_transaction` DESC";
             $res=mysqli_query($conn,$que);
             while($row=mysqli_fetch_assoc($res))
             {
        ?>
         <tr>
            <td><?php echo $row['Fname']." ".$row['Lname']?></td><td><?php echo $row['Amount']?>.00</td><td><?php echo $row['Category_Name']?></td><td><?php echo $row['Date_of_transaction']?></td>
        </tr>
        <?php
        }

?>

    </table>


</body>
</html>