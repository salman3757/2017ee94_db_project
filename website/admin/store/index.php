<?php 
session_start();
?>

<?php 
	require_once('../../php/database.php');
    require_once('../../php/admin_db.php');
    require_once('../../php/database_funcs.php');

if(isset($_POST['action']))
{
	$action=$_POST['action'];
}
else
{
	$action=$_GET['action'];
}

switch($action)
{
	case 'create':
	$administrator_id=$_POST['administrator_id'];
	$name=$_POST['name'];
	$result=create_store($name,$administrator_id);
    require('store_view.php'); 
	break;
	
	case'show':
	$name=$_GET['name'];	
	include('store_view.php');
	break;
	
	case'show_create_form':
	include('create_store.php');
	break;
	
	case'manage_products':
	include('products.php');
	break;
	
	case'manage_categories':
	include('categories.php');
	break;
}

?>