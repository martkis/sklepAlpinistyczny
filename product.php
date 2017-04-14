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
$query = "SELECT * FROM product WHERE id = $id ";

if ($result = $mysqli->query($query)) 
{

    $row = $result->fetch_assoc();
    $pic = $row['pics'];
    
    echo '<h1>' .$row['title'].'</h1>';
    echo '<i>Cena</i>: <b>'. ( $row['price'] / 100 ) .' zł</b><br>';
    echo '<form id="formularz_zakupow">';
    echo '<input type="number" name="ilosc" value="1"/>';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '"/>';
    echo "<img src=". $pic. " ";
    echo "<br></br>";

    echo '<button type="submit">Dodaj do koszyka</button>';
    echo '</form>';
    echo '<i>';
    echo $row['description'] . '</i><br>'; 
    
    $result->free();
}

$mysqli->close();
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>
<script>

$('#formularz_zakupow').on('submit', function (ev) 
{
    ev.preventDefault();
    
    var id = $('#formularz_zakupow [name=id]').val();
    var ilosc = $('#formularz_zakupow [name=ilosc]').val();
    
    $.ajax({
        url: 'dodaj_do_koszyka.php',
        type: 'POST',
    	dataType: 'json',
    	data: {id: id, ilosc: ilosc },
    })
    .done(function(data)
    {  
        $('#koszyk-ilosc').text(data.ilosc);
    });
});

</script>
<script type="text/javascript" src="ile_w_koszyku.js"></script>
</body>
</html>