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
            header p a{
                background-color: #ff8082;
            }
        </style>
    </head>
    <body>
        <div id="page">
            <header>
                <h1>
                    <a href="userauth.php">
                        <img src="/images/logo.png" alt="logo">
                    </a>
                </h1>
                <nav>
                    <div>
                        <ul>
                            <li><a href="<?=url('convert')?>">Конвертор</a></li>
                            <li><a href="#">Прогнозы</a></li>
                            <li><a href="#">СriptoIoann</a></li>
                        </ul>
                    </div>
                </nav>
                <p><a href="/index.php">Log out</a></p>
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