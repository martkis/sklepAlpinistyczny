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


if($_SESSION['user']['is_admin']){ 
  $query = "SELECT * FROM `order`";
}else{
  $user_id = $_SESSION['user']['id'];
  $query = "SELECT * FROM `order` WHERE user_id = $user_id";
}

if ($result = $mysqli->query($query)) 
{

    echo '<ul>';    
    while ($row = $result->fetch_assoc()) 
    {   echo '<br><div class="zamowienie-zamowienia">';
        echo '<li><a href="zamowienie.php?id=' . $row['id'] .'"> Zamowienie nr: ' . $row['id'] .'</a></li>';
        echo '</div>';
    }
    echo '</ul>';
    $result->free();
}

$mysqli->close();
?>


</table>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>
<script type="text/javascript" src="ile_w_koszyku.js"></script>
</body>
</html>