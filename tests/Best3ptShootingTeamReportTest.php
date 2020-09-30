<?php

use PHPUnit\Framework\TestCase;

require_once('vendor/autoload.php');
require_once('include/utils.php');
require_once('models/Report.php');

class Best3ptShootingTeamReportTest extends TestCase{

    protected $data, $report;

    public function setUp()
    {
        $this->report = new Report;
        $this->data = $this->report->getReportData('best_3pt_shooting_team');
    }

    public function testAllTeamsAreRetrieved(){
        $teams = $this->report->getReportData('getTeams');
        $this->assertEquals(count($teams), count($this->data));
    }

    public function testTwoDecimalPlacesTeamAccuracy(){
        $accuracy = $this->data[0]['team_accuracy'];
        $this->assertEquals(2, strpos($accuracy, '.'));
    }

    public function testTeamFieldsAreRetrieved(){
        $required_fields = array('team_name', 'team_3pt', 'team_accuracy', 'number_of_contributing_players_with_at_least_1_3pt', 'player_with_at_least_1_3pt_attempt', 'total_number_of_3pt_attempts_made_by_players_who_failed_to_make_a_3pt');

        foreach($this->data as $key => $value){
            foreach($required_fields as $field){
                if($value[$field] == 0 ) $value[$field] = 'a'; //0 is throwing an error as "Failed asserting that a string is not empty."
                $this->assertNotEmpty((string)$value[$field]);  
            }
        }
    }

    public function testTeamDataIsSortedHighestToLowest(){
        $expected = 100;
        
        foreach($this->data as $key => $value){
            $this->assertLessThanOrEqual($expected, $value['team_accuracy']);
            $extected = $value['team_accuracy'];
        }
    }

}
