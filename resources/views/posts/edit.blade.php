@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Edit Post
        </div>

        <div class="card-body">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text"
                    value="{{ old('title', $post->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                    name="title" id="title">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea
                    class="form-control @error('excerpt') is-invalid @enderror"
                    name="excerpt" id="excerpt" rows="4">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" 
                    name="content"
                    value="{{old('content', $post->content)}}">
                    <trix-editor input="content" ></trix-editor>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Category</label>
                    <select
                    class="form-control select2"
                    name="category_id" id="category_id">
                    <option value="-1" disabled selected>Select...</option>
                    @foreach($categories as $category)
                        <option value="{{old($category->id, $post->category_id)}}">{{$category->name}}</option>
                    @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Tags</label>
                    <select name="tags[]" id="tags" class="form-control select2" multiple>
                    
                        @foreach($tags as $tag)
                    <option value="{{$tag->id}}"
                    {{ old('tags') ? (in_array($tag->id, old('tags')) ? 'selected' : ''):  ($post->hasTag($tag->id) ? 'selected' : '')}}>{{$tag->name}}
                    </option>
                        @endforeach
                    </select>

                    @error('tags')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="published_at">Published at</label>
                    <input type="text"
                    value="{{ old('published_at', $post->published_at)}}"
                    class="form-control @error('published_at') is-invalid @enderror"
                    name="published_at" id="published_at">
                    @error('published_at')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                <img src="{{asset('storage/'.$post->image)}}" alt="img" width="100%">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    
                    <input type="file"
                    value="{{ old('image', $post->image)}}"
                    class="form-control @error('image') is-invalid @enderror"
                    name="image" id="image">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Update Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('page-level-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#published_at", {
            enableTime: true
        });
    </script>
@endsection
@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

