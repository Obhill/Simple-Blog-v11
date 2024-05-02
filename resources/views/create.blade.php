<!-- resources/views/posts/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Create a Post</h1>

    @can('create-post')
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="content">Content:</label>
            <textarea name="content" id="content" cols="30" rows="10" required></textarea>

            <button type="submit">Create Post</button>
        </form>
    @else
        <p>You do not have permissions to create posts</p>
    @endcan
@endsection