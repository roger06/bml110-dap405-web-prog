<?php
error_reporting(-1);
ini_set('display_errors', 'On');
$url = 'https://chichester.rl.talis.com/lists/C34D8F5E-B738-746C-F36F-CBBF11B21F33.json';
$url = 'https://chichester.rl.talis.com/items/D16ABD96-2384-2E38-346A-C27C6DA32618.json';



$json = file_get_contents($url);
$json_data = json_decode($json, true);
echo '<pre>';
var_dump($json_data);
echo '</pre>';
?>

