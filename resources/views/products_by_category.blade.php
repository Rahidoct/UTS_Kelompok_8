@extends('layouts.app')

@section('content')
    <div class="container-fluid m-0">
        <div class="row">
            <div class="col-md-3 m-3">
                <div class="card">
                    <div class="card-header">{{ __('Categories') }}</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($categories as $kategori)
                                <li class="list-group-item">
                                    <a href="{{ url('/products/category/'.$kategori->id) }}">
                                        {{ $kategori->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 m-3">
                <div class="row">
                    <div class="h4 pb-2 mb-4 text-primary border-bottom border-primary">
                        {{ $category->name }}
                    </div>
                    <div class="card-body">
                        @if(count($products) > 0)
                            @foreach($products as $index => $product)
                                @if($index % 3 == 0)
                                    <div class="row">
                                @endif
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top" width="200px" height="200px"
                                        object-fit="cover">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">{{ $product->description }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="h6 mb-0">Rp. {{ number_format($product->price) }}</span>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button>
                                                    <a href="#" class="btn btn-sm btn-outline-success">Buy now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                @if(($index + 1) % 3 == 0 || $loop->last)
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p>There are no products available in this category.</p>
                        @endif
                    </div>
                </div>                
            </div>
        </div>
    </div>
@endsection