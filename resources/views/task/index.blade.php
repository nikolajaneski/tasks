<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <style>
        .completed {
            text-decoration-line: line-through;
        }
    </style>
</head>
<body>
    
    @forelse ($tasks as $task)
        <H4><strong @class(['completed' => $task->completed])>{{ $task->name }} <br /></strong></H4>
        <p @class(['completed' => $task->completed])>{{ $task->description }}</p>

        <ul>
            @foreach ($task->items as $item)
                <li>{{ $item->description }}</li>
            @endforeach
        </ul>

        <form action="/task/{{ $task->id }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete">
            <input type="hidden" name="token" value="secret-key">
        </form>
    @empty
        There is no tasks
    @endforelse

</body>
</html>