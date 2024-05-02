<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    @foreach ($posts as $post)
        <div class="post">
            <h2>{{$post->title}}</h2>
            <p>{{$post->content}}</p>
            <p>Views: {{$post->views}}</p>
            <p>Posted by: {{$post->user->name}}</p>
            <a href="{{ route('posts.show', $post) }}"> Read more</a>
        </div>
    @endforeach
@endsection