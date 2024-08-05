<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Comments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Comments</h1>
    <form id="comment_form">
        <input type="hidden" id="comment_id">
        <div class="form-group">
            <label for="content">Comment</label>
            <input type="text" id="content" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <ul id="commentList" class="list-group mt-3">
        @foreach($comments as $comment)
            <li class="list-group-item" data-id="{{ $comment->id }}">
                {{ $comment->content }}
                <button class="btn btn-sm btn-danger float-right deleteTask">Delete</button>
                <button class="btn btn-sm btn-info float-right editTask mr-2">Edit</button>
            </li>
        @endforeach
    </ul>
</div>

<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#comment_form').on('submit', function(e) {
        e.preventDefault();
        let comment_id = $('#comment_id').val();
        let content = $('#content').val();

        if (comment_id) {
            $.ajax({
                url: '/comments/' + comment_id,
                type: 'PUT',
                data: { content: content },
                success: function(comment) {
                    $('#commentList').find(`[data-id="${comment.id}"]`).html(`${comment.content}
                        <button class="btn btn-sm btn-danger float-right deleteTask">Delete</button>
                        <button class="btn btn-sm btn-info float-right editTask mr-2">Edit</button>`);
                    $('#comment_form')[0].reset();
                    $('#comment_id').val('');
                }
            });
        } else {
            $.ajax({
                url: '/comments',
                type: 'POST',
                data: { content: content },
                success: function(comment) {
                    $('#commentList').append(`<li class="list-group-item" data-id="${comment.id}">${comment.content}
                        <button class="btn btn-sm btn-danger float-right deleteTask">Delete</button>
                        <button class="btn btn-sm btn-info float-right editTask mr-2">Edit</button></li>`);
                    $('#comment_form')[0].reset();
                }
            });
        }
    });

    $('#commentList').on('click', '.editTask', function() {
        let comment_id = $(this).parent().data('id');
        let content = $(this).parent().text().trim();
        $('#comment_id').val(comment_id);
        $('#content').val(content);
    });

    $('#commentList').on('click', '.deleteTask', function() {
        let comment_id = $(this).parent().data('id');
        $.ajax({
            url: '/comments/' + comment_id,
            type: 'DELETE',
            success: function() {
                $(`#commentList`).find(`[data-id="${comment_id}"]`).remove();
            }
        });
    });
});
</script>
</body>
</html>
