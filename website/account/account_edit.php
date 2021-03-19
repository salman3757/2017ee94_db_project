<?php session_start();
include('../php/customer_db.php');?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PATRIOT'S CLUB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/favicon.png">
<style>
<?php include('account_view.css');
?>



.input{
	font-size:1.5rem;
	border:1.5px solid black;
	height:2rem;
	width:42rem;
	padding:0.2em;
	text-align:center;
}
.input:hover, .input:focus, .input:active
{
	background-color:black;
	color:white;
	border:2px solid gray;
}

.submit2{
	height:2rem;
	width:10rem;
	text-align:center;
	font-size:1.3rem;
	text-transform:uppercase;
	border:4px dashed white; color:orange; padding:0.4em;
      background-color:yellow; font-weight:bold; height:50px; width:200px;
	  transition-type: background-color, border, font-family, color, height, width;
	  transition-duration:0.4s;
	  color:black;
}
#c2{
	height:60em;
}
.submit2:hover, .submit2:focus, .submit2:active
{
	height:50px;
	width:300px;
	background-color:#e01a00;
	color:black;
	border:5px solid white;
}
</style>
</head>
<?php if (isset($_SESSION['user']))
{
	$email=$_SESSION['user']['email'];
	$query="SELECT *
            FROM administrators
			WHERE email='$email'";
	$result=$db->query($query);
    $admin=$result->fetch(PDO::FETCH_BOTH);
	}
	
?>
<body>
<div id="container">
<header>
<nav>
<div id="nav">
  <ul>
    <li><a href="../index.php" >Home</a></li>
    <li><a href="">Our Story</a><li>
	<li><a href="../products.php">Armory</a></li>
	<li><a href="">Hours & Location</a><li>
	<?php if(!isset($_SESSION['user'])){
		echo "<li><a href=\"index.php?action=view_signin\">Sign In</a></li>
		      <li><a href=\"index.php?action=view_signup\">Sign Up</a></li>";
		}
		elseif($admin)
		{
			echo "<li><a href=\"../admin/?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"../admin/?action=signout\">Sign Out</a></li>";
		}
		else{
			echo "<li><a href=\"index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"index.php?action=signout\">Sign Out</a></li>";
		} ?>
	<li><a href="../cart/">Cart</a></li>
	<li><a href="../admin/">Seller Area</a></li>
  </ul>
  </div>
  <div id="search"><form action="../search.php" method="post">
	     <input placeholder="Search Weapons..." id="search_bar" type="text" name="search_products">
		 <input id="search_btn" type="submit" value="Search"></form>
	</div>
</nav> 

<div id="logo"> 
    <a href="../index.php"><img id="img" src="../images/logo.jpg" alt="logo" height="200px" width="auto"></a>
  </div> 
<h1><!--cont.--></h1>
</header>


<div id="p2" class="strip">
<p><span class="p1">Edit Account</span></p>
</div>

<div id="c2">
<div id="sign">
<?php 
$fname=$_SESSION['user']['fname'];
$lname=$_SESSION['user']['lname'];
$email=$_SESSION['user']['email'];
$phone=$_SESSION['user']['phone'];

$id=$_SESSION['user']['id'];
$address=get_address($id);

$address_detail=$address['detail'];
$zip=$address['zip'];
$city=$address['city'];
$state=$address['state'];


if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone'])
	    && isset($_POST['email']) && isset($_POST['detail']) && isset($_POST['city'])
	   && isset($_POST['state'])  && isset($_POST['zip']) && isset($_POST['password1']) && isset($_POST['password2']))
	   {
		   if(($_POST['password1']==$_POST['password2']) && (strlen($_POST['password1'])>7))
		   {
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$email=$_POST['email'];
			$password=$_POST['password1'];
			$phone=$_POST['phone'];
			$detail=$_POST['detail'];
			$city=$_POST['city'];
			$state=$_POST['state'];
			$zip=$_POST['zip'];
		   update_customer($id, $fname, $lname, $email, $password, $phone, $detail, $city, $state, $zip);
		   unset($_SESSION['user']);
		   $customer=get_customer($id);
		   $_SESSION['user']=$customer;
		   if($result)
		   {
			   echo"Account Updated;";
		   }
	   }
	   else {echo"Both Password must match and must be More than 7 characters ";}
	   }
	   else{echo "All fields must be filled";}
?>
<form action="" method="post">
<table>
<tr>
<th>First Name</th>
<td colspan="4"><input type="text" name="fname" value="<?php echo $fname?>" class="input"></td>
</tr>
<tr>
<th>Last Name</th>
<td colspan="4"><input type="text" name="lname" value="<?php echo $lname?>" class="input"></td>
</tr>
<tr>
<th>Email</th>
<td colspan="4"><input type="email" name="email" value="<?php echo $email;?>" class="input"></td>
</tr>
<tr>
<th>Password</th>
<td colspan="4"><input type="password" name="password1" value="<?php echo $password;?>" class="input"></td>
</tr>
<tr>
<th>Re-Type</th>
<td colspan="4"><input type="password" name="password2" value="<?php echo $password;?>" class="input"></td>
</tr>
<tr>
<th>PHONE</th>
<td colspan="4"><input type="text" name="phone" value="<?php echo $phone;?>" class="input"></td>
</tr>
<tr>
<th>ADDRESS</th>
<td><input type="text" name="detail" value="<?php echo $address_detail;?>" class="input"></td>
</tr>
<tr><th>CITY</th>
<td><input type="text" name="city" value="<?php echo $city;?>" class="input"></td>
</tr><tr><th>PROVINCE</th>
<td><input type="text" name="state" value="<?php echo $state;?>" class="input"></td>
</tr><tr><th>ZIP</th>
<td><input type="text" name="zip" value="<?php echo $zip;?>" class="input"></td>
</tr>
<tr style="background-color:black;">
<td colspan="5">
<input type="submit" value="Edit" style="" class="submit2"></tr>
</table>
</div>
<?php if($result)
{
	echo"<h3>Account Updated</h3>";
}?>
</div>





<footer>
<p><span id="footer">COPYRIGHT &copy; <?php echo date('Y'); ?>, PATRIOT'S CLUB</span></p> 
</footer>
</div>
</body>
</html>             
			                                                                    