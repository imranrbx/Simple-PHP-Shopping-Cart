<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Simple Add to Cart</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					
					<table class='table rwd-table'>
						
						<tr>
							<th > Product Name </th>
							<th > Product Details </th>
							<th > Product Price </th>
							<th > Product Quantity </th>
							<th > Product Date </th>
							<th > Action </th>
						</tr>
						
						<?php
						$result = $conn->query('select * from products');
						while($row = $result->fetch_object()){ ?>
						<tr>
							<td data-th="Product Name"> <?php echo $row->name; ?></td>
							<td data-th="Product Details"> <?php echo $row->description; ?></td>
							<td data-th="Product Price"> <?php echo $row->price; ?></td>
							<td data-th="Product Quantity"> <?php echo $row->quantity; ?></td>
							<td data-th="Product Date"> <?php echo $row->date_created; ?></td>
							<td data-th="Action"><a class="btn btn-primary" href="add_to_cart.php?id=<?php echo $row->id; ?>" >Add to Cart</a></td>
						</tr>
						<?php } ?>
						
					</table>
				</div>
			</div>
		</div>
	</body>
</html>