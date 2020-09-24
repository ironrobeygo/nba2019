<?php
require_once('classes/Exporter.php');
require_once('traits/PlayersTrait.php');
require_once('traits/ReportsTrait.php');

class Controller extends Exporter{
    use PlayersTrait, ReportsTrait;
    public function __construct($args=null) {
        $this->args = $args;
    }

    public function export($type, $format) {
        $data = $this->getData($type);
        if (!$data) {
            exit("Error: No data found!");
        }
        return $this->format($data, $format);
    }

    public function report($report){
        $data = $this->getReportData($report);
        if (!$data) {
            exit("Error: No data found!");
        }
        return $data;
    }
}