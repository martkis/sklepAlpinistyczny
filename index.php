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
}


$query = "SELECT * FROM category";

if ($result = $mysqli->query($query)) 
{
    echo '<div class= "center">';
    echo '<ul>';    
    while ($row = $result->fetch_assoc()) 
    { 
        echo '<li class="menu_kategorie"><a href="kategoria.php?id=' . $row['id'] .'">' . $row['name'] .'</a></li>';
    }
    echo '</ul>';
    echo '</div>';
    $result->free();
}

$mysqli->close();
?>
<script>  
    function fullsize(el)
     {
      var big_image = document.getElementById('big_image');
      big_image.src = el.src;
     }
</script>

<table>
  <tr>
     <td colspan="3"><img src="pics/122.jpg" alt="big" width="800" id="big_image" ></td>
  </tr>

  <tr>
     <td><img src="pics/1.jpg" alt="1" style="width:250px;height:144px;" onclick="fullsize(this)" /></td>
     <td><img src="pics/2.jpg" alt="2" style="width:250px;height:144px;" onclick="fullsize(this)" /></td>
     <td><img src="pics/3.jpg" alt="3" style="width:250px;height:144px;" onclick="fullsize(this)" /></td>
     <td><img src="pics/4.jpg" alt="4" style="width:250px;height:144px;" onclick="fullsize(this)" /></td>
  </tr>

</table>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>
<script type="text/javascript" src="ile_w_koszyku.js"></script>
</body>
</html>