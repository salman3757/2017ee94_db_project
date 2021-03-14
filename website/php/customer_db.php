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

function is_valid_customer_signin($email,$password)
{
	global $db;
	$password=sha1($email.$password);
	$query="SELECT * FROM customers
	        WHERE email='$email' and password='$password'";
			
	$result=$db->query($query);
	$valid=($result->rowcount()==1);
	
	return $valid;
}

function add_address($customerid,$address,$zip,$city,$state)
{
	global $db;
	$query="INSERT INTO addresses(customerid,detail, zip, city, state)
	        VALUES($customerid, '$address','$zip', '$city', '$state')";
			
	$db->exec($query);
	$addressid=$db->lastInsertId();
	
	return $addressid;
}

function get_customer($id)
{
	global $db;
	$query="SELECT * FROM customers
	        WHERE id=$id";
	$result=$db->query($query);
	$customer=$result->fetch();
	
	return $customer;
	
}

function get_customer_by_email($email)
{
	global $db;
	$query="SELECT * FROM customers 
	        WHERE email='$email'";
	$result=$db->query($query);
	$customer=$result->fetch();
	
	return $customer;
}

function get_address($id)
{
	global $db;
	$query="SELECT * FROM addresses   
	        WHERE customerid=$id";
	$result=$db->query($query);
	$address=$result->fetch();
	
	return $address;
}

function update_customer($id, $fname, $lname, $email, $password, $phone, $detail, $city, $state, $zip)
{
	global $db;
	$password=sha1($email.$password);
	$query="UPDATE customers
	        SET fname='$fname',
			    lname='$lname',
				email='$email',
				password='$password',
				phone='$phone'
			WHERE id='$id'";
	$db->exec($query);
	
	$query2="UPDATE addresses 
	          SET detail='$detail',
			       city='$city',
				   state='$state',
				   zip='$zip'
			 WHERE customerid='$id'";
	$db->exec($query2);
	
}




?>