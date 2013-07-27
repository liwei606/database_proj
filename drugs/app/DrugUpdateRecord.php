<?php
class DrugUpdateRecord extends fActiveRecord
{
  protected function configure()
  {
  }
	
	const CREATE = 1;
	const UPDATE = 2;
	const DELETE = 3;
	const ADD    = 4;
  
  public function getOperationName()
  {
    if ($this->getOperation() == DrugUpdateRecord::CREATE)
      return '添加药品';
    else if ($this->getOperation() == DrugUpdateRecord::UPDATE)
      return '更新药品';
    else if ($this->getOperation() == DrugUpdateRecord::DELETE)
      return '删除药品';
    else if ($this->getOperation() == DrugUpdateRecord::ADD)
      return '添加库存';
    return $this->getOperation();
  }
  
  public function getOperatorName()
  {
    return Administrator::fetchName($this->getOperator());
  }
}
