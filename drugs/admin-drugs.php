<?php
require_once __DIR__ . '/config.php';
$query = fRequest::get('q');
$page = fRequest::get('page', 'integer', 1);
$slot = (int)(($page - 1) / 5);
$drugs = fRecordSet::build('Drug', array('name~' => $query), array(), 20, $page);
include __DIR__ . '/header.php';
?>
<h1>药品列表</h1>
<?php fMessaging::show('success', 'admin-drugs.php'); ?>
<table class="table table-striped table-bordered table-hover">
<tr>
  <th>药品编号</th>
  <th>药品名称</th>
  <th>毒性</th>
  <th>库存</th>
	<th><a href="#createDrug" role="button" class="btn btn-small btn-success" data-toggle="modal">添加药品</a></th>
</tr>
<?php foreach ($drugs as $drug): ?>
<tr>
  <td><?= $drug->getId() ?></td>
  <td><?= $drug->getName() ?></td>
  <td><?= $drug->getToxicityName() ?></td>
  <td><?= $drug->getInventory() ?></td>
  <td>
    <button type="button" class="btn btn-small btn-primary" onclick="addDrug('<?= $drug->getId() ?>')">增加库存</button>
    <button type="button" class="btn btn-small btn-warning" onclick="updateDrug('<?= $drug->getId() ?>','<?= $drug->getName() ?>',<?= $drug->getInventory() ?>,<?= $drug->getToxicity() ?>)">编辑</button>
    <button type="button" class="btn btn-small btn-danger" onclick="deleteDrug('<?= $drug->getId() ?>')">删除</button>
  </td>
</tr>
<?php endforeach; ?>
</table>
<form id="createDrug" class="form-horizontal modal hide fade" method="POST" action="create-drug.php" role="dialog">
	<div class="modal-header">
		<button class="close" data-dismiss="modal">×</button>
		<h3>添加药品</h3>
	</div>
	<div class="modal-body">
    <div class="control-group">
      <label class="control-label" for="inputName">药品名称</label>
      <div class="controls">
        <input type="text" id="inputName" placeholder="" name="name">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="inputInventory">库存</label>
      <div class="controls">
        <input type="number" id="inputInventory" placeholder="" name="inventory">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">毒性</label>
      <div class="controls">
				<div class="btn-group" data-toggle="buttons-radio" data-toggle-name="toxicity">
				  <button type="button" class="btn" data-toggle="button" value="0">无毒</button>
				  <button type="button" class="btn" data-toggle="button" value="1">有毒</button>
				</div>
				<input type="hidden" name="toxicity" value="0">
			</div>
    </div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" type="submit">保存</button>
		<button class="btn" data-dismiss="modal">取消</button>
	</div>
</form>
<form id="updateDrug" class="form-horizontal modal hide fade" method="POST" action="update-drug.php" role="dialog">
	<div class="modal-header">
		<button class="close" data-dismiss="modal">×</button>
		<h3>编辑药品</h3>
	</div>
	<div class="modal-body">
    <input type="hidden" id="ud_inputId" name="id">
    <div class="control-group">
      <label class="control-label" for="ud_inputName">药品名称</label>
      <div class="controls">
        <input type="text" id="ud_inputName" placeholder="" name="name">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="ud_inputInventory">库存</label>
      <div class="controls">
        <input type="number" id="ud_inputInventory" placeholder="" name="inventory">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">毒性</label>
      <div class="controls">
				<div class="btn-group" data-toggle="buttons-radio" data-toggle-name="toxicity">
				  <button type="button" id="ud_toxicity0" class="btn" data-toggle="button" value="0">无毒</button>
				  <button type="button" id="ud_toxicity1" class="btn" data-toggle="button" value="1">有毒</button>
				</div>
				<input type="hidden" id="ud_inputToxicity" name="toxicity">
			</div>
    </div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" type="submit">保存</button>
		<button class="btn" data-dismiss="modal">取消</button>
	</div>
</form>
<?php
include __DIR__ . '/footer.php';
?>
<div class="pagination pagination-centered">
  <ul>
    <li><a href="?page=<?= $page-1 ?>">&laquo; 上一页</a><li>
    <?php for ($p = $slot * 5 + 1; $p <= $slot * 5 + 5; $p++): ?>
	  <li><a href="?page=<?= $p ?>"><?= $p ?></a></li>
	<?php endfor; ?>
	<li><a href="?page=<?= $page+1; ?>">下一页 &raquo;</a></li>
  </ul>
</div>
