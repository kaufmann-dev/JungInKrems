<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jung in Krems</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 16px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #f9e225;
            border-radius: 5px;
            box-shadow: 0 0 10px #f0e68c;
        }

        h1 {
            margin-top: 1rem;
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 2px 2px #666;
        }

        p {
            margin-bottom: 1rem;
            text-align: justify;
        }

        .button {
            background-color: #f9e225;
            border: none;
            color: #333;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #333;
            color: #f9e225;
        }

        .regards {
            font-style: italic;
            margin-top: 3rem;
            text-align: right;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">

        <h1>Bestätige deine Email-Adresse</h1>

        <p>Hallo {{ $name }},</p>

        <p>Vielen Dank für die Erstellung eines Kontos auf Jung in Krems!</p>

        <p><a href="{{ $verification_link }}" class="button">Email Adresse bestätigen</a></p>

        <p>Wenn du kein Konto erstellt hast oder deine E-Mail Adresse nicht verifizieren möchtest, sind keine weiteren Maßnahmen erforderlich.</p>

        <p class="regards">Mit freundlichen Grüßen,<br>Jung in Krems</p>

    </div>
</body>
</html>