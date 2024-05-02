@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p>Views: {{ $post->views }}</p>
    <p>Posted by: {{ $post->user->name }}</p>

    <h2>Add a comment</h2>
    <form action="{{ route('comments.store', $post) }}" method="POST">
        @csrf
        <label for="content">Comment:</label>
        <textarea name="content" id="content" cols="30" rows="5" required></textarea>
        <button type="submit">Add Comment</button>
    </form>

    <h2>Comments</h2>
    @foreach ($post->comments as $comment)
        <div class="comment" id="comment_{{ $comment->id }}">
            <p>{{ $comment->content }}</p>
            <p>Comment by: <a href="{{ route('users.comments', $comment->user) }}">{{ $comment->user->name }}</a></p>
            <p>Likes: <span id="likesCount_{{ $comment->id }}">{{ $comment->likes->count() }}</span></p>
            <form action="{{ route('comments.like', $comment) }}" method="POST" id="likeForm_{{ $comment->id }}">
                @csrf
                <button type="submit" id="likeButton_{{ $comment->id }}">Like</button>
            </form>
            @can('edit-comment', $comment)
                <button type="button" class="edit-button" onclick="showEditForm('{{ $comment->id }}')">Edit Comment</button>
                <div id="editForm_{{ $comment->id }}" style="display:none;">
                    <form action="{{ route('comments.update', ['post' => $post, 'comment' => $comment]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="edit-content-{{ $comment->id }}">Edit Comment:</label>
                        <textarea name="content" id="edit-content-{{ $comment->id }}" cols="30" rows="5" required>{{ $comment->content }}</textarea>
                        <button type="submit" class="update-button">Update Comment</button>
                    </form>
                </div>
            @else
                <button type="button" class="edit-button" disabled>Edit Comment</button>
            @endcan

            @can('delete-comment', $comment)
                <form action="{{ route('comments.destroy', ['post' => $post, 'comment' => $comment]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete Comment</button>
                </form>
            @else
                <button type="button" class="delete-button" disabled>Delete Comment</button>
            @endcan
        </div>
    @endforeach
@endsection

@push('scripts')
<script>
    function showEditForm(commentId) {
        var form = document.getElementById('editForm_' + commentId);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endpush