<p>Список книг</p>

<a href='http://localhost/test_project/authors' >По автору</a>
<br>
<a href='http://localhost/test_project' >По названию</a>
<br>
<br>

<?php

foreach ($data as $row)
{
    $id = $row['Id_book'];
    echo "<li>";
    echo "<a href=\"http://localhost/test_project/books/$id\">";
    echo '<q>'.$row['Name'].'</q>';
    //  echo $books[$row]['Content'].'<br>';
    echo "</a></p></li>";
}

?>
