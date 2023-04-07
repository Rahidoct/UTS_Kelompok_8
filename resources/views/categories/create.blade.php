@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow m-3">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">Tambah Kategori</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <a href="{{ route('categories.index') }}" class="btn btn-danger mt-3">Batal</a>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection