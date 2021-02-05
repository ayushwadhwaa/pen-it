@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit Tag
    </div>
    <div class="card-body">
        <form action="{{ route('tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" 
                value="{{ old('name', $tag->name) }}"
                name="name"
                id="name">
                @error('name')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning">
                    Update Tag
                </button>
            </div>
        </form>
    </div>
</div>
@endsection