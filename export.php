<?php
require('include/utils.php');
require_once('classes/Controller.php');

// process the args
$args = collect($_REQUEST);
$format = $args->pull('format') ?: 'html';
$type = $args->pull('type');
if (!$type) {
    exit('Please specify a type');
}

$controller = new Controller($args);
echo $controller->export($type, $format);