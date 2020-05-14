<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");

class Argument extends GeneratedObject
{
  private $Name = "";
  private $ItemsQuery = array();

  function SetName(string $string) {
    $this->Name = $string;
    return $this;
  }

  function GetName() : string {
    return $this->Name;
  }

  function AddItem(string $string) {
    array_push($this->ItemsQuery, $string);
    return $this;
  }

  function GetItems() : array {
    return $this->ItemsQuery;
  }

  private function GenerateItems() : string {
    $items = "";
    $itemsCount = count($this->ItemsQuery);
    for ($i=0; $i < $itemsCount; $i++) {
      $item = $this->ItemsQuery[$i];
      $items .= $item.($i == $itemsCount - 1 ? "" : " ");
    }
    return $items;
  }

  function Generate() : string {
    return $this->Name."='".$this->GenerateItems()."'";
  }
}