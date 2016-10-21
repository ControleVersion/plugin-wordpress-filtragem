<?php
$conn ='';
try {
    $conn = new PDO('mysql:host=vivo_rio_novo.mysql.dbaas.com.br;dbname=vivo_rio_novo', 'vivo_rio_novo', 'hedvuS2daka');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Foi";
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

