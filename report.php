<?php
require('include/utils.php');
require_once('classes/Controller.php');

$controller = new Controller();

$queries = array(
	'Example Query' => 'getTeams',
	'Report 1 - Best 3pt Shooters' => 'best_3pt_shooter',
	'Report 2 - Best 3pt Shooting Teams' => 'best_3pt_shooting_team',
);

foreach($queries as $key => $value){
	echo '<h1>'.$key.'</h1>';
	$data = $controller->report($value);
	echo asTable($data);
}