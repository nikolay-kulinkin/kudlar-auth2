@extends('layouts.default')

@section('title','Home page')

@section('content')
<div class="container my-5">
    <h1>Posts</h1>
    @forelse($posts as $post)
    <div class="mb-3">
        <h3>{{$post->title}}</h3>
        Author:{{$post->user->name}}
        |<a href="#" class="text-primary">Edit</a>
        |<a href="#" class="text-danger">Delete</a>
    </div>
    @empty
    <p>No posts...</p>
    @endforelse
</div>
@endsection