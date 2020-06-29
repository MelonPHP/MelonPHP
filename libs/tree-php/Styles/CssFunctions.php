<?php

require_once(__DIR__ . "/CssConstants.php");

function Px($value) : string {
  return $value.Px;
}

function Fr($value) : string {
  return $value.Fr;
}

function Pr($value) : string {
  return $value.Pr;
}

function Em($value) : string {
  return $value.Em;
}

function Hex($value) : string {
  return "#".$value;
}

function Rgb($r, $g, $b) : string {
  return "rgb(".CommaLine([$r, $g, $b]).")";
}

function Rgba($r, $g, $b, $a) : string {
  return "rgba(".CommaLine([$r, $g, $b, $a]).")";
}

function Url($value) : string {
  return "url(\"".$value."\")";
}

function MinMax($min, $max) : string {
  return "minmax(".$min.", ".$max.")";
}

function Repeat($start, $end) : string {
  return "repeat(".$start.", ".$end.")";
}

function Local(string $string) : string {
  return "local(".$string.")";
}

// TODO: Add scale to 1 to 2 args ctr
function Scale(string $width, string $height) : string {
  return "scale(".$width.", ".$height.")";
}

// TODO: Add translate to 1 to 2 args ctr
function Translate(string $x, string $y) : string {
  return "translate(".$x.", ".$y.")";
}

function Format(string $string) : string {
  return "format(".$string.")";
}

function Blur(string $string) : string {
  return "blur(".$string.")";
}

function FitContent($start, $end) : string {
  return "fit-content(".$start.", ".$end.")";
}

function Line(string $prefix_right, array $params) : string {
  $length = strlen($prefix_right);
  $line = "";
  foreach ($params as $value) {
    $line .= $value.$prefix_right;
  }
  if (strlen($line) > $length) {
    $line = substr($line, 0, -$length);
  }
  return $line;
}

function SpaceLine(array $params) : string {
  return Line(Sp, $params);
}

function CommaLine(array $params) : string {
  return Line(Cm, $params);
}

function WebKit(string $value) : string {
  return "-webkit-".$value;
}

// function MozOSX(string $value) {
//  return "-moz-osx-".$value;
// }

function Moz(string $value) : string {
  return "-moz-".$value;
}