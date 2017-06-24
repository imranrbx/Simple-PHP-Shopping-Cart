<?php
require('db.php');
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
			if(isset($_GET['id'])):
				$result = $conn->query("SELECT * FROM products WHERE id = ". $_GET['id']);
				$row = $result->fetch_object();
				$add_new = true;
				if(isset($_SESSION['cart']) AND count($_SESSION['cart']) > 0){
					foreach($_SESSION['cart'] as $key => $val){
						if($val->id == $_GET['id']){
							$_SESSION['cart'][$key]->quantity++;
							$add_new = false;
							break;
						}
					}
				}
				if($add_new == true){
					$row->quantity = 1;
					$_SESSION['cart'][] = $row;
				}
			endif;
		?>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<table class="table table-condensed rwd-table">
						<?php
						$cart = $_SESSION['cart'];
						if(! empty($cart)): ?>
						<tr>
							<th>Name</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Action</th>
						</tr>
						<?php foreach($cart as $key=>$val){
							echo "<tr>";
								echo "<td data-th='Name'> {$val->name} </td>";
								echo "<td data-th='Price'> {$val->price} </td>";
										echo "<td data-th='Qty'><div class='form-group'><input class='form-control' type='number' value= '{$val->quantity}' name='qty'/><a class='btn btn-primary form-control' href='update_cart.php?id={$val->id}'>Update</a></div> </td>";
								echo "<td data-th='Action'> <a class='btn btn-danger' href='delete_cart.php?id={$val->id}'>Delete</a></td>";
											echo "</tr>";
						}
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
	</body>
</html>