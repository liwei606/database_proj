<?php
require_once __DIR__ . '/config.php';

$application_id = fRequest::get('application_id', 'integer');
$dosage = fRequest::get('approved_dosage', 'integer');

if ($dosage < 0) {
  throw new fValidationException('批准剂量必须大于或等于零');
}

$application = new Application($application_id);
$drug_id = $application->getDrugId();

$drug = new Drug($drug_id);
if ($drug->getInventory() < $dosage) {
  throw new fValidationException('库存不足');
}

// 1. 减库存
// 2. 创建 approval
// 3. 保存 application
$db = fORMDatabase::retrieve();
$db->execute('BEGIN');
$db->execute('UPDATE drugs SET inventory=inventory-%i WHERE id=%i', $dosage, $drug_id);
$db->execute('INSERT INTO approvals (approved_by, approve_time, approved_dosage) VALUES (%s, NOW(), %i)', $_SESSION['username'], $dosage);
$db->execute('UPDATE applications SET approval_id=LAST_INSERT_ID() WHERE id=%i', $application_id);
$db->execute('COMMIT');
fMessaging::create('success', 'all-applications.php', '请求处理成功');
?>{ "status":"ok" }