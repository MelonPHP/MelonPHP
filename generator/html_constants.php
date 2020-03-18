<?php

class HtmlMainAxisAligment
{
  const Center = "center";
  const Start = "flex-start";
  const End = "flex-end";
  const Between = "space-between";
  const Around = "space-around";  
}

class HtmlCrossAxisAligment
{
  const Center = "center";
  const Start = "flex-start";
  const End = "flex-end";
  const Baseline = "baseline";
  const Scretch = "stretch";
}

const AutoFit = "auto-fit";
const Auto = "auto";

const Px = "px";
const Pr = "%";
const Pr100 = "100%";
const Fr = "fr";

const White = "white";
const Transparent = "transparent";
const Black = "black";
const Red = "red";
const Blue = "blue";
const Green = "green";
const Gray = "gray";
const Orange = "orange";
const Yellow = "yellow";

function Px($value) : string {
  return $value.Px;
}

function Fr($value) : string {
  return $value.Fr;
}

function Pr($value) : string {
  return $value.Pr;
}

function Hex($value) : string {
  return "#".$value;
}

function Rgba($r, $g, $b, $a) : string {
  return "rgba(".DotL($r, $g, $b, $a).")";
}

function Url($value) : string {
  return "url(".$value.")";
}

function SpaceL(...$params) {
  $line = "";
  foreach ($params as $value) {
    $line .= $value." ";
  }
  if (strlen($line) > 1) {
    $line = substr($line, 0, -1);
  }
  return $line;
}

function DotL(...$params) {
  $line = "";
  foreach ($params as $value) {
    $line .= $value.", ";
  }
  if (strlen($line) > 2) {
    $line = substr($line, 0, -2);
  }
  return $line;
}

const Width = "width";
const MaxWidth = "max-width";
const MinWidth = "min-width";

const Height = "height";
const MaxHeight = "max-height";
const MinHeight = "min-height";

const Margin = "margin";
const MarginLeft = "margin-left";
const MarginRight = "margin-right";
const MarginTop = "margin-top";
const MarginBotton = "margin-botton";

const Padding = "padding";
const PaddingLeft = "padding-left";
const PaddingRight = "padding-right";
const PaddingTop = "padding-top";
const PaddingBotton = "padding-botton";

const BackgroundImage = "background-image";
const BackgroundColor = "background-color";
const Color = "color";

const Border = "border";
const BorderRadius = "border-radius";

const FontWeight = "font-weight";
const FontSize = "font-size";
const FontFamily = "font-family";

const BoxShadow = "box-shadow";

?>