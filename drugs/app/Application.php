<?php
class Application extends fActiveRecord
{
  protected function configure()
  {
  }

  public function getApplicantName()
  {
    return User::fetchName($this->getApplicant());
  }

  public function getDrugName()
  {
    return Drug::fetchName($this->getDrugId());
  }

  public function isApproved()
  {
    return $this->getApprovalId() !== null;
  }

  public function getApproval()
  {
    return new Approval($this->getApprovalId());
  }
}
