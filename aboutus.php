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
<br>
<h1>O nas - About Us</h1>
<br>
<b> <i>LAMA</i> działa na rynku od 1998 roku. Najpierw jako <i>Lama i Syn</i> - sklep sportowy, a od 2012 roku – <i>LAMA Shop</i> – jesteśmy uznanym producentem sprzętu wspinaczkowego. Do spółki wniesiona też została licencja brytyjskiej firmy AplinaSopina na produkcję lin, napinaczy do lin i szekli oraz kasków.

23 maja 2013 firma dostała nagrodę konsumenta 2013- utrzymuje ją do dziś.</b>
<br><br>
<b>
<i>LAMA</i>  been on the market since 1998. First as a <i>Lama and Son</i> - a sports store, and since 2012 - <i>LAMA Shop</i> - we are a recognized manufacturer of climbing equipment. The company brought a license is a British company AplinaSopina the production of ropes, rope tensioners and shackles and the helmets.

23 May 2013 the company was awarded the consumer keeps it from 2013 until today.</b>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>
<script type="text/javascript" src="ile_w_koszyku.js"></script>
</body>
</html>