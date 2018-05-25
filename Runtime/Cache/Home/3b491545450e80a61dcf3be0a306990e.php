<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('address_manage');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		<?php echo L('address_manage');?>		
	</h3>
</header>
		<div class="main change">			
				<ul>
					<li>
						<label><?php echo L('wallet_sign');?></label>
						<input type="text"placeholder="<?php echo L('wallet_sign_p');?>" id='name' value="<?php echo ($info["name"]); ?>">
					</li>
					<li>
						<label><?php echo L('wallet_address');?></label>
						<input type="text"placeholder="<?php echo L('wallet_address_p');?>" id='address' value="<?php echo ($info["address"]); ?>">
					</li>
				</ul>
				<p><em class="tips"><?php echo L('wallet_notice');?>:</em></p>
				<p class="tc">
					<button class="lhbg mod-btn" id='zcwallet'><?php echo L('submit');?></button>
				</p>			
		</div>
		
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
	$(function(){
		$('#zcwallet').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);
			var name = $('#name').val();
			var address = $('#address').val();
			if(name == ''){
				layer.msg("<?php echo L('wallet_sign_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(address == ''){
				layer.msg("<?php echo L('wallet_address_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			$.post("<?php echo U('finance/ajax_add_myzc_wallet');?>",{name:name,address:address,id:"<?php echo ($info["id"]); ?>"},function(data){
				if(data.info == 'success'){
					layer.msg(data.msg,{time:2000,icon:1},function(){
						location.href = "<?php echo U('finance/address');?>";
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