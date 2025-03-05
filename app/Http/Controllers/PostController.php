<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::with('user')->orderBy('id','desc')->get();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('create-post');
        if(Gate::denies('create-post')){
            abort(403);
        }
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create-post')){
            abort(403);
        }
        $validated=$request->validate([
            'title'=>['required','max:255']
        ]);
        Post::create([
            'title'=>$validated['title'],
            'user_id'=>auth()->user()->id
        ]);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post=Post::findOrFail($id);
        if(Gate::denies('update-post',$post)){
            abort(403);
        }
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post=Post::findOrFail($id);
        if(!Gate::allows('update-post',$post)){
            abort(403);
        }
        $validated=$request->validate([
            'title'=>['required','max:255']
        ]);
        $post->update($validated);
        return redirect()->route('home')->with('success','Success update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // if(Gate::denies('delete-post')){
        //     abort(403);
        // }
        $post=Post::findOrFail($id);
        $post->delete();
        return redirect()->route('home')->with('success','Success delete');
    }
}
