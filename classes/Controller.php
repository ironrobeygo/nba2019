<?php
use Illuminate\Support;
use Jenssegers\Blade\Blade;
require_once('vendor/autoload.php');
require_once('classes/Exporter.php');
require_once('models/Player.php');
require_once('models/Report.php');
require_once('include/utils.php');

class Controller{

    protected $blade, $args, $type, $format;

    public function __construct($args=null) {
        $this->blade = new Blade('views', 'cache');

        $this->args = $args;
        $this->type = isset($this->args['type']) ? $this->args['type'] : null;
        $this->format = isset($this->args['format']) ? $this->args['format'] : 'html';

        $method = $this->args['page'];
        $this->$method();
    }

    public function export() {
        $player = new Player($this->args);
        $data = $player->getPlayerData($this->type);
        if (!$data) {
            exit("Error: No data found!");
        }
        $export = new Exporter();
        echo $export->format($data, $this->format);
    }

    public function report(){

        $report = new Report();

        $queries = array(
            'Example Query' => 'getTeams',
            'Report 1 - Best 3pt Shooters' => 'best_3pt_shooter',
            'Report 2 - Best 3pt Shooting Teams' => 'best_3pt_shooting_team',
        );

        foreach($queries as $key => $value){
            $queries[$key] = $report->getReportData($value);
        }
        echo $this->blade->render('report', ['queries' => $queries, 'utils' => new Utils]);
    }
}