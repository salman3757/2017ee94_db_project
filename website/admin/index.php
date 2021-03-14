<?php 
session_set_cookie_params(strtotime("+1 year"), '/');
session_start();
require_once('../php/database.php');
require_once('../php/admin_db.php');

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
	$action='view_default';
}

switch($action)
{
	case'view_default':
	include('default_view.php');
	
	break;
	case 'view_signin':
	include('signin.php');
	break;
	
	case 'view_signup':
	include('signup.php');
	break;
	
	case'signin':
	$email=$_POST['email'];
	$password=$_POST['password'];
	$valid=is_valid_admin_signin($email,$password);
	if($valid)
	{
		$user=get_admin_by_email($email);
		$_SESSION['user']=$user;
		header('Location:../index.php');
	}
	else
	{
		echo"Email / Password incorrect ";
	}
	break;
	
	case 'signup':
	$fname=$_POST['firstname'];
	$lname=$_POST['latname'];
	$email=$_POST['email'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	$_SESSION['formdata']=array();
	$_SESSION['formdata']['fname']=$fname;
    $_SESSION['formdata']['lname']=$lname;
	$_SESSION['formdata']['email']=$email;
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
		$admin_id=add_admin($fname,$lname,$email,$password1);
		$user=get_admin($admin_id);
		$_SESSION['user']=get_admin($admin_id);
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
	
	case 'view_account':
    header('Location:account_view.php');
	break;
}

?>