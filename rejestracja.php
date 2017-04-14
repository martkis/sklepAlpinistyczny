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
    <form method="post" action="zarejestruj.php">
        Login: <input type="text" name="login"></br>
        Hasło: <input type="password" name="password"></br>
        Imie i nazwisko: <input type="text" name="client_name"></br>
        ulica i numer: <input type="text" name="line_1"></br>
        Miasto: <input type="text" name="city"></br>
        Kod pocztowy: <input type="text" name="post_code"></br>
        <button type="submit">Zarejestruj</button>        
    </form>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>
<script type="text/javascript" src="ile_w_koszyku.js"></script>
</body>
</html>

