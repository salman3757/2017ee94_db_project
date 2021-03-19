
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PATRIOT'S CLUB</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/favicon.png">
<style>
<?php 
session_start();
$id=$_SESSION['user']['id'];

include('admin.css'); ?>
</style>

<?php 
	require_once('../../php/database.php');
    require_once('../../php/database_funcs.php');
?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
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
    <li><a href="index.php" >Home</a></li>
    <li><a href="">Our Story</a><li>
	<li><a href="products.php">Armory</a></li>
	<li><a href="">Hours & Location</a><li>
	<?php if(!isset($_SESSION['user'])){
		echo "<li><a href=\"../../account/index.php?action=view_signin\">Sign In</a></li>
		      <li><a href=\"../../account/index.php?action=view_signup\">Sign Up</a></li>";
		}
		elseif($admin)
		{
			echo "<li><a href=\"../index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"../index.php?action=signout\">Sign Out</a></li>";
		}
		else{
			echo "<li><a href=\"../index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"../index.php?action=signout\">Sign Out</a></li>";
		} ?>
	<li><a href="../../cart/">Cart</a></li>
	<li><a href="../index.php">Seller Area</a></li>
  </ul>
  </div>
  <div id="search"><form action="../../search.php" method="post">
	     <input placeholder="Search Weapons..." id="search_bar" type="text" name="search_products">
		 <input id="search_btn" type="submit" value="Search"></form>
	</div>
</nav> 
 

<div id="logo"> 
    <a href="../../index.php"><img id="img" src="../../images/logo.jpg" alt="logo" height="200px" width="auto"></a>
  </div> 
<h1><!--cont.--></h1>
</header>
<div id="p2" class="strip">
<p><span class="p1">Category Manager</span></p>
</div>

<div id="c2">
<div id="signn">

<div id="flex">
<div class="fitem">
<h3>ADD CATEGORY </h3>
<form action="categories.php" method="post">
<label>Category Name</label>
<input type="hidden" name="action" value="add">
<input type="text" name="name"><br>
<input type="submit" value="ADD" class="btn"><br>
</form>
<br><p style="font-family: Century Gothic;
color: black; background-color:orange; margin-top:100px;">
scroll down to see Output Display.</p>
</div>
<div class="fitem">
<h3>SHOW ALL CATEGORIES</h3>
<form action="categories.php" method="post">
<input type="hidden" name="action" value="show">
<input type="submit" value="SHOW" class="btn">
</form>
<br><br><p style="font-family: Century Gothic;
color: black; background-color:orange; margin-top:115px;">
scroll down to see Results Display.</p>
</div>
<div class="fitem">
<h3>UPDATE CATEGORY Name</h3>
<form action="categories.php" method="post">
<input type="hidden" name="action" value="update">
<label>Enter ID of Category to be UPDATED</label>
<select name="id">
<?php
$categories=get_categories();
foreach ($categories as $category) 
{
	echo "<option value=\"".$category['id']."\">".$category['id']."</option>";
}
?>
</select><br><label>ENTER " NEW NAME " for the Category</label>
<input type="text" name="name"><br>
<input type="submit" value="UPDATE" class="btn">
</form>
<p style="margin-top:50px; color:black; font-family:Century Gothic; background-color:orange;">
For a reference to id of a category, see show all categories section.
</p><p style="font-family: Century Gothic;
color: black; background-color:orange">
scroll down to see Output Display.</p>
</div>

<div class="fitem">
<h3>UPDATE CATEGORY - ID</h3>
<form action="categories.php" method="post">
<input type="hidden" name="action" value="update_id">
<label>Select Category</label>
<select name="name">
<?php
$categories=get_categories();
foreach ($categories as $category) 
{
	echo "<option value=\"".$category['name']."\">".$category['name']."</option>";
}
?>
</select><br><br><br>
<label>Enter "NEW ID" of Category</label>
<input type="text" name="id"><br><input type="submit" value="UPDATE" class="btn">
</form>
<p style="margin-top:58px;color:black; font-family:Century Gothic; background-color:orange;">
For a reference to id of a category, see show all categories section.
</p><p style="font-family: Century Gothic;
color: black; background-color:orange">
scroll down to see Output Display.</p>
</div>

<div class="fitem">
<h3>DELETE CATEGORY</h3>
<form action="categories.php" method="post">
<input type="hidden" name="action" value="delete">
<label>Select Category</label>
<select name="id">
<?php
$categories=get_categories();
foreach ($categories as $category) 
{
	echo "<option value=\"".$category['id']."\">".$category['name']."</option>";
}
?>
</select><br><br><br><br>
<input type="submit" value="DELETE" class="btn">
</form>
</div>
<div class="fitem">
<br><h3>RESULT DISPLAY</h3>
</div>
<?php 

if(isset($_POST['action']) && isset($_SESSION['user']) && $admin==TRUE)
{
	$action=$_POST['action'];
	
	
	switch ($action)
	{
		case 'add':
		if (isset($_POST['name']))
		{
			$name=$_POST['name'];
			$id=add_category($name);
			echo "<p class=\"result2\" style=\"background-color:orange;\">Category Added with ID = $id </p>";
		}
		else
		{
			echo "ERROR - Name Cannot be empty";
		}
		break;
		
		case 'show':
		$categories=get_categories();
		$count=1;
		?> <?php
		foreach ($categories as $category)
		{
			echo "<div class=\"result2\" style=\"background-color:orange;\" >-------$count-----<br><br><br>";
			echo "ID   => $category[id] <br>";
			echo "NAME => $category[name]<br></div>";
			$count+=1;
		}?>
		<?php
		break;
		
		case 'update':
		if (isset($_POST['id']) && isset($_POST['name']))
		{
			$id=$_POST['id'];
			$name=$_POST['name'];
			$result=update_category($id, $name);
			if($result)
			{
				echo "<p class=\"result2\"> Category Updated </p>";
			}
		}
		else
		{
			echo "<p class=\"result2\"> All Fields must be Filled </p>";
		}
		break;
		
		case 'delete':
		if (isset($_POST['id']))
		{
			$id=$_POST['id'];
			$result= delete_category($id);
			if($result)
			{
				echo "<p class=\"result2\"> Category Deleted </p>";
			}
		}
		else if($_POST['action'] == 'delete' && !isset($_POST['id']))
		{
			echo "<p class=\"result2\"> ID Must be Set </p>";
		}
		break;
		
		case 'update_id':
		if(isset($_POST['id']) && isset($_POST['name']))
		{
			$id=$_POST['id'];
			$name=$_POST['name'];
			$flag=0;
			$categories=get_categories();
			$result=update_category_id($id, $name);
			if($result)
			{
				      echo "<p class=\"result2\"> Category ID Updated </p>"; 
		    }
			
			else
			{
				echo "<p class=\"result2\">Cannot Update ID</p>";
			}
		}
	}
}
 else
	{
		?> <div style="background-color:wheat;color:red; margin:20px; padding:20px; border:6px solid black;"><h1 style="margin-left:0px; color=red; background-color=silver; font-family:Century Gothic;">You
		Must Be logged in as Administrator to use Admin Panel.</h1>
		</div><?php
	}
?>

</div>
</div>
</div>


<footer>
<p><span id="footer">COPYRIGHT &copy; <?php echo date('Y'); ?>, PATRIOT'S CLUB</span></p> 
</footer>
</div>
</body>
</html>