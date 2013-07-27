<?php
require_once __DIR__ . '/config.php';
$query = fRequest::get('q');
$durs = fRecordSet::build('DrugUpdateRecord', array('drug_name~' => $query));
include __DIR__ . '/header.php';
?>
<h1>药品更改记录</h1>
<?php fMessaging::show('success', 'history.php'); ?>
<table class="table table-striped table-bordered table-hover">
<tr>
  <th>记录编号</th>
  <th>操作类别</th>
  <th>药品编号</th>
  <th>药品名称</th>
  <th>操作人</th>
  <th>更改时间</th>
</tr>
<?php foreach ($durs as $dur): ?>
<tr>
  <td><?= $dur->getId() ?></td>
  <td><?= $dur->getOperationName() ?></td>
  <td><?= $dur->getDrugId() ?></td>
  <td><?= $dur->getDrugName() ?></td>
  <td><?= $dur->getOperatorName() ?></td>
  <td><?= $dur->getUpdateTime() ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php
include __DIR__ . '/footer.php';
