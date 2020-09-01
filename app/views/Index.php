<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Книжная полка</title>
</head>
<body>
<h1>BOOKOCEAN</h1>
<div class="main_page">
    <div>
        <p><a href="">Список авторов</a></p>
        <p><a href="">Список книг</a></p>
        <div class="ref_list">
            <ul>
                <?php
                for ($row = 0; $row<count($args); $row++)
                {
                    foreach ($args as $item)
                    {
                       echo '<li><a href="">'.$item[$row]['Name'].'</li>';
                    }
                }?>
            </ul>
        </div>
    </div>
</div>
</body>
</html>