<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <style>
        /* Base styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Outfit', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f8fafc;
            padding-bottom: 40px;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-top: 40px;
        }

        .header {
            background-color: #ffffff;
            padding: 40px 20px;
            text-align: center;
        }

        .logo {
            max-width: 180px;
            height: auto;
        }

        .content {
            padding: 0 40px 40px;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            padding: 40px 20px;
            color: #64748b;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            background-color: #f29004;
            color: #ffffff !important;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 30px 0;
        }

        h1 {
            color: #05299E;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
            font-weight: 700;
        }

        h2 {
            color: #05299E;
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 15px;
            font-weight: 600;
        }

        p {
            margin-bottom: 15px;
        }

        .highlight-box {
            background-color: #f1f5f9;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #f29004;
            margin-bottom: 20px;
        }

        .label {
            font-weight: 600;
            color: #64748b;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
            display: block;
        }

        .value {
            font-size: 16px;
            color: #1e293b;
            margin-bottom: 12px;
        }

        @media screen and (max-width: 600px) {
            .content {
                padding: 0 20px 30px;
            }

            .main {
                margin-top: 20px;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>
    <center class="wrapper">
        <table class="main" role="presentation">
            <tr>
                <td class="header">
                    <img src="{{ $message->embed(public_path('images/logo-fond-blanc.png')) }}" alt="{{ config('app.name') }}"
                        class="logo">
                </td>
            </tr>
            <tr>
                <td class="content">
                    @yield('content')
                </td>
            </tr>
        </table>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
        </div>
    </center>
</body>

</html>
