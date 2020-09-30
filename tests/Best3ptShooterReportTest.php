<?php

use PHPUnit\Framework\TestCase;

require_once('vendor/autoload.php');
require_once('include/utils.php');
require_once('models/Report.php');

class Best3ptShooterReportTest extends TestCase{

	protected $data, $report;

	public function setUp()
	{
        $this->report = new Report;
		$this->data = $this->report->getReportData('best_3pt_shooter');
	}

    public function testOlderThanThirtyYearsOld(){
        foreach($this->data as $key => $value){
        	$this->assertGreaterThan(30, $value['age']);
        }
    }

    public function testGreaterThanThirtyFiveAccuracy(){
        foreach($this->data as $key => $value){
        	$this->assertGreaterThan(35, $value['accuracy']);
        }
    }

    public function testFieldsAreRetrieved(){
    	$required_fields = array('player_name', 'full_team_name', 'age', 'player_number', 'position', 'accuracy', '3pt_made');

        foreach($this->data as $key => $value){
        	foreach($required_fields as $field){
        		$this->assertNotEmpty($value[$field]);	
        	}
        }
    }

    public function testDataIsSortedHighestToLowest(){
    	$expected = 100;
		
        foreach($this->data as $key => $value){
        	$this->assertLessThanOrEqual($expected, $value['accuracy']);
        	$extected = $value['accuracy'];
        }

    }
}
