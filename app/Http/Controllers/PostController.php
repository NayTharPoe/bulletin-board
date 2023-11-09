<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('show_on_list', true)->latest()->filter(request(['search']))->paginate(6);
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => ['required', Rule::unique('posts', 'title')],
            'description' => 'required',
        ]);

        $formFields['user_id'] = auth()->id();

        Post::create($formFields);
        return redirect('/')->with('message', 'Post created successfully!');
    }

    public function show(Post $postId)
    {
        return view('posts.show', ['post' => $postId]);
    }

    public function edit(Post $postId)
    {
        return view('posts.edit', ['post' => $postId]);
    }

    public function update(Request $request, Post $postId)
    {
        $formFields = $request->validate([
            'title' => ['required', Rule::unique('posts', 'title')->ignore($postId->id)],
            'description' => 'required',
        ]);

        if($request->show_on_list == 'on') {
            $formFields['show_on_list'] = 1;
        } else {
            $formFields['show_on_list'] = 0;
        }

        $formFields['user_id'] = auth()->id();
        $postId->update($formFields);

        return redirect('/')->with('message', 'Post updated successfully!');
    }

    public function destroy(Post $postId)
    {
        $postId->delete();
        return redirect('/')->with('message', 'Post deleted successfully!');
    }

    public function manage()
    {
        $posts = [];

        $posts = auth()->check() ? auth()->user()->posts() : $posts;
        $posts = $posts->latest()->filter(request(['search']))->paginate(6);

        return view('posts.manage', compact('posts'));
    }

    public function showFileImport()
    {
        return view('posts.import-posts');
    }

    public function fileImport(Request $request)
    {
        $request->validate([
            'excel-file' => 'required|mimes:xlsx,csv'
        ]);
        $import = new PostsImport();
        $import->import($request->file('excel-file'));

        if($import->failures()->isNotEmpty()) {
            return redirect('posts-import')->with('error-message', 'Title, Description or Show On List is missing in your csv file.');
        } elseif($import->errors()->count() !== 0) {
            return redirect('/')->with('error-message', $import->errors()->count() . ' data duplicated');
        }

        return redirect('/')->with('message', 'Posts Imported successfully!');
    }

    public function fileExport()
    {
        $currentPath = session('path');
        $search = session('search');

        $query = $currentPath === 'manage' && auth()->check()
        ? auth()->user()->posts()
        : Post::where('show_on_list', true);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $filteredPosts = $query->latest()->get();

        return Excel::download(new PostsExport($filteredPosts), 'posts.xlsx');
    }
}
