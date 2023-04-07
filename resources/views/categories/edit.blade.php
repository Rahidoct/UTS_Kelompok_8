@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow m-5">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">Edit Category</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
                </div>
                <a href="{{ route('categories.index') }}" class="btn btn-danger mt-3">Batal</a>
                <button type="submit" class="btn btn-primary mt-3">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection