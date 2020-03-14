<?php

use function PHPSTORM_META\type;

class DatabaceContext
{
    public static function ConnectTo($databace) {
        return $databace->Connect("localhost.username.password");
    }
}

abstract class DatabaceBase {
    abstract public function Connect($net);
}

class ExampleDatabace extends DatabaceBase
{
    private $Data;
    public function Connect($net) {
        $this->Data = explode(".", $net);
        return $this;
    }

    public function TestCollection() {
        return new Table($this->Data[0], $this->Data[1], $this->Data[2], "test");
    } 
    public function ExampleCollection() {
        return new Table($this->Data[0], $this->Data[1], $this->Data[2], "example");
    } 
}

class Table
{
    private $Client;
    private $IsOpen = false;

    public function Table($host, $user, $password, $table) {
        $this->Connect($host, $user, $password, $table);
    }

    public function IsConnect() {
        return $this->IsOpen;
    }

    private function Connect($host, $user, $password, $table) {
        try {
            $this->Client = mysqli_connect($host, $user, $password, $table);
            $this->IsOpen = !!$this->Client;
        } catch (RuntimeException $e) {
            $this->IsOpen = false;
        }
    }

    public function Close() {
        if ($this->IsOpen)
            mysqli_close($this->Client);
        $this->IsOpen = false;
    }

    public function Send($request) {
        try {
            return new TableReader(mysqli_query($this->Client, $request), $this->IsOpen);
        } catch (\Throwable $th) {
            return new TableReader(null, false);
        }
    }
}

class TableReader {
    private $Result;
    private $IsCan = false;
    private $Data = array();

    public function TableReader($result, $iscan) {
        $this->Result = $result;
        $this->IsCan = $iscan;
    }

    public function IsCan() {
        return $this->IsCan;
    }

    public function Read() {
        if ($this->IsCan)
            return $this->Data = mysqli_fetch_assoc($this->Result);
        else
            return false;
    }

    public function Get() {
        return $this->Data;
    }
}

?>
