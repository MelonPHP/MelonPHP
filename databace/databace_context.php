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
    private $IsOpen;

    public function Table($host, $user, $password, $table) {
        $this->Connect($host, $user, $password, $table);
    }

    public function IsConnect() {
        return $this->IsOpen;
    }

    private function Connect($host, $user, $password, $table) {
        $this->Client = mysqli_connect($host, $user, $password, $table);

        $this->IsOpen = !!$this->Client;
    }

    public function Close() {
        mysqli_close($this->Client);
        $this->IsOpen = false;
    }

    public function Send($request) {
        return new TableReader(mysqli_query($this->Client, $request));
    }
}

class TableReader {
    private $Result;
    private $IsCan;
    private $Data;

    public function TableReader($result) {
        $this->Result = $result;
    }

    public function Read() {
        return $this->Data = mysqli_fetch_assoc($this->Result);
    }

    public function Get() {
        return $this->Data;
    }
}

?>
