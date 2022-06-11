@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? 'Chỉnh sửa bài đăng' : 'Tạo bài đăng' }}
        </div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ isset($post) ? $post->title: '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">
                        {{ isset($post) ? $post->description: '' }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content: '' }}">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at: '' }}">
                </div>
                @if (isset($post))
                    <div class="form-group">
                        <img src="{{ asset($post->image) }}" alt="" style="width: 100%">
                    </div>
                @endif
                <div class="form-group md-2">
                    <label for="image">Ảnh bìa</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group md-2">
                    <label for="url_image">Liên kết hình ảnh</label>
                    <input type="text" class="form-control" name="url_image" id="url_image" value="{{ isset($post) ? $post->url_image: '' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="category">Danh mục</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($category as $category)
                        <option value="{{ $category->id }}"
                            @if (isset($post))
                                @if ($category->id === $post->category_id)
                                selected
                                @endif
                            @endif
                            >
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                @if ($tags->count() > 0)
                <div class="form-group">
                    <label for="tags">Nhãn</label>                   
                        <select name="tags[]" id="tags" class="form-control select2" multiple>
                            @foreach ($tags as $tag)
                                <option selected="selected" value="{{ $tag->id }}"
                                    @if (isset($post))
                                        @if ($post->hasTag($tag->id))
                                            selected
                                        @endif
                                    @endif
                                    >
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                </div>
                @endif
                <div class="form-group mb-2">
                    <button type="submit" class="btn btn-success ">
                        {{ isset($post) ? 'Cập nhật bài đăng' : 'Tạo bài đăng' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    flatpickr('#published_at',{
        enableTime: true,
        enableSeconds: true
    })


    // $(document).ready(function(){
    //     $(".form-control select2").select2();
    // })

    $(".form-control select2").select2({
    tags: true,
    tokenSeparators: [',', ' ']
    })
</script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" />
@endsection