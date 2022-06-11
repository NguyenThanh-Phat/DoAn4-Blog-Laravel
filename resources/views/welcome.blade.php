@extends('layouts.blog')

@section('title')
    Karen blog
@endsection


@section('header')
<header class="header-classic">
    <nav class="navbar navbar-expand-lg">
        <!-- header bottom -->
        <div class="header-bottom  w-100">
            
            <div class="container-xl">
                <div class="d-flex align-items-center">
                    <div class="collapse navbar-collapse flex-grow-1">
                        <!-- menus -->
                        <ul class="navbar-nav">
							<div class="col-md-4 col-xs-12">
								<!-- site logo -->
								<a class="navbar-brand" href="{{ route('welcome') }}"><img src="{{ asset('images/logo.svg') }}" alt="logo" /></a> 
							</div>
                            <li class="nav-item dropdown active">
                                <a class="nav-link " href="{{ route('welcome') }}">Home</a>
                            </li>							
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#">Danh mục</a>
                                <ul class="dropdown-menu">
                                    @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="#">
                                        {{ $category->name }}
                                    </a>
                                    <span>
                                        {{-- {{ $tags->posts->count() }}  --}}
                                    </span>
                                </li>
                                    @endforeach                               
                                </ul>
                            </li>
							<li class="nav-item dropdown  ">
                                <a class="nav-link dropdown-toggle" href="#">Tài khoản</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('users.edit-profile') }}">Đăng nhập</a></li>
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Đăng ký</a></li></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!-- header buttons -->
                    <div class="header-buttons">
                        <button class="search icon-button">
                            <i class="icon-magnifier"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </nav>

</header>
@endsection

@section('content')
	<!-- section main content -->
	<section class="main-content">
		<div class="container-xl">

			<div class="row gy-4">

				<div class="col-lg-8">

					@forelse ($posts as $post)
                    <!-- post -->
					<div class="post post-classic rounded bordered">
						<div class="thumb top-rounded">
							<a href="#" class="category-badge lg position-absolute">
                                {{ $post->category->name }}
                            </a>
							<span class="post-format">
								<i class="icon-picture"></i>
							</span>
							<a href="{{ route('blog.show', $post->id) }}">
								<div class="inner">
									<img src="{{ $post->url_image }}" alt="post-title" />
								</div>
							</a>
						</div>
						<div class="details">
							<ul class="meta list-inline mb-0">
								<li class="list-inline-item"><a href="#"><img src="{{ Gravatar::get($post->user->email) }}" class="author" alt="author"/>{{ $post->user->name }}</a></li>
								<li class="list-inline-item">29 March 2021</li>
								<li class="list-inline-item"><i class="icon-bubble"></i> (0)</li>
							</ul>
							<h5 class="post-title mb-3 mt-3">
                                <a href="{{ route('blog.show', $post->id) }}">
                                    {{ $post->title }}
                                </a>
                            </h5>
							<p class="excerpt mb-0">
                                {{ $post->description }}
                            </p>
						</div>
						<div class="post-bottom clearfix d-flex align-items-center">
							<div class="social-share me-auto">
								<button class="toggle-button icon-share"></button>
								<ul class="icons list-unstyled list-inline mb-0">
									<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
									<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
									<li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
									<li class="list-inline-item"><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
									<li class="list-inline-item"><a href="#"><i class="far fa-envelope"></i></a></li>
								</ul>
							</div>
							<div class="float-end d-none d-md-block">
								<a href="{{ route('blog.show', $post->id) }}" class="more-link">Đọc tiếp<i class="icon-arrow-right"></i></a>
							</div>
							<div class="more-button d-block d-md-none float-end">
								<a href="{{ route('blog.show', $post->id) }}"><span class="icon-options"></span></a>
							</div>
						</div>
					</div>
                    @empty
						<p class="text-center">
							Không có kết quả cho <strong>{{ request()->query('search') }}</strong>
						</p>
					@endforelse

					<nav>
						<ul class="pagination justify-content-center">
							{{ $posts->appends(['search' => request()->query('search') ])->links() }}
						</ul>
					</nav>



				</div>
				<div class="col-lg-4">

					<!-- sidebar -->
					<div class="sidebar">

						<!-- widget categories -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Danh mục bài viết</h3>
								<img src="images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<ul class="list">
									@foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('blog.category', $category->id) }}">
                                                {{ $category->name }}
                                            </a>
                                            <span>
                                                {{-- {{ $tags->posts->count() }}  --}}
                                            </span>
                                        </li>
                                    @endforeach
								</ul>
							</div>
							
						</div>

                        <!-- widget tags -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Nhãn bài đăng</h3>
								<img src="images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								@foreach ($tags as $tag)
                                <a href="{{ route('blog.tag', $tag->id) }}" class="tag">#{{ $tag->name }}</a>
                                @endforeach
							</div>		
						</div>				

					</div>

				</div>

			</div>

		</div>
	</section>

	
<!-- search popup area -->
@include('partials.sidebar')
@endsection
