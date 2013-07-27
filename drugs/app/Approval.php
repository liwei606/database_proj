<?php
class Approval extends fActiveRecord
{
  protected function configure()
  {
  }

  public function getApprovedByName()
  {
    if ($this->getApprovedBy() === null) {
      return "(系统自动批准)";
    }
    return Administrator::fetchName($this->getApprovedBy());
  }
}
