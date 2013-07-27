<?php
require_once __DIR__ . '/config.php';

$id = fRequest::get('id');
$drug = new Drug($id); // 如果不存在会抛异常

$db = fORMDatabase::retrieve();
$db->execute('BEGIN');
$db->execute('INSERT INTO drug_update_records '.
	'(drug_id, drug_name, update_time, operator, operation) '.
  'SELECT id, name, NOW(), %s, %i FROM drugs WHERE id=%i',
	$_SESSION['username'], DrugUpdateRecord::DELETE, $id);
$db->execute('DELETE FROM drugs WHERE id=%i', $id);
$db->execute('COMMIT');
fMessaging::create('success', 'admin-drugs.php', '药品库存添加成功');
?>{ "status":"ok" }