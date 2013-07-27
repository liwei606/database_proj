<?php
require_once __DIR__ . '/config.php';

$drug_id = fRequest::get('drug_id', 'integer');
$dosage = fRequest::get('dosage', 'integer');

if ($dosage <= 0) {
  throw new fValidationException('申请剂量必须大于零');
}

$drug = new Drug($drug_id);
if ($drug->getInventory() < $dosage) {
  throw new fValidationException('库存不足');
}

$application = new Application();
$application->setApplicant($_SESSION['username']);
$application->setApplyTime(new fTimestamp());
$application->setDrugId($drug->getId());
$application->setAppliedDosage($dosage);

if ($drug->isPoisonous()) {
  // 需要审批
  $application->store();
  fMessaging::create('success', 'drugs.php', '申请已提交，等待审批。');
  fURL::redirect('drugs.php');
}
else {
  // 直接减少库存，自动批准
  // 1. 减库存
  // 2. 创建 approval
  // 3. 保存 application
  $db = fORMDatabase::retrieve();
  $db->execute('BEGIN');
  $db->execute('UPDATE drugs SET inventory=inventory-%i WHERE id=%i', $dosage, $drug->getId());
  $db->execute('INSERT INTO approvals (approve_time, approved_dosage) VALUES (%p, %i)', $application->getApplyTime(), $dosage);
  $db->execute('INSERT INTO applications (applicant, apply_time, drug_id, applied_dosage, approval_id) VALUES (%s, %p, %i, %i, LAST_INSERT_ID())',
    $application->getApplicant(), $application->getApplyTime(), $application->getDrugId(), $application->getAppliedDosage());
  $db->execute('COMMIT');
  fMessaging::create('success', 'drugs.php', '药品无毒，申请自动批准。');
  fURL::redirect('drugs.php');
}

