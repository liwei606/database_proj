<?php
require_once __DIR__ . '/config.php';
$query = fRequest::get('q');
$page = fRequest::get('page', 'integer', 1);
$slot = (int)(($page - 1) / 5);
$drugs = fRecordSet::build('Drug', array('name~' => $query), array(), 20, $page);
include __DIR__ . '/header.php';
?>
<h1>药品列表</h1>
<?php fMessaging::show('success', 'drugs.php'); ?>
<table class="table table-striped table-bordered table-hover">
<tr>
  <th>药品编号</th>
  <th>药品名称</th>
  <th>毒性</th>
  <th>库存</th>
  <th></th>
</tr>
<?php foreach ($drugs as $drug): ?>
<tr>
  <td><?= $drug->getId() ?></td>
  <td><?= $drug->getName() ?></td>
  <td><?= $drug->getToxicityName() ?></td>
  <td><?= $drug->getInventory() ?></td>
  <td>
    <form class="form-inline" method="POST" action="apply.php">
      <input type="hidden" name="drug_id" value="<?= $drug->getId() ?>">
      <div class="input-append">
        <input type="number" class="input-small" name="dosage" placeholder="剂量">
        <button class="btn" type="submit">申请使用</button>
      </div>
    </form>
  </td>
</tr>
<?php endforeach; ?>
</table>
<?php
include __DIR__ . '/footer.php';
?>
<div class="pagination pagination-centered">
  <ul>
    <li><a href="?q=<?= $query ?>&page=<?= $page-1 ?>">&laquo; 上一页</a><li>
    <?php for ($p = $slot * 5 + 1; $p <= $slot * 5 + 5; $p++): ?>
	  <li><a href="?q=<?= $query ?>&page=<?= $p ?>"><?= $p ?></a></li>
	<?php endfor; ?>
	<li><a href="?q=<?= $query ?>&page=<?= $page+1; ?>">下一页 &raquo;</a></li>
  </ul>
</div>
