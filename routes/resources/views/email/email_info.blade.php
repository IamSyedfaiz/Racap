<html>

<head>
    <title>RACAP</title>
</head>

<body>
    <h1>User Login ID</h1>
    <p>User Name: {{ @$name }}</p>
    <p>User ID: {{ @$email }}</p>
    {!! isset($password) ? '<p>Password: ' . $password . '</p>' : null !!}
    <p>User Type: {{ @$type }}</p>
    <p><a target="_blank" href="{{ $link }}">Click here to login</a></p>
    <p>{{ @$msg }}</p>
</body>

</html>
