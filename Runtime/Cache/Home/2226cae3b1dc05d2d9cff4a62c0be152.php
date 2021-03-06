<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('login');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<div class="main login">
			<h3 class="tc"><?php echo L('login');?></h3>
			<p class="tc loglo">
				<img src="<?php echo (PUB_IMG); ?>log.png" alt="">
			</p>
			
				<ul>
					<li>
						<input type="text"placeholder="<?php echo L('phone');?>" id="phone">
					</li>
					<li>
						<input type="text"placeholder="<?php echo L('sms');?>" id="sms">
						<span class="flex-1 code"><?php echo L('sms_get');?></span>
					</li>
				</ul>
				
				<p class="tc"><button class="lhbh mod-btn" id='login_phone'><?php echo L('login');?></button></p>
			
			<p class="ovh lolink">
				<a href="<?php echo U('login/password');?>" class="fl"><?php echo L('use_password');?></a>
				<a href="<?php echo U('login/register');?>" class="fr"><?php echo L('register');?></a>
			</p>
			
		</div>
		
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
		function hasClass(element, cls) {
			return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
		}
		var wait=120;//60s验证码
		var t;
		function time(o) {
			if (wait == 0) {
				o.removeAttribute("class", "");   
				o.innerText="<?php echo L('sms_get');?>";
				wait = 120;
				} else {
					o.setAttribute("class", "disabled");
					o.innerText="<?php echo L('sms_get_again');?>(" + wait + "s)";
					wait--;
					t = setTimeout(function() {
						time(o)
					},
					1000)
			}
		}
		window.onload = function(){
			var agree = document.getElementById('agree'),
				agrI = agree.getElementsByTagName('i')[0];				
				agrI.onclick = function(){
					if(hasClass(agrI,'active')){
						this.className = '';
					}else{
						this.className = 'active';
					}
				}
			
				$('.hided').click(function(){
					var inval = $(this).siblings('input').val();
					if($(this).parent().hasClass('active')){
						$(this).siblings('input').detach();
						$(this).before('<input type="text"  value="'+ inval +'">');
						$(this).parent().removeClass('active');
					}else{
						$(this).parent().addClass('active');
						$(this).siblings('input').detach();
						$(this).before('<input type="password" value="'+ inval +'">');
					}
			});
		}
	</script>
	
<script>
$(function(){
	$('.code').click(function(){
		var phone = $('#phone').val();
		if(phone == ''){
			layer.msg("<?php echo L('phone_set_empty');?>",{time:2000,icon:5});
			return false;
		}
		time(this);
		var obj = $(this);
		$.post("<?php echo U('login/ajax_send_sms_login');?>",{phone:phone},function(data){
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
	
	$('#login_phone').click(function(){
		var obj = $(this);
		obj.prop('disabled',true);
		var phone = $('#phone').val();
		var sms = $('#sms').val();
		
		
		if(phone == ''){
			layer.msg("<?php echo L('phone_set_empty');?>",{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		if(sms == ''){
			layer.msg("<?php echo L('sms_set_empty');?>",{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		
		
		$.post("<?php echo U('login/ajax_login_phone');?>",{phone:phone,sms:sms},function(data){
			if(data.info == 'success'){
				layer.msg(data.msg,{time:2000,icon:1},function(){
					var url = "<?php echo U('user/index');?>";
					location.href = url;
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