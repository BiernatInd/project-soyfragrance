<!DOCTYPE html>
<html>
<head>
    <title>Nowa wiadomość ze strony internetowej:</title>
</head>
<body>
    <p>Nowa wiadomość z formularza kontaktowego:</p>
    <p><strong>Imię:</strong> {{ $data['name'] }}</p>
    <p><strong>E-mail:</strong> {{ $data['email'] }}</p>
    <p><strong>Temat:</strong> {{ $data['subject'] }}</p>
    <p><strong>Wiadomość:</strong> {{ $data['message'] }}</p>
</body>
</html>
