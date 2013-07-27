</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
jQuery(function($) {
  $('div.btn-group[data-toggle-name]').each(function(){
    var group   = $(this);
    var form    = group.parents('form').eq(0);
    var name    = group.attr('data-toggle-name');
    var hidden  = $('input[name="' + name + '"]', form);
    $('button', group).each(function(){
      var button = $(this);
      button.click(function(){
        hidden.val($(this).val());
      });
      if (button.val() === hidden.val()) {
        button.addClass('active');
      }
    });
  });
});

// 编辑药品
function updateDrug(id, name, inventory, toxicity) {
  $('#ud_inputId').val(id);
  $('#ud_inputName').val(name);
  $('#ud_inputInventory').val(inventory);
  $('#ud_inputToxicity').val(toxicity);
  $('#ud_toxicity' + toxicity).click();
  $('#updateDrug').modal();
}

// 增加药品库存
function addDrug(id) {
	var addInventory = prompt('(#' + id + ') 请输入增加的库存数量：', 10);
	if (addInventory !== null) {
    jQuery.post('add-drug.php', {
      id: id,
      inventory: addInventory
    }, function(result){
      if (result && result.status && result.status === 'ok') {
        // 成功
        window.location.reload();
      }
      else {
        // 失败
        if (result.reason) {
          alert(result.reason);
        }
        else {
          alert('增加库存失败（未知错误）');
        }
      }
    }, 'json');
	}
}

// 删除药品
function deleteDrug(id) {
	if (confirm('(#' + id + ') 确定要删除该药品吗？')) {
    jQuery.post('delete-drug.php', {
      id: id
    }, function(result){
      if (result && result.status && result.status === 'ok') {
        // 成功
        window.location.reload();
      }
      else {
        // 失败
        if (result.reason) {
          alert(result.reason);
        }
        else {
          alert('删除药品失败（未知错误）');
        }
      }
    }, 'json');
	}
}

// 批准使用申请
function approve(id, appliedDosage) {
	var approvedDosage = prompt('(#' + id + ') 请输入批准用量：', appliedDosage);
	if (approvedDosage !== null) {
    jQuery.post('update-application.php', {
      application_id: id,
      approved_dosage: approvedDosage
    }, function(result){
      if (result && result.status && result.status === 'ok') {
        // 成功
        window.location.reload();
      }
      else {
        // 失败
        if (result.reason) {
          alert(result.reason);
        }
        else {
          alert('批准使用申请失败（未知错误）');
        }
      }
    }, 'json');
	}
}

// 拒绝使用申请
function reject(id) {
	if (confirm('(#' + id + ') 确定要拒绝此申请吗？')) {
    jQuery.post('update-application.php', {
      application_id: id,
      approved_dosage: 0
    }, function(result){
      if (result && result.status && result.status === 'ok') {
        // 成功
        window.location.reload();
      }
      else {
        // 失败
        if (result.reason) {
          alert(result.reason);
        }
        else {
          alert('拒绝使用申请失败（未知错误）');
        }
      }
    }, 'json');
	}
}
</script>
</body>
</html>
