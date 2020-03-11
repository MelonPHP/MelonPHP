<?php

abstract class HtmlBase
{
    abstract public function Generate();
}

abstract class HtmlComponent extends HtmlBase
{
    private $ArgsQuery = array();

    private $StyleArgument;
    private $ClassArgument;

    public function AddStyleItem($string) {
        $this->StyleArgument->AddItem($string);
        return $this;
    }

    public function AddClassItem($string) {
        $this->ClassArgument->AddItem($string);
        return $this;
    }

    public function __construct()
    {
        $this->StyleArgument = (new HtmlArgument)->SetName("style");
        $this->ClassArgument = (new HtmlArgument)->SetName("class");
    }

    public function AddArgument($argument) {
        array_push($this->ArgsQuery, $argument);
        return $this;
    }

    protected function GenerateArgs() {
        $args = $this->ArgsQuery;
        array_push($args, $this->StyleArgument);
        array_push($args, $this->ClassArgument);

        $squery = "";
        foreach ($args as &$item) {
            if (!$item->IsEmpty())
                $squery .= $item->Generate()." ";
        }
        if (strlen($squery) > 0)
            return " ".$squery;
        else
            return null;
    }
}

class HtmlArgument
{
    private $Name = "";
    private $ItemsQuery = array();

    public function SetName($name) {
        if (gettype($name) === gettype(""))
            $this->Name = $name;
        return $this;
    }

    public function IsEmpty()
    {
        return !(count($this->ItemsQuery) > 0);
    }

    public function AddItem($item) {
        array_push($this->ItemsQuery, $item);
        return $this;
    }

    public function Generate() {
        $squery = "";
        foreach ($this->ItemsQuery as &$item) {
            $squery .= strval($item)." ";
        }
        if (strlen($squery) > 0)
            return $this->Name."=\"".$squery."\"";
        else
            return null;
    }
}

abstract class HtmlElement
{
    abstract function Build();

    function Run() {
        echo $this->Build()->Generate();
    }

    static function RunOf($item) {
        echo $item->Generate();
    }
}

class HtmlNullable extends HtmlBase {
    public function Generate() {
        return "";
    }
}

?>