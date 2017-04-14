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
      <li><a href="rejestracja.php">Rejestracja</a></li>
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
};

if(!isset($_SESSION['koszyk'])) 
{
    $_SESSION['koszyk'] = [];
};

$ids = array_keys($_SESSION['koszyk']);
$ids_str = implode(',', $ids);
$query = "SELECT * FROM product WHERE id IN ($ids_str);";

if ($result = $mysqli->query($query)) 
{

    echo '<br><div class="koszyk-zamowienia">';
    echo '<form method="post" action="zloz_zamowienie.php">';
    echo '<table>';

    echo '<thead>';
    echo '<tr>';
    
    echo '<th>Nazwa</th>';
    echo '<th>Cena</th>';
    echo '<th>Ilość</th>';
    
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    
    while ($row = $result->fetch_assoc()) 
    {
        $id = $row['id'];
       
        echo '<tr>';
        echo '<td><a href="product.php?id=' . $row['id'] .'">' . $row['title'] . '</td>';
        echo '<td>' . ( $row['price'] / 100 ) .' zł</td>';
        echo '<td><input type="number" name="produkty['.$id .']" value="'.$_SESSION['koszyk'][ $id ] .'"></td>';
        echo '</tr>';
        
    }
    echo '<tbody>';

    echo '</table>';
    
    if(empty($_SESSION['user']))
    {
        echo 'Imie i nazwisko <input type="text" name="client_name"></br>';
        echo 'ulica i numer <input type="text" name="line_1"></br>';
        echo 'Miasto <input type="text" name="city"></br>';
        echo 'Kod pocztowy <input type="text" name="post_code"></br>';
    }
    else
    {
        echo '<br>Imie i Nazwisko <input type="text" value="'.$_SESSION['user']['client_name'].'" name="client_name"></br>';
        echo '<br><br>Ulica i numer <input type="text" value="'.$_SESSION['user']['line_1'].'"name="line_1"></br>';
        echo '<br>Miasto <input type="text" value="'.$_SESSION['user']['city'].'" name="city"></br>';
        echo '<br>Kod pocztowy <input type="text" value="'.$_SESSION['user']['post_code'].'" name="post_code"></br>';
    }

    echo '<br><button type="submit">Zamów</button>';
    echo '</form>';
    echo '</div>' ;
    $result->free();
}

$mysqli->close();
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>
<script type="text/javascript" src="ile_w_koszyku.js"></script>
</body>
</html>

