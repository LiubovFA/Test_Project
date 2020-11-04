<br>
<br>
<br>
<?php

//если ищем, то отображаем форму поиска
$search = preg_match("/search/", $type);

if ($search)
{
    echo "<form name=\"search-form\"  method=\"post\" action=\"http://localhost/test_project/searchbook\">
                <input id=\"search_input\" type=\"text\" class=\"search-input\" name=\"request\" style='width: 400px' placeholder=\"Ищу ...\"/><br>
                <input type=\"radio\" class=\"search-radio\" name=\"searchBy\" value=\"book\" checked/> По названию<br>                
                <input type=\"radio\" class=\"search-radio\" name=\"searchBy\" value=\"author\"/> По автору<br>
                <button id=\"search_button\" type=\"submit\" name=\"submit\">Найти</button>
            </form><br>";
}

//работаем с данными в случаем получения результатов поиска и в случае вывода списков авторов и книг
if (!empty($data)) {
    //если строка - значит там сообщение
    if (is_string($data) && $search) {
        echo "<p style='margin-left: 20px'>$data</p>";
    }

    //если массив - значит там есть данные из БД для отображения
    if (is_array($data)) {
        //вывод строки "Вы искали:"
        if ($search)
            echo "<p style='margin-left: 20px'>Вы искали:</p>";

        //вывод списка авторов
        if ($type == "authors")
        {
            echo "<div class='list'>";

            foreach ($data as $row)
            {
                $id = $row['Id_author'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/authors/$id\">";
                echo $row['Full_name'];
                echo "</a></li>";
            }
            echo "</div>";
        }
        //вывод результатов поиска книг по автору
        else if ($type == "search_author")
        {
            $last_key = array_key_last($data);

            for ($i = 0; $i <= $last_key; $i++)
            {
                if ($i == 0)
                {
                    echo "<p><li>" . $data[$i]['Full_name'] . ":<div class='list'><ul>
                            <li><a href='\"http://localhost/test_project/books/" . $data[$i]['Id_book'] . "\"'>" . $data[$i]['Name'] . "</a></li>";
                }
                else
                {
                    if ($data[$i]['Id_author'] != $data[$i - 1]['Id_author'])
                    {
                        echo "</ul></div></li></p>";
                        echo "<p><li>" . $data[$i]['Full_name'] . ":<div class='list'>><ul>
                                <li><a href='\"http://localhost/test_project/books/" . $data[$i]['Id_book'] . "\"'>" . $data[$i]['Name'] . "</a>></li>";
                    }
                    else
                    {
                        echo "<li><a href=\"http://localhost/test_project/books/" . $data[$i]['Id_book'] . "\">" . $data[$i]['Name'] . "</a></li>";
                    }
                }
            }
            echo "</ul></div></li></p>";
        }
        //вывод списка книг или книг конкретного автору, или результатов поиска книги по названию
        else if ($type == "books" || ($type == "search_book") || ($type == "authorbooks"))
        {
            if ($type == "authorbooks")
            {
                echo "<label id='author_name'>" . $data[0]['Full_name'] . ":</label><br>";

                echo "<div class='list'>";

                foreach ($data as $row) {
                    $id = $row['Id_book'];
                    echo "<li>";
                    echo "<a href=\"http://localhost/test_project/books/$id\">";
                    echo '<q>' . $row['Name'] . '</q>';

                    if ($type != "authorbooks")
                        echo " - " . $row['Full_name'];
                    echo "</a></li>";
                }
                echo "</div>";
            }
            else
            {
                $last_key = array_key_last($data);

                echo "<div class='list'>";
                for ($i = 0; $i <= $last_key; $i++)
                {
                    if ($i == 0)
                    {
                        $id = $data[$i]['Id_book'];
                        echo "<li>";
                        echo "<a href=\"http://localhost/test_project/books/$id\">";
                        echo '<q>' . $data[$i]['Name'] . '</q>';
                        echo " - " . $data[$i]['Full_name'];
                    }
                    else
                    {
                        if ($data[$i]['Name'] == $data[$i - 1]['Name'])
                        {
                            echo ", " . $data[$i]['Full_name'];
                        }
                        else
                        {
                            echo "</a></li>";
                            $id = $data[$i]['Id_book'];
                            echo "<li>";
                            echo "<a href=\"http://localhost/test_project/books/$id\">";
                            echo '<q>' . $data[$i]['Name'] . '</q>';
                            echo " - " . $data[$i]['Full_name'];
                        }
                    }
                }
                echo "</a></li></div>";
            }
        }
    }
}

?>
