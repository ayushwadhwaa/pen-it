@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Add Tag
        </div>

        <div class="card-body">
            <form action="{{ route('tags.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text"
                    value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" id="name">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Add Tag</button>
                </div>
            </form>
        </div>
    </div>
@endsection