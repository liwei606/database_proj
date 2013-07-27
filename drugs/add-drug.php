<?php
require_once __DIR__ . '/config.php';

$id = fRequest::get('id');
$inventory = fRequest::get('inventory', 'integer');

if ($inventory <= 0) {
	throw new fValidationException('库存必须大于零');
}
$drug = new Drug($id); // 如果不存在会抛异常

$db = fORMDatabase::retrieve();
$db->execute('BEGIN');
$db->execute('UPDATE drugs SET inventory=inventory+%i WHERE id=%i', $inventory, $id);
$db->execute('INSERT INTO drug_update_records '.
	'(drug_id, drug_name, update_time, operator, operation) '.
  'SELECT id, name, NOW(), %s, %i FROM drugs WHERE id=%i',
	$_SESSION['username'], DrugUpdateRecord::ADD, $id);
// FIXME Flourish有BUG，如果上一行少一个参数（$id），事务不会失败但是dur没有插进去
$db->execute('COMMIT');
fMessaging::create('success', 'admin-drugs.php', '药品库存添加成功');
?>{ "status":"ok" }