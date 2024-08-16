<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show</title>
</head>

<body>
    <header>
        <div>
            <h1>This is header</h1>
        </div>
    </header>
    <main>
        <div>
            <h2>This is main</h2>
            <form action="{{ route('user.file') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" placeholder="Enter your name">
                <input type="submit" value="Submit">
            </form>
        </div>
    </main>
    <footer>
        <h2>this is footer</h2>
    </footer>
</body>

</html>
