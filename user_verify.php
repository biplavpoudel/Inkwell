<?php
	session_start();
	require "./functions/db_functions.php";
	$conn = db_connect();

	$email = trim($_POST['email']);
	$pass = trim($_POST['password']);

	if(empty($email) || empty($pass)){
		// header("Location:../onlinebookstore/signin.php?signin=empty");/
        $_SESSION['msg'] = "Email and Password fields are empty. Please enter again.";
        header("Location:signin.php");
	}
    else
    { 
		//check if it is manager
		$query = "SELECT name,pass from manager";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);

		if($email == $row['name'] && $pass == $row['pass'] )
        {
			$_SESSION['manager'] = true;
			unset($_SESSION['expert']);
			unset($_SESSION['user']);
			unset($_SESSION['email']);
			header("Location: admin_book.php");
		}
		else
        {
			//check if it is expert
			$query = "SELECT name,pass from expert";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);
			if($email == $row['name'] && $pass == $row['pass'] )
            {
				$_SESSION['expert'] = true;
				unset($_SESSION['manager']);
				unset($_SESSION['user']);
				unset($_SESSION['email']);
				header("Location: admin_book.php");
			}
		    else
            {   
				//check if it is customer
				$email = mysqli_real_escape_string($conn, $email);
				$pass = mysqli_real_escape_string($conn, $pass);
				$query = "SELECT email,password from customers";
				$result = mysqli_query($conn, $query);
				for($i = 0; $i < mysqli_num_rows($result); $i++)
                {
					$row = mysqli_fetch_assoc($result);
					if($email == $row['email'] && $pass == $row['password'] ){ 
						$_SESSION['user'] = true;	
						$_SESSION['email'] = $email;
						unset($_SESSION['manager']);
						unset($_SESSION['expert']);
						header("Location: index.php");      //email session is set after customer logins
                    }
				}
			}
		}
	}
	

	if(isset($conn)) {
        mysqli_close($conn);
    }
?>