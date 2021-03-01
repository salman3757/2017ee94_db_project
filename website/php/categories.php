
<?php
include('database.php');
include('database_funcs.php');
 ?>

<html>
<head>
<title>CATEGORY MANAGER
</title>
<style>
<?php
include('admin.css');
 ?>
 </style>
</head>

<body>



<div id="flex">
<div class="fitem">
<h3>ADD CATEGORY </h3>
<form action="categories.php" method="post">
<label>Category Name</label>
<input type="hidden" name="action" value="add">
<input type="text" name="name"><br>
<input type="submit" value="ADD"><br>
</form>
</div>
<div class="fitem">
<h3>SHOW ALL CATEGORIES</h3>
<form action="categories.php" method="post">
<input type="hidden" name="action" value="show">
<input type="submit" value="SHOW">
</form>
</div>
<div class="fitem">
<h3>UPDATE CATEGORY</h3>
<form action="categories.php" method="post">
<input type="hidden" name="action" value="update">
<label>Enter ID of Category to be UPDATED</label>
<input type="text" name="id"><br>
<label>ENTER " NEW NAME " for the Category</label>
<input type="text" name="name"><br>
<input type="submit" value="UPDATE">
</form>
</div>

<div class="fitem">
<h3>UPDATE CATEGORY - ID</h3>
<form action="categories.php" method="post">
<input type="hidden" name="action" value="update_id">
<label>Enter NEW ID of Category</label>
<input type="text" name="id"><br>
<label>ENTER name the Category</label>
<input type="text" name="name"><br>
<input type="submit" value="UPDATE">
</form>
</div>

<div class="fitem">
<h3>DELETE CATEGORY</h3>
<form action="categories.php" method="post">
<input type="hidden" name="action" value="delete">
<label>Enter ID of the Category to be DELETED</label>
<input type="text" name="id"><br>
<input type="submit" value="DELETE">
</form>
</div>
<div class="fitem">
<br><h3>RESULT DISPLAY</h3>
</div>
<?php 

if(isset($_POST['action']))
{
	$action=$_POST['action'];
	
	
	switch ($action)
	{
		case 'add':
		if (isset($_POST['name']))
		{
			$name=$_POST['name'];
			$id=add_category($name);
			echo "Category Added with ID = $id ";
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
			echo "<div class=\"fitem\">-----------$count-----------<br><br><br>";
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
				echo "Category Updated";
			}
		}
		else
		{
			echo "All fields must be filled";
		}
		break;
		
		case 'delete':
		if (isset($_POST['id']))
		{
			$id=$_POST['id'];
			$result= delete_category($id);
			if($result)
			{
				echo "Category Deleted";
			}
		}
		else if($_POST['action'] == 'delete' && !isset($_POST['id']))
		{
			echo "ID must be set";
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
				      echo "Category ID updated"; 
		    }
			
			else
			{
				echo "CANNOT UPDATE ID.";
			}
		}
	}
}
?>

</div>

</body>

</html>