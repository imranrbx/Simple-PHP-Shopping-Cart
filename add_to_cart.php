<?php
require "vendor/autoload.php";
require('db.php');
use voku\Cart\Cart;
use voku\Cart\Storage\Session;
use voku\Cart\Identifier\Cookie;
$cart = new Cart(new Session, new Cookie);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
		
		.rwd-table {
		margin: 1em 0;
		min-width: 300px;
		}
		.rwd-table tr {
		border-top: 1px solid #ddd;
		border-bottom: 1px solid #ddd;
		}
		.rwd-table th {
		display: none;
		}
		.rwd-table td {
		display: block;
		}
		.rwd-table td:first-child {
		padding-top: .5em;
		}
		.rwd-table td:last-child {
		padding-bottom: .5em;
		}
		.rwd-table td:before {
		content: attr(data-th) " : ";
		color: "#000";
		font-weight: bold;
		width: 6.5em;
		display: inline-block;
		}
		@media (min-width: 513px) {
		.rwd-table td:before {
		display: none;
		}
		}
		.rwd-table th, .rwd-table td {
		text-align: left;
		}
		@media (min-width: 513px) {
		.rwd-table th, .rwd-table td {
		display: table-cell;
		padding: .25em .5em;
		}
		.rwd-table th:first-child, .rwd-table td:first-child {
		padding-left: 0;
		}
		.rwd-table th:last-child, .rwd-table td:last-child {
		padding-right: 0;
		}
		}
		.rwd-table {
		border-radius: .4em;
		overflow: hidden;
		}
		.rwd-table tr {
		border-color: #46637f;
		}
		.rwd-table th, .rwd-table td {
		margin: .5em 1em;
		}
		@media (min-width: 513px) {
		.rwd-table th, .rwd-table td {
		padding: 1em !important;
		}
		}
		</style>
	</head>
	<body>
		<?php
		if (isset($_REQUEST['id'])):
			$result = $conn->query('select * from products where id = ' . $_REQUEST['id']);

			if($result->num_rows > 0){
				
			while($row = $result->fetch_object()){
				 if(isset($_POST['update'])):
						$cart->update($_POST['identifier'], 'quantity', $_POST['quantity']);
				else:
					$cart->insert(array(
							'id' => $row->id,
							'name' => $row->name,
							'quantity' => (isset($_REQUEST['quantity'])) ? $_REQUEST['quantity'] : 1,
							'price' => $row->price,
						));
				endif;
				}
			
			}else{
				echo "No Products Found";
				die();
			}
		endif;
		?>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<table class="table table-condensed rwd-table">
						<?php
						
						if(! empty($cart)): ?>
						<tr>
							<th>Name</th>
							<th>Price</th>
							<th>Total</th>
							<th>Qty</th>
							<th>Action</th>
						</tr>
						<?php foreach($cart->contents() as $val){
							$total = $val->price * $val->quantity;
							echo "<tr>";
									echo "<td data-th='Name'> {$val->name} </td><td data-th='Name'> {$val->price} </td>";
									echo "<td data-th='Price'> {$total} </td>";
											echo "<td data-th='Qty'><form method='POST' clas='form-horizontal'><input type='hidden' name='id' value='{$val->id}' /><input type='hidden' name='identifier' value='{$val->identifier}' /><input type='number' class='form-control' value='{$val->quantity}' name='quantity' /><input class='form-control btn btn-info' type='submit' value='Update' name='update' /></form></td>";
									echo "<td data-th='Action'> <a onclick='return delete_item()' class='btn btn-danger' href='delete_cart.php?id={$val->id}'>Delete</a></td>";
											echo "</tr>";
						}
						echo "<tr colspan='4'><td></td><td></td><td></td><td style='text-align:right;' ><strong>Total Amount: </strong></td><td>{$cart->total()}</td></tr>";
						else:
							unset($_SESSION['cart']);
							echo "<tr><td>Your Cart is Empty.</td></tr>";
						endif;
						?>
						<tr>
							<td colspan="5" data-th=''><a href="index.php">Back to Shop</a></td>
						</tr>
						
					</table>
					
				</div>
			</div>
		</div>
		
		<script src="https://code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="text/javascript">
				function delete_item(){
					var item = confirm("Are You Sure You want to Remove this item?");
					if(item){
						return true;
					}else{
						return false;
					}
				}
		</script>
	</body>
</html>