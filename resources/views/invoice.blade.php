<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<style>
		.invoice-box {
			background-color: #ffffff;
			padding: 30px;
			border-radius: 10px;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
		}
		.total {
			margin-top: 20px;
			font-size: 24px;
			font-weight: bold;
			text-align: right;
		}
	</style>
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
		  <div class="col-md-8">
			<div class="invoice-box">
			  <h1 class="text-dark">Invoice</h1>
			  <p class="mb-3 text-end border-bottom"><strong>Date:</strong> {{ $transaction_details[0]->transaction->date }} <span class="vr"></span> <span><strong>Status:</strong> {{ $transaction_details[0]->transaction->status }}</span></p>
			  <table class="table">
				<thead>
				  <tr>
					<th scope="col">Product</th>
					<th scope="col">Quantity</th>
					<th scope="col">Price</th>
					<th scope="col">Subtotal</th>
				  </tr>
				</thead>
				<tbody>
				  @foreach($transaction_details as $transaction)
					<tr>
					  <td>{{ $transaction->product->name }}</td>
					  <td>{{ $transaction->quantity }}</td>
					  <td>Rp. {{ number_format($transaction->product->price, 0, ',', '.') }}</td>
					  <td>Rp. {{ number_format($transaction->quantity * $transaction->product->price, 0, ',', '.') }}</td>
					</tr>
				  @endforeach
				</tbody>
			  </table>
			  <div class="total">
				<?php
				  $total = 0;
				  foreach($transaction_details as $transaction) {
					$subtotal = $transaction->quantity * $transaction->product->price;
					$total += $subtotal;
				  }
				  echo '<strong>Total :</strong> Rp. '.number_format($total, 0, ',', '.');
				?>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	  
	<script>
		window.onload = function() {
			window.print();
			//window.location.href = "{{ route('beranda') }}";
		}
	</script>
</body>
</html>