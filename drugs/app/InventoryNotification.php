<?php
class InventoryNotification extends fActiveRecord
{
  protected function configure()
  {
  }
  
  public function getDrugName()
  {
    return Drug::fetchName($this->getDrugId());
  }
}
