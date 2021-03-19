<?php session_start();?>


<?php 
	require_once('../php/database.php');
    require_once('../php/admin_db.php');
?>


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
#submit{
	height:2rem;
	width:10rem;
	text-align:center;
	font-size:1.3rem;
	text-transform:uppercase;
}
#c2{
	height:60em;
}

.submit2{
	height:2rem;
	width:10rem;
	text-align:center;
	font-size:1.3rem;
	text-transform:uppercase;
	border:4px dashed black; color:orange; padding:0.4em;
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
		echo "<li><a href=\"../account/?action=view_signin\">Sign In</a></li>
		      <li><a href=\"../account/?action=view_signup\">Sign Up</a></li>";
		}
		elseif($admin)
		{
			echo "<li><a href=\"index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"index.php?action=signout\">Sign Out</a></li>";
		}
		else{
			echo "<li><a href=\"../account/index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"../account/?action=signout\">Sign Out</a></li>";
		} ?>
	<li><a href="../cart/">Cart</a></li>
	<li><a href="index.php">Seller Area</a></li>
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
$id=$_SESSION['user']['id'];

if(isset($_POST['fname']) && isset($_POST['lname'])
	    && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2']))
	   {
		   if(($_POST['password1']==$_POST['password2']) && (strlen($_POST['password1'])>7))
		   {
			$fname=$_POST['fname'];
			$lname=$_POST['lname'];
			$email=$_POST['email'];
			$password=$_POST['password1'];
		    $result=update_admin($id, $fname, $lname, $email, $password);
		    unset($_SESSION['user']);
		    $admin=get_admin($id);
		    $_SESSION['user']=$admin;
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
<input type="hidden" name="action" value="edit">
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

<tr>
<td colspan="5">
<input type="submit" value="Edit"  class="submit2"></tr>
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
			                                                                    