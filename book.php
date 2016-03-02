<?php
$pageTitle = 'Нова книга';
include 'includes/header.php';
mb_internal_encoding('UTF-8');
?>
<?php
$connection = mysqli_connect( $database['db_host'], $database['db_user'],$database['db_pass'],$database['db_name']);
if (!$connection) {
echo 'no datebase';
exit;
}
mysqli_set_charset($connection, 'utf8');
$a = mysqli_query($connection, 'SELECT * FROM authors');
?>
<a href="index.php">Книги</a> 
<form method="POST">    
    <div>Име на книгата:<input type="text"name="books"/></div>
    <p><select name="select[]" size="6" multiple="multiple">
            <?php while ($row = $a->fetch_assoc()) { ?>  <option value="<?php echo $row['author_id']; ?>" >
                <?php
                echo $row['author_name'];
                }
                ?></option>

        </select></p>
    <div>

    </div>

    <div>
        <input type="submit" value="Добави"/>
    </div>
</form>
<?php
if ($_POST) {
$books = trim($_POST['books']);
if (mb_strlen($books) < 3) {
echo '<p>Името на книгата е прекалено късо!</p>';
exit;
}
$q = mysqli_query($connection, 'SELECT * FROM books 
            WHERE book_title=("' . $books . '")');

if (!$q->num_rows == 0) {
echo 'Съеществуваща книга!';
die;
}
$books = mysqli_real_escape_string($connection, $books);
$sql = 'INSERT INTO books (book_title) VALUES("' . $books . '")';

if (mysqli_query($connection, $sql)) {

//         echo '<pre>'.print_r($connection, TRUE).'</pre>';
//echo '<pre>'.print_r($books, TRUE).'</pre>';
//die;
//
$book_id = $connection->insert_id;
$book_id = mysqli_real_escape_string($connection, $book_id);
echo '<pre>'.print_r($book_id, true).'</pre>';


$select = $_POST['select'];
if ($select) {
foreach ($select as $author_id) {
$author_id = mysqli_real_escape_string($connection, $author_id);
$sql = 'INSERT INTO books_authors(author_id,book_id) VALUES(" '.$author_id.'" , "'.$book_id.'")';

if (mysqli_query($connection, $sql)){
echo 'Успешен запис!';
header('Location: book.php');
}


}
}
} 
}

?>
