<?php
require_once __DIR__ . '/config.php';
$query = fRequest::get('q');
$applications = fRecordSet::build('Application', array('applicant~' => $query));
include __DIR__ . '/header.php';
?>
<h1>申请结果</h1>
<?php fMessaging::show('success', 'all-applications.php'); ?>
<table class="table table-striped table-bordered table-hover">
<tr>
  <th>申请编号</th>
  <th>申请人</th>
  <th>申请药品</th>
  <th>申请药品剂量</th>
  <th>申请时间</th>
  <th>批准人</th>
  <th>批准药品剂量</th>
  <th>批准时间</th>
</tr>
<?php foreach ($applications as $application): ?>
<tr>
  <td><?= $application->getId() ?></td>
  <td><?= $application->getApplicantName() ?></td>
  <td><?= $application->getDrugName() ?></td>
  <td><?= $application->getAppliedDosage() ?></td>
  <td><?= $application->getApplyTime() ?></td>
  <?php if ($application->isApproved()): ?>
    <td><?= $application->getApproval()->getApprovedByName() ?></td>
    <td><?= $application->getApproval()->getApprovedDosage() ?></td>
    <td><?= $application->getApproval()->getApproveTime() ?></td>
  <?php else: ?>
    <td colspan="3">
      <button type="button" class="btn btn-small btn-success" onclick="approve('<?= $application->getId() ?>',<?= $application->getAppliedDosage() ?>)">批准</button>
      <button type="button" class="btn btn-small btn-danger" onclick="reject('<?= $application->getId() ?>')">不批准</button>
    </td>
  <?php endif; ?>
</tr>
<?php endforeach; ?>
</table>
<?php
include __DIR__ . '/footer.php';
