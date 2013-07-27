<?php
require_once __DIR__ . '/config.php';
$query = fRequest::get('q');
$notifications = fRecordSet::build('InventoryNotification', array('drug_id~' => $query));
include __DIR__ . '/header.php';
?>
<h1>库存提醒</h1>
<?php fMessaging::show('success', 'notifications.php'); ?>
<table class="table table-striped table-bordered table-hover">
<tr>
  <th>提醒编号</th>
  <th>药品编号</th>
  <th>药品名称</th>
  <th>提醒时库存量</th>
  <th>提醒时间</th>
</tr>
<?php foreach ($notifications as $notification): ?>
<tr>
  <td><?= $notification->getId() ?></td>
  <td><?= $notification->getDrugId() ?></td>
  <td><?= $notification->getDrugName() ?></td>
  <td><?= $notification->getInventory() ?></td>
  <td><?= $notification->getCreateTime() ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php
include __DIR__ . '/footer.php';
