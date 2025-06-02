<?php


require '../vendor/autoload.php';

use abilioj\ToolToDev\connection\ConnPDO;

class connection extends ConnPDO
{
}

$conn = new connection();

if($conn->TestConect()) {
    echo "Connection successful!";
} else {
    echo "Connection failed!";
}

