 
<?php
$pageTitle = 'Всички книги';
include 'includes/header.php';
mb_internal_encoding('UTF-8');
?>
<a href="book.php">Нова книга</a> <a href="authors.php">Нов автор</a> 
<form method="POST">   
        <div>
    </div>
    <?php
     $connection = mysqli_connect( $database['db_host'], $database['db_user'],$database['db_pass'],$database['db_name']);
    if (!$connection) {
        echo 'no datebase';
        exit;
}
mysqli_set_charset($connection, 'utf8');
$a = mysqli_query($connection, 'SELECT * FROM books INNER JOIN 
         books_authors ON books.book_id=books_authors.book_id INNER JOIN
         authors ON books_authors.author_id=authors.author_id');
$result=array();
while($row=  mysqli_fetch_assoc($a)){
    $result[$row['book_id']]['book_title'][$row['book_id']]=$row['book_title'];
    $result[$row['book_id']]['author_name'][$row['author_id']]=$row['author_name'];
  // echo '<pre>'.print_r($result, true). '</pre>'; 
} 
//echo '<pre>'.print_r($result, true). '</pre>';
echo'<table border="1px"><tr><td>Книгa</td><td>Автори</td></tr>';
foreach ($result as $v){
 //  echo '<pre>'.print_r($result, true).'</pre>';
//    echo '<tr><td><a href="./book.php'.$row.'" >'.$row['author_name'].'</a></td></tr>';
        ?>
        <tr>
            <td>
                <?php 
                foreach ($v['book_title']as $key=>$vv){
                ?>             
                <a href="./book_comment.php?book_id=<?php echo $key;?>"><?php echo $vv; ?></a>
                <?php}?>
            </td>
            <td>
              <?php  
              foreach ($v['author_name'] as $key=>$vv){ 
              ?>
                
                <a href="./book_author.php?author_id=<?php echo $key;?>"><?php echo $vv; ?></a>
            <?php }?>
            </td>
        </tr>
<?php } ?>

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
}}
?>   