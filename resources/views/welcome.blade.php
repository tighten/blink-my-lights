<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blink Matt's Light</title>

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

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
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
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Blink Matt's Light
                </div>

                @if (session()->has('message'))
                <p>{{ session('message') }}</p>
                @endif

                <div class="links">
                    <form method="post" action="/flash">
                        {{ csrf_field() }}

                        <select name="color">
                            <option value="kelvin:8000">Cold White</option>
                            <option value="kelvin:5000">Cool White</option>
                            <option value="kelvin:3500">Medium White</option>
                            <option value="kelvin:3000">Warm White</option>
                            <option value="kelvin:2700">Hot White</option>
                            <option value="red">Red</option>
                            <option value="orange">Orange</option>
                            <option value="yellow">Yellow</option>
                            <option value="green">Green</option>
                            <option value="cyan">Cyan</option>
                            <option value="blue">Blue</option>
                            <option value="purple">Purple</option>
                            <option value="pink">Pink</option>
                            <option value="red saturation:0.5">Pastel Red</option>
                            <option value="orange saturation:0.5">Pastel Orange</option>
                            <option value="yellow saturation:0.5">Pastel Yellow</option>
                            <option value="green saturation:0.5">Pastel Green</option>
                            <option value="cyan saturation:0.5">Pastel Cyan</option>
                            <option value="blue saturation:0.5">Pastel Blue</option>
                            <option value="purple saturation:0.5">Pastel Purple</option>
                            <option value="pink saturation:0.5">Pastel Pink</option>
                            <option value="random">Random</option>
                            <option value="blue">Blue</option>
                        </select>

                        <input type="submit" value="Queue my blink">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
