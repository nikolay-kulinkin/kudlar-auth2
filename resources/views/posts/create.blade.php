@extends('layouts.default')

@section('title','Post page')

@section('content')
<div class="container my-5">
    <h1>New post</h1>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="{{route('posts.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Post title">
                </div>
                <button type="submit" class="btn btn-warning">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection