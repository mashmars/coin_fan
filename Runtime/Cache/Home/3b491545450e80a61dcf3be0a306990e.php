<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>添加转出钱包</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		添加转出钱包		
	</h3>
</header>
		<div class="main change">			
				<ul>
					<li>
						<label>钱包标识</label>
						<input type="text"placeholder="请输入钱包标识" id='name'>
					</li>
					<li>
						<label>钱包地址</label>
						<input type="text"placeholder="请输入钱包" id='address'>
					</li>
				</ul>
				<p><em class="tips">友情提示：</em></p>
				<p class="tc">
					<button class="lhbg mod-btn" id='zcwallet'>确定</button>
				</p>			
		</div>
		
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script>
	$(function(){
		$('#zcwallet').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);
			var name = $('#name').val();
			var address = $('#address').val();
			if(name == ''){
				layer.msg('钱包标识不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(address == ''){
				layer.msg('钱包地址不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			$.post("<?php echo U('finance/ajax_add_myzc_wallet');?>",{name:name,address:address},function(data){
				if(data.info == 'success'){
					layer.msg(data.msg,{time:2000,icon:1},function(){
						location.href = "<?php echo U('finance/myzc');?>";
					});
				}else{
					layer.msg(data.msg,{time:2000,icon:5});
					obj.prop('disabled',false);
				}
			},'json')
		})
	})
	</script>
</html>