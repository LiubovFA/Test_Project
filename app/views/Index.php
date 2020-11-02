<p><b>Список книг</b></p>

<a href='http://localhost/test_project/authors' >По автору</a>
<br>
<a href='http://localhost/test_project' >По названию</a>
<br>
<br>

<?php

foreach ($data as $row)
{
    if ($type == "authors")
    {
        $id = $row['Id_author'];
        echo "<li>";
        echo "<a href=\"http://localhost/test_project/authors/$id\">";
        echo '<q>' . $row['Full_name'] . '</q>';
        echo "</a></p></li>";
    }
    else {
        $id = $row['Id_book'];
        echo "<li>";
        echo "<a href=\"http://localhost/test_project/books/$id\">";
        echo '<q>' . $row['Name'] . '</q>';
        //  echo $books[$row]['Content'].'<br>';
        echo "</a></p></li>";
    }
}

?>
