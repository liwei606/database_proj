<?php
class User extends fActiveRecord
{
  protected function configure()
  {
  }

  public static function fetchName($username)
  {
    $user = new User($username);
    return $user->getName();
  }
}
