<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('user_title');?>-<?php echo L('phone_h3');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		<?php echo L('phone_h3');?>
	</h3>
</header>
		<div class="main bindingPhone">
			<p class="tips"><?php echo L('phone_text');?></p>
			
				<ul>
					<li>
						<label><?php echo L('phone_old');?></label>
						<input type="text"value="<?php echo (session('phone')); ?>" readonly>
					</li>
					<li>
						<label><?php echo L('phone_new');?></label>
						<input type="text"placeholder="<?php echo L('phone_new');?>" id='newphone'>
					</li>
					<li>
						<label><?php echo L('sms');?></label>
						<input type="text"placeholder="<?php echo L('sms_p');?>" id='sms'>
						<span id="code"><?php echo L('sms_get');?></span>
					</li>
				</ul>
				<p class="tc"><button class="lhbg mod-btn" id='change'><?php echo L('submit');?></button></p>
			

		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
		var wait=60;//60s验证码
		var t;
		function time(o) {
			if (wait == 0) {
				o.removeAttribute("class", "");   
				o.innerText="<?php echo L('sms_get');?>";
				wait = 60;
				} else {
					o.setAttribute("class", "disabled");
					o.innerText="<?php echo L('sms_get_again');?>(" + wait + "s)";
					wait--;
					t=setTimeout(function() {
						time(o)
					},
					1000)
			}
		}
		
	</script>
	<script>
	$(function(){
		$('#code').click(function(){
			var phone = $('#newphone').val();
			if(phone == ''){
				layer.msg("<?php echo L('newpassword_set_empty');?>",{time:2000,icon:5});
				return false;
			}
			time(this);
			var obj = $(this);
			$.post("<?php echo U('user/ajax_send_sms');?>",{phone:phone},function(data){
				if(data.info == 'success'){				
					layer.msg(data.msg,{time:2000,icon:1})
				}else{			
					clearTimeout(t);
					obj.text("<?php echo L('sms_get');?>");
					obj.removeClass('disabled');	
					layer.msg(data.msg,{time:2000,icon:5});
								
				}
			},'json')
		})
		$('#change').click(function(){
			var obj = $(this);
			var phone = $('#newphone').val();
			var sms = $('#sms').val();
			if(phone == ''){
				layer.msg("<?php echo L('newpassword_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(sms == ''){
				layer.msg("<?php echo L('sms_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			$.post("<?php echo U('user/ajax_change_phone');?>",{phone:phone,sms:sms},function(data){
				if(data.info == 'success'){				
					layer.msg(data.msg,{time:2000,icon:1},function(){
						location.reload();
					})
				}else{
					layer.msg(data.msg,{time:2000,icon:5});
					obj.prop('disabled',false);			
				}
			},'json')
		})
	})
	</script>
	
</html>