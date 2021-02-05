@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit Category
    </div>
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" 
                value="{{ old('name', $category->name) }}"
                name="name"
                id="name">
                @error('name')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection