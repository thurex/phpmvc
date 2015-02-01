<?php

namespace Anax\ThurexTable;
use Exception;

/**
 * A helper to create tables.
 *
 */
class CSimpleTable {
    
    private $tableContent;
    private $html;
    private $styleTable; //Style for <table>
    private $styleTd; //Style for <td>
    private $styleTrTh; //Table row TH, Style for <tr> for header
    private $styleTrOdd; //Table row odd number, Style for <tr>
    private $styleTrEven; //Table row even number, Style for <tr>
    private $styleTh; //Style for <th>
    private $class=array(); //css classes


    /**
     * 
     * @param String array $tableContent, content to fill table
     * @param String $style, call for method of style
     * @param String array $class, css classes for different html prefix
     * 
     * Fill $class in call as follow:
     * //$class = array('styleTable'=>null, 'styleTd'=>null, 'styleTrTh'=>null, 'styleTrOdd'=>null, 'styleTrEven'=>null, 'styleTh'=>null);
     */
    public function __construct($tableContent, $style, $class = NULL) {
        //$class = array('styleTable'=>null, 'styleTd'=>null, 'styleTrTh'=>null, 'styleTrOdd'=>null, 'styleTrEven'=>null, 'styleTh'=>null);
        $this->class = $class;
        $this->tableContent = $tableContent;
        
        if ($class != null){
            try {
                $this->fillClass($class);
                $this->class=$class;
            } catch (\Exception $ex) {
            }    
        }
        if (method_exists($this, $style)){
            $this->$style();
        }
        else {
            $this->defaultStyle();
        }
    }
    
    private function fillClass($class){
        if (count($class)!=6){
            throw new Exception("Wrong input of class -array");
        }
        else {
            $this->class=$class;
        }
    }


    /**
     * 
     * @return String $html, html code
     */
    public function getHTML(){        
        $maxHeight = count( $this->tableContent );
        $maxWidth = max( array_map( 'count',  $this->tableContent ) );
        //$html = "<table border= {$this->border['5']}><tr>";
        $html = "<table {$this->styleTable}><tr {$this->styleTrTh}>";
        for ($header=0; $header<$maxWidth; $header++){
            $html .= "<th {$this->styleTh}> {$this->tableContent[0][$header]} </th>";
        }
        $html .= "</tr>";
        for ($row = 1; $row < $maxHeight; $row++) {
            if ($row%2>0){
                $html .= "<tr $this->styleTrEven>";
            }
            else {      
                $html .= "<tr $this->styleTrOdd>";
            }
            for ($col = 0; $col<$maxWidth; $col++) {
                $html .= "<td {$this->styleTd} > {$this->tableContent[$row][$col]} </td>";
            }
            $html .= "</tr>";
        }
        $html .= "</table>";
        $this->html=$html;
        return $html;
    }
    
    /**
     * Style for table
     */
    private function defaultStyle(){
        $this->styleTable = null;
        $this->styleTd = null;
        $this->styleTr = null;
        $this->styleTh = null;                
    }
    
    /**
     * Style for table
     */
    private function greenStyle(){
        $this->styleTable = " class = '{$this->class['styleTable']}' border = 0px style = 'background-color:#A7C942;color:black;padding:4px 10px 4px 5px;'";
        $this->styleTh = "border-collapse: collapse style = "
                . "color:black;"
                . "padding:4px 10px 4px 5px;"
                . "font-weight:bold'";
        $this->styleTd = "style = 'padding:4px 10px 4px 5px;'";
        $this->styleTrOdd =     "class = '{$this->class['styleTrOdd']}' border = 5px style = 'background-color:#A7C942;color:black;'";
        $this->styleTrEven =    "class = '{$this->class['styleTrEven']}' border = 5px style = 'background-color:#A7C100;color:black;'";
        $this->styleTrTh =      "class = '{$this->class['styleTrTh']}' style = 'padding:4px 10px 4px 5px;background-color:#A7E942;color:blue'";        
    }
    
    /**
     * Style for table
     */
    private function grayStyle(){
        $this->styleTable = " class = '{$this->class['styleTable']}' border = 1px color: #E1E1E1 style = 'background-color:#E1E1E1;color:black;padding:4px 10px 4px 5px;'";
        $this->styleTh = "border-collapse: collapse style = "
                . "color:black;"
                . "padding:4px 10px 4px 5px;"
                . "font-weight:bold'";
        $this->styleTd = "style = 'padding:4px 10px 4px 5px;'";
        $this->styleTrOdd =     "class = '{$this->class['styleTrOdd']}' border = 5px style = 'background-color:#797C80;color:black;'";
        $this->styleTrEven =    "class = '{$this->class['styleTrEven']}' border = 5px style = 'background-color:#C1C1C1;color:black;'";
        $this->styleTrTh =      "class = '{$this->class['styleTrTh']}' style = 'padding:4px 10px 4px 5px;background-color:#E1E1E1;color:blue'";        
    }
}