<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Post as ModelsPost;
use App\Models\Tag;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
        //return view('posts.index')->with('posts', Post::all()->simplePaginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('category', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest  $request)
    {
        //dd($request->all());
        //tải ảnh lên
        $image = $request->image->store('posts');
        //tạo bài viết
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'url_image' => $request->url_image,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        //gửi tin nhắn
        session()->flash('success','Tạo bài viết thành công.');
        //chuyển hướng người dùng
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // dd($post->tags->pluck('id')->toArray());
        return view('posts.create')->with('post',$post)->with('category', Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content', 'url_image', 'category']);
        //Kiểm tra hình ảnh mới
        if ($request->hasFile('image')){
            //upload
            $image = $request->image->store('posts');
            //Xóa ảnh cũ
            $post->deleteImage();
            //Storage::delete($post->$image);
            $data['image'] = $image;
        }
        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }        
        if($request->category)
        {
            $post->tags()->sync($request->category);
        }

        //Cập nhật nội dung
        $post->update($data);
        //Thông báo
        session()->flash('success', 'Cập nhật thành công.');
        //chuyển hướng người dùng
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()){
            $post->deleteImage();
            //Storage::delete($post->image);
            $post->forceDelete();
        }else{
            $post->delete();
        }

        session()->flash('success','Đã xóa bài viết.');

        return redirect(route('posts.index'));
    }

    /**
     * Hiển thị danh sách các bài viết được lưu trữ.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed(){
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts',$trashed);
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        session()->flash('success','Đã khôi phục bài viết.');
        return redirect()->back();
    }
}
