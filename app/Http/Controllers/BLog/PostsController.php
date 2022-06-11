<?php

namespace App\Http\Controllers\BLog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show')
        ->with('post', $post)
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('posts', Post::all());
    }

    public function category(Category $category)
    {
        // $search = request()->query('search');

        // if ($search) {
        //     $post = $category->posts()->where('tile', 'LIKE', "%{$search}%" )->simplePaginate(2);
        // } else {
        //     $post = $category->posts()->simplePaginate(2);
        // }

        return view('blog.category')
        ->with('category', $category)
        ->with('posts',     $category->posts()->searched()->simplePaginate(2))
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
    }

    public function tag(Tag $tag)
    {
        return view('blog.tag')
        ->with('tag', $tag)
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('posts', $tag->posts()->searched()->simplePaginate(2));
    }
}
