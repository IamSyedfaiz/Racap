<html>

<head>
    <title>RACAP</title>
</head>

<body>
    <h1>User Login ID</h1>
    <p>User Name: {{ @$name }}</p>
    <p>User ID: {{ @$email }}</p>
    <p>Password: {{ @$password }}</p>
    <p><a target="_blank" href="{{ $link }}">Click here to login</a></p>
    <p>{{ @$msg }}</p>
</body>

</html>
