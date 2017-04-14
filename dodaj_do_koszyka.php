<?php 
session_start();

if(!isset($_SESSION['koszyk'])) 
{
    $_SESSION['koszyk'] = [];
};

$id = $_POST['id'];
$ilosc = $_POST['ilosc'];

$_SESSION['koszyk'][$id] = $ilosc;

$ilosc_wszystkich = array_sum( $_SESSION['koszyk'] );

echo json_encode([ 'ilosc'=> $ilosc_wszystkich ]);


