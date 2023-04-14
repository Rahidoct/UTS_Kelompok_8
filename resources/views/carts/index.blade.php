<!-- resources/views/carts/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Shopping Cart</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        {{-- <th>Product Image</th> --}}
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            {{-- <td><img src="{{ asset('storage/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="img-thumbnail" width="100"></td> --}}
                            <td>{{ $cart->product->name }}</td>
                            <td>
                                <form action="{{ route('carts.update', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" max="{{ $cart->product->stock }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </td>
                            <td>{{ $cart->product->price }}</td>
                            <td>{{ $cart->product->price * $cart->quantity }}</td>
                            <td>
                                <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
            </div>
            <div class="col-sm-6 text-right">
                <h2>Total: {{ $carts->sum(function($cart) { return $cart->product->price * $cart->quantity; }) }}</h2>
                <a href="#" class="btn btn-success">Checkout</a>
            </div>
            {{-- <div class="col-md-6 text-right">
                <h2>Total: {{ $carts->sum(function($cart) { return $cart->product->price * $cart->quantity; }) }}</h2>
                <form method="POST" action="{{ route('checkout') }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Checkout</button>
                </form>
            </div> --}}
        </div>
    </div>
@endsection