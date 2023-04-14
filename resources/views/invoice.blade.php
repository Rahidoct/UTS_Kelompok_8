<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<style>
		body {
			background-color: #f8f9fa;
		}

		.invoice-box {
			background-color: #ffffff;
			border: 1px solid #dddddd;
			padding: 40px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.invoice-box h1 {
			font-size: 36px;
			font-weight: 700;
			color: #343a40;
			margin-bottom: 20px;
		}

		.invoice-box hr {
			border-top: 2px solid #343a40;
			margin-bottom: 30px;
		}

		.invoice-box table {
			width: 100%;
			border-collapse: collapse;
		}

		.invoice-box table th {
			font-size: 16px;
			font-weight: 700;
			color: #343a40;
			background-color: #f8f9fa;
			border-bottom: 2px solid #dddddd;
			padding: 10px;
			text-align: left;
		}

		.invoice-box table td {
			font-size: 14px;
			font-weight: 400;
			color: #343a40;
			border-bottom: 1px solid #dddddd;
			padding: 10px;
		}

		.invoice-box table td strong {
			font-weight: 700;
		}

		.invoice-box table td:first-child {
			font-weight: 700;
		}

		.invoice-box table td:last-child {
			text-align: right;
		}

		.invoice-box table tr:last-child td {
			border-bottom: none;
		}

		.invoice-box .total {
			margin-top: 30px;
			margin-bottom: 30px;
			text-align: right;
		}

		.invoice-box .total strong {
			font-size: 20px;
			color: #343a40;
			font-weight: 700;
		}

		@media print {
			.invoice-box {
				border: none;
				box-shadow: none;
			}
		}
	</style>
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="invoice-box">
					<h1>Invoice</h1>
					<hr>
					<table>
						<thead>
							<tr>
								<th>Date</th>
								<th>Status</th>
								<th>Product</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							@foreach($transaction_details as $transaction)
								<tr>
									<td>{{ $transaction->transaction->date }}</td>
									<td>{{ $transaction->transaction->status }}</td>
									<td>{{ $transaction->name }}</td>
									<td>{{ $transaction->quantity }}</td>
									<td>{{ $transaction->price }}</td>
									<td>{{ $transaction->quantity * $transaction->price }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<div class="total">
						<strong>Total:</strong> {{ $transaction->total_price }}
					</div>
				</div>
			</div>
		</div>
	</div>
		
</body>
</html>
