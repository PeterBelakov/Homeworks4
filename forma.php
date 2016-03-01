 <?php
$pageTitle = 'Форма за регистрация';
include 'includes/header.php';
mb_internal_encoding('UTF-8');
echo '<a href="destroy.php">EXIT</а></br>';
 ?>
<a href=>Форма за регистрация</a> 
<form method="POST">    
    <div>Име<input type="text"name="username"/></div>
    <div>Парола<input type="text"name="password"/></div>
    <div>
       
    </div>
    <div>
        <input type="submit" value="Запиши"/>
    </div>
</form>

    
<?php

if($_POST){
    $username = trim($_POST['username']);
    $password = (trim($_POST['password']));
    if (mb_strlen($username) < 5) {
        echo '<p>Името е прекалено късо!</p>';
        exit;
    }
    if (mb_strlen($password) < 5) {
        echo '<p>Паролата е прекалено къса!</p>';
        exit;
    }

    $connection = mysqli_connect('localhost', 'Petyo', 'qwerty', 'books');
    if (!$connection) {
        echo 'no datebase';
        exit;
    }
    mysqli_set_charset($connection, 'utf8');
    $q = mysqli_query($connection, 'SELECT * FROM users 
            WHERE user_name=("' . $username . '")');
    
       if (!$q->num_rows == 0) {
        echo 'Съеществуващо потребител!';
        die;
    }    
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $sql = 'INSERT INTO users (user_name, password) VALUES("' . $username . '","' . $password . '")';

    if (mysqli_query($connection, $sql)) {
        echo 'Успешна региистрация!';
        //header('location: index.php');
   
    }
     
}
?>

<?php
include 'includes/footer.php';
?>



