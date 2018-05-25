<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('transfer');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		<?php echo L('transfer');?>
	</h3>
</header>
		<div class="main transferAccounts">
			
				<ul class="real-item">					
					<li class="fix">
						<label><?php echo L('phone');?></label>
						<input type="text"placeholder="<?php echo L('duifang_phone_p');?>" id='phone'>
					</li>
				</ul>
				<div class="amount">
					<p><?php echo L('transfer_money');?></p>
					<p class="flex-box"><i ></i><input type="number"class="flex-1" id='money'></p>
					<p><?php echo L('keyong_money');?>: <span id='coin'><?php echo ($usercoin['lth']*1); ?></span></p>
				</div>
				<ul class="real-item">
					<li class="fix">
						<label><?php echo L('paypassword');?></label>
						<input type="password"placeholder="<?php echo L('paypassword_p');?>" id='password'>
					</li>
				</ul>
				<p class="tc"><button class="lhbg mod-btn" id='transfer'><?php echo L('submit');?></button></p>
			
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
	$(function(){
		$('#transfer').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);		
			var phone = $('#phone').val();
			var money = parseFloat($('#money').val());
			var password = $('#password').val();
			var coin = parseFloat($('#coin').text());
			if(phone == ''){
				layer.msg("<?php echo L('duifang_phone_p');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(password == ''){
				layer.msg("<?php echo L('paypassword_p');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(money == '' || isNaN(money) || money <=0 || money > coin){
				layer.msg("<?php echo L('transfer_money_error');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			$.post("<?php echo U('finance/ajax_transfer');?>",{phone:phone,money:money,password:password},function(data){
				if(data.info =='success'){
					layer.msg(data.msg,{time:2000,icon:1},function(){
						location.reload();
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