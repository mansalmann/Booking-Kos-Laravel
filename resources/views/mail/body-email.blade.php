<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Body Email</title>
    <link rel="stylesheet" href="{{ asset('assets/output.css') }}">
</head>
<body>
    <h2>Aduan dan Kritik</h2>
    <h3>email : {{ $email }}</h3>
    <br>
    <p style="white-space: pre-wrap;" class="text-30px">{{ $body }}</p>
</body>
</html>