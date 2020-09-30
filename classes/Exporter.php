<?php
use LSS\Array2Xml;

require_once('include/utils.php');

// retrieves & formats data from the database for export
class Exporter extends Utils{

    public function format($data, $format = 'html') {
        return $this->$format($data);
    }

    public function xml($data){
       header('Content-type: text/xml');
        
        // fix any keys starting with numbers
        $keyMap = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        $xmlData = [];
        foreach ($data->all() as $row) {
            $xmlRow = [];
            foreach ($row as $key => $value) {
                $key = preg_replace_callback('(\d)', function($matches) use ($keyMap) {
                    return $keyMap[$matches[0]] . '_';
                }, $key);
                $xmlRow[$key] = $value;
            }
            $xmlData[] = $xmlRow;
        }
        $xml = Array2XML::createXML('data', [
            'entry' => $xmlData
        ]);
        return $xml->saveXML();
    }

    public function json($data){
        header('Content-type: application/json');
        return json_encode($data->all());
    }

    public function csv($data){
        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="export.csv";');
        if (!$data->count()) {
            return;
        }
        $csv = [];

        // extract headings
        // replace underscores with space & ucfirst each word for a decent headings
        $headings = self::getHeadings($data);
        $csv[] = $headings->join(',');

        // format data
        foreach ($data as $dataRow) {
            $csv[] = implode(',', array_values($dataRow));
        }
        return implode("\n", $csv);
    }

    public function html($data){
        if (!$data->count()) {
            return $this->htmlTemplate('Sorry, no matching data was found');
        }

        return $this->htmlTemplate($this->outputTable($data));
    }

}