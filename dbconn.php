<?php
   $conn=mysqli_connect('localhost','root','','group_expensedb');
   // check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
?>
