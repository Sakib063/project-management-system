<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test create</title>
</head>
<body>
    <form action="{{route('task.store')}}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name"><br><br>
        <label for="date">Due Date</label>
        <input type="date" id="date"><br><br>
        <label for="status">Status</label>
        <input type="number" id="status"><br><br>
        <label for="project_id">Project</label>
        <input type="number" id="project_id"><br><br>
        <label for="user_id">User</label>
        <input type="number" id="user_id"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>