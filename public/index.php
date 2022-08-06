<?php 

declare(strict_types=1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transection_file' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

require APP_PATH ."App.php";

$files = getTransectionFile( FILES_PATH );

$transections = [];
$totals = calculateTotals($transections);

foreach( $files as $file ) {
  
    $transections = array_merge($transections, getTransection( $file, 'extectTransection')); 
}
require VIEWS_PATH . 'transection.php';