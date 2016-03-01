

<?php
$pageTitle = 'Книги от автор';
include 'includes/header.php';
mb_internal_encoding('UTF-8');
?>
<a href="index.php">Книги</a> 
<form method="POST" >
                         <select name="filter">
                            <option value="books_asc">Книги възходящ</option>      
                            <option value="books_desc">Книги низходящ</option>
                            <option value="author_asc">Автори възходящ</option>
                            <option value="author_desc">Автори низходящ</option>
                          </select>
    <div>Търсене по книга:<input type="text" name="search"/></div>
    <input type="submit" value="Филтрирай"/>
</form>
<div>
</div>
<?php
$connection = mysqli_connect('localhost', 'Petyo', 'qwerty', 'books');
if (!$connection) {
    echo 'no datebase';
    exit;
}
$sql = 'SELECT * FROM books 
        INNER JOIN books_authors ON books.book_id=books_authors.book_id 
        INNER JOIN authors ON books_authors.author_id=authors.author_id 
        WHERE books.book_id IN (
                SELECT books.book_id 
                FROM books
                INNER JOIN books_authors ON books.book_id=books_authors.book_id 
                INNER JOIN authors ON books_authors.author_id=authors.author_id
                where books_authors.author_id = ' . $_GET['author_id'] . '

        ) ';
if ($_POST) {
    if($_POST ['search']){
        $sql .= " and books.book_title LIKE '%".$_POST['search']. "%'" ;
         
    }
    switch ($_POST ['filter']) {
        case 'books_asc':
            $sql .= ' order by books.book_title asc ';
            break;
        case 'books_desc':
            $sql .= ' order by books.book_title desc ';
            break;
        case 'author_asc':
            $sql .= ' order by authors.author_name asc ';
            break;
        case 'author_desc':
            $sql .= ' order by authors.author_name desc ';
            break;
    }
   
}

mysqli_set_charset($connection, 'utf8');
$a = mysqli_query($connection, $sql);
$result = array();
while ($row = mysqli_fetch_assoc($a)) {
    $result[$row['book_id']]['book_title'][$row['book_id']] = $row['book_title'];
    $result[$row['book_id']]['author_name'][$row['author_id']] = $row['author_name'];
    //echo '<pre>'.print_r($row, true). '</pre>'; 
}
//echo '<pre>'.print_r($result, true). '</pre>';
echo'<table border="1px"><tr><td>Книгa</td><td>Автори</td></tr>';
foreach ($result as $v) {
    #if(array_key_exists($_GET['author_id'], $v['author_name'])){
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
<?php }} ?>
