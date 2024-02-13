@extends('layouts.main')

@section('content')
<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">@lang('main.blog')</h1>
        <h2>Weather Information for {{ $weatherData['name'] }}</h2>
        <p>Temperature: {{ $weatherData['main']['temp'] }} &#8451;</p>
        <p>Weather: {{ $weatherData['weather'][0]['description'] }}</p>
        <section class="featured-posts-section">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-md-4 fetured-post blog-post" data-aos="fade-up">
                    <div class="blog-post-thumbnail-wrapper">
                        <img src="{{ 'storage/' . $post->preview_image }}" alt="blog post">
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="blog-post-category">{{ $post->category->title }}</p>
                        @auth()
                        <form action="{{ route('post.like.store', $post->id) }}" method="post">
                            @csrf
                            <span>{{ $post->liked_users_count }}</span>
                            <button type="submit" class="border-0 bg-transparent">
                                        <i class="fa{{ auth()->user()->likedPosts->contains($post->id) ? 's' : 'r' }} fa-heart"></i>
                            </button>
                        </form>
                        @endauth
                        @guest()
                            <div>
                                <span>{{ $post->liked_users_count }}</span>
                                <i class="far fa-heart"></i>
                            </div>
                        @endguest
                    </div>
                    <a href="{{ route('post.show', $post->id) }}" class="blog-post-permalink">
                        <h6 class="blog-post-title">{{ $post->title }}</h6>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="mx-auto" style="margin-top: -100px; ">
                    {{ $posts->links() }}
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-md-8">
                <section>
                    <div class="row blog-post-row">
                        @foreach($randomPosts as $post)
                        <div class="col-md-6 blog-post" data-aos="fade-up">
                            <div class="blog-post-thumbnail-wrapper">
                                <img src="{{ 'storage/' . $post->preview_image }}" alt="blog post">
                            </div>
                            <p class="blog-post-category">{{ $post->category->title }}</p>
                            <a href="{{ route('post.show', $post->id) }}" class="blog-post-permalink">
                                <h6 class="blog-post-title">{{ $post->title }}</h6>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>
            <div class="col-md-4 sidebar" data-aos="fade-left">
                <div class="widget widget-post-list">
                    <h5 class="widget-title">Популярні пости</h5>
                    <ul class="post-list">
                        @foreach($likedPostes as $post)
                        <li class="post">
                            <a href="{{ route('post.show', $post->id) }}" class="post-permalink media">
                                <img src="{{ 'storage/' . $post->preview_image }}" alt="blog post">
                                <div class="media-body">
                                    <h6 class="post-title">{{ $post->title }}</h6>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="widget">
                    <h5 class="widget-title">Категорії</h5>
                    <section class="featured-posts-section">
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="{{ route('category.post.index', $category->id) }}">{{ $category->title }}</a></li>
                            @endforeach
                        </ul>
                    </section>
                </div>
            </div>
            <a href="{{ route('openai.index') }}" style="font-size: 30px; color: white">Погано розкрили тему? Є додаткові питання?</a>
        </div>
    </div>

</main>
@endsection
