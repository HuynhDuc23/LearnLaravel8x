<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculator</title>
</head>

<body>
    <h1>This is Calculator</h1>
    <form action="" method="post">
        {{ csrf_field() }}
        <input type="number" name="a" step="0.1" size="50"
            placeholder="Enter number a"value="{{ $a }}">
        <br>
        <input type="number" name="b" step="0.1" size="50" placeholder="Enter number b"
            value="{{ $b }}">
        <br>
        Result : {{ $result }}
        <button name="cal" value="+">Tinh Tong</button>
        <button name="cal" value="-">Tinh Tru</button>
        <button name="cal" value="*">Tinh Nhan</button>
        <button name="cal" value="/">Tinh Chia</button>

    </form>
</body>

</html>
