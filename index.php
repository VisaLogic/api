<?php

require 'vendor/autoload.php';
require 'src/ApiContract.php';
require 'src/Api.php';

$visalogic = new VisaLogic\Api('key');

var_dump($visalogic->getVisa(1501));
die();
$order = $visalogic->createOrder(['email' => 'info@danielgelling.nl']);
$order->addApplication(['firstnames' => 'Albert Daniel']);
$order->addApplication(['firstnames' => 'Josse Zwols']);

die(var_dump($order));

die(var_dump($visalogic->postOrder($order)));
