@extends('layouts.app')

@section('content')    
    <div class="card card-default">
        <div class="card-header">
            {{ isset($tag) ? 'Sửa nhãn' : 'Tạo nhãn' }}
        </div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
                @csrf
                @if (isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group mb-4">
                    <label for="name">Tên</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ isset($tag) ? $tag->name : '' }}">
                </div>
                <div class="form-group mb-2">
                    <button class="btn btn-success ">
                        {{ isset($tag) ? 'Cập nhật nhãn' : 'Thêm nhãn' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    
@endsection