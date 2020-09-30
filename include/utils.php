<?php
use Illuminate\Support;
require_once('vendor/autoload.php');

class Utils{
    /**
     * Fail method - used in testing to output a decent failure message
     * @param string message the message to output
     */
    public function fail($message) {
        exit('<div style="display: inline-block; color: #a94442; background: #f2dede; border: solid 1px #ebccd1; font-family: Helvetica, Arial; size: 16px; padding: 15px;">Test failed: ' . $message . '</div>');
    }

    /**
     * Pass method - used in testing to output a decent pass message
     * @param string message the message to output
     */
    public function pass($message) {
        exit('<div style="display: inline-block; color: #3c763d; background: #dff0d8; border: solid 1px #d6e9c6; font-family: Helvetica, Arial; size: 16px; padding: 15px;">Test failed: ' . $message . '</div>');
    }

    /**
     * Display an array of assoc arrays (query resultset) as an HTML table
     * Depends on Laravel collections class being available
     * @param array an array of assoc arrays
     * @return string HTML table
     */
    public function asTable($data) {
        if (!$data || !is_array($data) || !count($data)) {
            return 'Sorry, no matching data was found';
        }
        $data = collect($data);

        // output data
        $table = $this->outputTable($data);
        return $table;
    }

    // wrap html in a standard template
    public function htmlTemplate($html) {
        return '<html>
        <head>
        <link rel="stylesheet" href="static/styles.css">
        </head>
        <body>
        ' . $html . '
        </body>
        </html>';
    }

    public function getHeadings($data){
        $headings = collect($data->get(0))->keys();
        return $headings->map(function($item, $key) {
            return collect(explode('_', $item))
                ->map(function($item, $key) {
                    return ucfirst($item);
                })
                ->join(' ');
        });
    }

    public function outputTable($data){
        
        $headings = $this->getHeadings($data);
        $headings = '<tr><th>' . $headings->join('</th><th>') . '</th></tr>';

        $rows = [];
        foreach ($data as $dataRow) {
            $row = '<tr>';
            foreach ($dataRow as $key => $value) {
                $row .= '<td>' . $value . '</td>';
            }
            $row .= '</tr>';
            $rows[] = $row;
        }
        $rows = implode('', $rows);

        return '<table>' . $headings . $rows . '</table>';
    }

}