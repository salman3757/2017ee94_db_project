<?php 

require_once('database.php');

function add_customer($fname, $lname,$phone, $email, $password)
{
	global $db;
	$password=sha1($email.$password);
	
	$query="INSERT INTO customers(fname, lname, phone, email, password)
	        VALUES ('$fname','$lname', '$phone', '$email', '$password')";
			
	$db->exec($query);
	$customer_id=$db->lastInsertId();
	
	return $customer_id;
}

function is_valid_customer_login($email,$password)
{
	global $db;
	$password=sha1($email.$password);
	$query="SELECT * FROM customers
	        WHERE email='$email' and password='$password'";
			
	$result=$db->query($query);
	$valid=($result->rowcount()==1);
	
	return $valid;
}











?>