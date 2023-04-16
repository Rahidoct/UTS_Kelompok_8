@extends('layouts.app')

@section('content')
  <div class="container">
    <h2 class="mb-4">Transaction History</h2>
    <div class="table-responsive">
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
              <td>
                @if ($transaction->status == 'pending')
                  <span class="badge bg-warning text-dark">{{ ucfirst($transaction->status) }}</span>
                @elseif ($transaction->status == 'processed')
                  <span class="badge bg-info text-white">{{ ucfirst($transaction->status) }}</span>
                @elseif ($transaction->status == 'completed')
                  <span class="badge bg-success">{{ ucfirst($transaction->status) }}</span>
                @elseif ($transaction->status == 'cancelled')
                  <span class="badge bg-danger">{{ ucfirst($transaction->status) }}</span>
                @endif
              </td>
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
@endsection

@push('styles')
  <style>
    .table {
      color: #212529;
    }
    .table-responsive {
      overflow-x: auto;
    }
    .table thead th {
      border-top: none;
      font-weight: 600;
      background-color: #fff;
      position: sticky;
      top: 0;
      z-index: 1;
    }
    .table tbody tr:hover {
      background-color: #f5f5f5;
    }
    .badge {
      font-size: 0.8rem;
      font-weight: 500;
      padding: 0.5rem 0.6rem;
      text-transform: uppercase;
      letter-spacing: 0.05rem;
    }
    .badge.bg-warning {
      color: #fff;
    }
    .badge.bg-info {
      color: #fff;
    }
  </style>
@endpush
