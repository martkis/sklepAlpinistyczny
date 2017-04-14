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
    echo 'Connect failed: %s' . $mysqli->connect_error . "\n";
    exit();
}


$id = $_GET['id'];

$query = "SELECT * FROM product WHERE category_id = $id ";


if ($result = $mysqli->query($query)) 
{

    echo '<ul>';    
    while ($row = $result->fetch_assoc()) 
    {
        echo '<li class ="kategoria_produkt"><a href="product.php?id=' . $row['id'] .'">' . $row['title'] . ' <i>' . ( $row['price'] / 100 ) .' zł</i></a></li>';
        echo "<br></br>";
        echo "<img src=". $row['pics']. " ";
        echo "<br></br>";
    }
    echo '</ul>';
    $result->free();
}

$mysqli->close();
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>
<script type="text/javascript" src="ile_w_koszyku.js"></script>
</body>
</html>