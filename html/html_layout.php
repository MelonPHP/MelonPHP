<?php

require_once("html/html_core.php");

class HtmlContainer extends HtmlComponent
{
    private $Child;

    public function SetChild($child) {
        $this->Child = $child;
        return $this;
    }

    public function Generate() {
        return "<div".$this->GenerateArgs().">".$this->Child->Generate()."</div>";
    }
}

abstract class HtmlQuery extends HtmlComponent
{
    protected $Query = array();

    public function AddItem($item) {
        array_push($this->Query, $item);
        return $this;
    }

    protected function GenerateQuery() {
        $squery = "";

        foreach ($this->Query as &$item) {
            $squery .= $item->Generate();
        }

        return $squery;
    }
}

class HtmlColumn extends HtmlQuery
{
    public function Generate() {
        return "<div".$this->GenerateArgs().">".$this->GenerateQuery()."</div>";
    }
}

?>