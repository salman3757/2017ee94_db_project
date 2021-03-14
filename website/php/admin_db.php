<?php 

require_once('database.php');

function add_admin($fname, $lname, $email, $password)
{
	global $db;
	$password=sha1($email.$password);
	
	$query="INSERT INTO administrators(fname, lname, email, password)
	        VALUES ('$fname','$lname', '$email', '$password')";
			
	$db->exec($query);
	$customer_id=$db->lastInsertId();
	
	return $customer_id;
}

function is_valid_admin_signin($email,$password)
{
	global $db;
	$password=sha1($email.$password);
	$query="SELECT * FROM administrators
	        WHERE email='$email' and password='$password'";
			
	$result=$db->query($query);
	$valid=($result->rowcount()==1);
	
	return $valid;
}
function get_admin($id)
{
	global $db;
	$query="SELECT * FROM administrators
	        WHERE id=$id";
	$result=$db->query($query);
	$customer=$result->fetch();
	
	return $customer;
	
}

function get_admin_by_email($email)
{
	global $db;
	$query="SELECT * FROM administrators 
	        WHERE email='$email'";
	$result=$db->query($query);
	$customer=$result->fetch();
	
	return $customer;
}
function update_admin($id, $fname, $lname, $email, $password)
{
	global $db;
	$password=sha1($email.$password);
	$query="UPDATE administrators
	        SET fname='$fname',
			    lname='$lname',
				email='$email',
				password='$password',
			WHERE id='$id'";
	$db->exec($query);
	
}




?>