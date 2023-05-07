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
        header("Location: localhost/Inkwell/signup.php?signup=empty");
    }
    else{
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            header("Location: localhost/Inkwell/signup.php?signup=invalidemail");
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
            header("Location: signin.php");
            }
            //if email exists aka an existing customer
            else {
                $row = mysqli_fetch_assoc($findResult);
                $userid = $row['id'];
                header("Location: signin.php");
                // Any ways to auto form fill for existing users? (only email tho) ani you already have an account message in small letters below form uisng div?
            }
        }
    }

?>