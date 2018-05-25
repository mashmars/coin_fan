<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('user_title');?>-<?php echo L('password_h3');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		<?php echo L('password_h3');?>
	</h3>
</header>
		<div class="main passwordManagement">
			<p class="tips"><?php echo L('password_text');?></p>
			<div class="pwd-box">
				<ul class="ovh tc" id="pwdNav">
					<li class="active"><?php echo L('password_login');?></li>
					<li><?php echo L('paypassword');?></li>
				</ul>
				<div class="pwd-con"id="pwdCon">
					<div class="pwd-item"style="display: block;">
						<ul>
							
							<li>
								<label><?php echo L('newpassword');?></label>
								<input type="password"placeholder="<?php echo L('newpassword_p');?>" id='newpassword'>
							</li>
							<li>
								<label><?php echo L('newpassword2');?></label>
								<input type="password"placeholder="<?php echo L('newpassword2_p');?>" id='newpassword2'>
							</li>
							<li>
								<label><?php echo L('sms');?></label>
								<input type="text"placeholder="<?php echo L('sms_p');?>" id='sms1'>
								<span id="code1"><?php echo L('sms_get');?></span>
							</li>
						</ul>
						<p class="tc">
							<button class="lhbg mod-btn" id="password_confirm"><?php echo L('submit');?></button>
						</p>
					</div>
					<div class="pwd-item">
						<ul>
							
							<li>
								<label><?php echo L('newpassword');?></label>
								<input type="password"placeholder="<?php echo L('newpassword_pay_p');?>" id="newpaypassword">
							</li>
							<li>
								<label><?php echo L('newpassword2');?></label>
								<input type="password"placeholder="<?php echo L('newpassword2_pay_p');?>" id="newpaypassword2">
							</li>
							<li>
								<label><?php echo L('sms');?></label>
								<input type="text"placeholder="<?php echo L('sms_p');?>" id='sms'>
								<span id="code"><?php echo L('sms_get');?></span>
							</li>
						</ul>
						<p class="tc">
							<button class="lhbg mod-btn" id="paypassword_confirm"><?php echo L('submit');?></button>
						</p>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
		window.onload = function(){
			var pwdNav = document.getElementById('pwdNav'),
				pLi = pwdNav.getElementsByTagName('li'),
				pwdCon = document.getElementById('pwdCon'),
				pwdItem = pwdCon.getElementsByClassName('pwd-item');
				for(var i=0;i<pLi.length;i++){
					pLi[i].index=i;
					pLi[i].onclick=function (){
						for(var i=0;i<pLi.length;i++){
							pLi[i].className = '';
							pwdItem[i].style.display = 'none';
						}
						this.className ='active';
						pwdItem[this.index].style.display='block';
					}
			}

		}
	</script>
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
			
			time(this);
			var obj = $(this);
			$.post("<?php echo U('user/ajax_paypassword_send_sms');?>",'',function(data){
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
		$('#code1').click(function(){
			
			time(this);
			var obj = $(this);
			$.post("<?php echo U('user/ajax_password_send_sms');?>",'',function(data){
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
		$('#password_confirm').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);
			var sms = $('#sms1').val();
			var newpassword  = $('#newpassword').val();
			var newpassword2 = $('#newpassword2').val();
			
			if(newpassword == ''){
				layer.msg("<?php echo L('newpassword_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(newpassword2 == ''){
				layer.msg("<?php echo L('newpassword2_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(newpassword != newpassword2){
				layer.msg("<?php echo L('newpassword2_set_noequal');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(sms == ''){
				layer.msg("<?php echo L('sms_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			$.post("<?php echo U('user/ajax_password');?>",{newpassword:newpassword,newpassword2:newpassword2,sms:sms},function(data){
				if(data.info == 'success'){
					layer.msg(data.msg,{time:2000,icon:1},function(){
						location.reload();
					});
				}else{
					layer.msg(data.msg,{time:2000,icon:5});
					obj.prop('disabled',false);
				}
			},'json')
		})
		$('#paypassword_confirm').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);
			
			var newpassword  = $('#newpaypassword').val();
			var newpassword2 = $('#newpaypassword2').val();
			var sms = $('#sms').val();
			
			if(newpassword == ''){
				layer.msg("<?php echo L('newpassword_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(newpassword2 == ''){
				layer.msg("<?php echo L('newpassword2_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(newpassword != newpassword2){
				layer.msg("<?php echo L('newpassword2_set_noequal');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(sms == ''){
				layer.msg("<?php echo L('sms_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			$.post("<?php echo U('user/ajax_paypassword');?>",{newpassword:newpassword,newpassword2:newpassword2,sms:sms},function(data){
				if(data.info == 'success'){
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