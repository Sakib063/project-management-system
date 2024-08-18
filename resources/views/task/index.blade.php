<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
</head>
<body>
    <h1 class="text-danger">TASK</h1>
    <div class="d-flex justify-content-center">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Project</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->name}}</td>
                        <td>
                            @if($task->status==1)
                                <p class="text-danger">UNASSIGNED</p>
                            @elseif($task->status==2)
                                <p class="test-warning">Pending</p>
                            @else
                                <p class="text-success">Successfull</p>
                            @endif
                        </td>
                        <td>{{$task->due_date}}</td>
                        <td>{{$task?->user?->name}}</td>
                        <td>{{$task?->project?->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</body>
</html>