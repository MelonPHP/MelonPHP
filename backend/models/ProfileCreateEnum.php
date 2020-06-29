<?php

class ProfileCreateEnum
{
  const BadName = 1;
  const BadLastName = 2;
  const BadLogin = 3;
  const BadPassword = 4;
  const Exists = 5;
  const Ok = 0;
  const ServerError = -1;
}