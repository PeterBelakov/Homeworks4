 <?php
$pageTitle = 'Автори на книги';
include 'includes/header.php';
mb_internal_encoding('UTF-8');
?>
<a href="index.php">Книги</a> 
<form method="POST">    
    <div>Автор:<input type="text"name="authors"/></div>

    <div>

    </div>
    <div>
        <input type="submit" value="Добави"/>
    </div>
</form>
<?php
 $connection = mysqli_connect('localhost', 'Petyo', 'qwerty', 'books');
    if (!$connection) {
        echo 'no datebase';
        exit;
}
mysqli_set_charset($connection, 'utf8');
$a = mysqli_query($connection, 'SELECT * FROM authors');
echo'<table border="1px"><tr><td>Автори</td></tr>';
while ($row = $a->fetch_assoc()) {
    
//    echo '<tr><td><a href="./book.php'.$row.'" >'.$row['author_name'].'</a></td></tr>';
    ?>
    <tr>
        <td>
            <a href="./book_author.php?author_id=<?php echo $row['author_id']; ?>"><?php echo $row['author_name']; ?></a>
        </td>
    </tr>
<?php   } ?>

<!--echo '</tr>';-->
<!--?>-->
<?php
if ($_POST) {

    $authors = trim($_POST['authors']);
    if (mb_strlen($authors) < 3) {
        echo '<p>Името е прекалено късо!</p>';
        exit;
    }


    $q = mysqli_query($connection, 'SELECT * FROM authors 
            WHERE author_name=("' . $authors . '")');

    if (!$q->num_rows == 0) {
        echo 'Съеществуващ автор!';
        die;
    }
    $authors = mysqli_real_escape_string($connection, $authors);
    $sql = 'INSERT INTO authors (author_name) VALUES("' . $authors . '")';

    if (mysqli_query($connection, $sql)) {
        echo 'Успешна региистрация!';
        header('Location: authors.php');
    }
}
?>   