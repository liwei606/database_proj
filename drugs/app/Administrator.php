<?php
class Administrator extends fActiveRecord
{
  protected function configure()
  {
  }

  public static function fetchName($username)
  {
    $user = new Administrator($username);
    return $user->getName();
  }
}
