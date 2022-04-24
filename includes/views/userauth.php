<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cryptocurrencies News</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.css">
        <style>
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
            <main>
                <div id="tsb">
                    <?php if (!empty($userName)):?>
                    <div>Добро пожаловать, <?=$userName?></div>
                    <?php endif;?>
                    <p>Инвестируй с умом!</p>
                    <img src="/images/coin.png" alt="coin">
                </div>
                <div id="content">
                    <div id="lsb">
                        <h2>Все о криптовалюте простым языком</h2>
                        <p style="font-weight: bold ">Основные вопросы о криптовалюте: кто придумал криптовалюту, почему криптовалюта растет и как лучше всего распоряжаться цифровыми деньгами</p>
                        <div class="img1"><img src="/images/content1.jpg" alt="image"></div>
                        <div id="article">
                            <h2>БЛОГ: Полезные статьи и обсуждение криптовалютных тем</h2>
                            <hr/>
                            <?php include_once 'includes'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'pages'.DIRECTORY_SEPARATOR.$page.'.php'?>
                        </div>
                    </div>
                    <div id="rsb">

                        <h2>АКТИВНО ТОРГУЕМЫЕ РЫНКИ</h2>
                        <img src="/images/grafic.png" alt="img1">
                        <h2>КРИПТОВАЛЮТНЫЕ БИРЖИ</h2>
                        <img src="/images/binance.jpg" alt="img2">
                        <h2>БЛОКЧЕЙН ТЕХНОЛОГИЯ</h2>
                        <img src="/images/img2.jpg" alt="img3">
                        <h2>NTF инвестиции</h2>
                        <img src="/images/ntf.jpg" alt="img4">
                    </div>
                </div>
            </main>
            <footer>
                <a href="#">Ioann web-studio</a> 2022 &copy;
            </footer>
        </div>
    </body>
</html>