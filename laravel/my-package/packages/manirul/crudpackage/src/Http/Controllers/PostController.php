<?php

namespace Manirul\CrudPackage\Http\Controllers;

use Illuminate\Routing\Controller;
use Manirul\CrudPackage\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('crudpackage::index', compact('posts'));
    }

    public function create()
    {
        return view('crudpackage::create');
    }

    public function store()
    {
        Post::create([
            'title' => request('title'),
            'body' => request('body'),
        ]);

        return redirect('/posts');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('crudpackage::edit', compact('post'));
    }

    public function update($id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'title' => request('title'),
            'body' => request('body'),
        ]);

        return redirect('/posts');
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return redirect('/posts');
    }
}