@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-end mb-3 mt-3">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
    </div>

    <div class="card">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
        @if($posts->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Action</th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                    <td>
                            <img src="{{asset('storage/'.$post->image)}}" alt="Post Image" width="128">
                        </td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->excerpt}}</td>
                        <td>{{$post->category->name}}</td>
                        <td>{{$post->author->name}}</td>
                        <td>
                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="" class="btn btn-danger btn-sm"
                            onclick="displayModalForm({{ $post }})"
                            data-toggle="modal"
                            data-target="#deleteModal">Trash</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h5>Nothing to show!</h5>
            @endif
        </div>
        <div class="card-footer">
        {{$posts->links()}}
        </div>
    </div>
    
    <!---Delete Modal--->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                </div>
            <div class="modal-body">
            <form action="" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you wanna delete</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Delete Post
                    </button>
                </div>
            </form>
            </div>
            </div>
    </div>
@endsection

@section('page-level-scripts')
    <script>
        function displayModalForm($post){
            var url = '/trash/'+$post.id;
            $("#deleteForm").attr('action', url);
        }
    </script>
@endsection