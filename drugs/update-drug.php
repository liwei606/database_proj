<?php
require_once __DIR__ . '/config.php';

$id = fRequest::get('id', 'integer');
$name = fRequest::get('name', 'string');
$inventory = fRequest::get('inventory', 'integer');
$toxicity = fRequest::get('toxicity', 'integer');

// 检查输入参数的正确性，如果出错抛异常 fValidationException
if (strlen($name) === 0) {
	throw new fValidationException('药品名称不能为空');
}
if ($inventory <= 0) {
	throw new fValidationException('库存必须大于零');
}
$drug = new Drug($id);

$db = fORMDatabase::retrieve();
$db->execute('BEGIN');
$db->execute('UPDATE drugs SET name=%s, inventory=%i, toxicity=%i WHERE id=%i', $name, $inventory, $toxicity, $id);
$db->execute('INSERT INTO drug_update_records '.
	'(drug_id, drug_name, update_time, operator, operation) '.
	'VALUES (%i, %s, NOW(), %s, %i)',
	$id, $name, $_SESSION['username'], DrugUpdateRecord::UPDATE);
$db->execute('COMMIT');
fMessaging::create('success', 'admin-drugs.php', '药品更新成功');
fURL::redirect('admin-drugs.php');
