<?php 
session_start();

if(!isset($_SESSION['koszyk'])) 
{
    $_SESSION['koszyk'] = [];
};

$ilosc_wszystkich = array_sum( $_SESSION['koszyk'] );

echo json_encode([ 'ilosc' => $ilosc_wszystkich ]);