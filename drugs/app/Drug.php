<?php
class Drug extends fActiveRecord
{
  protected function configure()
  {
  }

  public function getToxicityName()
  {
    $names = array('无毒', '有毒');
    return $names[$this->getToxicity()];
  }

  public function isPoisonous()
  {
    return $this->getToxicity() > 0;
  }

  public static function fetchName($drugId)
  {
    $drug = new Drug($drugId);
    return $drug->getName();
  }
}

