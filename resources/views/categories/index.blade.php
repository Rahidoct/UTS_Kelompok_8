@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow m-3">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Kategori Produk</h6>
            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">+ Tambah Kategori</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col" style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-primary me-2">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection