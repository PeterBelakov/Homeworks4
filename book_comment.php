<?php 
$pageTitle = 'Коментари за книга';
include 'includes/header.php';
mb_internal_encoding('UTF-8');
?>
<a href="book.php">Нова книга</a> <a href="authors.php">Нов автор</a> 
<form method="POST">   
        <div>
    </div>
    <?php
     $connection = mysqli_connect('localhost', 'Petyo', 'qwerty', 'books');
    if (!$connection) {
        echo 'no datebase';
        exit;
}
mysqli_set_charset($connection, 'utf8');
$a = mysqli_query($connection, 'SELECT * FROM books INNER JOIN 
         books_authors ON books.book_id=books_authors.book_id INNER JOIN
         authors ON books_authors.author_id=authors.author_id WHERE books_authors.book_id='.$_GET['book_id'].' ');
$result=array();
while($row=  mysqli_fetch_assoc($a)){
    $result[$row['book_id']]['book_title'][$row['book_id']]=$row['book_title'];
    $result[$row['book_id']]['author_name'][$row['author_id']]=$row['author_name'];
   //echo '<pre>'.print_r($row, true). '</pre>'; 
} 
//echo '<pre>'.print_r($result, true). '</pre>';
echo'<table border="1px"><tr><td>Книгa</td><td>Автори</td></tr>';
foreach ($result as $v){
   
//    echo '<tr><td><a href="./book.php'.$row.'" >'.$row['author_name'].'</a></td></tr>';
        ?>
      <tr>
            <td>
                <?php 
                foreach ($v['book_title']as $k=>$vv){
                ?>             
                <a href="./book_comment.php?book_id=<?php echo $k;?>"><?php echo $vv; ?></a>
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
<?php }

if ($_POST) {

    $comment = trim($_POST['comment']);
    if (mb_strlen($comment) < 3) {
        echo '<p>Коментара е прекалено къс!</p>';
        exit;
    }   
if( !key_exists('is_logged',$_SESSION) || $_SESSION['is_logged']==0  ){ 
         header('Location: login.php');
         die;
}
    $comment = mysqli_real_escape_string($connection, $comment);
    $sql = 'INSERT INTO com (comment, user_id, book_id) VALUES("' . $comment . '",'.$_SESSION['user_id'].',"'.$k.'" )';

    if (mysqli_query($connection, $sql)) {
        echo 'Успешн коментар!';
       
    }
}
$sq = mysqli_query($connection,'SELECT * FROM users INNER JOIN com ON users.user_id=com.user_id 
INNER JOIN books ON com.book_id=books.book_id WHERE com.book_id='.$_GET['book_id'].' ORDER BY time DESC ');
if(!$sq){
    echo 'error';
   }
echo '<table border="1px"><tr><td>Коментари</td><td>Потребител</td><td>Дата</td></tr>';
while($row=$sq->fetch_assoc()){
    
   //echo '<pre>'.print_r($row, true). '</pre>';
echo '<tr><td>'.$row['comment'].'</td>  
      <td>'.$row['user_name'].'</td>
      <td>'.$row['time'].'</td></tr>';
}
echo '</tr>';
?>
        

    <tr>
            <td>
                <div><textarea name="comment"/></textarea>
                </div>
                <div>
                    <input type="submit" value="Запиши"/>
                </div>
            </td>
    </tr>
</form>
        
<?php
}
?>   