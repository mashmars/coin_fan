<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>密码登录</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<div class="main login">
			<h3 class="tc">登录</h3>
			<p class="tc loglo">
				<img src="<?php echo (PUB_IMG); ?>log.png" alt="">
			</p>
			
				<ul>
					<li>
						<input type="text"placeholder="手机号" id='phone'>
					</li>
					<li>
						<input type="password"placeholder="密码" id="password">
						<!--<i class="hided"></i>-->
					</li>
				</ul>
				<p class="tr forget"><a href="<?php echo U('login/findpassword');?>">忘记密码？</a></p>
				<p class="agreement"id="agree">
					<i class="active"></i>
					<span>注册表示您已阅读并同意</span>
					<a href="#">《矿产链用户注册协议》</a>
				</p>
				<p class="tc"><button class="lhbh mod-btn" id='login_password'>登录</button></p>
			
			<p class="ovh lolink">
				<a href="<?php echo U('login/phone');?>" class="fl">使用验证码登录</a>
				<a href="<?php echo U('login/register');?>" class="fr">注册新账号</a>
			</p>
			
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
		$('.hided').click(function(){
			var inval = $(this).siblings('input').val();
				if($(this).parent().hasClass('active')){
					$(this).siblings('input').detach();
					$(this).before('<input type="text" value="'+ inval +'"placeholder="密码">');
					$(this).parent().removeClass('active');
				}else{
					$(this).parent().addClass('active');
					$(this).siblings('input').detach();
					$(this).before('<input type="password" value="'+ inval +'"placeholder="密码">');
				}
			});
		function hasClass(element, cls) {
			return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
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
		$('#login_password').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);
			var phone = $('#phone').val();
			var password = $('#password').val();
			
			var agree = $('#agree i').hasClass('active');
			if(!agree){
				layer.msg('请阅读并同意协议',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(phone == ''){
				layer.msg('手机号不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(password == ''){
				layer.msg('登录密码不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			
			
			$.post("<?php echo U('login/ajax_login_password');?>",{phone:phone,password:password},function(data){
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