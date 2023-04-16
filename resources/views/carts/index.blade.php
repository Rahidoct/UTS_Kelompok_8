@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4">Shopping Cart</h1>
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
                                    <div class="input-group">
                                        <button type="submit" class="input-group-text btn btn-outline-danger" id="minus-btn"><i class="fas fa-minus"></i></button>
                                        <input type="number" name="quantity" value="{{ $cart->quantity }}" class="form-control-sm text-center" min="1" max="{{ $cart->product->stock }}">
                                        <button type="submit" class="input-group-text btn btn-outline-success" id="plus-btn"><i class="fas fa-plus"></i></button>
                                    </div>
                                </form>                                
                            </td>                            
                                                        
                            <td>Rp. {{ $cart->product->price }}</td>
                            <td>Rp. {{ $cart->product->price * $cart->quantity }}</td>
                            <td>
                                <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
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
            <div class="col-sm-6 text-end">
                <h2>Total: Rp. {{ $carts->sum(function($cart) { return $cart->product->price * $cart->quantity; }) }},-</h2>
                <form method="POST" action="{{ route('checkout') }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Checkout</button>
                </form>
            </div>
        </div>
    </div>
@endsection
