<?php
    session_start();
    $title = "User_Signup_Verify";
    include "./functions/db_functions.php";
    // include "./template/header.php";
    $conn = db_connect();

    // Now onto trimming and escaping special characters in form inputs
    $firstname = trim($_POST['firstname']);
    $firstname = mysqli_real_escape_string($conn, $firstname);
    
    $lastname = trim($_POST['lastname']);
    $lastname = mysqli_real_escape_string($conn, $lastname);

    $email = trim($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    
    $password = trim($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    
    $address = trim(trim($_POST['address']));
    $address = mysqli_real_escape_string($conn, $address);
    
    $city = trim($_POST['city']);
    $city = mysqli_real_escape_string($conn, $city);
    
    $zipcode = trim($_POST['zipcode']);
    $zipcode = mysqli_real_escape_string($conn, $zipcode);

    if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($address)||empty($city)||empty($zipcode)){
        $_SESSION['msg1'] = "You did not fill in all the fields.";
        header("Location: signup.php");
    }
    else{
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $_SESSION['msg2'] = "You did not enter a valid email address.";
            header("Location: signup.php");
        }
        else{
            // check if exisiting email exists
            $findUser = "SELECT * FROM customers WHERE email = '$email' ";
            $findResult = mysqli_query($conn, $findUser);

            // if email doesn't exist aka new customer
            if(mysqli_num_rows($findResult)==0){       
                $insertUser = "INSERT INTO customers(firstname, lastname, email, address, password, city, zipcode) VALUES 
                ('$firstname', '$lastname', '$email', '$address', '$password', '$city', '$zipcode')";
                $insertResult = mysqli_query($conn, $insertUser);
                
                if(!$insertResult){
                    echo "Can't add new user " . mysqli_error($conn);
                    exit();
            }
            $userid = mysqli_insert_id($conn);
            $_SESSION['msg'] = "Account successfully registered. Now login.";
            header("Location: signin.php");
            }
            //if email exists aka an existing customer
            else {
                $row = mysqli_fetch_assoc($findResult);
                $userid = $row['id'];
                header("Location: signin.php");
                $_SESSION['msg'] = "Account with this email is already registered. Please login.";
            }
        }
    }

?>

<?php
	if(isset($conn)) {
        mysqli_close($conn);
    }
	// require_once "./template/footer.php";
?>