@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success ">Thêm danh mục</a>
    </div>
    
    <div class="card card-default">
        <div class="card-header">Danh mục bài viết</div>
        <div class="card-body">
            @if ($categories->count() > 0)
            <table class="table">
                <thead>
                    <th>Tên danh mục</th>
                    <th>Số lượng bài viết</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                {{ $category->posts->count() }}
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">
                                    Sửa
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})">Xoá</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="POST" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deleteModalLabel">Xoá danh mục</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p class="text-center text-bold">
                                  Bạn có chắc muốn xoá danh mục này?
                              </p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Không, quay trở lại</button>
                              <button type="submit" class="btn btn-danger">Có, xoá</button>
                            </div>
                          </div>
                    </form>
                </div>
              </div>
            @else
              <h3 class="text-center">Chưa có danh mục</h3>
            @endif
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteCategoryForm')
            form.acction = '/categories/' + id
            $('#deleteModal').modal('show')
        }
    </script>
@endsection