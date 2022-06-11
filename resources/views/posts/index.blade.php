@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success ">Thêm bài đăng</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Bài đăng</div>
        <div class="card-body">
            @if ($posts->count() > 0)
            <table class="table">
                <thead>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                {{-- {{ $post->image }} --}}
                                {{-- <img src="{{ Storage::path($post->image) }}" width="120px" height="60px" alt=""> --}}
                                <img src="{{ $post->url_image }}" width="120px" height="60px" alt="">
                            </td>
                            <td>
                                {{ $post->title }}
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $post->category->id) }}">
                                    {{ $post->category->name }}
                                </a>
                            </td>
                            @if (!$post->trashed())
                            <td>
                                <a href="{{ route('posts.edit', $post->id ) }}" class="btn btn-info btn-sm">Chỉnh sửa</a>
                            </td>
                            @else
                            <td>
                                <form action="{{ route('restore-posts', $post->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info btn-sm">Khôi phục</button>
                                </form>
                            </td>
                            @endif
                            <td>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        {{ $post->trashed() ? 'Xóa bỏ' : 'Lưu trữ' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 

            phân trang
            {{-- {{ $posts->links() }} --}}
            @else
            <h3 class="text-center">Không có bài đăng nào</h3>
            @endif
        </div>
    </div>
@endsection

{{-- @section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deletePostForm')
            form.acction = '/posts/' + id
            $('#deleteModal').modal('show')
        }
    </script>
@endsection --}}