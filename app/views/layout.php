<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <title><?php echo $title?></title>
    <style>
        li {
            padding: 0; /* Убираем поля */
            margin-left: 20px; /* Отступ слева */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="http://localhost/test_project">BOOK_shelf</a>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Список книг</a>
            <li class="nav-item dropdown">
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="http://localhost/test_project/authors">По автору</a>
                    <a class="dropdown-item" href="http://localhost/test_project">По названию</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<?php echo $content; ?>
<script src="../../vendor/components/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>