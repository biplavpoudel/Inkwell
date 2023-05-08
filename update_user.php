<?php
	session_start();
	require "./functions/db_functions.php";
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


    // Get the uploaded image file information
    // $image = $_FILES['image']['tmp_name'];
    // $image_name = $_FILES['image']['name'];
    // $image_size = $_FILES['image']['size'];

    // Read the file contents into a variable
    // $image_data = file_get_contents($image);

    // Escape special characters in the image name
    // $image_name = mysqli_real_escape_string($conn, $image_name);
    // $sql = "INSERT INTO pimage (name, size, data) VALUES ('$image_name', '$image_size', '$image_data')";

    // if (mysqli_query($conn, $sql)) {
    //     $_SESSION['upload_msg']= "Image uploaded successfully.";
    //   } else {
    //     $_SESSION['upload_msg']= "Error: " . mysqli_error($conn);
    //   }

    //Form validation for other data
    if(empty($firstname) || empty($lastname) || empty($password) || empty($address) ||empty($city)||empty($zipcode)){
        $_SESSION['profile_msg1'] = "You did not fill in all the fields.";
        header("Location: profile.php");
        exit;
    }
    else{
        $query ="UPDATE customers
        SET firstname = '$firstname', lastname = '$lastname', address = '$address', password = '$password', city = '$city', zipcode = '$zipcode'
        WHERE email = '$email' ";

        $result = mysqli_query($conn, $query);

        if (!$result){
            $_SESSION['profile_msg1'] = "Something wrong. Profile cannot be updated.";
            header("Location: profile.php");
            exit;
        }
        else{
            $_SESSION['profile_msg2'] = "Profile successfully updated.";

            // //Now to retrieve image stored in database
            // $sql = "SELECT * FROM images WHERE email = $email";
            // $result = mysqli_query($conn, $sql);

            // if ($result && mysqli_num_rows($result) > 0) {
            // $row = mysqli_fetch_assoc($result);
            // $image_data = $row['data'];
            // $image_type = mime_content_type($row['name']);
            
            // // Output the image data
            // header("Content-type: $image_type");
            // echo $image_data;
            // }
            // else {
            // echo "Image not found.";}

            header("Location: profile.php");
            exit;
        }
    }
        
?>