@extends('layouts.blog')

@section('title')
    {{ $post->title }}
@endsection

@section('header')
<header class="header-default">
    <nav class="navbar navbar-expand-lg">
        <div class="container-xl">
            <!-- site logo -->
            <a class="navbar-brand" href="{{ route('welcome') }}"><img src="{{ asset('images/logo.svg') }}" alt="logo" /></a> 

            <div class="collapse navbar-collapse">
                <!-- menus -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item  active">
                        <a class="nav-link" href="/"> {{ $post->user->name }}</a>
                    </li>
                </ul>
            </div>

            <!-- header right section -->
            <div class="header-right">
                <!-- header buttons -->
                <div class="header-buttons">
                    <button class="search icon-button">
                        <i class="icon-magnifier"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>
@endsection

@section('content')
<section class="main-content mt-3">
    <div class="container-xl">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $post->category->name }} </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
            </ol>
        </nav>

        <div class="row gy-4">

            <div class="col-lg-8">
                <!-- post single -->
                <div class="post post-single">
                    <!-- post header -->
                    <div class="post-header">
                        <h1 class="title mt-0 mb-3">{{ $post->title }}</h1>
                        <ul class="meta list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="#"><img src="{{ Gravatar::get($post->user->email) }}" class="author" alt="author"/>
                                    {{ $post->user->name }}
                                </a>
                            </li>
                            <li class="list-inline-item"><a href="#">Mới nhất</a></li>
                            <li class="list-inline-item">{{ $post->published_at }}</li>
                        </ul>
                    </div>
                    <!-- featured image -->
                    <div class="featured-image">
                        <img src="{{ $post->url_image }}" alt="post-title" />
                    </div>
                    <!-- post content -->
                    <div class="post-content clearfix">
                        {!! $post->content !!}
                    </div>
                    <!-- post bottom section -->
                    <div class="post-bottom">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-6 col-12 text-center text-md-start">
                                <!-- tags -->
                                @foreach ($post->tags as $tag)
                                    <a href="{{ route('blog.tag', $tag->id) }}" class="tag">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                            <div class="col-md-6 col-12">
                                <!-- social icons -->
                                <ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="far fa-envelope"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="spacer" data-height="50"></div>

                <div class="about-author padding-30 rounded">
                    <div class="thumb">
                        <img src="{{ Gravatar::get($post->user->email) }}" alt="Katen Doe" />
                    </div>
                    <div class="details">
                        <h4 class="name"><a href="#">{{ $post->user->name }}</a></h4>
                        <p>{{ $post->user->about }}</p>
                        <!-- social icons -->
                        <ul class="social-icons list-unstyled list-inline mb-0">
                            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="spacer" data-height="50"></div>

                <div class="section-header">
                    <h3 class="section-title">Bình luận</h3>
                    <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
                </div>
                <!-- post comments -->
                <div class="comments bordered padding-30 rounded">
                    <div id="disqus_thread"></div>

                <script>
                    /**
                    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                    
                    var disqus_config = function () {
                        this.page.url = "{{ config('app.url') }}/blog/posts/{{ $post->id }}";  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = "{{ $post->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    
                    (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://laravel-blog-fj308xru2m.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    
                </div>
                
                
            </div>

            <div class="col-lg-4">

                <!-- sidebar -->
                <div class="sidebar">
                    <!-- widget categories -->
                    <div class="widget rounded">
                        <div class="widget-header text-center">
                            <h3 class="widget-title">Danh mục bài viết</h3>
                            <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
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
                            <h3 class="widget-title">Nhãn bài viết</h3>
                            <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
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
@endsection