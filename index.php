<?php

require_once '_connec.php';
$pdo = new \PDO(DSN, USER, PASS);


?>

<html>
<body>

<form action='index.php' method="post">
    <input name="firstname" type="text" placeholder="firstname">
    <input name="lastname" type="text" placeholder="lastname">
    
    <button type="submit">enregister</button>
</form>

</body>
</html>

<?php

require_once '_connec.php';
$pdo = new \PDO(DSN, USER, PASS);

if (isset($_POST['firstname'])&& isset($_POST['lastname'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
    $statement = $pdo->prepare($query);

    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);


    $statement->execute();
}

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);

$friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);


?>
<ul>
    <?php 
   foreach($friendsArray as $friend) {
        ?> <li><?php echo $friend['firstname']  ?> <?php echo $friend['lastname']  ?></li>
<?php
    }?>
</ul>

<?php