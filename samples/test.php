<?php
 
include_once "../api/config.php";
include_once "../api/bitreserve.php";

$bitReserve = new BitreserveApi();


$bitReserve->setVarUrl($bitr_url);



// ****
// Get all Tickers example
// ***
$allTickers = $bitReserve->getAllTickers();

print '<h4>Get All Tickers</h4>';
print '<pre>' . $allTickers . '</pre>';



// ****
// Get Tickers for Currency example
// ***
$tickerCurrency = $bitReserve->getTickersForCurrency('EUR');

print '<h4>Get Tickers for Currency</h4>';
print '<pre>' . $tickerCurrency . '</pre>';



// ****
// List Cards example
// ***
$my_token = '123456789';
$header_token = array('Authorization: Bearer ' . $my_token);
$card = $bitReserve->listCards($header_token);

print '<h4>List Cards</h4>';
print '<pre>' . $card . '</pre>';



// ****
// Gat Card Details example
// ***
$my_token = '123456789';
$card_id = '123456789';
$header_token = array('Authorization: Bearer ' . $my_token);
$card = $bitReserve->getCardDetails($header_token, $card_id);

print '<h4>Card Details</h4>';
print '<pre>' . $card . '</pre>'


?>