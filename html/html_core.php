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
        $this->StyleArgument->AddItem($string.";");
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
            return " ".(mb_substr($squery, 0, strlen($squery) - 3))."\"";
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

    public function ClearItemQuery() {
        $this->ItemsQuery = array();
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

class HtmlBuilder extends HtmlBase
{
    private $Function;
    private $Arg = null;

    public function __construct() {
        $numargs = func_num_args();
        $args = func_get_args();

        if ($numargs == 2) {
            $this->Arg = $args[0];
            $this->Function = $args[1];
        }
        else if ($numargs == 1) {
            $this->Function = $args[0];
        }
        else
            throw new Exception("bad ciinstructor args");
    }
    
    public function Generate() {
        if ($this->Arg != null)
            return call_user_func($this->Function, $this->Arg)->Generate();
        else
            return call_user_func($this->Function, array())->Generate();
        
    }
}

abstract class HtmlElement extends HtmlBase
{
    protected $Context;

    public function __construct() {
        $this->Context = new HtmlContext($this);
    }

    public function Run() {
        HtmlElement::RunOf($this->Build());
    }

    public static function RunOf($item) {
        echo @$item->Generate();
    }

    public function Generate() {
        return $this->Build()->Generate();
    }

    abstract public function Build();
}

abstract class HtmlStreamElement extends HtmlElement
{

}

class HtmlContext
{
    private $Id;
    private $Element;
    public function __construct($element) {
        $this->Id = random_int(0, 10000000);
        $this->Element = $element;
    }

    public function UpdateState() {
        header("Refresh:0");
    }

    public function GetId() {
        return $this->Id;
    }
}

class HtmlNullable extends HtmlBase {
    public function Generate() {
        return "";
    }
}

?>