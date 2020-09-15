<br>
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
        echo "</a></p></li>";
    }
}
?>
