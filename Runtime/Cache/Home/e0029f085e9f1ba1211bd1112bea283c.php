<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>转账</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		账户转账
	</h3>
</header>
		<div class="main transferAccounts">
			
				<ul class="real-item">					
					<li class="fix">
						<label>手机号码</label>
						<input type="text"placeholder="请输入对方手机号码" id='phone'>
					</li>
				</ul>
				<div class="amount">
					<p>转账金额</p>
					<p class="flex-box"><i ></i><input type="number"class="flex-1" id='money'></p>
					<p>可用余额: <span id='coin'><?php echo ($usercoin['lth']*1); ?></span>
					 手续费:<span id='fee' style="margin-left:15px;">0.00</span>
					</p>
				</div>
				<ul class="real-item">
					<li class="fix">
						<label>交易密码</label>
						<input type="password"placeholder="请输入交易密码" id='password'>
					</li>
				</ul>
				<p class="tc"><button class="lhbg mod-btn" id='transfer'>确认转账</button></p>
			
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
				layer.msg('请填写对方手机号',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(password == ''){
				layer.msg('请填写交易密码',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(money == '' || isNaN(money) || money <=0 || money > coin){
				layer.msg('转出金额不正确',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}obj.prop('disabled',false);
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
		
		//
		var fee = <?php echo ($fee); ?>;
		$('#money').keyup(function(){
			var money = $(this).val();	
			if(isNaN(money) || money == ''){
				$('#fee').text('0.00');
				return false;
			}
			zfee = parseFloat(money) * fee ;
			$('#fee').text(zfee.toFixed(2));
		})
	})
	</script>
</html>