<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $posts = Post::where('title', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $posts = Post::latest()->paginate($perPage);
        }

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $requestData = $request->all();

        Post::create($requestData);

        return redirect('admin/posts')->with('flash_message', 'Post added!');
    }

    public function show(Post $post): View
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $requestData = $request->all();

        $post->update($requestData);

        return redirect('admin/posts')->with('flash_message', 'Post updated!');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect('admin/posts')->with('flash_message', 'Post deleted!');
    }
}
