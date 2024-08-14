<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h1>This is add form</h1>

    <form action="{{ route('categories.add') }}" method="post">
        @csrf
        <input type="text" name="categories" value="">
        <button type="submit">Add</button>
    </form>

</body>

</html>
