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
	$admin=$result->fetch();
	
	return $admin;
	
}

function get_admin_by_email($email)
{
	global $db;
	$query="SELECT * FROM administrators 
	        WHERE email='$email'";
	$result=$db->query($query);
	$admin=$result->fetch();
	
	return $admin;
}
function update_admin($id, $fname, $lname, $email, $password)
{
	global $db;
	$password=sha1($email.$password);
	$query="UPDATE administrators
	        SET fname='$fname',
			    lname='$lname',
				email='$email',
				password='$password'
			WHERE id=$id";
	$db->exec($query);
	
}


// -------------------   STORE   -------------------- //


function create_store($name, $administrator_id)
{
	global $db;
	$query="INSERT INTO store(name, administrator_id)
	         VALUES('$name', $administrator_id)";
	$result=$db->exec($query);
	return $result;
}
function update_store($name,$administrator_id)
{
	global $db;
	$query="UPDATE store SET name='$name'
	        WHERE administrator_id=$administrator_id";
	$result=$db->exec($query);
	
	return $result; //returns TRUE if updated successfully
}
function delete_store($administrator_id)
{
	global $db;
	$query="DELETE 
	        FROM store
			WHERE administrator_id=$administrator_id";
	$result=$db->exec($query);
	return $result;
}
function get_store($administrator_id)
{
	global $db;
	$query="SELECT * FROM store
	        WHERE administrator_id=$administrator_id";
	$result=$db->query($query);
	$store=$result->fetch();
	
	return $store;
}


?>