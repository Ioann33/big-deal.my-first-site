<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cryptocurrencies News</title>
        <link rel="stylesheet" href="/css/style.css">
        <style>
            main{
                background-color: #ffffff;
            }
             header p{
                 margin-left: 1100px;
             }
        </style>
    </head>
    <body>
        <div id="page">
            <header>
                <h1>
                    <a href="index.php">
                        <img src="/images/logo.png" alt="logo">
                    </a>
                </h1>
                <p><a href="/auth.php">Log in</a></p>
            </header>
            <main style="min-height: 600px ">
                <div id="tsb" style="height: 200px">

                </div>
                <div id="content">
                    <?php include_once 'includes'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'pages'.DIRECTORY_SEPARATOR.$page.'.php'?>
                </div>
            </main>
            <footer>
                <a href="#">Ioann web-studio</a> 2022 &copy;
            </footer>
        </div>
    </body>
</html>