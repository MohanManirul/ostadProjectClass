<?php

namespace Manirul\CrudPackage\Http\Controllers;

use Illuminate\Routing\Controller;
use Manirul\CrudPackage\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('crudpackage::posts.index', compact('posts'));
    }

    public function create()
    {
        return view('crudpackage::posts.create');
    }

    public function store(Request $request)
    {
        Post::create($request->only('title','body'));
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('crudpackage::posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->only('title','body'));
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index');
    }
}
