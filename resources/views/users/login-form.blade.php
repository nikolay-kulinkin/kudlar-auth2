@extends('layouts.default')

@section('title','Login page')

@section('content')
<div class="container my-5">
    <h1>Login</h1>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="{{route('login.auth')}}" method="post">
                @csrf
               
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-warning">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection