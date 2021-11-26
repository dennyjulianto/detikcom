<?php
    require_once "koneksi_db.php";

    // mysql_select_db($database) or die('Error selecting MySQL database: ' . mysqli_error());
    $connect->select_db("db_detik");

    $filename = $argv[1];
    $templine = '';
    $lines = file($filename);
    
    foreach ($lines as $line) {
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;
        
        $templine .= $line;
        
        if (substr(trim($line), -1, 1) == ';') {
            $connect->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $connect->error() . '<br /><br />');
            $templine = '';
        }
    }
    echo "Tables imported successfully";
?>