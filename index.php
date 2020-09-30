<?php
require_once('classes/Controller.php');
$args = collect($_REQUEST);
new Controller($args);