<!-- resources/views/transactions.blade.php -->

@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mb-4">Transaction History</h2>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Status</th>
              <th scope="col">Total</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transactions as $transaction)
              <tr>
                <td>{{ $transaction->date }}</td>
                <td>{{ $transaction->status }}</td>
                <td>Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
                <td>
                  <a href="{{ route('invoice', ['transaction_id' => $transaction->id]) }}" class="btn btn-sm btn-primary">View Invoice</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@push('styles')
  <style>
    table {
      width: 100%;
      margin-bottom: 1rem;
      color: #212529;
      border-collapse: collapse;
    }
    th,
    td {
      padding: 0.75rem;
      vertical-align: middle;
      border-top: 1px solid #dee2e6;
    }
    th {
      text-align: inherit;
      background-color: #f5f5f5;
    }
    tbody tr:hover {
      background-color: #f5f5f5;
    }
  </style>
@endpush