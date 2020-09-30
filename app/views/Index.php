<br>
<br>
<br>
<?php

$search = preg_match("/search/", $type);

if ($search)
{
    echo "<form name=\"search-form\"  method=\"post\" action=\"http://localhost/test_project/searchbook\">
                <input type=\"text\" class=\"search-input\" name=\"request\" style='width: 400px' placeholder=\"Ищу ...\"/><br>
                <input type=\"radio\" class=\"search-radio\" name=\"searchBy\" value=\"book\" checked/> По названию<br>                
                <input type=\"radio\" class=\"search-radio\" name=\"searchBy\" value=\"author\"/> По автору<br>
                <button type=\"submit\" name=\"submit\">Найти</button>
            </form><br>";
}

if (!empty($data))
{
    //если строка - значит там сообщение
    if (is_string($data) && $search)
    {
        echo "<p style='margin-left: 20px'>$data</p>";
    }

    //если массив - значит там есть данные из БД для отображения
    if (is_array($data))
    {
        //вывод строки "Вы искали:"
        if ($search)
            echo "<p style='margin-left: 20px'>Вы искали:</p>";

        if ($type == "authors")
        {
            foreach ($data as $row) {
                $id = $row['Id_author'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/authors/$id\">";
                echo $row['Full_name'];
                echo "</a></p></li>";
            }
        }
        else if ($type == "search_author")
        {
            $last_key = array_key_last($data);

            for ($i = 0; $i <= $last_key; $i++)
            {
                if ($i == 0)
                {
                    echo "<li>" . $data[$i]['Full_name'] . ":<ul>
                            <li><a href='\"http://localhost/test_project/books/".$data[$i]['Id_book']."\"'>" . $data[$i]['Name'] . "</a></li>";
                }
                else {
                    if ($data[$i]['Id_author'] != $data[$i-1]['Id_author'])
                    {
                        echo "</ul></li>";
                        echo "<li>".$data[$i]['Full_name'].":<ul>
                                <li><a href='\"http://localhost/test_project/books/".$data[$i]['Id_book']."\"'>" . $data[$i]['Name'] . "</a>></li>";
                    }
                    else {
                        echo "<li><a href=\"http://localhost/test_project/books/".$data[$i]['Id_book']."\">" . $data[$i]['Name'] . "</a></li>";
                    }
                }
            }
            echo "</ul></li>";
        }
        else if ($type == "books" || ($type == "search_book") || ($type == "authorbooks"))
        {
            if ($type == "authorbooks")
                echo $data[0]['Full_name'].":<br>";

            foreach ($data as $row)
            {
                $id = $row['Id_book'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/books/$id\">";
                echo '<q>'.$row['Name'].'</q>';
                if ($type != "authorbooks")
                    echo " - ".$row['Full_name'];
                echo "</a></p></li>";
            }
        }
        /*if (key_exists('Name', $data[0]))
        {
            foreach ($data as $row)
            {
                $id = $row['Id_book'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/books/$id\">";
                echo '<q>'.$row['Name'].'</q>';

                if (!$author)
                    echo " - ".$row['Full_name'];

                echo "</a></p></li>";
            }
        }
        else
        {
            foreach ($data as $row) {
                $id = $row['Id_author'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/authors/$id\">";
                echo $row['Full_name'];
                echo "</a></p></li>";
            }
        }*/



        /*if ($author && !key_exists('Name', $data))
        {
            foreach ($data as $row) {
                $id = $row['Id_author'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/authors/$id\">";
                echo $row['Full_name'];
                echo "</a></p></li>";
            }
        }
        else
        {
            foreach ($data as $row)
            {
                $id = $row['Id_book'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/books/$id\">";
                echo '<q>'.$row['Name'].'</q> - '.$row['Full_name'];
                echo "</a></p></li>";
            }
        }

        if (key_exists('Name', $data[0]) || $type == "books")
        {
            if ($type == "authorBooks" || $type == "search")
                echo "<p style='margin-left: 20px'>".$data[0]['Full_name']."</p>";

            foreach ($data as $row)
            {
                $id = $row['Id_book'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/books/$id\">";
                echo '<q>'.$row['Name'].'</q> - '.$row['Full_name'];
                echo "</a></p></li>";
            }
        }
        else if (!key_exists('Name', $data[0]) || $type == "authors")
        {
            foreach ($data as $row) {
                $id = $row['Id_author'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/authors/$id\">";
                echo $row['Full_name'];
                echo "</a></p></li>";
            }
        }*/
    }
}

/*if ($type == "books" || !empty($data))
{
    if(is_string($data))
    {
        echo "<br> $data";
    }
    else {
        foreach ($data as $row) {
            $id = $row['Id_book'];
            echo "<li>";
            echo "<a href=\"http://localhost/test_project/books/$id\">";
            echo '<q>' . $row['Name'] . '</q>';
            echo "</a></p></li>";
        }
    }
}

if ($type == "authors" && !empty($data))
{
    foreach ($data as $row) {
        $id = $row['Id_author'];
        echo "<li>";
        echo "<a href=\"http://localhost/test_project/authors/$id\">";
        echo $row['Full_name'];
        echo "</a></p></li>";
    }
}*/
   /* switch ($type)
    {
        case "search":
        {
            echo "<form name=\"search-form\"  method=\"post\" action=\"http://localhost/test_project/searchbook\">";
            echo "<input type=\"text\" class=\"search-input\" name=\"request\" style='width: 400px' placeholder=\"Ищу ...\"/><br>
                <input type=\"radio\" class=\"search-radio\" name=\"searchBy\" value=\"book\" checked/> По названию<br>                
                <input type=\"radio\" class=\"search-radio\" name=\"searchBy\" value=\"author\"/> По автору<br>
                <button type=\"submit\" name=\"submit\">Найти</button>
            </form>";
            break;
        }
        case "authors":
        {
            foreach ($data as $row) {
                $id = $row['Id_author'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/authors/$id\">";
                echo '<q>' . $row['Full_name'] . '</q>';
                echo "</a></p></li>";
            }
            break;
        }
        case "books":
        {
            foreach ($data as $row) {
                $id = $row['Id_book'];
                echo "<li>";
                echo "<a href=\"http://localhost/test_project/books/$id\">";
                echo '<q>' . $row['Name'] . '</q>';
                echo "</a></p></li>";
            }
            break;
        }
        case "message":
        {
            echo 'тут';
            break;
           // echo $type;
            //echo "<p>".$data."</p>";
        }
    }
*/?>
