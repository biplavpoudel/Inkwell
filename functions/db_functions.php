<?php

// Database connection function
    if (!function_exists("db_connect")){
        function db_connect(){
            $conn = mysqli_connect("localhost", "root", "", "inkwell");

            if (!$conn){
                echo "Cannot connect to database !" . mysqli_connect_error();
                exit;
            }
            return $conn;
        }
    }

//Function to select any four latest books out of the database
    if (!function_exists("select6books")){
        function select6books($conn){
            $row = array();  //we create an anrray called row
            $query = "SELECT book_isbn, book_image FROM books ORDER BY book_isbn DESC";
            $result = mysqli_query($conn, $query);
            if (!$result){
                echo "Cannot retrieve data ! " . mysqli_error($conn);
                exit;
            }
            for ($i=0; $i<6; $i++){
                array_push($row, mysqli_fetch_assoc($result));  //concatenates result as an associative array to $row
            }
            return $row;
        }
    } 

//retrieve book by isbn number

    if (!function_exists("getBookByIsbn")){
        function getBookByIsbn($conn, $isbn){
            $query = "SELECT book_title, book_author, book_price FROM books WHERE book_isbn = '$isbn'";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Cannot retrieve data ! " . mysqli_error($conn);
                exit;
            }
            return $result;
        }
    }

//retrieve cartid using customerid from cart table

    if (!function_exists("getCartId")){
        function getCartId($conn, $customerid){
            $query = "SELECT id FROM cart WHERE customerid = '$customerid'";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Retrieving data failed !" . mysqli_error($conn);
                exit;
            }
            $row = mysqli_fetch_assoc($result);
            return $row['id'];
        }
    } 
    
//insert customerid and date into cart table    

    if (!function_exists("insertIntoCart")){
        function insertIntoCart($conn, $customerid,$date){
            $query = "INSERT INTO cart(customerid, date) VALUES('$customerid','$date') ";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Insert Cart failed ! " . mysqli_error($conn);
                exit;
            }
        }
    }

//retrieve book price from book table using isbn number

    if (!function_exists("getbookprice")){
        function getbookprice($isbn){
            $conn = db_connect();
            $query = "SELECT book_price FROM books WHERE book_isbn = '$isbn'";
            $result = mysqli_query($conn, $query);
            if(!$result){
                echo "Retrieving book price failed ! " . mysqli_error($conn);
                exit;
            }
            $row = mysqli_fetch_assoc($result);
            return $row['book_price'];
        }
    } 
 
//retrieve customerid using name, address, zip and country from customers table

if (!function_exists("getCustomerId")){
	function getCustomerId($name, $address, $city, $zip_code, $country){
		$conn = db_connect();

		$query = "SELECT customerid from customers WHERE 
		name = '$name' AND 
		address= '$address' AND 
		city = '$city' AND 
		zip_code = '$zip_code' AND 
		country = '$country'";

		$result = mysqli_query($conn, $query);
		// if there is customer in db, take it out
		if($result){
			$row = mysqli_fetch_assoc($result);
			return $row['customerid'];
		} else {
			return null;
		}
	}
}

//retrieving customer info using email
if (!function_exists("getCustomerInfoByEmail")){
	function getCustomerInfoByEmail($email){
		$conn = db_connect();
		$query = "SELECT * from customers WHERE email = '$email'";
		$result = mysqli_query($conn, $query);
		if($result){
			$row = mysqli_fetch_assoc($result);
			return $row;
		} else {
			return null;
		}
	}
}

//retrieve publisher name from publisher table using publisherid

if (!function_exists("getPubName")){
	function getPubName($conn, $pubid){
		$query = "SELECT publisher_name FROM publisher WHERE publisherid = '$pubid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Cannot retrieve data ! " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Not Set";
		}

		$row = mysqli_fetch_assoc($result);
		return $row['publisher_name'];
	}
}

//retrieve category name from category table using categoryid

if (!function_exists("getCatName")){
	function getCatName($conn, $catid){
		$query = "SELECT category_name FROM category WHERE categoryid = '$catid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Cannot retrieve data ! " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Not Set";
		}

		$row = mysqli_fetch_assoc($result);
		return $row['category_name'];
	}
}

//retrieve all books 

if (!function_exists("getAllBooks")){
	function getAllBooks($conn){
		$query = "SELECT * from books ORDER BY book_isbn DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Cannot retrieve data ! " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}

//retrieve all publishers

if (!function_exists("getAllPublishers")){
	function getAllPublishers($conn){
		$query = "SELECT * from publisher ORDER BY publisher_name ASC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Cannot retrieve data ! " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}

//retrieve all categories of books in the database

if (!function_exists("getAllCategories")){
	function getAllCategories($conn){
		$query = "SELECT * from category ORDER BY category_name ASC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}

?>