
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
</style>
</head>

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
		echo "<li><a href=\"../account/?action=view_signin\">Sign In</a></li>
		      <li><a href=\"../account/?action=view_signup\">Sign Up</a></li>";
		}
		else{
			echo "<li><a href=\"../account/index.php?action=view_account\">".$_SESSION['user']['fname']."</a></li>
			      <li><a href=\"../account/?action=signout\">Sign Out</a></li>";
		} ?>
	<li><a href="cart/">Cart</a></li>
	<li><a href="">Seller Area</a></li>
 </ul>
  </div>
  <div id="search"><form action="search.php" method="post">
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
<p><span class="p1">C a r t</span></p>
</div>

<div id="c2">
<div id="sign">

<!-- ------------------ -->

    <h1>Your Cart</h1>
    <?php if (cart_product_count() == 0) : ?>
        <p>There are no products in your cart.</p>
    <?php else: ?>
        <p>To remove an item from your cart, change its quantity to 0.</p>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="update" />
            <table id="table">
            <tr id="cart_header">
                <th class="left">Item</th>
                <th class="right">Price</th>
                <th class="right">Quantity</th>
                <th class="right">Total</th>
            </tr>
            <?php foreach ($cart as $product_id => $item) : ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td class="right">
                    <?php echo sprintf('$%.2f', $item['price']); ?>
                </td>
                <td class="right">
                    <input type="text" size="3" class="right"
                           name="items[<?php echo $product_id; ?>]"
                           value="<?php echo $item['quantity']; ?>" />
                </td>
                <td class="right">
                    <?php echo sprintf('$%.2f', $item['price']); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr id="cart_footer" >
                <td colspan="3" class="right" ><b>Subtotal</b></td>
                <td class="right">
                    <?php echo sprintf('$%.2f', cart_subtotal()); ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="right">
                    <input type="submit" value="Update Cart" />
                </td>
            </tr>
            </table>
        </form>
        
    <?php endif; ?>

    <!-- if cart has items, display the Checkout link -->
    <?php if (cart_product_count() > 0) : ?>
        <p>
            Proceed to: <a href="../checkout">Checkout</a>
        </p>
    <?php endif; ?>



<!--
<table id="table">
<tr>
<th>Name</th>
<th>price</th>
<th>Quantity</th>
<th>Item Total</th>
</tr>
<tr>
<td ><form action="" method="post">
<input type="text" name="qty">
</td></tr>
<tr>
<th colspan="3">Total :</th>
<td>$ 0.00</td></tr>
<tr>
<div id="flex">
<td ><div class="btn2">
<a class="lnk" href="" >Empty Cart</a></div></td>
<td><div class="btn2"><a class="lnk" href="">Update Cart</a></div></td>
<td colspan="2"><input type="submit" class="btn" value="Proceed to Checkout"></td></div></tr>
</table>
</form>
-->

</div>
</div>





<footer>
<p><span id="footer">COPYRIGHT &copy; <?php echo date('Y'); ?>, PATRIOT'S CLUB</span></p> 
</footer>
</div>
</body>
</html>
