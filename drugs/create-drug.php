<?php
require_once __DIR__ . '/config.php';

$name = trim(fRequest::get('name', 'string'));
$inventory = fRequest::get('inventory', 'integer');
$toxicity = fRequest::get('toxicity', 'integer');

// 检查输入参数的正确性，如果出错抛异常 fValidationException
if (strlen($name) === 0) {
	throw new fValidationException('药品名称不能为空');
}
if ($inventory <= 0) {
	throw new fValidationException('库存必须大于零');
}

$db = fORMDatabase::retrieve();
$db->execute('BEGIN');
$db->execute('INSERT INTO drugs (name, inventory, toxicity) VALUES (%s, %i, %i)', $name, $inventory, $toxicity);
$db->execute('INSERT INTO drug_update_records '.
	'(drug_id, drug_name, update_time, operator, operation) '.
	'VALUES (LAST_INSERT_ID(), %s, NOW(), %s, %i)',
	$name, $_SESSION['username'], DrugUpdateRecord::CREATE);
$db->execute('COMMIT');
fMessaging::create('success', 'admin-drugs.php', '药品添加成功');
fURL::redirect('admin-drugs.php');
