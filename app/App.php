<?php 

declare(strict_types=1);

function getTransectionFile( string $full_files_path): array 
{
    $files = [];
    foreach(scandir( $full_files_path ) as $file) {

        if(is_dir($file)) {

            continue;
        }
        $files[] = $full_files_path .$file;
    }
    return $files;
}
function getTransection( string $file_name, ?callable $transection_handler = null ): array
{
    if( ! file_exists( $file_name )){
        trigger_error('File'. $file_name . "doen not exit". E_USER_ERROR);
    }
    $file = fopen($file_name, 'r');
    fgetcsv($file);
    $transections = [];
    while(($transection = fgetcsv($file)) !== false ) {
        if( $transection_handler !== null ) {
        $transections [] = extectTransection($transection);   
        }
    }
    return $transections;
}

function extectTransection( array $transection_row): array {

     [ $data, $checkNumber, $description, $amount]=$transection_row;

    $amount = (float)str_replace(['$',','], '', $amount);
    return [
        'data'  => $data,
        'checkNumber'  => $checkNumber,
        'description'  => $description,
        'amount'  => $amount,
    ];
}

function calculateTotals(array $transections) {
    $totals = ['neTotals' => 0, 'totalIncom' => 0, 'totalExpends' => 0];

    foreach ($transections as $transection) {

        $totals['neTotals'] += $transection['amount'];
        
        if($totals['amount'] >= 0) {

            $totals['totalIncom'] += $transection['amount'];
        }else {

            $totals['totalExpends'] += $transection['amount'];
        }
    }
    return $totals;
}