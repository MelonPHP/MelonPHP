<?php

require_once("html/html_core.php");

class HtmlTable extends HtmlComponent
{
    private $LinesQuery = array();

    public function IsQueryEmpty() {
        return !(count($this->LinesQuery) > 0);
    }

    public function AddLine($line) {
        array_push($this->LinesQuery, $line);
        return $this;
    }

    public function Generate() {
        $slines = "";
        foreach ($this->LinesQuery as &$line) {
            $slines .= $line->Generate();
        }

        return "<table".$this->GenerateArgs().">".$slines."</tr>";
    }
}

class HtmlTableLine extends HtmlComponent
{
    private $TableItemsQuery = array();

    public function IsQueryEmpty() {
        return !(count($this->TableItemsQuery) > 0);
    }
    
    public function AddItem($item) {
        array_push($this->TableItemsQuery, $item);
        
        return $this;
    }

    public function Generate() {
        $items = "";
        foreach ($this->TableItemsQuery as $item) {
            $items .= $item->Generate();
        }

        return "<tr".$this->GenerateArgs().">".$items."</tr>";
    }
}

class HtmlTableItem extends HtmlComponent
{
    private $Item;
    
    public function SetItem($item) {
        $this->Item = $item;
        return $this;
    }

    public function Generate() {
        return "<td".$this->GenerateArgs().">".$this->Item->Generate()."</td>";
    }
}

?>