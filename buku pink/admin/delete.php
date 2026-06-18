    <?php 
    require __DIR__ . "/../db_connect.php";
    $userID = $_GET["userID"];

		$sql = "DELETE FROM user WHERE userID = '$userID'";
		$sendsql = mysqli_query($connect,$sql);	
							
		if($sendsql){
			echo "<script>alert('Account has been deleted.'); window.location.href = 'manage user.php';</script>";
            
		}else{
			echo "<script>alert('ERROR: Unable to delete. Please try again.'); window.location.href = 'manage user.php';</script>";
		}		 
        ?>