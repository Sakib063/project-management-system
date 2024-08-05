<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Projects</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Projects</h1>
    <form id="project_form">
        <input type="hidden" id="project_id">
        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <ul id="projectList" class="list-group mt-3">
        @foreach($projects as $project)
            <li class="list-group-item" data-id="{{ $project->id }}">
                {{ $project->name }}
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

    $('#project_form').on('submit', function(e) {
        e.preventDefault();
        let project_id = $('#project_id').val();
        let name = $('#name').val();

        if (project_id) {
            $.ajax({
                url: '/projects/' + project_id,
                type: 'PUT',
                data: { name: name },
                success: function(project) {
                    $('#projectList').find(`[data-id="${project.id}"]`).html(`${project.name}
                        <button class="btn btn-sm btn-danger float-right deleteTask">Delete</button>
                        <button class="btn btn-sm btn-info float-right editTask mr-2">Edit</button>`);
                    $('#project_form')[0].reset();
                    $('#project_id').val('');
                }
            });
        } else {
            $.ajax({
                url: '/projects',
                type: 'POST',
                data: { name: name },
                success: function(project) {
                    $('#projectList').append(`<li class="list-group-item" data-id="${project.id}">${project.name}
                        <button class="btn btn-sm btn-danger float-right deleteTask">Delete</button>
                        <button class="btn btn-sm btn-info float-right editTask mr-2">Edit</button></li>`);
                    $('#project_form')[0].reset();
                }
            });
        }
    });

    $('#projectList').on('click', '.editTask', function() {
        let project_id = $(this).parent().data('id');
        let name = $(this).parent().text().trim();
        $('#project_id').val(project_id);
        $('#name').val(name);
    });

    $('#projectList').on('click', '.deleteTask', function() {
        let project_id = $(this).parent().data('id');
        $.ajax({
            url: '/projects/' + project_id,
            type: 'DELETE',
            success: function() {
                $(`#projectList`).find(`[data-id="${project_id}"]`).remove();
            }
        });
    });
});
</script>
</body>
</html>
