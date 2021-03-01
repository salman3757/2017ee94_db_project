<?php 
session_start();
require_once('../php/database.php');
require_once('../php/customer_db.php');

if(isset($_POST['action']))
{
	$action=$_POST['action'];
}
elseif(isset($_GET['action']))
{
	$action=$_GET['action'];
}
elseif(isset($_SESSION['user']))
{
	$action='view_account';
}
else{
	$action='view_signin.php';
}

switch($action)
{
	case 'view_signin':
	include('signin.php');
	break;
	
	case 'view_signup':
	include('signup.php');
	break;
	
	case'signin':
	$email=$_POST['email'];
	$password=$_POST['password'];
	$valid=is_valid_customer_signin($email,$password);
	if($valid)
	{
		$user=get_customer_by_email($email);
		$_SESSION['user']=$user;
		header('Location:..');
	}
	else
	{
		echo"Email / Password incorrect ";
	}
	break;
	
	case 'signup':
	$fname=$_POST['firstname'];
	$lname=$_POST['latname'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	$address=$_POST['address'];
	$zip=$_POST['zip'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$_SESSION['formdata']=array();
	$_SESSION['formdata']['fname']=$fname;
    $_SESSION['formdata']['lname']=$lname;
	$_SESSION['formdata']['email']=$email;
	$_SESSION['formdata']['phone']=$phone;
	$_SESSION['formdata']['address']=$address;
	$_SESSION['formdata']['zip']=$zip;
	$_SESSION['formdata']['city']=$city;
	$_SESSION['formdata']['state']=$state;
	$valid=True;
	
	if(empty($fname))
	{
		echo"First Name can't be empty.";
		$valid=False;
	}
	if(empty($lname))
	{
		echo"Last Name can't be empty.";
		$valid=False;
	}
	if(empty($email))
	{
		echo"Email can't be empty.";
		$valid=False;
	}
	if(empty($phone))
	{
		echo"Phone can't be empty.";
		$valid=False;
	}
	if(empty($address))
	{
		echo"Address Name can't be empty.";
		$valid=False;
	}
	if(empty($zip))
	{
		echo"Zip can't be empty.";
		$valid=False;
	}
	if(empty($password1) || empty($password2))
	{
		echo"Password can't be empty.";
		$valid=False;
	}
	elseif($password1 !== $password2 )
	{
		echo"Passwords Don't Match";
	    $valid=False;
	}
	elseif(strlen($password1)<8)
	{
		echo"Password Must be atleast 8 Characters long.";
		$valid=False;
	}
	
	if($valid==True)
	{
		$customer_id=add_customer($fname,$lname,$phone,$email,$password1);
		$addressid =add_address($customer_id,$address,$zip,$city,$state);
		$user=get_customer($customer_id);
		$_SESSION['user']=get_customer($customer_id);
	    if($addressid==true)
		{
			$_SESSION['user']['fname'];
			header('Location:../index.php');
		}
		else{
			echo "account not created";
		}
	unset($_SESSION['formdata']);
	}
	
	break;
	
	case 'signout':
	unset($_SESSION['user']);
	header('Location:../index.php');
	break;
}

?>