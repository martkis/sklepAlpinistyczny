<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styleprojektu2.css">
    <title></title>
</head>
<body>

<h2>LAMA SHOP<br><div id="h3">Climb with LAMA</div></h2>
  <div class="center">
  <ul id="menu">
    <li><a href="index.php">Strona Domowa</a></li>
    <li><a href="aboutus.php">O nas</a></li>
    <li><a href="koszyk.php">Koszyk(<span id="koszyk-ilosc">0</span>)</a></li>
    <?php
    if(empty($_SESSION['user'])){
    ?>
      <li><a href="logowanie.php">Logowanie</a></li>
    <?php
    }else{
    ?>
      <li><a href="zamowienia.php">Zamówienia</a></li>
      <li><a href="wylogowywanie.php">Wyloguj (<?php echo $_SESSION['user']['client_name']; ?>)</a></li>
    <?php
    }
    ?>
  </ul>
</div> 

<?php
$mysqli = new mysqli("localhost", "root", "", "lama");

if ($mysqli->connect_errno) 
{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$id = $_GET['id'];
if($_SESSION['user']['is_admin']){
    $query = "SELECT * FROM `order` WHERE id = $id"; 
}else{
    $user_id = $_SESSION['user']['id'];
    $query = "SELECT * FROM `order` WHERE id = $id AND user_id = $user_id ";
}

if ($result = $mysqli->query($query)) 
{

    $row = $result->fetch_assoc();
    echo '<br><div class="zamowienie-konkretne">';
    echo '<h1>Zamowienie nr:' . $row['id'] . ' </h1>';
    echo '<i>Imie i Nazwisko:</i> '. $row['client_name'] .'<br>';
    echo '<i>Ulica:</i> '. $row['line_1'] .'<br>';
    echo '<i>Miasto:</i> '. $row['city'] .'<br>';
    echo '<i>Kod pocztowy:</i> '. $row['post_code'] .'<br>';
    echo '</div>';
    
    $result->free();



    $query = "SELECT `order_product`.*, `product`.*  FROM `order_product`, `product` WHERE `order_product`.`product_id` = `product`.`id` AND `order_product`.`order_id` = $id";

    if ($result = $mysqli->query($query)) 
    {

        echo '<ul>';    
        while ($row = $result->fetch_assoc()) 
        {
            echo '<li class="zamowienie_produkt"><a href="product.php?id=' . $row['product_id'] .'">' . $row['title'] . '</a> <i>' . ( $row['price'] / 100 ) .' zł</i>, ilość: ' . $row['count'] . '</li>';
        }
        echo '</ul>';
        $result->free();
    }
}

$mysqli->close();
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>
<script type="text/javascript" src="ile_w_koszyku.js"></script>
</body>
</html>