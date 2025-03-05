@extends('layouts.default')

@section('title','Home page')

@section('content')
<div class="container my-5">
    <h1>Posts</h1>
    @forelse($posts as $post)
    <div class="mb-3">
        <h3>{{$post->title}}</h3>
        Author:{{$post->user->name}}
        @can('update-post',$post)
        |<a href="{{route('posts.edit',$post)}}" class="text-primary">Edit</a>
        @endcan
        @can('delete-post')
        <form action="{{route('posts.destroy',$post)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-link link-danger">Delete</button>
        </form>
        @endcan
    </div>
    @empty
    <p>No posts...</p>
    @endforelse
</div>
@endsection