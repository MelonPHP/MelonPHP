<?php

require_once("html/html_core.php");

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

?>