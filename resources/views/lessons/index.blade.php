<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>InProgress Lessons</h1>
    @foreach($inProgress as $lesson)
        <h3><a href="/{{ $lesson->id }}">{{ $lesson->title }}</a></h3>
    @endforeach

    <h1>All Lessons</h1>
    @foreach($lessons as $lesson)
        <h3><a href="/{{ $lesson->id }}">{{ $lesson->title }}</a></h3>
    @endforeach
</body>
</html>