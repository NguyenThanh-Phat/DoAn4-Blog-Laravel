@extends('layouts.app')

@section('content')    
    <div class="card card-default">
        <div class="card-header">
            {{ isset($category) ? 'Edit Category' : 'Create Category' }}
        </div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                <div class="form-group mb-4">
                    <label for="name">Tên danh mục</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ isset($category) ? $category->name : '' }}">
                </div>
                <div class="form-group mb-2">
                    <button class="btn btn-success ">
                        {{ isset($category) ? 'Sửa danh mục' : 'Thêm danh mục' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    
@endsection