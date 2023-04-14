<!-- Header halaman -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Transactions') }}</div>
                    <div class="card-body">
                        @if(count($transactions) > 0)
                            <ul>
                                @foreach($transactions as $transaction)
                                    <li>
                                        <a href="{{ route('invoice', $transaction->id) }}">Invoice {{ $transaction->id }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Tidak ada transaksi yang tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
