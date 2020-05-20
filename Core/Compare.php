<?php

function Compare(bool $is, $yes, $no) {
  if ($is)
    return $yes;
  else
    return $no;
}