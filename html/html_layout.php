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

class HtmlCenter extends HtmlComponent
{
    private $Item;

    public function __construct() {
        parent::__construct();
        $this
        ->AddStyleItem("margin: 0 auto");
    }

    public function SetItem($item) {
        $this->Item = $item;
        return $this;
    }

    public function Generate() {
        return "<div".$this->GenerateArgs().">".$this->Item->Generate()."</div>";
    }
}

class HtmlVertivalScroll extends HtmlComponent
{
    private $Item;

    public function __construct() {
        parent::__construct();
        $this
        ->AddStyleItem("overflow-y: auto");
    }

    public function SetItem($item) {
        $this->Item = $item;
        return $this;
    }

    public function Generate() {
        return "<div".$this->GenerateArgs().">".$this->Item->Generate()."</div>";
    }
}

class HtmlHorizontalScroll extends HtmlComponent
{
    private $Item;

    public function __construct() {
        parent::__construct();
        $this
        ->AddStyleItem("overflow-x: auto");
    }

    public function SetItem($item) {
        $this->Item = $item;
        return $this;
    }

    public function Generate() {
        return "<div".$this->GenerateArgs().">".$this->Item->Generate()."</div>";
    }
}

class HtmlSeparator extends HtmlComponent
{
    public function __construct() {
        parent::__construct();
        $this->AddStyleItem("border : 0");
        $this->AddStyleItem("height : 1px");
        $this->AddStyleItem("background : #c2c2c2");
    }

    public function Generate() {
        return "<hr".$this->GenerateArgs()."/>";
    }
}


?>