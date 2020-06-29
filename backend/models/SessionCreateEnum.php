<?php

class SessionCreateEnum
{
  const BadLogin = 1;
  const BadPassword = 2;
  const Ok = 0;
  const UserNotExists = 3;
  const ServerError = -1;
}