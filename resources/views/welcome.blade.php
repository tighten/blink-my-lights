<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Blink {{ config('app.name') }} Lights</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 44px;
                margin-top: 3rem;
            }

            @media only screen and (min-width: 640px) {
                .title {
                    font-size: 84px;
                }
            }

            .footer {
                margin-top: 10em;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div id="app" class="position-ref">
            <div class="content">
                <div class="title m-b-md">
                    Blink {{ config('app.name') }} Light
                </div>

                <color-selector></color-selector>

                <div class="footer">
                    <a href="https://github.com/mattstauffer/flash-my-lights">Source</a>
                </div>
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
