<?php

require 'vendor/autoload.php';
require 'src/ApiContract.php';
require 'src/Api.php';

$visalogic = new VisaLogic\Api('key');


$order = $visalogic->createOrder(['email' => 'info@danielgelling.nl']);
$order->addApplication(['firstnames' => 'Albert Daniel']);
$order->addApplication(['firstnames' => 'Josse Zwols']);

die(var_dump($visalogic->postOrder($order)));
