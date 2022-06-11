@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">Người dùng</div>
        <div class="card-body">
            @if ($users->count() > 0)
            <table class="table">
                <thead>
                    <th>Ảnh</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{-- {{ Gravatar::src($user->email) }} --}}
                                <img src="{{ Gravatar::get($user->email) }}" alt="">
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                @if (!$user->isAdmin())
                                    <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Chỉ định quản trị viên</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
            @else
            <h3 class="text-center">Chưa có người dùng ;<</h3>
            @endif
        </div>
    </div>
@endsection