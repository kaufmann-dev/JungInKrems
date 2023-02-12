<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Verified</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->ACCOUNT_ID }}</td>
                        <td>{{ $account->NAME }}</td>
                        <td>{{ $account->EMAIL }}</td>
                        <td>{{ $account->IS_EMAIL_VERIFIED }}</td>
                        <td>{{ $account->ACCOUNT_TYPE }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
