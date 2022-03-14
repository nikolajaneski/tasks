<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
</head>
<body>
    <form action="/task/{{ $task->id }}" method="POST">
        @csrf
        @method('PUT')
        Task name <br />
        <input type="text" name="name" value="{{ $task->name }}"> <br />
        Task description <br />
        <textarea name="description" id="" cols="30" rows="10">{{ $task->description }}</textarea>
        <input type="hidden" name="token" value="secret-key">
        <input type="submit" name="submit">
    </form>
</body>
</html>