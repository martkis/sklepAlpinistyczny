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

<?php
$mysqli = new mysqli("localhost", "root", "", "lama");

if (mysqli_connect_errno()) 
{
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$client_name = $_POST['client_name'];
$line_1 = $_POST['line_1'];
$city = $_POST['city'];
$post_code = $_POST['post_code'];

if(empty($_SESSION['user'])){
    $query = "INSERT INTO `order` ( `client_name`, `line_1`, `city`, `post_code`) VALUES ( '$client_name', '$line_1', '$city', '$post_code')";
}else{
    $user_id = $_SESSION['user']['id'];
    $query = "INSERT INTO `order` ( `user_id`, `client_name`, `line_1`, `city`, `post_code`) VALUES ('$user_id', '$client_name', '$line_1', '$city', '$post_code')";
}
$mysqli->query($query);

$zamowienie_id = $mysqli->insert_id;

$produkty = $_POST['produkty'];

foreach($produkty as $id => $ilosc)
{
    if($ilosc>0)
    {
        $query = "INSERT INTO `order_product` (`product_id`, `order_id`, `count`) VALUES ('$id', '$zamowienie_id', '$ilosc')";
        $mysqli->query($query);
    
    };  

};
echo "Dziękujemy Za złożenie zamówienia!<br>";

$mysqli->close();
?>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>
<script type="text/javascript" src="ile_w_koszyku.js"></script>
</body>
</html>
